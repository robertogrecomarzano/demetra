<?php
namespace App\Core\Controller;

use App\Core\IController;
use App\Core\ITableController;
use App\Core\Lib\Form;
use App\Core\Lib\Language;
use App\Core\Lib\Page;
use App\Core\TableController;
use App\Models\Avviso;
use App\Core\Lib\CustomDate;

/**
 * Classe controller per la gestione della pagina admin/avvisi
 * Classe autogenerata
 */
class AdminAvvisiController extends TableController implements IController, ITableController
{

    public function __construct($alias)
    {
        $this->page = Page::getInstance();
        $this->alias = $alias;
        $this->src["alias"] = $alias;
        $this->custom_template = false;
        $this->table = "avvisi";
        $this->pk = "id_avviso";
        $this->mappings = [
            "titolo" => "titolo",
            "descrizione" => "descrizione",
            "descrizione_lunga" => "descrizione_lunga",
            "dal" => "dal",
            "al" => "al"
        ];
        $this->other = [];
        $this->src["alias"] = $alias;
        $this->src["title"] = Language::get("Registra nuovo avviso");
        $this->src["pk"] = $this->pk;
        $this->src["custom-template"] = $this->custom_template;
        $this->src["writable"] = true;
        $this->src["edit"] = true;
        $this->src["delete"] = true;
        $this->src["add"] = true;
        $this->src["clone"] = true;
        $this->src["fields"] = [
            "titolo" => [
                "label" => Language::get("Titolo"),
                "writable" => true,
                "others" => [
                    "required" => "required"
                ]
            ],
            "descrizione" => [
                "label" => Language::get("Descrizione"),
                "type" => "textarea",
                "writable" => true | false // true di default
            ],
            "descrizione_lunga" => [
                "label" => Language::get("Descrizione lunga"),
                "type" => "textarea",
                "writable" => true | false // true di default
            ],
            "dal" => [
                "label" => Language::get("Dalla data"),
                "type" => "calendar",
                "writable" => true,
                "others" => [
                    "required" => "required"
                ]
            ],
            "al" => [
                "label" => Language::get("Alla data"),
                "type" => "calendar",
                "writable" => true,
                "others" => [
                    "required" => "required"
                ]
            ]
        ];

        $this->page->addPlugin("calendar");
    }

    public function edit($request)
    {
        $row = Avviso::find($request["id"])->toArray();
        Form::mappingsAssignPost([
            $row
        ], "mod", $request["id"], $this->pk, $this->mappings, $this->page);
        $this->src["rows"] = $row;
        $this->src["view"] = "edit";
        $this->page->assign("src", $this->src);
    }

    public function show($request)
    {
        $row = Avviso::find($request["id"])->toArray();
        $this->src["rows"] = $row;
        $this->src["view"] = "edit";
        $this->page->assign("src", $this->src);
    }

    public function index($request)
    {
        $rows = Avviso::all()->toArray(); // TODO: modificare le date dal al con formato d/m/y
        $this->src["rows"] = $rows;
        $this->page->assign("src", $this->src);
    }

    public function create($request)
    {
        $this->page->assign("src", $this->src);
    }

    public function update($request, $redirect = true)
    {
        $request["dal"] = CustomDate::format($request["dal"]);
        $request["al"] = CustomDate::format($request["al"]);
        $result = false;
        $id = $request["id"];
        // TODO:
        // Personalizzare se necessario la logica per effettuare l'operazione di Update
        // Se l'operazione è andata a buon fine eseguire il redirect
        $obj = new Avviso();
        foreach ($obj->getFillable() as $field)
            $params[$field] = $request[$field];
        try {
            Avviso::where($this->pk, $id)->update($params);
        } catch (\Illuminate\Database\QueryException $ex) {
            $this->page->addError(Language::get("Errore in fase di aggiornamento"));
            return false;
        }
        if ($redirect)
            Page::redirect($this->alias, "", true, Language::get("Avviso aggiornato"));
        else
            return true;
    }

    public function store($request, $redirect = true)
    {
        // TODO:
        // Personalizzare se necessario la logica per effettuare l'operazione di Insert
        $request["dal"] = CustomDate::format($request["dal"]);
        $request["al"] = CustomDate::format($request["al"]);
        $obj = new Avviso();
        foreach ($obj->getFillable() as $field)
            $params[$field] = $request[$field];
        $newId = $obj->insertGetId($params);
        if (! $newId) {
            $this->page->addError("Errore in fase di registrazione");
            return false;
        }
        if ($redirect)
            Page::redirect($this->alias, "", true, Language::get("Avviso registrato"));
        else
            return true;
    }

    public function delete($request)
    {
        $result = false;
        $id = $request["id"];
        // TODO:
        // Personalizzare se necessario la logica per effettuare l'operazione di Delete
        $result = Avviso::destroy($id);
        if (! $result) {
            $this->page->addError("Errore in fase di cancellazione");
            return false;
        }
        Page::redirect($this->alias, "", true, Language::get("Avviso eliminato"));
    }

    public function store_preview($request)
    {
        $newId = $this->store($request, false);
        if ($newId > 0)
            Page::redirect($this->alias . "/" . $request["id"], "", true, Language::get("Avviso inserito"));
    }

    public function store_new($request)
    {
        $newId = $this->store($request, false);
        if ($newId > 0)
            Page::redirect($this->alias . "/create", "", true, Language::get("Avviso inserito, procedi con un altro inserimento"));
    }

    public function update_preview($request)
    {
        $result = $this->update($request, false);
        if ($result)
            Page::redirect($this->alias . "/" . $request["id"], "", true, Language::get("Avviso aggiornato"));
    }

    public function clone($request)
    {
        // TODO:
        // Personalizzare se necessario la logica per effettuare l'operazione di Clone
        $oldRow = Avviso::find($request["id"]);
        $newRow = $oldRow->replicate();
        $newId = $newRow->save();
        if (! $newId) {
            $this->page->addError("Errore in fase di clonazione");
            return false;
        }
        Page::redirect($this->alias, "", true, Language::get("Avviso clonato"));
    }
}
