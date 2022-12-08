<?php
namespace App\Core\Controller;

use App\Core\BaseController;
use App\Core\Config;
use App\Core\User;
use App\Core\Lib\Database;
use App\Core\Lib\Language;
use App\Core\Lib\Page;
use App\Core\IController;
use App\Core\App;

class AuthenticationConfirmController extends BaseController implements IController
{

    public function __construct($alias)
    {
        $this->page = Page::getInstance();
        $this->alias = $alias;
    }

    public function edit($request)
    {}

    public function show($request)
    {}

    public function index($request)
    {
        $token = $request["token"];
        App::setConfig(true);
        $row = Database::getRow("SELECT * FROM utenti WHERE token = ? AND record_attivo=0 AND ts_confirm IS NULL AND NOW() <= DATE_ADD(ts_create, INTERVAL 48 HOUR) ", array(
            $token
        ));

        if (! empty($row)) {

            Database::update("UPDATE  utenti SET record_attivo=1, ts_confirm=NOW() WHERE id_utente=?", array(
                $row["id_utente"]
            ));

            User::logUser($row["id_utente"]);
            Page::redirect("home", null, true, "<h3>" . Language::get("Registrazione completata") . "</h3>");
        } else
            Page::redirect("error");
    }

    public function create($request)
    {}

    public function update($request, $redirect = true)
    {}

    public function store($request, $redirect = true)
    {}

    public function delete($request)
    {}
}

