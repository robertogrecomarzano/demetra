<?php
namespace App\Core\Lib;

use Smarty;
use App\Components\Menu;
use App\Core\App;
use App\Core\Framework;
use App\Core\Config;
use App\Core\User;

/**
 * Classe per la gestione delle pagine
 */
class Page
{

    private static $instance;

    private $dump = "";

    public static $read = true;

    public static $write = true;

    public static $add = true;

    public static $delete = true;

    public static $wizard = array();

    public $token;

    /**
     * $sqlError
     */
    public static $sqlError = "";

    /**
     * variabile usata per i template
     */
    public $tpl;

    /**
     *
     * Id stringa (alias) della pagina
     *
     * @var string
     */
    public $alias;

    /**
     *
     * @var string
     */
    public $title;

    /**
     *
     * @var string
     */
    public $subTitle;

    /**
     *
     * @var string
     */
    public $pageLabel;

    /**
     * Contenuto principale della pagina (nel template viene assegnato al
     * tag "$mainContent")
     *
     * @var string
     */
    public $content = "";

    /**
     *
     * @var string
     */
    public $template = "";

    public $view = "";

    public $templateExport = "";

    public $logoCustom = "";

    /**
     * Array di errori, a loro volta array associativi del tipo
     * array("msg"=>"alias del messaggio di errore",
     * "args"=>array di variabili da passare)
     *
     * @var array
     */
    public $errors = array();

    /**
     * Array di messages, a loro volta array associativi del tipo
     * array("msg"=>"alias del messaggio di warning",
     * "args"=>array di variabili da passare)
     *
     * @var array
     */
    public $messages = array();

    /**
     * Array di info, a loro volta array associativi del tipo
     * array("msg"=>"alias del messaggio di info",
     * "args"=>array di variabili da passare)
     *
     * @var array
     */
    public $info = array();

    /**
     * Array di warnings, a loro volta array associativi del tipo
     * array("msg"=>"alias del messaggio di warning",
     * "args"=>array di variabili da passare)
     *
     * @var array
     */
    public $warnings = array();

    /**
     *
     * @var CSS
     */
    public $css;

    /**
     *
     * @var string
     */
    public $varie;

    /**
     * Assigns (variabili dinamiche da sostituire nel template)
     *
     * @var array
     */
    public $assigns = array();

    /**
     *
     * @return Page
     */
    public static function getInstance()
    {
        if (self::$instance == null) {
            $className = __CLASS__;
            self::$instance = new $className();
        }
        return self::$instance;
    }

    public function setCurrentAlias($alias)
    {
        $this->alias = $alias;
    }

    /**
     * Aggiunge un messaggio di "errore"
     *
     * @param string $msg
     */
    public function addError($msg)
    {
        $this->errors[] = $msg;
    }

    /**
     * Aggiunge un messaggio di "successo"
     *
     * @param string $msg
     */
    public function addMessages($msg)
    {
        $this->messages[] = $msg;
    }

    /**
     * Aggiunge un messaggio di "info"
     *
     * @param string $msg
     */
    public function addInfo($msg)
    {
        $this->info[] = $msg;
    }

    /**
     * Aggiunge un messaggio di "warning"
     *
     * @param string $msg
     */
    public function addWarning($msg)
    {
        $this->warnings[] = $msg;
    }

    /**
     * Carica un plugin dal filesystem e lo include nel codice se viene
     * trovato nella cartella apposita
     *
     * @param string $pluginName
     *            Nome del plugin (e della classe)
     */
    private function loadPlugin($pluginName)
    {
        $path = Framework::getPluginFolder($pluginName) . DS . "$pluginName.php";

        if (file_exists($path))
            return include ($path);
        else {
            $this->addError("ERROR_PLUGIN_FOLDER_MISSING", array(
                $pluginName
            ));
        }
    }

