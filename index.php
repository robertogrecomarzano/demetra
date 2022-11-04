<?php
error_reporting(E_ALL & ~ E_DEPRECATED & ~ E_WARNING & ~ E_NOTICE);

require 'vendor/autoload.php';

// --------------
// Core libraries
// --------------
require_once "core/database.php";
require_once "core/ipermissions.interface.php";
require_once "core/imenu.interface.php";
require_once "core/minify.urirewriter.class.php";
require_once "core/jsmin.class.php";

use App\Components\Menu;
use App\Core\Config;
use App\Core\Classes\User;
use App\Core\Lib\Database;
use App\Core\Lib\Language;
use App\Core\Lib\Page;
use App\Core\Lib\Security;
use App\Core\Lib\Servizi;
use App\Core\Classes\Istat;
use App\Core\Lib\OrmObj;



/*
 *
 *
 * require "bootstrap.php";
 *
 * use App\Models\Utente;
 * use Illuminate\Database\Capsule\Manager as DB;
 * DB::enableQueryLog();
 * echo DB::table('users')->toSql();
 * /*
 * $user = Utente::Create([
 * 'name' => "Roberto Greco",
 * 'email' => "grecomarzano@libero.it",
 * 'password' => password_hash("ahmedkhan", PASSWORD_BCRYPT)
 * ]);
 *
 * print_r($user->todo()->create([
 *
 * 'todo' => "Working with Eloquent Without PHP",
 *
 * 'category' => "eloquent",
 *
 * 'description' => "Testing the work using eloquent without laravel"
 * ]));
 *
 * $user = Utente::find(19)->toArray();
 *
 * var_dump($user);
 *
 * /*
 * DB::table('users')->insert([
 * 'name' => "Roberto Greco",
 * 'email' => "grecomarzano4@libero.it",
 * 'password' => password_hash("ahmedkhan", PASSWORD_BCRYPT)
 * ]);
 *
 *
 * $users = DB::table('users')->get();
 *
 * foreach ($users as $user)
 * echo $user->name;
 *
 * // var_dump(DB::getQueryLog());
 */

if (! defined('DS'))
    define('DS', DIRECTORY_SEPARATOR);

$tmp_dir = Config::$serverRoot . DS . "tmp";
if (! file_exists($tmp_dir))
    mkdir($tmp_dir, 077, true);
session_save_path($tmp_dir);
session_start();
date_default_timezone_set('Europe/Rome');
if ($_POST)
    Security::checkCSRFToken();

Database::initializeConnection();

$pg = ! empty($_GET['page']) ? $_GET['page'] : "login";
$id = isset($_GET['id']) ? $_GET['id'] : 0;

// $pg2 = $pg . ($id > 0 ? ("/" . $id) : "");
$pg2 = $pg;
if ($id > 0)
    $pg2 .= "/" . $id;
elseif ($_GET["search_azi"] > 0)
    $pg2 .= "?search_azi=" . $_GET["search_azi"];

// Creazione oggetto pagina
$page = Page::getInstance();
$page->setCurrentAlias($pg);

/**
 * Inizializza la pagina e i parametri della singola installazione
 */

User::initPage();

// Esecuzione script principale del template
$mainTemplateDir = Config::$serverRoot . DS . "core" . DS . "templates";
$templateScript = $mainTemplateDir . DS . "main.php";
$preFile = $page->serverFolder() . DS . "pre.php";
$pageFile = $page->serverFolder() . DS . "page.php";
$jsFile = $page->serverFolder() . DS . "page.js";
$cssFile = $page->serverFolder() . DS . "templates" . DS . "main.css";
$templateFile = $mainTemplateDir . DS . "main.tpl";

if (! file_exists($page->serverFolder()))
    Page::redirect("notfound", "index");

if (file_exists($preFile))
    include $preFile;

$page->css->addJS(Config::$urlRoot . DS . "core" . DS . "templates" . DS . "js" . DS . "template-script.js", $mainTemplateDir . DS . "js" . DS . "template-script.js");
$page->css->addJS(Config::$urlRoot . DS . "core" . DS . "templates" . DS . "js" . DS . "main.js", $mainTemplateDir . DS . "js" . DS . "main.js");
// }

// inclusione del file js della pagina
if (file_exists($jsFile))
    $page->css->addJS($page->webFolder() . "/page.js", $jsFile);

// inclusione del file css della pagina
if (file_exists($cssFile))
    $page->css->addCSS($page->webFolder() . "/templates/main.css", $cssFile);

$lang = Language::getCurrentLocale();

// Codice JS comune a tutti, fornisce URL codebase e traduzioni Js
$page->css->addJSCode("var codebase=" . json_encode(Config::$urlRoot) . ";");
$page->css->addJSCode("var lang='" . $lang . "';");

if (file_exists($templateScript))
    include $templateScript;
elseif (User::isSuperUser())
    $page->addError("Errore nella pagina template. Main script non trovato...", array(
        $pg
    ));

$page->addPlugin("Menu");
$page->addPlugin("Errorbox");
$page->addPlugin("Help");
$page->addPlugin("Forms");

// Carica parte statica del menu
Menu::load();

// imposto gli attributi alla Home Page
$home = Menu::findNodeById("home");

User::createMenu(); // Personalizzo il menà in base al gruppo utente.

// Carico le voci di menù, relative ai soli servizi per cui è abilitato l'utente
$servizi = Servizi::getServizi();
if (count($servizi) > 0)
    foreach ($servizi as $s)
        Menu::addClassHook($s['servizio']);

Menu::callHooks(); // processa le voci di menu dinamiche delle classi

Menu::createURLs(); // crea gli URL a partire dagli id
Menu::setActive($pg2); // imposta pagina corrente nel menu
$page->setTitles($pg2); // imposta i titoli

if (file_exists($pageFile))
    include $pageFile;

if (! in_array($pg, Config::$openPage)) {
    $alias = $pg;
    $id = $page->getId();
    if (! empty($id))
        $alias .= "/" . $id;
    if (Menu::is_hide($alias))
        Page::redirect("notauth", "menu");
    if (empty(Menu::findNodeById($alias))) // || Menu::is_hide($alias)
        Page::redirect("notfound");
}

$topMenu = Menu::styleMenu("bread");
$mainMenu = Menu::styleMenu("left");

$page->template = $templateFile;

$modules = array(
    "debug" => Config::$config["debug"] ? "debug" : "",
    "collaudo" => Config::$config["collaudo"] ? "collaudo" : "",
    "offline" => Config::$config["offline"] ? "offline" : "",
    "title" => Config::$config["sitename"],
    "tecnico" => $page->tecnico,
    "contentTitle" => $page->title,
    "contentSubTitle" => $page->subTitle,
    "pageLabel" => $page->pageLabel,
    "left" => $mainMenu,
    "top" => $topMenu,
    "lang" => substr($lang, 0, 2),
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

echo $page->render($modules);
