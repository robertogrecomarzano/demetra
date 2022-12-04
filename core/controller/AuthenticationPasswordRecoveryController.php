<?php
namespace App\Core\Controller;

use App\Core\BaseController;
use App\Core\Config;
use App\Core\User;
use App\Core\Lib\Database;
use App\Core\Lib\Page;
use App\Core\IController;
use App\Core\App;
use App\Core\Lib\Message;
use App\Core\Lib\Language;

class AuthenticationPasswordRecoveryController extends BaseController implements IController
{

    public function __construct($alias)
    {
        $this->page = Page::getInstance();
        $this->page->template = Config::$serverRoot . DS . "core" . DS . "templates" . DS . "tpl" . DS . "authentication" . DS . "passwordrecovery.tpl";
        $this->alias = $alias;

        $captcha = $this->page->addPlugin("captcha");
        $this->page->assign("captcha", $captcha->Draw());
    }

    public function edit($request)
    {}

    public function show($request)
    {}

    public function index($request)
    {}

    public function create($request)
    {}

    public function update($request, $redirect = true)
    {}

    public function store($request, $redirect = true)
    {
        $email = $request['email'];
        $row = Database::getRow("SELECT * FROM utenti WHERE email=? AND record_attivo=1", array(
            $email
        ));

        if (count($row) > 0) {
            $clearPassword = App::createRandomString();
            $saltPassword = User::saltPassword($clearPassword);
            $id = $row['id_utente'];
            $query = "UPDATE utenti SET password=? WHERE id_utente=?";
            Database::update($query, array(
                $saltPassword,
                $id
            ));

            $username = $row['username'];

            $msg = new Message("authentication/credenziali", null, null, Language::get("Recupero credenziali"), $row['cognome'] . " " . $row['nome'], $row['email'], array(
                "username" => $username,
                "password" => $clearPassword
            ));
            $ret = $msg->render();
            if ($ret["SUCCESS"] == "FALSE")
                $this->page->dump($ret["ERROR"]);
        } else
            $this->page->addError(Language::get("Utente non trovato"));
    }

    public function delete($request)
    {}
}

