<?php
$action = isset($_POST['form_action']) ? $_POST['form_action'] : "";
$actionId = isset($_POST['form_id']) ? $_POST['form_id'] : 0;
$table = "faq";
$tablePk = "id_faq";

$mappings = array(
    "question" => "question",
    "answer" => "answer"
);

/*
 * CONTROLLO DATI
 */
$errors = array();
if ($action == "mod2" || $action == "add2") {
    if (! isset($_POST['question']) || empty($_POST['question']))
        $errors[] = "Manca la domanda.";
    if (! isset($_POST['answer']) || empty($_POST['answer']))
        $errors[] = "Manca la risposta.";

    foreach ($errors as $e)
        $page->addError($e);
}

if (empty($errors))
    Form::processAction($action, $actionId, $table, $tablePk, $mappings, $other);

$sql = "SELECT id_faq, question, answer FROM faq ORDER BY question, answer";

$rows = Database::getRows($sql);
Form::mappingsAssignPost($rows, $action, $actionId, $tablePk, $mappings, $page);

$src = array(
    "writable" => true, // default è true
    "rows" => $rows, // righe ritornate dal db
    "pk" => $tablePk, // chiave primaria tabella
    "inline" => true,
    "id" => 'dataTables', // Per attivare la gestione dataTables
    "custom-template" => false, // Per usare dei template custom (table.tpl e add.tpl)
    "fields" => array( // fields, usato solo se custom-template è false
        "question" => array(
            "label" => "Domanda",
            "type" => "text",
            "others" => array(
                "size" => 25,
                "required" => "required"
            )
        ),
        "answer" => array(
            "label" => "Risposta",
            "type" => "textarea",
            "others" => array(
                "size" => 25,
                "required" => "required"
            )
        )
    )
);
$page->assign("src", $src);