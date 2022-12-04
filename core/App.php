<?php
namespace App\Core;

use App\Core\Lib\Database;
use App\Core\Lib\Page;

/**
 * Classe di gestione App
 */
class App
{

    static $pg = "";

    private static $servizi = array();

    private static $ip = "";

    private static $url = "";

    /**
     * Cartella installazione
     *
     * @var string
     */
    private static $folder = "";

    /**
     * Inizializzazione pagina, con controllo della sessione ed eventuale redirect
     */
    static function initPage()
    {
        // Operazione da fare come prima
        App::setConfig();

        $page = Page::getInstance();

        App::$pg = $page->alias;

        if (Config::$config["offline"] && ! User::isUserInGroups([
            "superuser",
            "administrator"
        ])) {

            if (App::$pg != "offline")
                Page::redirect("offline");
            else
                User::logout();
        } else {

            # if (App::$pg == "notfound")
            # return;

            // Controllo session scaduta
            if (! User::isUserLogged()) {

                $apage = explode("/", App::$pg);
                $base = $apage[0];

                if (! in_array(App::$pg, Config::$openPage) && $base != "public") {
                    header("Location: " . Config::$config["web"]);
                }
            }

            // Controllo user simulation - Utente - Gruppo
            if (isset($_POST['userSimSelectGruppo']) && ! empty($_POST['userSimSelectGruppo'])) {

                $simulatedGroup = $_POST['userSimSelectGruppo'];
                User::logUser(User::getLoggedUserId(), $simulatedGroup);
                $_SESSION['user']['simulation']['id'] = User::getLoggedUserId();
                $_SESSION['user']['simulation']['gruppo'] = $simulatedGroup;
                $_SESSION['user']['gruppo'] = $simulatedGroup;
                Page::redirect("home1");
            } else {
                // Controllo user simulation - SuperUser
                if ((isset($_POST['userSimSelect']) && $_POST['userSimSelect'] > 0) || (isset($_POST['form_changeuser']) && ! empty($_POST['form_changeuser']) && $_POST["form_changeuser"] > 0)) {
                    $simulatedUserId = $_POST['userSimSelect'] > 0 ? $_POST['userSimSelect'] : $_POST["form_changeuser"];
                    User::logUser($simulatedUserId);
                    $sql = "SELECT g.nome FROM utenti u JOIN utenti_has_gruppi ug USING(id_utente) LEFT JOIN utenti_gruppi g USING (id_gruppo_utente) WHERE id_utente = ?";
                    $simulatedUserGroup = Database::getField($sql, array(
                        $simulatedUserId
                    ));
                    $_SESSION['user']['simulation']['id'] = $simulatedUserId;
                    $_SESSION['user']['simulation']['gruppo'] = $simulatedUserGroup;
                    $_SESSION['user']['simulation']['superuser'] = true;
                }
            }

            User::online();

            User::hasPermission();

            if (User::isReadOnly())
                $page->addWarning("Accesso in sola lettura, nessuna modifica è concessa.");
        }
    }

    static function checkRequest()
    {
        $uri = strtok($_SERVER["REQUEST_URI"], '?');
        $uri = substr($uri, strpos($_SERVER["REQUEST_URI"], '/', 1) + 1);

        # $uri = $_GET["page"];
        $page = Page::getInstance();
        $id = $page->getId();

        $parts = explode('/', $uri);

        if (str_ends_with($page->alias, "/create"))
            $page->alias = preg_replace('#\/[^/]*$#', '', $page->alias);

        $parts = explode('/', $page->alias);
        # $uri = implode('/', $parts);

        # if (! empty($id))
        # $uri .= "/$id";

        if (end($parts) == "create")
            array_pop($parts);

        $controllerName = implode(array_map('ucfirst', $parts)) . "Controller";
        if (empty($uri)) {
            $uri = "authentication/login";
            $controllerName = "AuthenticationLoginController";
        }

        $classController = '\\App\\Core\\Controller\\' . $controllerName;

        $controller = null;

        if (class_exists($classController)) {

            $controller = new $classController($page->alias);

            $action = $_REQUEST["form_action"];
            $http_method = isset($_POST["form_method"]) ? $_POST["form_method"] : $_SERVER['REQUEST_METHOD'];

            switch ($http_method) {
                case "GET":
                    switch ($uri) {
                        case $page->alias:
                            $page->view = "index";
                            $method = empty($action) ? "index" : $action;
                            break;
                        case $page->alias . "/create":
                            $page->view = "create";
                            $method = empty($action) ? "create" : $action;
                            break;
                        case $page->alias . "/$id":
                            $page->view = "show";
                            $method = empty($action) ? "show" : $action;
                            break;
                        case "$page->alias/$id/edit":
                            $page->view = "edit";
                            $method = empty($action) ? "edit" : $action;
                            break;
                        case "$page->alias/edit":
                            $page->view = "edit";
                            $method = empty($action) ? "edit" : $action;
                            break;
                    }
                    break;
                case "POST":
                    switch ($uri) {
                        case $page->alias:
                            $method = empty($action) ? "store" : $action;
                            $page->view = "index";
                            break;
                        case $page->alias . "/create":
                            $page->view = "create";
                            $method = empty($action) ? "store" : $action;
                            break;
                        default:
                            $method = empty($action) ? "store" : $action;
                            $page->view = "index";
                            break;
                    }
                    break;
                case "PUT":
                    switch ($uri) {
                        case "$page->alias/$id":
                            $method = empty($action) ? "update" : $action;
                            $page->view = "edit";
                            break;
                    }
                    break;
                case "DELETE":
                    switch ($uri) {
                        case "$page->alias/$id":
                            $method = "delete";
                            break;
                    }
                    break;
            }
        }

        if (Config::$config["is_debug"])
            $page->dump( [
                "URI: " . $uri,
                "ALIAS: " . $page->alias,
                "CONTROLLER: " . $controllerName,
                "METHOD: " . $method,
                "REQUEST_METHOD: " . $_SERVER['REQUEST_METHOD'],
                "ACTION: " . $action,
                "VIEW: " . $page->view,
                "HTTP_METHOD: " . $http_method
            ]);

        # var_dump(implode("\n",[$uri,$page->alias,$controllerName,$method,$_SERVER['REQUEST_METHOD'],$action, $page->view,$http_method." ".$page->view]));
        # die;
        if (is_object($controller) && method_exists($controller, $method))
            $controller->$method($_REQUEST);
        else {
            $page->dump([
                "URI: " . $uri,
                "ALIAS: " . $page->alias,
                "CONTROLLER: " . $controllerName,
                "METHOD: " . $method,
                "REQUEST_METHOD: " . $_SERVER['REQUEST_METHOD'],
                "ACTION: " . $action,
                "VIEW: " . $page->view,
                "HTTP_METHOD: " . $http_method
            ]);
            
            if (User::isUserLogged())
                $redirectPage = "home";
            else
                $redirectPage = "authentication/login";

            Page::redirect($redirectPage, "", true, "<h1>ERRORE</h1><h2>Pagina <span class='text-info'>$page->title $method</span> non disponibile</h2>", "danger");
        }
    }

