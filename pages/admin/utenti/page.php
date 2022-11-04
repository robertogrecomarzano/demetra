<?php
$action = isset($_POST['form_action']) ? $_POST['form_action'] : "";
$actionId = isset($_POST['form_id']) ? $_POST['form_id'] : 0;

$table = "utenti";
$tablePk = "id_utente";

$mappings = array(
    "cognome" => "cognome",
    "nome" => "nome",
    "username" => "username",
    "email" => "email",
    "readonly" => "sola_lettura"
);

$other = array(
    "record_attivo" => 1
);

$password = null;
if (! empty($_POST['password'])) {
    $password = User::saltPassword($_POST['password']);
    $other["password"] = $password;
}

if (! empty($action)) {

    $errors = array();

    switch ($action) {
        case "mod2":
        case "add2":
            $user = Database::getRow("SELECT * FROM utenti WHERE record_attivo=1 AND username=? AND email=?", [
                $_POST["username"],
                $_POST["email"]
            ]);

            if (! empty($user) && $action == "add2")
                $errors[] = "Utente già presente";
            if (! isset($_POST['username']) || empty($_POST['username']))
                $errors[] = "Indicare lo username.";
            break;
        case "del":
            break;
    }

    foreach ($errors as $e)
        $page->addError($e);

    if (empty($errors)) {
        switch ($action) {
            case "mod2":
            case "add2":
                $newId = Form::processAction($action, $actionId, $table, $tablePk, $mappings, $other);
                $actionId = ($action == "add2" && empty($actionId)) ? $newId : $actionId;

                Database::query("DELETE FROM utenti_has_gruppi WHERE id_utente=?", array(
                    $actionId
                ));

                if (isset($_POST['gruppo']))
                    foreach ($_POST['gruppo'] as $g)
                        Database::query("INSERT INTO utenti_has_gruppi SET id_utente=?, id_gruppo_utente=?", array(
                            $actionId,
                            $g
                        ));

                Database::query("DELETE FROM servizi_utenti WHERE id_utente=?", array(
                    $actionId
                ));
                if (isset($_POST['servizio']))
                    foreach ($_POST['servizio'] as $ids)
                        Servizi::addServizioUtente($actionId, $ids);

                $subject = "Registrazione utente";

                /**
                 * Invio mail con username
                 */
                $msg = new Message("registrazione", null, null, $subject, $_POST['cognome'] . " " . $_POST['nome'], $_POST['email'], array(
                    "username" => $_POST["username"],
                    "password" => $_POST["password"],
                    "nominativo" => $_POST['cognome'] . " " . $_POST['nome']
                ));
                $msg->render();

                break;
            case "del":
                Database::query("UPDATE utenti SET record_attivo=0 WHERE id_utente=?", array(
                    $actionId
                ));
                break;
        }
    }
}

if ($actionId > 0 && $action == "mod") {

    unset($_POST['gruppo']);
    $gruppo = Database::getRows("SELECT * FROM utenti_gruppi g JOIN utenti_has_gruppi USING(id_gruppo_utente) WHERE id_utente=?", array(
        $actionId
    ));
    foreach ($gruppo as $a)
        $_POST['gruppo'][] = $a['id_gruppo_utente'];

    unset($_POST['servizio']);
    $servizio = Database::getRows("SELECT DISTINCT cs.id_servizio,  cs.servizio 
			FROM servizi_utenti us 
			JOIN servizi cs USING(id_servizio)
			JOIN servizi_config_gruppo USING(id_servizio)
			WHERE id_utente=?", array(
        $actionId
    ));
    foreach ($servizio as $ids)
        $_POST['servizio'][] = $ids['id_servizio'];

    $where2 = "AND u.id_utente = $actionId";
}

$sql = "SELECT u.*, GROUP_CONCAT(DISTINCT(g.nome)) AS profili
FROM utenti u
JOIN utenti_has_gruppi ug USING(id_utente)
JOIN utenti_gruppi g USING(id_gruppo_utente)
WHERE u.record_attivo=1 
$where2
GROUP BY id_utente
ORDER BY g.nome ASC";
$righe = Database::getRows($sql, $params);

$page->assign('righe', $righe);
$gruppi = Database::getRows("SELECT id_gruppo_utente,descrizione FROM utenti_gruppi", null, PDO::FETCH_KEY_PAIR);
$page->assign("gruppi", $gruppi);
$servizi = Database::getRows("SELECT DISTINCT id_servizio,descrizione FROM servizi_config_gruppo cs
		JOIN servizi USING(id_servizio) ", null, PDO::FETCH_KEY_PAIR);
$page->assign("servizi", $servizi);

Form::mappingsAssignPost($righe, $action, $actionId, $tablePk, $mappings, $page);

$page->assign("src", array(
    "custom-template" => true,
    "title" => "Registra nuovo utente"
));