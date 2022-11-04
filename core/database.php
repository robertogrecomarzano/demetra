<?php
use App\Core\Config;
use Illuminate\Database\Capsule\Manager as Capsule;
$capsule = new Capsule();
$capsule->addConnection([
    "driver" => "mysql",
    "host" => "localhost",
    "database" => Config::$db,
    "username" => Config::$user,
    "password" => Config::$pass,
    "port" => Config::$port
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();