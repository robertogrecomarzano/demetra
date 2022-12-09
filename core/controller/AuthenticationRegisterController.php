<?php
namespace App\Core\Controller;

use App\Core\BaseController;
use App\Core\Config;
use App\Core\User;
use App\Core\Lib\Database;
use App\Core\Lib\Language;
use App\Core\Lib\Mail;
use App\Core\Lib\Page;
use App\Core\Lib\RegExp;
use App\Core\Lib\Servizi;
use App\Core\IController;
use App\Core\Lib\Message;
use Illuminate\Database\Capsule\Manager as DB;
use Exception;

class AuthenticationRegisterController extends BaseController implements IController
{

    public function __construct($alias)
    {
        $this->page = Page::getInstance();
        $this->page->template = Config::$serverRoot . DS . "core" . DS . "templates" . DS . "tpl" . DS . "authentication" . DS . "register.tpl";
        $this->alias = $alias;
    }

    public function edit($request)
    {}

    public function show($request)
    {}

    public function index($request)
    {
    
    }

    public function create($request)
    {}

    public function update($request, $redirect = true)
    {}

    public function store($request, $redirect = true)
    {
        $surname = trim($request['cognome']);
        $name = trim($request['nome']);
        $email = trim($request['email']);
        $pwd = trim($request['password']);
        $pwd2 = trim($request['password2']);

        if (empty($surname))
            $this->page->addError(Language::get("Indicare il cognome"));
        if (empty($name))
            $this->page->addError(Language::get("Indicare il nome"));
        if ($pwd != $pwd2)
            $this->page->addError(Language::get("Le password non coincidono"));

        if (! RegExp::checkPassword($pwd))
            $this->page->addError(Language::get("Password non valida, verificare i caratteri ammessi"));

        if (! RegExp::checkEmail($email))
            $this->page->addError(Language::get("Indirizzo email non valido"));

        if (empty($this->page->errors)) {
            $numrows = Database::getCount("utenti", "record_attivo=1 AND email=?", [
                $email
            ]);
            if ($numrows > 0)
                $this->page->addError(Language::get("Indirizzo email già presente"));
        }

        if (empty($this->page->errors)) {
            $sha_pwd = User::saltPassword($pwd);
            $gruppo = User::getIdGruppo("user");

            $db = DB::connection();

            try {

                $db->beginTransaction();

                $token = User::saltPassword(microtime());

                $sql = "INSERT INTO utenti SET
                            username=?,
                            password=?,
                            cognome=?,
                            nome=?,
                            email=?,
                            readonly=?,
                            record_attivo=?,
                            token=?";
                $parameters = array(
                    $email,
                    $sha_pwd,
                    $surname,
                    $name,
                    $email,
                    0,
                    0,
                    $token
                );

                $res = Database::insert($sql, $parameters);


                if ($res != null) {

                    $userId = Database::getLastIsertId();
                    
                    Database::insert("INSERT INTO utenti_has_gruppi SET id_utente=?, id_gruppo_utente=?", array(
                        $userId,
                        $gruppo
                    ));

                    
                    
                    $default = Servizi::getServiziDefault("id_servizio");
                    foreach ($default as $s)
                        Servizi::addServizioUtente($userId, $s);

                    $subject = Language::get("Registrazione utente");
                    $nominativo = "$surname $name";

                    /**
                     * Invio mail con username
                     */
                    $msg = new Message("authentication/register", null, null, $subject, $nominativo, $email, [
                        "username" => $email
                    ]);
                    $retvalue = $msg->render();

                    if ($retvalue['SUCCESS'] == "TRUE") {
                        /**
                         * Invio mail con password e token per confermare la registrazione
                         */

                        $msg = new Message("authentication/confirm", null, null, $subject, $nominativo, $email, [
                            "password" => $pwd,
                            "token" => $token,
                            "nominativo" => $nominativo
                        ]);
                        $msg->render();

                        $db->commit();
                        $this->page->addMessages(Language::get("Per completare la registrazione cliccare sul link presente all'interno del messaggio."));
                    }
                    
                    unset($request);
                } else {
                    $this->page->addError(Language::get("Errore in fase di registrazione"));
                    $db->rollBack();
                }
            } catch (Exception $ex) {
                $this->page->addError($ex->getMessage());
                $db->rollBack();
            }
        }
    }

    public function delete($request)
    {}
}

