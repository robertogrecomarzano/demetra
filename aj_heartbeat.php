<?php
error_reporting(E_ALL & ~ E_DEPRECATED & ~ E_WARNING & ~ E_NOTICE);

require 'vendor/autoload.php';

use App\Core\Config;
use App\Core\User;

if (! defined('DS'))
    define('DS', DIRECTORY_SEPARATOR);

$tmp_dir = Config::$serverRoot . DS . "tmp";
if (! file_exists($tmp_dir))
    mkdir($tmp_dir, 077, true);
session_save_path($tmp_dir);
session_start();
date_default_timezone_set('Europe/Rome');

if (! User::isUserLogged())
    echo "-1";
else if (time() - $_SESSION["user"]["heartbeat"] > Config::$formtokenMaxTime) {
    User::logout();
    echo "-2";
}