    /**
     * Imposta nella variabile Config::$config, il contenuto della tabella config
     */
    static function setConfig($load = false)
    {
        if ($load || empty($_SESSION["configuration"]) || in_array(App::$pg, Config::$openPage)) {
            Config::$config = null;

            $config = Database::getRow("SELECT * FROM config LIMIT 1");
            if (count($config) > 0) {
                $_SESSION["configuration"]["config"] = $config;
                Config::$config = $config;
            }
        } else {
            Config::$config = $_SESSION["configuration"]["config"];
        }
    }

    /**
     * Restituisce l'HTML che permette al superuser di selezionare
     * l'utente da simulare in modalità User Simulation
     *
     * @return string
     */
    static function userSimulationSuperUserHtml()
    {
        if (! User::isSuperUser() && ! $_SESSION['user']['simulation']['superuser'])
            return "";

        $sql = "SELECT u.*,g.nome AS gruppo,
		CONCAT(IFNULL(u.cognome,''), ' ',IFNULL(u.nome,'')) AS username
		FROM utenti u
		JOIN utenti_has_gruppi ug USING(id_utente)
		JOIN utenti_gruppi g USING(id_gruppo_utente)
		WHERE u.record_attivo=1 
		GROUP BY id_utente
		ORDER BY g.nome, username";

        $utenti = Database::getRows($sql);
        if (count($utenti) == 0)
            return;

        $gr = "";
        $out = '<li class="dropdown">
							<a class="dropdown-toggle"	data-toggle="dropdown" href="#">
								<i class="fas fa-users fa-2x"></i>
								<i class="fas fa-caret-down"></i>
							</a>
						   <form id="userSimFormSuper" method="post" style="display:inline;">
				   			<input type="hidden" name="userSimSelect" id="userSimSelect"/>
							</form>
							<ul class="dropdown-menu scrollable-menu" role="menu">';
        foreach ($utenti as $g) {
            if ($gr != $g["gruppo"]) {
                $out .= '<li class=\'active\'><a href="#"><strong>' . strtoupper($g["gruppo"]) . '</strong></a></li>';
                $gr = $g["gruppo"];
            }
            $class = null;
            if (isset($_SESSION['user']['simulation']))
                $class = $_SESSION['user']['simulation']['id'] == $g["id_utente"] ? "active" : "";

            $out .= '<li><a class="' . $class . '" href="#" onclick="$(\'#userSimSelect\').val(\'' . $g["id_utente"] . '\'); $(\'#userSimFormSuper\').submit()"><i class="fas fa-user fa"></i> ' . $g["username"] . '</a></li>';
        }
        $out .= "</ul></li>";

        return $out;
    }

    /**
     * Restituisce l'HTML che permette all'utente di cambiare profilo
     *
     * @return string
     */
    static function userSimulationUserProfiloHtml()
    {
        if (! User::isUserLogged())
            return "";
        $gruppi = $_SESSION['user']['gruppi'];
        if (count($gruppi) == 1)
            return "";

        $out = '<li class="dropdown">
							<a class="dropdown-toggle"	data-toggle="dropdown" href="#">
								<i class="fas fa-refresh fa-2x"></i>
								<i class="fas fa-caret-down"></i>
							</a>
						   <form id="userSimForm" method="post" style="display:inline;">
				   			<input type="hidden" name="userSimSelectGruppo" id="userSimSelectGruppo"/>
							</form>
							<ul class="dropdown-menu dropdown-user">';
        foreach ($gruppi as $g) {
            $class = $_SESSION['user']['gruppo'] == $g["gruppo"] ? "active" : "";
            $out .= '<li><a class="' . $class . '" href="#" onclick="$(\'#userSimSelectGruppo\').val(\'' . $g["gruppo"] . '\'); $(\'#userSimForm\').submit()"><i class="fas fa-user fa-2x"></i>' . $g["gruppo_desc"] . '</a></li>';
        }
        $out .= "</ul></li>";

        return $out;
    }

    static function createRandomString($length = 8)
    {
        $chars = "abcdefghijkmnopqrstuvwxyz023456789";
        srand((float) microtime() * 1000000);
        $i = 0;
        $pass = '';
        while ($i < $length) {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $pass = $pass . $tmp;
            $i ++;
        }
        return $pass;
    }
}