    /**
     * Ottiene l'URL della pagina a partire dal suo Id
     *
     * @param string $id
     * @return string
     */
    static function getURLStatic($alias)
    {
        $p = new Page($alias);
        return $p->getURL();
    }

    /**
     * Ottiene il path della pagina a partire dal suo Id
     *
     * @param string $id
     * @return string
     */
    static function getPathStatic($alias)
    {
        $p = new Page($alias);
        return $p->getPath();
    }

    /**
     * Funzione per il redirect.
     *
     * @param string $alias
     * @param string $restResto
     *            dell'indirizzo (parametri e querystring), es. "/4", "/34?param=value"
     */
    static function redirect($alias, $rest = "", $post = false, $msg = null, $class = "success")
    {
        $page = Page::getInstance();
        if ($post) {
            $_SESSION["redirect"]["post"] = true;
            $_SESSION["redirect"]["msg"] = $msg;
            $_SESSION["redirect"]["class"] = $class;
        }

        $rest = (! empty($rest)) ? "?param=$rest" : "?fp=" . $page->alias;
        $url = Page::getURLStatic($alias) . $rest;
        header("Location: " . $url);
        die();
    }

    /**
     * Ritorna l'id della pagina
     *
     * @return int
     */
    static function getId()
    {
        return isset($_GET['id']) ? $_GET['id'] : 0;
    }

    /**
     * Crea un nuovo plugin e ne restituisce un'istanza.
     *
     * @param string $name
     *            Nome del Plugin da creare
     * @param array $args
     *            Argomenti da passare al costruttore
     * @return Plugin
     */
    private function newPlugin($name, $args)
    {
        if (! $this->loadPlugin($name))
            return false;

        $class = "App\\Components\\$name";
        if (! class_exists($class)) {
            $this->addError("ERROR_PLUGIN_CLASS_NOT_FOUND", array(
                $name
            ));

            return false;
        }

        $refl = new \ReflectionClass($class);
        $plugin = $refl->newInstanceArgs($args);
        if (! ($plugin instanceof Plugin)) {
            $this->addError("ERROR_CLASS_NOT_PLUGIN_INSTANCE", array(
                $name
            ));
            return false;
        }
        return $plugin;
    }

    /**
     * Utilizza il plugin di nome $name, con i suoi file JS e CSS,
     * nella pagina
     *
     * @param string $name
     *            Nome del plugin (e della sua classe PHP)
     * @return mixed Oggetto di classe $name (eredita dalla classe Plugin)
     */
    function addPlugin($name)
    {
        $args = func_get_args();
        array_shift($args);
        $plugin = $this->newPlugin($name, $args);
        if (isset($plugin->scripts)) {
            foreach ($plugin->scripts as $s) {
                $serverJS = $plugin->serverFolder() . DS . "js" . DS . $s;
                $webJS = $plugin->webFolder() . "/js/" . $s;
                if (file_exists($serverJS)) {
                    $this->css->addJS($webJS, $serverJS);
                }
            }
        }
        if (isset($plugin->css)) {
            foreach ($plugin->css as $s) {
                $serverCSS = $plugin->serverFolder() . DS . "css" . DS . $s;
                $webCSS = $plugin->webFolder() . "/css/" . $s;
                if (file_exists($serverCSS)) {
                    $this->css->addCSS($webCSS, $serverCSS);
                }
            }
        }
        $plugin->callerPage = $this;
        $plugin->init();
        return $plugin;
    }

    /**
     * Cartella della pagina
     *
     * @return string
     */
    function serverFolder()
    {
        return Config::$serverRoot . DS . "pages" . DS . $this->alias;
    }

    /**
     * URL della pagina
     *
     * @return string
     */
    function webFolder()
    {
        if (str_ends_with($page->alias, "/create"))
            $this->alias = preg_replace('#\/[^/]*$#', '', $this->alias);

        return Config::$urlRoot . "/pages/" . $this->alias;
    }

