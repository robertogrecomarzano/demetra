<?php
use App\Core\User;
use App\Core\Lib\Database;
use App\Core\Lib\RegExp;
use App\Core\Lib\Message;

$captcha = $page->addPlugin("Captcha");

$userId = User::getLoggedUserId();

$action = isset($_POST['form_action']) ? $_POST['form_action'] : "";
if (! empty($action)) {
    if ($captcha->Validate()) {
        if ($action == "confirm") {

            $username = trim($_POST['username']);
            $pwd = trim($_POST['password']);
            $pwd2 = trim($_POST['password2']);
            if ($pwd != $pwd2)
                $page->addError("Le password non sono uguali");

            if (! RegExp::checkPassword($pwd))
                $page->addError("Password <b>$pwd</b> non valida, deve contenere almeno un numero, un carattere minuscolo, uno maiuscolo e un carattere speciale tra !.@#$% e deve avere lunghezza compresa tra 8 e 20 caratteri.");

            if (! RegExp::checkEmail($_POST['email']))
                $page->addError("Email non valida.");

            if (empty($page->errors)) {
                $sha_pwd = User::saltPassword($pwd);

                $cognome = $_POST['cognome'];
                $nome = $_POST['nome'];
                $email = $_POST['email'];

                $sql = "UPDATE utenti SET username=?, password=?, cognome=?, nome=?, email=? WHERE id_utente=?";
                $parameters = array(
                    $username,
                    $sha_pwd,
                    $cognome,
                    $nome,
                    $email,
                    $userId
                );
                $res = Database::update($sql, $parameters);
            }

            if ($res == null)
                $page->addError("ERROR");
            else {
                $msg = new Message("profilo", null, null, "Aggiornamento profilo", "$cognome $nome", $email, array(
                    "username" => $username,
                    "password" => $pwd,
                    "nominativo" => $cognome . " " . $nome
                ));
                $msg->render();

                $page->addMessages("Dati aggiornati correttamente");
            }
        }
    } else
        $page->addError("Codice captcha non valido, " . $_REQUEST['captcha_value'] . " diverso da " . $_SESSION["captcha"]);
}
$page->assign("captcha", $captcha->Draw());

$row = Database::getRow("SELECT * FROM utenti u WHERE id_utente=?", array(
    User::getLoggedUserId()
));
$_POST['username'] = $row['username'];
$_POST['cognome'] = $row['cognome'];
$_POST['nome'] = $row['nome'];
$_POST['email'] = $row['email'];

$profili = Database::getRows("SELECT g.* FROM utenti_has_gruppi ug JOIN utenti_gruppi g USING(id_gruppo_utente) WHERE id_utente=?", array(
    User::getLoggedUserId()
));
foreach ($profili as $p)
    $prof[$p['id_gruppo_utente']] = $p['nome'];
$page->assign("profili", $prof);