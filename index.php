<?php
error_reporting(E_ALL & ~ E_DEPRECATED & ~ E_WARNING & ~ E_NOTICE);

require 'vendor/autoload.php';

require_once "core/database.php";
require_once "core/Ipermissions.php";
require_once "core/imenu.interface.php";
require_once "core/minify.urirewriter.class.php";
require_once "core/jsmin.class.php";

use App\Components\Menu;
use App\Core\Config;
use App\Core\User;
use App\Core\Lib\Language;
use App\Core\Lib\Page;
use App\Core\Lib\Security;
use App\Core\Lib\Servizi;
use Melbahja\Environ\Environ;
use App\Core\App;

if (empty(Environ::get('APP_KEY'))) {
    $key = App::createRandomString(40);
    Environ::set("APP_KEY", $key);
    $path = '.env';
    if (file_exists($path))
        file_put_contents($path, str_replace('APP_KEY = ""', 'APP_KEY = "' . $key . '"', file_get_contents($path)));
}

if (! defined('DS'))
    define('DS', DIRECTORY_SEPARATOR);

Language::setCurrentLocale(Config::$defaultLocale); // da togliere se prevista i18n e l10n
date_default_timezone_set("Europe/Rome");

$tmp_dir = Config::$serverRoot . DS . "tmp";
if (! file_exists($tmp_dir))
    mkdir($tmp_dir, 077, true);
session_save_path($tmp_dir);
session_start();
date_default_timezone_set('Europe/Rome');

if ($_POST)
    Security::checkCSRFToken();

$pg = ! empty($_GET['page']) ? $_GET['page'] : "authentication/login";
$id = isset($_GET['id']) ? $_GET['id'] : 0;

// Creazione oggetto pagina
$page = Page::getInstance();
$page->setCurrentAlias($pg);

/**
 * Plugin comuni a tutte le pagine
 */
$page->addPlugin("Menu");
$page->addPlugin("Forms");
$page->addPlugin("Helper");

/**
 * Inizializza la pagina
 */
App::initPage();

// Codice JS comune a tutti, fornisce URL codebase e traduzioni Js
$lang = Language::getCurrentLocale();
$page->css->addJSCode("var codebase=" . json_encode(Config::$urlRoot) . ";");
$page->css->addJSCode("var lang='" . $lang . "';");

// Carica parte statica del menu
// Il menù va caricato perima della chiamta ad App::checkRequest()
Menu::load();
User::createMenu(); // Personalizzo il menù in base al gruppo utente.

// Carico le voci di menù, relative ai soli servizi per cui è abilitato l'utente
$servizi = Servizi::getServizi();
if (count($servizi) > 0)
    foreach ($servizi as $s)
        Menu::addClassHook($s['servizio']);
Menu::callHooks(); // processa le voci di menu dinamiche delle classi
Menu::createURLs(); // crea gli URL a partire dagli id

$alias = $pg;
$id = $page->getId();
if (! empty($id))
    $alias .= "/" . $id;

/**
 * Gestione route
 */
App::checkRequest();
$page->setTitles($pg); // imposta i titoli
Menu::setActive($alias); // imposta pagina corrente nel menu

$mainTemplateDir = Config::$serverRoot . DS . "core" . DS . "templates";
$jsFile = $page->serverFolder() . DS . "page.js";
$cssFile = $page->serverFolder() . DS . "templates" . DS . "main.css";
# $page->css->addJS(Config::$urlRoot . DS . "core" . DS . "templates" . DS . "js" . DS . "template-script.js", $mainTemplateDir . DS . "js" . DS . "template-script.js");

if (empty($page->template))
    $page->template = $mainTemplateDir . DS . "main.tpl";

// inclusione del file js della pagina
if (file_exists($jsFile))
    $page->css->addJS($page->webFolder() . "/page.js", $jsFile);

// inclusione del file css della pagina
if (file_exists($cssFile))
    $page->css->addCSS($page->webFolder() . "/templates/main.css", $cssFile);

/**
 * Creazione menù laterale/bread con le voci aggiunte dai vari servizi
 */
#$breadMenu = Menu::styleMenu("bread");
$mainMenu = Menu::styleMenu("left");

$modules = array(
    "title" => Config::$config["denominazione"],
    "tecnico" => $page->tecnico,
    "contentTitle" => $page->title,
    "contentSubTitle" => $page->subTitle,
    "pageLabel" => $page->pageLabel,
    "left" => $mainMenu,
    #"bread" => $breadMenu,
    "lang" => substr($lang, 0, 2),
    "lang_country" => $lang,
    "direction" => $lang == "ar_AR" ? "rtl" : ""
);

if (isset($_SESSION["redirect"])) {
    $message = ! empty($_SESSION["redirect"]["msg"]) ? $_SESSION["redirect"]["msg"] : "Errore nel titolo...";

    switch ($_SESSION["redirect"]["class"]) {
        case "success":
            $page->addMessages($message);
            break;
        case "warning":
            $page->addWarning($message);
            break;
        case "danger":
            $page->addError($message);
            break;
    }

    unset($_SESSION["redirect"]);
}

# echo ("<pre><code>" . htmlspecialchars(Menu::$tree->asXML()) . "</code></pre>");
# die;
echo $page->render($modules);