    /**
     * Fornisce l'URL da utilizzare per puntare alla pagina.
     * Utile per link menu, e tutti gli altro link interni del sito.
     * Di default corrisponde a webFolder() perché è parsato
     * da .htaccess, se cambiano le regole di .htaccess o esso
     * viene eliminato, si può adattare la funzione di conseguenza,
     * adattando anche la funzione webFolder()
     *
     * @return string
     */
    function getURL()
    {
        return Config::$urlRoot . "/" . $this->alias;
    }

    function getPath()
    {
        if (str_ends_with($page->alias, "/create"))
            $this->alias = preg_replace('#\/[^/]*$#', '', $this->alias);

        return Config::$serverRoot . DS . "pages" . DS . $this->alias;
    }

    /**
     *
     * @return string
     */
    function getTemplateServerPath($template = null)
    {
        if (empty($template))
            $template = $this->view;
        $tplPath = $this->serverFolder() . DS . "templates" . DS . $template . ".tpl";
        return $tplPath;
    }

    /**
     * Recupera il template della pagina in oggetto
     *
     * @return Smarty Template
     */
    function fetchTemplate()
    {
        $tplPath = $this->getTemplateServerPath();
        if (file_exists($tplPath)) {
            return $tplPath;
        } else {
            $args = array(
                $this->alias,
                $tplPath
            );
            $this->addError("ERROR_PAGE_TEMPLATE_NOT_FOUND", $args);
            return false;
        }
    }

    /**
     * Setta i titoli della pagina
     *
     * @param string $title
     * @param string $subTitle
     * @param string $preTitle
     *            da implementare
     */
    function setTitle($title, $subTitle = "", $preTitle = "")
    {
        $this->title = $title;
        $this->subTitle = $subTitle;
        $this->preTitle = $preTitle;
    }

    /**
     * Cartella in cui Smarty crea le versioni già compilate dei template
     *
     * @return string
     */
    public function getTemplateCompileDir()
    {
        return Config::$serverRoot . DS . "cache" . DS . "templates_c";
    }

    /**
     * Crea un oggetto Page
     *
     * @param string $alias
     *            Alias della pagina
     */
    function __construct($alias = "")
    {
        if (! isset($alias) || empty($alias))
            $alias = "home";
        $this->alias = $alias;
        $this->css = new Css();
        $this->registerPlugin();
    }

    /**
     * Imposta i titoli e le etichette della pagina.
     * Cerca nei seguenti
     * tag XML:
     * <label> etichetta da usare nel menu
     * <desc> descrizione ("sottotitolo") della pagina
     * <pagelabel> titolo della pagina, se assente usa <label>
     *
     * @param string $alias
     *            Alias della pagina
     */
    function setTitles($alias)
    {
        $label = Menu::getNodeSub("label", $alias);
        $desc = Menu::getNodeSub("desc", $alias);
        $pagelabel = Menu::getNodeSub("pagelabel", $alias);

        $this->title = $label;
        $this->subTitle = $desc;
        $this->pageLabel = $pagelabel;
    }

    /**
     * Renderizza gli alerts comunicati alla pagina con
     * addError() e addWarning().
     * Funzione generica, genera
     * un alert di tipo diverso a seconda della classe CSS
     * comunicata.
     *
     * @param array $alerts
     * @param string $class
     * @return string
     */
    private function renderAlerts($alerts, $class = "alert alert-danger")
    {
        $out = "";

        $testi = array();
        if (count($alerts) > 0) {
            foreach ($alerts as $e) {
                $trimmed = trim($e);
                if (! empty($trimmed))
                    $testi[] = $trimmed;
            }
        }
        if (empty($testi))
            return $out;

        $testi = array_unique($testi);

        if (count($testi) == 1) {

            $testo = $testi[0];
            $testoTrimmed = trim($testo);
            if (! empty($testoTrimmed))
                $out = $testo;
        } elseif (count($testi) > 0) {
            $out = "<ul>";
            foreach ($testi as $testo) {
                $testoTrimmed = trim($testo);
                if (! empty($testoTrimmed))
                    $out .= "<li>$testo</li>";
            }
            $out .= "</ul>";
        }

        return HTML::tag("div", [
            "class" => $class
        ], $out);
    }

