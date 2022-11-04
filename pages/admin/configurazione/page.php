<?php
$table = "config";
$tablePk = "id";

$mappings = [
    "email_support" => "email_support",
    "web" => "web",
    "offline" => "offline",
    "debug" => "debug",
    "collaudo" => "collaudo"
];

$action = isset($_POST['form_action']) ? $_POST['form_action'] : "";
$action_id = isset($_POST['form_id']) ? $_POST['form_id'] : "";

if ($action == "mod2") {
    Form::processAction($action, $action_id, $table, $tablePk, $mappings);
    User::setConfig(true);
}

$riga = Database::getRow("SELECT * FROM $table");

$page->assign("pkValue", $riga[$tablePk]);

foreach (array_keys($riga) as $k)
    $_POST["$k"] = $riga["$k"];

    

