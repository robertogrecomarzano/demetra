<?php
$token = $_GET["token"];

$row = Database::getRow("SELECT * FROM utenti WHERE token = ? AND record_attivo=0 AND ts_confirm IS NULL AND NOW() <= DATE_ADD(ts_create, INTERVAL 48 HOUR) ", array(
    $token
));

if (! empty($row)) {
    
    Database::query("UPDATE utenti SET record_attivo=1, ts_confirm=NOW() WHERE id_utente=?", array(
        $row["id_utente"]
    ));
    $page->addMessages("Registrazione terminata, <a href='" . Config::$config["web"] . "'>clicca qui per accedere</a>.");
} else
    $page->addError("Attenzione, l'indirizzo inserito non è valido.");

