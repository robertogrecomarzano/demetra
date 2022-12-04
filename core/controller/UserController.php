<?php
namespace App\Core\Controller;

use App\Core\BaseController;
use App\Core\User;
use App\Core\Lib\Database;
use App\Core\Lib\Page;
use App\Core\IController;
use App\Models\Utente;
use App\Core\ITableController;
use App\Core\Lib\RegExp;
use App\Core\Lib\Language;

class UserController extends BaseController implements IController, ITableController
{

    private $idUtente = null;

    private function middleware($id)
    {
        if ($this->idUtente != $id)
            Page::redirect("home", "", true, "Non hai accesso alla risorsa", "danger");
    }

    public function __construct($alias)
    {
        $this->page = Page::getInstance();
        $this->alias = $alias;

        $this->table = "utenti";
        $this->pk = "id_utente";

        $this->idUtente = User::getLoggedUserId();
    }

    public function index($request)
    {}

    public function edit($request)
    {
        $this->middleware($request["id"]);

        $utente = Utente::find($this->idUtente)->toArray();
        $_POST["cognome"] = $utente["cognome"];
        $_POST["nome"] = $utente["nome"];
        $_POST["email"] = $utente["email"];
    }

    public function show($request)
    {
        $this->middleware($request["id"]);

        $utente = Utente::find($this->idUtente)->toArray();

        $gruppo = Database::getRows("SELECT g.nome FROM utenti_gruppi g JOIN utenti_has_gruppi USING(id_gruppo_utente) WHERE id_utente=?", [
            $request["id"]
        ]);
        foreach ($gruppo as $a)
            $utente['gruppo'][] = $a['nome'];
        $utente["gruppo"] = implode(", ", $utente["gruppo"]);

        $servizio = Database::getRows("SELECT DISTINCT cs.id_servizio,  cs.servizio
			FROM servizi_utenti us
			JOIN servizi cs USING(id_servizio)
			JOIN servizi_config_gruppo USING(id_servizio)
			WHERE id_utente=?", [
            $request["id"]
        ]);
        foreach ($servizio as $a)
            $utente['servizi'][] = $a['servizio'];
        $utente["servizi"] = implode(", ", $utente["servizi"]);

        $this->page->assign("utente", $utente);
    }

    public function create($request)
    {}

    public function update($request, $redirect = false)
    {
        $this->middleware($request["id"]);

        $newId = $request["id"];
        Database::update("UPDATE $this->table SET cognome=?, nome=?, email=? WHERE $this->pk=?", [
            $request["cognome"],
            $request["nome"],
            $request["email"],
            $newId
        ]);

        if ($redirect)
            Page::redirect($this->alias . "/$newId", "", true, "Utente aggiornato");
        else
            return $newId;
    }

    public function store($request, $redirect = false)
    {}

    public function delete($request)
    {}

    public function update_preview($request)
    {
        $newId = $this->update($request, false);
        if ($newId > 0)
            Page::redirect($this->alias . "/$newId", "", true, "Dati aggiornati");
    }

    public function store_preview($request)
    {}

    public function store_new($request)
    {}

    public function password($request)
    {
        $this->middleware($request["id"]);

        $utente = User::getUserData($this->idUtente); // Non uso Utente::find perchè password è un campo $hidden e quindi non viene restituito dal find()

        if ($utente["password"] != User::saltPassword($request["password_old"]))
            $errors[] = "La password attuale non è corretta";
        if (empty($request["password_old"]))
            $errors[] = Language::get("Indicare la password attuale");
        if (empty($request["password"]))
            $errors[] = Language::get("Indicare la nuova password");
        if (empty($request["password2"]))
            $errors[] = Language::get("Confermare la nuova password");
        if ($request["password"] != $request["password2"])
            $errors[] = Language::get("Le due password non coincidono");

        if (! empty($errors)) {
            foreach ($errors as $e)
                $this->page->addError($e);
            return false;
        }

        $newId = $request["id"];

        Database::update("UPDATE $this->table SET password=? WHERE $this->pk=?", [
            User::saltPassword($request["password"]),
            $newId
        ]);

        Page::redirect($this->alias . "/$newId", "", true, "Password aggiornata");
    }
}