    /**
     * Assigns per il template (usato specialmente nel codice delle
     * pagine per dinamicizzare le variabili dei template Smarty).
     * Accetta assign stringa (chiave/valore), o un array con una
     * serie di chiavi/valori
     *
     * @param string/array $assign1
     * @param string $assign2
     */
    function assign($assign1, $assign2 = NULL)
    {
        $this->assigns[$assign1] = $assign2;
    }

    /**
     * Renderizza la pagina, riempiendo i vari moduli del layout con i valori
     * presi da $modules, e restituendo la stringa del layout già riempito.
     * I valore assegnabili a $modules sono liberi, per permettere l'utilizzo
     * futuro di layout differenti, solo il modulo "mainContent" deve rimanere
     * fisso.
     *
     * @param array $modules
     *            Array key/value dei moduli del layout da riempire
     * @return string Stringa della pagina renderizzata
     */
    function render(array $modules = NULL)
    {
        $this->token = Security::htmlCSRFToken(Security::getAndStoreCSRFToken());

        if (! empty(Page::$sqlError))
            $this->errors[] = array(
                "msg" => Page::$sqlError,
                "args" => array()
            );

        // $content = $this->fetchTemplate();

        $view = $this->fetchTemplate();

        if (! file_exists($view) && ! empty($view))
            header("Location: " . Config::$urlRoot . "/404?msg=Template non trovato $view");

        $errors = $this->renderAlerts($this->errors, "alert alert-danger");
        $warnings = $this->renderAlerts($this->warnings, "alert alert-warning");
        $messages = $this->renderAlerts($this->messages, "alert alert-success");
        $info = $this->renderAlerts($this->info, "alert alert-info");

        $js = $this->css->getScripts();
        $css = $this->css->getCSS();

        $userSimulationSuper = App::userSimulationSuperUserHtml();
        $userSimulationProfilo = App::userSimulationUserProfiloHtml();
        $welcome = isset($_SESSION['user']);

        $iniziali = null;

        $user = User::getUserData(User::getLoggedUserId());

        $nominativo = $user["cognome"] . " " . $user["nome"];
        explode(" ", $nominativo);
        foreach (explode(" ", $nominativo) as $w)
            $iniziali .= strtoupper($w[0]) . ".";

        $this->tpl->setCompileDir($this->getTemplateCompileDir());
        $this->tpl->assign($modules);

        $this->tpl->assign(array(
            "siteUrl" => Config::$urlRoot,
            "siteRoot" => Config::$serverRoot,
            "mainTemplates" => Config::$serverRoot . DS . "core" . DS . "templates",
            "templateCSSUrl" => Config::$urlRoot . "/core/templates/css",
            "templateJSUrl" => Config::$urlRoot . "/core/templates/js",
            "welcome" => $welcome,
            "login" => Page::getURLStatic("authentication/login"),
            "logout" => Page::getURLStatic("authentication/logout"),
            "css" => $css,
            "js" => $js,
            "mainContent" => $view,
            "pagina" => $view,
            "mainErrors" => $errors,
            "mainWarnings" => $warnings,
            "mainMessages" => $messages,
            "mainInfo" => $info,
            "userSimulationSuper" => $userSimulationSuper,
            "userSimulationProfilo" => $userSimulationProfilo,
            "userProfilo" => User::getLoggedUserGroup(),
            "userNominativo" => User::getLoggedUserNominativo(),
            "userId" => User::getLoggedUserId(),
            "userIniziali" => $iniziali . " ",
            "formToken" => $this->token,
            "alias" => $this->alias,
            "pageId" => $this->getId(),
            "templateExport" => $this->templateExport,
            "logo" => empty($this->logoCustom) ? "logo" : $this->logoCustom,
            "struttura" => Config::$config["denominazione"],
            "isDebug" => Config::$config["debug"],
            "isCollaudo" => Config::$config["collaudo"],
            "dump" => $this->dump
        ));

        $this->tpl->assign($this->assigns);

        return $this->tpl->fetch($this->template);
    }

