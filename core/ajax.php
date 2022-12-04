<?php
error_reporting(E_ALL & ~ E_DEPRECATED & ~ E_WARNING & ~ E_NOTICE);

require 'vendor/autoload.php';
require_once "core/database.php";

use App\Core\App;
use App\Core\Config;
use App\Core\User;
use App\Core\Lib\Language;
use App\Core\Lib\Page;
use Melbahja\Environ\Environ;

if (empty(Environ::get('APP_KEY'))) {
    $key = App::createRandomString(40);
    Environ::set("APP_KEY", $key);
    $path = '.env';
    if (file_exists($path))
        file_put_contents($path, str_replace('APP_KEY = ""', 'APP_KEY = "' . $key . '"', file_get_contents($path)));
}

$tmp_dir = Config::$serverRoot . DS . "tmp";
if (! file_exists($tmp_dir))
    mkdir($tmp_dir, 077, true);
session_save_path($tmp_dir);
session_start();

$page = Page::getInstance();

Language::setCurrentLocale(Config::$defaultLocale); // da togliere se prevista i18n e l10n
date_default_timezone_set("Europe/Rome");

if (User::isUserLogged())
    User::setConfig();

$callPage = substr($_SERVER['HTTP_REFERER'], strlen(Config::$urlRoot . "/"));

$alias = null;
$pagina = explode("/", $_GET["alias"]);
if (! empty($pagina)) {
    array_pop($pagina);
    $alias = implode("/", $pagina);
}

if (! isset($_SESSION['user']) && ! in_array($callPage, Config::$openPage) && ! in_array($alias, Config::$openPage))
    exit();

if (isset($_GET['plugin']) && $_GET['plugin'] != "") {
    $action = $_GET['action'];
    $plugin = $_GET['plugin'];
    $parametro_get = $_GET['p'];
    $page = new Page();
    $parametri_post = $_POST;
    $plug = $page->addPlugin($plugin);

    if (! empty($action)) {
        if (! empty($parametri_post))
            $plug->$action($parametri_post);
        else
            $plug->$action($parametro_get);
    } else
        $plug->init($parametro_get);
} elseif (isset($_GET['alias']) && $_GET['alias'] != "") {
    $file = $_GET['alias'];
    $pagina = new Page(dirname($file));
    $path = "../pages/$file.php";
    if (file_exists($path))
        include $path;
}