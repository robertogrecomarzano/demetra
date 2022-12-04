<?php
use App\Core\Config;
use App\Core\User;
use App\Core\Lib\Database;
use App\Core\Lib\Page;

if (! Config::$config["offline"])
    Page::redirect("home");
else if (isset($_POST['username']) && isset($_POST['password']) && ! User::isUserLogged()) {
    $isValidLogin = User::login($_POST['username'], $_POST['password'], "", true);

    if (! $isValidLogin) {
        $page->addError("Errore in fase di login, verificare i dati di accesso");
    } else {
        $idUtente = User::getLoggedUserId();

        $idUtente = $_SESSION['user']["id"];

        $default_page = Database::getField("SELECT default_page FROM utenti WHERE id_utente=?", array(
            $idUtente
        ));
        $default_page = is_null($default_page) ? "admin" : $default_page;

        Page::redirect("home");
    }
}
