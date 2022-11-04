<?php
if (! isset($_SESSION["getPagine"]))
    $_SESSION["getPagine"] = Servizi::getPagine();

$action = isset($_POST['form_action']) ? $_POST['form_action'] : "";
$actionId = isset($_POST['form_id']) ? $_POST['form_id'] : 0;
$table = "help";
$tablePk = "id";
$mappings = array(
    "alias" => "alias",
    "text" => "text",
    "title" => "title",
    "stato" => "stato",
    "id_gruppo" => "id_gruppo"
);
Form::processAction($action, $actionId, $table, $tablePk, $mappings, $other);
$sql = "SELECT id, alias, text, title, stato, u.descrizione AS ruolo FROM $table LEFT JOIN utenti_gruppi u ON id_gruppo=id_gruppo_utente";

$rows = Database::getRows($sql);
Form::mappingsAssignPost($rows, $action, $actionId, $tablePk, $mappings, $page);

$stati = Database::getEnumValues($table, "stato");
$gruppi = Database::getRows("SELECT id_gruppo_utente, descrizione FROM utenti_gruppi ORDER BY descrizione", null, PDO::FETCH_KEY_PAIR);

$src = array(
    "writable" => true, // default è true
    "rows" => $rows, // righe ritornate dal db
    "pk" => $tablePk, // chiave primaria tabella
    "inline" => true,
    "id" => 'dataTables', // Per attivare la gestione dataTables
    "custom-template" => false, // Per usare dei template custom (table.tpl e add.tpl)
    "fields" => array( // fields, usato solo se custom-template è false
        "alias" => array(
            "label" => "Alias",
            "type" => "text",
            "others" => array(
                "size" => 25,
                "required" => "required"
            )
        ),
        "title" => array(
            "label" => "Titolo",
            "type" => "text",
            "others" => array(
                "size" => 25,
                "required" => "required"
            )
        ),
        "text" => array(
            "label" => "Testo",
            "type" => "textarea",
            "others" => array(
                "size" => 25,
                "required" => "required"
            )
        ),
        "stato" => array(
            "label" => "Stato",
            "type" => "select",
            "value" => "stato",
            "others" => array(
                "src" => $stati,
                "first" => true,
                "required" => "required"
            )
        ),
        "id_gruppo" => array(
            "label" => "Ruolo",
            "type" => "select",
            "value" => "ruolo",
            "others" => array(
                "src" => $gruppi,
                "first" => true,
                "required" => "required"
            )
        )
    )
);
$page->assign("src", $src);