    /**
     * Registrazione plugin
     */
    function registerPlugin()
    {
        $this->tpl = new Smarty();

        // Funzioni estensione smarty per forms
        $this->tpl->registerPlugin("function", "form_tbox", "App\Core\Lib\Form::textbox");
        $this->tpl->registerPlugin("function", "form_area", "App\Core\Lib\Form::textarea");
        $this->tpl->registerPlugin("function", "form_checks", "App\Core\Lib\Form::checks");
        $this->tpl->registerPlugin("function", "form_check", "App\Core\Lib\Form::check");
        $this->tpl->registerPlugin("function", "form_radios", "App\Core\Lib\Form::radios");
        $this->tpl->registerPlugin("function", "form_radio", "App\Core\Lib\Form::radio");
        $this->tpl->registerPlugin("function", "form_select", "App\Core\Lib\Form::select");
        $this->tpl->registerPlugin("function", "form_hidden", "App\Core\Lib\Form::hidden");
        $this->tpl->registerPlugin("function", "form_calendar", "App\Core\Lib\Form::calendar");
        $this->tpl->registerPlugin("function", "form_cf", "App\Core\Lib\Form::cf");

        $this->tpl->registerPlugin("function", "form_edit", "App\Core\Lib\Form::edit"); // form_mod / form_mod2
        $this->tpl->registerPlugin("function", "form_delete", "App\Core\Lib\Form::delete");
        $this->tpl->registerPlugin("function", "form_add", "App\Core\Lib\Form::add");
        $this->tpl->registerPlugin("function", "form_add2", "App\Core\Lib\Form::add2");
        $this->tpl->registerPlugin("function", "form_confirm", "App\Core\Lib\Form::confirm");
        $this->tpl->registerPlugin("function", "form_submit", "App\Core\Lib\Form::submit");
        $this->tpl->registerPlugin("function", "form_button", "App\Core\Lib\Form::button");
        $this->tpl->registerPlugin("function", "form_link", "App\Core\Lib\Form::link");
        $this->tpl->registerPlugin("function", "form_select_group", "App\Core\Lib\Form::selectGroup");
        $this->tpl->registerPlugin("function", "form_add_edit", "App\Core\Lib\Form::add_edit");
        $this->tpl->registerPlugin("function", "form_undo", "App\Core\Lib\Form::undo");
        $this->tpl->registerPlugin("function", "form_wizard", "App\Core\Lib\Form::wizard");

        $this->tpl->registerPlugin("function", "form_closing", "App\Core\Lib\Form::form_close");
        $this->tpl->registerPlugin("function", "form_opening", "App\Core\Lib\Form::form_open");
        $this->tpl->registerPlugin("function", "form_table", "App\Core\Lib\Form::form_table");

        $this->tpl->registerPlugin("function", "form_show_dropdown", "App\Core\Lib\Form::show_dropdown");
        $this->tpl->registerPlugin("function", "form_edit_dropdown", "App\Core\Lib\Form::edit_dropdown");
        $this->tpl->registerPlugin("function", "form_create_dropdown", "App\Core\Lib\Form::create_dropdown");

        $this->tpl->registerPlugin("function", "form_lang", "App\Core\Lib\Form::translate");
    }

    function dump($object)
    {
        if (! Config::$config["is_debug"])
            return null;
        
        $callers = debug_backtrace();
        $errore = "<br />" . $callers[0]["file"] . " linea " . $callers[0]["line"];
        ob_start();
        $dump = Debug::var_dump($object);
        $content = ob_get_contents();
        ob_end_clean();
        $this->dump = $errore . $dump . $content;
    }
}
