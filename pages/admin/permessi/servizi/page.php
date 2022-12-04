<?php
use App\Core\Lib\Database;
use App\Core\Lib\Form;
use App\Core\Lib\Servizi;

$action = isset($_POST['form_action']) ? $_POST['form_action'] : "";
$actionId = isset($_POST['form_id']) ? $_POST['form_id'] : 0;

$table = "servizi";
$tablePk = "id_servizio";
$mappings = array(
    "servizio" => "servizio",
    "descrizione" => "descrizione",
    "menu" => "menu",
    "posizione" => "posizione"
);

/*
 * CONTROLLO DATI
 */
$errors = array();
if ($action == "mod2" || $action == "add2") {
    if (! isset($_POST['descrizione']) || empty($_POST['descrizione']))
        $errors[] = "Indicare la descrizione.";
    if (! isset($_POST['menu']) || empty($_POST['menu']))
        $errors[] = "Indicare la voce del menù.";
    if (! isset($_POST['posizione']) || empty($_POST['posizione']))
        $errors[] = "Indicare la posizione.";
    if ($action == "add2")
        if (Form::checkDupes("servizi", array(
            "servizio" => "servizio"
        ), array(
            "servizio"
        )))
            $errors[] = "Riga duplicata.";
    foreach ($errors as $e)
        $page->addError($e);
}

if (empty($errors)) {
    $newId = Form::processAction($action, $actionId, $table, $tablePk, $mappings, $other);
    Database::update("UPDATE  servizi SET servizio=LOWER(servizio)");
}

if ($action == "mod2") {
    Database::delete("DELETE FROM servizi_default WHERE id_servizio=?", array(
        $newId
    ));
    Database::delete("DELETE FROM servizi_config_gruppo WHERE id_servizio=?", array(
        $newId
    ));
    
}

if ($action == "add2" || $action == "mod2") {
    if (empty($errors)) {
        $gruppi = Database::getRows("SELECT id_gruppo_utente FROM utenti_gruppi");
        foreach ($gruppi as $g)
            Servizi::addServizioGruppoRegione($g['id_gruppo_utente'], $newId);
        
        Servizi::addServizioDefault($newId);
    }
}

$righe = Servizi::getServiziRegione();
Form::mappingsAssignPost($righe, $action, $actionId, $tablePk, $mappings, $page);
$page->assign("righe", $righe);

$src = array(
    "rows" => $righe, // righe ritornate dal db
    "pk" => $tablePk, // chiave primaria tabella
    "inline" => true,
    "title" => "Aggiungi nuovo servizio", // Testo del botton per nuovo inserimento (solo con inline=false)
    "id" => 'dataTables',
    "fields" => array( // fields, usato sulo se custom-template è false
        "servizio" => array(
            "label" => "Servizio",
            "type" => "text",
            "others" => array(
                "size" => 40,
                "required" => "required"
            )
        ),
        "descrizione" => array(
            "label" => "Descrizione",
            "type" => "textarea",
            "others" => array(
                "rows" => 2,
                "required" => "required"
            )
        ),
        "menu" => array(
            "label" => "Voce di menù",
            "type" => "text",
            "others" => array(
                "required" => "required"
            )
        
        ),
        "posizione" => array(
            "label" => "Posizione",
            "type" => "number",
            "others" => array(
                "size" => 4,
                "required" => "required",
                "min" => 1
            
            )
        )
    )
);
$page->assign("src", $src);