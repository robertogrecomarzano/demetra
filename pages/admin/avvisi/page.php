<?php
$page->addPlugin("calendar");
$action = isset($_POST['form_action']) ? $_POST['form_action'] : "";
$actionId = isset($_POST['form_id']) ? $_POST['form_id'] : 0;
$table = "avvisi";
$tablePk = "id_avviso";
$mappings = array(
    "titolo" => "titolo",
    "descrizione" => "descrizione",
    "descrizione_lunga" => "descrizione_lunga",
    "dal" => "dal",
    "al" => "al"
);
switch ($action) {
    case "mod2":
    case "add2":
        $idRiga = Form::processAction($action, $actionId, $table, $tablePk, $mappings);
        if ($idRiga) {
            Database::update("UPDATE  $table SET
							dal=STR_TO_DATE(?,'%d/%m/%Y'),
							al=STR_TO_DATE(?,'%d/%m/%Y')
							WHERE $tablePk=?", array(
                $_POST["dal"],
                $_POST["al"],
                $idRiga
            ));
        }
        break;
    default:
        Form::processAction($action, $actionId, $table, $tablePk, $mappings);
        break;
}
$sql = "SELECT id_avviso,titolo, descrizione, descrizione_lunga, 
       DATE_FORMAT(dal,'%d/%m/%Y') AS dal,
       DATE_FORMAT(al,'%d/%m/%Y') AS al,
	  NOT (NOW() BETWEEN dal AND al) AS is_scaduto
	  FROM avvisi a
	  WHERE a.record_attivo=1";

$rows = Database::getRows($sql, $params);
Form::mappingsAssignPost($rows, $action, $actionId, $tablePk, $mappings, $page);
$src = array(
    "writable" => true, // default è true
    "rows" => $rows, // righe ritornate dal db
    "pk" => $tablePk, // chiave primaria tabella
    "inline" => false,
    "id" => 'dataTables', // Per attivare la gestione dataTables
    "custom-template" => false, // Per usare dei template custom (table.tpl e add.tpl)
    "fields" => array( // fields, usato solo se custom-template è false
        "titolo" => array(
            "label" => "Titolo",
            "type" => "text",
            "others" => array(
                "size" => 25,
                "required" => "required"
            )
        ),
        "descrizione" => array(
            "label" => "Descrizione",
            "type" => "textarea"
        ),
        "descrizione_lunga" => array(
            "label" => "Descrizione lunga",
            "type" => "textarea"
        ),
        "dal" => array(
            "label" => "Visibile dal",
            "type" => "calendar"
        ),
        "al" => array(
            "label" => "Visibile fino al",
            "type" => "calendar"
        ),
        "is_scaduto" => array(
            "label" => "Scaduto",
            "type" => "checkbox",
            "read" => true
        )
    )
);
$page->assign("src", $src);