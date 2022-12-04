<?php
use App\Core\Config;
use Melbahja\Environ\Environ;
use Illuminate\Database\Capsule\Manager as Capsule;
$capsule = new Capsule();

Environ::load('.');

$db = Environ::get('DATABASE');

$capsule->addConnection([
    "driver" => "mysql",
    "host" => $db["HOST"],
    "database" => $db["DBNAME"],
    "username" => $db["USERNAME"],
    "password" => $db["PASSWORD"],
    "port" => $db["PORT"]
]);


$capsule->setAsGlobal();
$capsule->bootEloquent();