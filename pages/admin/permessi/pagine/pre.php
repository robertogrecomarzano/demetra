<?php
Servizi::get_risorse();
$action = isset($_POST['form_action']) ? $_POST['form_action'] : "";
$actionId = isset($_POST['form_id']) ? $_POST['form_id'] : 0;

$table = "utenti_permessi";
$tablePk = "id";

$mappings = array(
    "id_gruppo" => "gruppo",
    "id_risorsa" => "risorsa",
    "$table.read" => "read",
    "$table.add" => "add",
    "$table.update" => "update",
    "$table.delete" => "delete"
);

$errors = array();
if ($action == "mod2" || $action == "add2") {
    if (! isset($_POST['gruppo']) || empty($_POST['gruppo']))
        $errors[] = "Manca il gruppo";
    if (! isset($_POST['risorsa']) || empty($_POST['risorsa']))
        $errors[] = "Manca la risorsa";
    foreach ($errors as $e)
        $page->addError($e);
}

if (empty($errors)) {
    Form::processAction($action, $actionId, $table, $tablePk, $mappings, $other);
}

$sql = "SELECT *,r.name AS risorsa,g.nome AS gruppo,
    	IF($table.read=1,'<i class=\'fa fa-check\'></i>','') AS 'read_check', 
		IF($table.update=1,'<i class=\'fa fa-check\'></i>','') AS 'update_check', 
		IF($table.delete=1,'<i class=\'fa fa-check\'></i>','') AS 'delete_check', 
		IF($table.add=1,'<i class=\'fa fa-check\'></i>','') AS 'add_check',
        $table.read AS '$table.read',
        $table.add AS '$table.add',
        $table.delete AS '$table.delete', 
        $table.update AS '$table.update'
		FROM utenti_permessi_risorse r 
        JOIN utenti_permessi USING(id_risorsa)
        JOIN utenti_gruppi g ON id_gruppo=id_gruppo_utente
		WHERE type='PAGE'
		ORDER BY gruppo, risorsa";
$rows = Database::getRows($sql);

Form::mappingsAssignPost($rows, $action, $actionId, $tablePk, $mappings, $page);

$risorse = Database::getRows("SELECT id_risorsa,name FROM utenti_permessi_risorse WHERE type='PAGE' ORDER BY 2", null, PDO::FETCH_KEY_PAIR);
$gruppi = Database::getRows("SELECT g.id_gruppo_utente AS id_gruppo, g.nome AS gruppo FROM utenti_gruppi g ORDER BY 2", null, PDO::FETCH_KEY_PAIR);

$src = array(
    "rows" => $rows, // righe ritornate dal db
    "pk" => $tablePk, // chiave primaria tabella
    "inline" => true,
    "title" => "Aggiungi nuova regola", // Testo del botton per nuovo inserimento (solo con inline=false)
    "id" => 'dataTables',
    "fields" => array( // fields, usato sulo se custom-template è false
        "id_risorsa" => array(
            "label" => "Risorsa",
            "type" => "select",
            "value" => "risorsa",
            "name" => "risorsa",
            "others" => array(
                "required" => "required",
                "src" => $risorse
            )
        ),
        "id_gruppo" => array(
            "label" => "Gruppo",
            "type" => "select",
            "value" => "gruppo",
            "name" => "gruppo",
            "others" => array(
                "required" => "required",
                "src" => $gruppi
            )
        ),
        "$table.read" => array(
            "label" => "Lettura",
            "type" => "checkbox",
            "value" => "read_check",
            "name" => "read",
            "others" => array(
                "label" => "Abilita lettura"
            )
        ),
        "$table.add" => array(
            "label" => "Aggiunta",
            "type" => "checkbox",
            "value" => "add_check",
            "name" => "add",
            "others" => array(
                "label" => "Abilita aggiunta"
            )
        ),
        "$table.update" => array(
            "label" => "Modifica",
            "type" => "checkbox",
            "value" => "update_check",
            "name" => "update",
            "others" => array(
                "label" => "Abilita modifica"
            )
        ),
        "$table.delete" => array(
            "label" => "Eliminazione",
            "type" => "checkbox",
            "value" => "delete_check",
            "name" => "delete",
            "others" => array(
                "label" => "Abilita eliminazione"
            )
        )
    )
);
$page->assign("src", $src);