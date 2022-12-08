<?php
namespace App\Core\Controller;

use App\Core\IController;
use App\Core\ITableController;
use App\Core\Lib\Database;
use App\Core\Lib\Form;
use App\Core\Lib\Language;
use App\Core\Lib\Page;
use App\Core\Lib\Servizi;
use App\Models\Servizio;
use App\Core\TableController;

/**
 * Classe controller per la gestione della pagina admin/permessi/servizi
 * Classe autogenerata
 */
class AdminPermessiServiziController extends TableController implements IController, ITableController
{

    public function __construct($alias)
    {
        $this->page = Page::getInstance();
        $this->alias = $alias;
        $this->src["alias"] = $alias;
        $this->custom_template = false;
        $this->table = "servizi";
        $this->pk = "id_servizio";

        $this->mappings = [
            "servizio" => "servizio",
            "descrizione" => "descrizione",
            "menu" => "menu",
            "posizione" => "posizione"
        ];

        $this->other = [];

        $this->src["title"] = Language::get("Registra nuovo servizio");
        $this->src["alias"] = $this->alias;
        $this->src["pk"] = $this->pk;
        $this->src["custom-template"] = $this->custom_template;
        $this->src["writable"] = true;
        $this->src["edit"] = true;
        $this->src["delete"] = true;
        $this->src["add"] = true;
        $this->src["clone"] = false;
        $this->src["fields"] = [
            "servizio" => [
                "label" => Language::get("Servizio"),
                "writable" => true,
                "others" => [
                    "required" => "required"
                ]
            ],
            "descrizione" => [
                "label" => Language::get("Descrizione"),
                "writable" => true,
                "others" => [
                    "required" => "required"
                ]
            ],
            "menu" => [
                "label" => Language::get("Voce di menù"),
                "writable" => true,
                "others" => [
                    "required" => "required"
                ]
            ],
            "posizione" => [
                "label" => Language::get("Posizione"),
                "writable" => true,
                "type" => "number",
                "others" => [
                    "required" => "required"
                ]
            ]
        ];
    }

    public function edit($request)
    {
        $row = Servizio::find($request["id"])->toArray();
        Form::mappingsAssignPost([
            $row
        ], "mod", $request["id"], $this->pk, $this->mappings, $this->page);
        $this->src["rows"] = $row;
        $this->src["view"] = "edit";
        $this->page->assign("src", $this->src);
    }

    public function show($request)
    {
        $row = Servizio::find($request["id"])->toArray();
        $this->src["rows"] = $row;
        $this->src["view"] = "edit";
        $this->page->assign("src", $this->src);
    }

    public function index($request)
    {
        $rows = Servizio::all()->toArray();
        $this->src["rows"] = $rows;
        $this->page->assign("src", $this->src);
    }

    public function create($request)
    {
        $this->page->assign("src", $this->src);
    }

    public function update($request, $redirect = true)
    {
        $id = $request["id"];

        $check = $this->check($request, false);
        if (! $check)
            return false;

        $obj = new Servizio();
        foreach ($obj->getFillable() as $field)
            $params[$field] = $request[$field];

        try {
            Servizio::where($this->pk, $id)->update($params);
        } catch (\Illuminate\Database\QueryException $ex) {

            $this->page->addError(Language::get("Errore in fase di aggiornamento"));
            return false;
        }

        Database::delete("DELETE FROM servizi_default WHERE id_servizio=?", [
            $id
        ]);
        Database::delete("DELETE FROM servizi_config_gruppo WHERE id_servizio=?", [
            $id
        ]);
        Database::delete("DELETE FROM protocolli WHERE id_servizio=?", [
            $id
        ]);
        Database::delete("DELETE FROM protocolli_head_foot WHERE id_servizio=?", [
            $id
        ]);

        Database::update("UPDATE servizi SET servizio=LOWER(servizio)");

        $gruppi = Database::getRows("SELECT id_gruppo_utente FROM utenti_gruppi");
        foreach ($gruppi as $g)
            Servizi::addServizioGruppo($g['id_gruppo_utente'], $id);

        Servizi::addServizioDefault($id);

        if ($redirect)
            Page::redirect($this->alias, "", true, Language::get("Record aggiornato"));
        else
            return true;
    }

    public function store($request, $redirect = true)
    {
        $check = $this->check($request, true);
        if (! $check)
            return false;

        $obj = new Servizio();
        foreach ($obj->getFillable() as $field)
            $params[$field] = $request[$field];
        $newId = $obj->insertGetId($params);
        if (! $newId) {
            $this->page->addError("Errore in fase di registrazione");
            return false;
        }

        Database::update("UPDATE servizi SET servizio=LOWER(servizio)");

        $gruppi = Database::getRows("SELECT id_gruppo_utente FROM utenti_gruppi");
        foreach ($gruppi as $g)
            Servizi::addServizioGruppo($g['id_gruppo_utente'], $newId);

        Servizi::addServizioDefault($newId);

        if ($redirect)
            Page::redirect($this->alias, "", true, Language::get("Record registrato"));
        else
            return true;
    }

    public function delete($request)
    {
        $result = false;
        $id = $request["id"];
         
        $result = Servizio::destroy($id);
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
    {}

    private function check($request, $isNew = false)
    {
        if (! isset($request['descrizione']) || empty($request['descrizione']))
            $errors[] = "Indicare la descrizione.";
        if (! isset($request['menu']) || empty($request['menu']))
            $errors[] = "Indicare la voce del menù.";
        if (! isset($request['posizione']) || empty($request['posizione']))
            $errors[] = "Indicare la posizione.";

        if ($isNew)
            if (Form::checkDupes("servizi", [
                "servizio" => "servizio"
            ], [
                "servizio"
            ]))
                $errors[] = Language::get("Servizio già presente");
        foreach ($errors as $e)
            $this->page->addError($e);

        return empty($errors);
    }
}
