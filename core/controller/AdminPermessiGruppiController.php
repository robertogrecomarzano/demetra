<?php
namespace App\Core\Controller;

use App\Core\IController;
use App\Core\ITableController;
use App\Core\Lib\Form;
use App\Core\Lib\Language;
use App\Core\Lib\Page;
use App\Core\Lib\Servizi;
use App\Core\TableController;
use App\Models\Gruppo;

/**
 * Classe controller per la gestione della pagina admin/permessi/gruppi
 * Classe autogenerata
 */
class AdminPermessiGruppiController extends TableController implements IController, ITableController
{

    public function __construct($alias)
    {
        $this->page = Page::getInstance();
        $this->alias = $alias;
        $this->src["alias"] = $alias;
        $this->custom_template = false;
        $this->table = "utenti_gruppi";
        $this->pk = "id_gruppo_utente";
        $this->mappings = [
            "nome" => "nome",
            "descrizione" => "descrizione"
        ];
        $this->other = [];
        $this->src["alias"] = $alias;
        $this->src["title"] = Language::get("Registra nuovo record");
        $this->src["pk"] = $this->pk;
        $this->src["custom-template"] = $this->custom_template;
        $this->src["writable"] = true;
        $this->src["edit"] = true;
        $this->src["delete"] = true;
        $this->src["add"] = true;
        $this->src["clone"] = true;
        $this->src["fields"] = [
            "nome" => [
                "label" => Language::get("Nome"),
                "writable" => true
            ],
            "descrizione" => [
                "label" => Language::get("Descrizione"),
                "writable" => true
            ]
        ];
    }

    public function edit($request)
    {
        $row = Gruppo::find($request["id"])->toArray();
        Form::mappingsAssignPost([
            $row
        ], "mod", $request["id"], $this->pk, $this->mappings, $this->page);
        $this->src["rows"] = $row;
        $this->src["view"] = "edit";
        $this->page->assign("src", $this->src);
    }

    public function show($request)
    {
        $row = Gruppo::find($request["id"])->toArray();
        $this->src["rows"] = $row;
        $this->src["view"] = "edit";
        $this->page->assign("src", $this->src);
    }

    public function index($request)
    {
        $rows = Gruppo::all()->toArray();
        $this->src["rows"] = $rows;
        $this->page->assign("src", $this->src);
    }

    public function create($request)
    {
        $this->page->assign("src", $this->src);
    }

    public function update($request, $redirect = true)
    {
        $check = $this->check($request, false);
        if (! $check)
            Page::redirect($this->alias, "", true, Language::get("Record gi?? presente"), "danger");

        $id = $request["id"];

        $obj = new Gruppo();
        foreach ($obj->getFillable() as $field)
            $params[$field] = $request[$field];

        try {
            Gruppo::where($this->pk, $id)->update($params);
        } catch (\Illuminate\Database\QueryException $ex) {

            $this->page->addError(Language::get("Errore in fase di aggiornamento"));
            return false;
        }

        if ($redirect)
            Page::redirect($this->alias, "", true, Language::get("Record aggiornato"));
        else
            return true;
    }

    public function store($request, $redirect = true)
    {
        $check = $this->check($request, true);
        if (! $check)
            Page::redirect($this->alias, "", true, Language::get("Record gi?? presente"), "danger");

        $obj = new Gruppo();
        foreach ($obj->getFillable() as $field)
            $params[$field] = $request[$field];
        $newId = $obj->insertGetId($params);

        if (! $newId) {
            $this->page->addError("Errore in fase di registrazione");
            return false;
        }

        $servizi = Servizi::getServizi("id_servizio");
        foreach ($servizi as $s)
            Servizi::addServizioGruppoRegione($newId, $s['servizio']);

        if ($redirect)
            Page::redirect($this->alias, "", true, Language::get("Record registrato"));
        else
            return true;
    }

    public function delete($request)
    {
        $result = false;
        $id = $request["id"];

        $result = Gruppo::destroy($id);

        // TODO:
        // Inserire qui la logica per effettuare l'operazione di Delete
        // Se l'operazione ?? andata a buon fine eseguire il redirect
        if (! $result) {
            $this->page->addError("Errore in fase di cancellazione");
            return false;
        }
        Page::redirect($this->alias, "", true, Language::get("Record eliminato"));
    }

    public function store_preview($request)
    {
        $newId = $this->store($request, false);
        if ($newId > 0)
            Page::redirect($this->alias . "/" . $request["id"], "", true, Language::get("Record inserito"));
    }

    public function store_new($request)
    {
        $newId = $this->store($request, false);
        if ($newId > 0)
            Page::redirect($this->alias . "/create", "", true, Language::get("Record inserito, procedi con un altro inserimento"));
    }

    public function update_preview($request)
    {
        $result = $this->update($request, false);
        if ($result)
            Page::redirect($this->alias . "/" . $request["id"], "", true, Language::get("Record aggiornato"));
    }

    public function clone($request)
    {
        // TODO:
        // Inserire qui la logica per effettuare l'operazione di Clone
        // Se l'operazione ?? andata a buon fine eseguire il redirect
        $oldRow = Gruppo::find($request["id"]);
        $newRow = $oldRow->replicate();

        $obj = new Gruppo();
        foreach ($obj->getFillable() as $field)
            if (! empty($newRow->$field))
                $newRow->$field = $oldRow->$field . " (" . Language::get("copia") . ") ";

        $newId = $newRow->save();

        if (! $newId) {
            $this->page->addError("Errore in fase di registrazione");
            return false;
        }
        Page::redirect($this->alias, "", true, Language::get("Record clonato"));
    }

    private function check($request, $isNew = false)
    {
        if (! isset($request['nome']) || empty($request['nome']))
            $errors[] = "Indicare il gruppo.";
        if (! isset($request['descrizione']) || empty($request['descrizione']))
            $errors[] = "Indicare una descrizione per il gruppo.";

        if ($isNew)
            if (Form::checkDupes($this->table, $this->mappings, array(
                "nome"
            )))
                $errors[] = "Gruppo gi?? inserito, indicare un'altra voce e riprovare!";

        foreach ($errors as $e)
            $this->page->addError($e);

        return empty($errors);
    }
}
