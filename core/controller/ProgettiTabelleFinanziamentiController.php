<?php
namespace App\Core\Controller;

use App\Core\IController;
use App\Core\ITableController;
use App\Core\Lib\Form;
use App\Core\Lib\Language;
use App\Core\Lib\Page;
use App\Core\TableController;
use App\Models\Donatore;
use App\Models\Finanziamento;

/**
 * Classe controller per la gestione della pagina progetti/tabelle/finanziamenti
 * Classe autogenerata
 */
class ProgettiTabelleFinanziamentiController extends TableController implements IController, ITableController
{

    public function __construct($alias)
    {
        $this->page = Page::getInstance();
        $this->alias = $alias;
        $this->src["alias"] = $alias;
        $this->custom_template = false;
        $this->table = "progetti_finanziamenti_values";
        $this->pk = "id_finanziamento";
        $this->mappings = [
            "acronimo" => "acronimo",
            "finanziamento" => "finanziamento",
            "id_donatore" => "id_donatore"
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

        $donatori = Donatore::all()->pluck('donatore', 'id_donatore', 'id_donatore');

        $this->src["fields"] = [
            "acronimo" => [
                "label" => Language::get("Acronimo"),
                "writable" => true | false // true di default
            ],
            "finanziamento" => [
                "label" => Language::get("Programma di finanziamento")
            ],
            "id_donatore" => [
                "label" => Language::get("Donatore"),
                "type" => "select",
                "others" => [
                    "src" => $donatori,
                    "first" => true,
                    "required" => "required"
                ]
            ]
        ];
    }

    public function edit($request)
    {
        $row = Finanziamento::find($request["id"])->getOriginal();
        Form::mappingsAssignPost([
            $row
        ], "mod", $request["id"], $this->pk, $this->mappings, $this->page);
        $this->src["rows"] = $row;
        $this->src["view"] = "edit";
        $this->page->assign("src", $this->src);
    }

    public function show($request)
    {
        $row = Finanziamento::find($request["id"])->toArray();
        $this->src["rows"] = $row;
        $this->src["view"] = "edit";
        $this->page->assign("src", $this->src);
    }

    public function index($request)
    {
        $rows = Finanziamento::all()->toArray();
        $this->src["rows"] = $rows;
        $this->page->assign("src", $this->src);
    }

    public function create($request)
    {
        $this->page->assign("src", $this->src);
    }

    public function update($request, $redirect = true)
    {
        $result = false;
        $id = $request["id"];
        // TODO:
        // Personalizzare se necessario la logica per effettuare l'operazione di Update
        // Se l'operazione è andata a buon fine eseguire il redirect
        $obj = new Finanziamento();
        foreach ($obj->getFillable() as $field)
            $params[$field] = $request[$field];
        try {
            Finanziamento::where($this->pk, $id)->update($params);
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
        // TODO:
        // Personalizzare se necessario la logica per effettuare l'operazione di Insert
        $obj = new Finanziamento();
        foreach ($obj->getFillable() as $field)
            $params[$field] = $request[$field];
        $newId = $obj->insertGetId($params);
        if (! $newId) {
            $this->page->addError("Errore in fase di registrazione");
            return false;
        }
        if ($redirect)
            Page::redirect($this->alias, "", true, Language::get("Record registrato"));
        else
            return true;
    }

    public function delete($request)
    {
        $result = false;
        $id = $request["id"];
        // TODO:
        // Personalizzare se necessario la logica per effettuare l'operazione di Delete
        $result = Finanziamento::destroy($id);
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
        // Personalizzare se necessario la logica per effettuare l'operazione di Clone
        $oldRow = Finanziamento::find($request["id"]);
        $newRow = $oldRow->replicate();
        
        $obj = new Finanziamento();
        foreach ($obj->getFillable() as $field)
            if (! empty($newRow->$field))
                $newRow->$field = $oldRow->$field . " (" . Language::get("copia") . ") ";
            
        $newId = $newRow->save();
        if (! $newId) {
            $this->page->addError("Errore in fase di clonazione");
            return false;
        }
        Page::redirect($this->alias, "", true, Language::get("Record clonato"));
    }
}
