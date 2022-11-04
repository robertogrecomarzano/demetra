<?php
$action = isset($_POST['form_action']) ? $_POST['form_action'] : "";
$actionId = isset($_POST['form_id']) ? $_POST['form_id'] : 0;

$idUtente = user::getLoggedUserId();

$competence = new SettoriUtenti();

$table = "utenti_settori";
$tablePk = "id";

$mappings = [
    "id_settore" => "id_settore"
];

$other = [
    "id_utente" => $idUtente
];

/*
 * CONTROLLO DATI
 */
$errors = array();
if ($action == "mod2" || $action == "add2") {

    if (! isset($_POST['id_settore']) || empty($_POST['id_settore']))
        $errors[] = "Selezionare il settore";
}

/**
 * Modifica
 */

foreach ($errors as $e)
    $page->addError($e);

if (empty($errors)) {

    switch ($action) {
        case "add2":
        case "mod2":
            Form::processAction($action, $actionId, $table, $tablePk, $mappings, $other);
            break;
        default:
            Form::processAction($action, $actionId, $table, $tablePk, $mappings, $other);
            break;
    }
}

$rows = $competence->getSettoriUtente($idUtente);

Form::mappingsAssignPost($rows, $action, $actionId, $tablePk, $mappings, $page);

/**
 * Gestione delle tabelle inline (e non)
 *
 * Basta fare $page->assign("src"=>$src) e nel template scrivere {form_table src=$src}
 */

$isWritable = true;
$src = array(
    "writable" => $isWritable, // default è true
    "rows" => $rows, // righe ritornate dal db
    "pk" => $tablePk, // chiave primaria tabella
    "inline" => false,
    "title" => "Aggiungi settore/competenza", // Testo del botton per nuovo inserimento (solo con inline=false)
    "id" => 'dataTables', // Per attivare la gestione dataTables
    "custom-template" => true // Per usare dei template custom (table.tpl e add.tpl)
);
$page->assign("src", $src);
$page->assign("isWritable", $isWritable);

if ($action == "mod" || $action == "add" || (! empty($errors) && ($action == "mod2" || $action == "add2"))) {

    $page->assign("settori", (new Settore())->getList());
}