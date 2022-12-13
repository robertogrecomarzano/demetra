<?php
namespace App\Core\Controller;

use App\Core\IController;
use App\Core\ITableController;
use App\Core\Lib\Database;
use App\Core\Lib\Form;
use App\Core\Lib\Language;
use App\Core\Lib\Page;
use App\Core\TableController;
use App\Models\Personale;

/**
 * Classe controller per la gestione della pagina progetti/tabelle/personale
 * Classe autogenerata
 */
class ProgettiTabellePersonaleController extends TableController implements IController, ITableController
{

    public function __construct($alias)
    {
        $this->page = Page::getInstance();
        $this->alias = $alias;
        $this->src["alias"] = $alias;
        $this->custom_template = false;
        $this->table = "progetti_personale_values";
        $this->pk = "id_personale";
        $this->mappings = [
            "cognome" => "cognome",
            "nome" => "nome",
            "genere" => "genere",
            "funzione" => "funzione",
            "telefono" => "telefono",
            "email" => "email"
        ];
        $this->other = [];
        $this->src["alias"] = $alias;
        $this->src["title"] = Language::get("Registra nuovo personale");
        $this->src["pk"] = $this->pk;
        $this->src["custom-template"] = $this->custom_template;
        $this->src["writable"] = true;
        $this->src["edit"] = true;
        $this->src["delete"] = true;
        $this->src["add"] = true;
        $this->src["clone"] = true;

        $ruoli = [
            "communication_officer" => "Communication Officer",
            "coordinatore" => "Coordinatore di progetto",
            "desk_officer" => "Desk Officer",
            "financial_officer" => "Financial Officer",
            "focal_point" => "Focal Point",
            "junior_assistant" => "Junior assistant",
            "project_officer" => "Project officer",
            "redattore" => "Redattore",
            "referente" => "Referente Paese"
        ];

        $generi = [
            "F" => Language::get("Femmina"),
            "M" => Language::get("Maschio"),
            "Altro" => Language::get("Altro"),
            "Non binario" => Language::get("Non binario")
        ];

        $this->src["fields"] = [
            "cognome" => [
                "label" => Language::get("Cognome"),
                "writable" => true | false // true di default
            ],
            "nome" => [
                "label" => Language::get("Nome")
            ],
            "genere" => [
                "label" => Language::get("Genere"),
                "type" => "select",
                "others" => [
                    "src" => $generi,
                    "first" => true,
                    "required" => "required"
                ]
            ],
            "funzione" => [
                "label" => Language::get("Funzione"),
                "type" => "checkboxs",
                "others" => [
                    "help" => Language::get("almeno una voce"),
                    "src" => $ruoli,
                    "cols" => 1
                ],
                "writable" => true // true di default
            ],
            "telefono" => array(
                "label" => Language::get("Telefono"),
                "type" => "text",
                "others" => [
                    "size" => 20,
                    "max" => 20
                ],
                "writable" => true // true di default
            ),
            "email" => array(
                "label" => Language::get("Indirizzo email"),
                "type" => "text",
                "others" => [
                    "size" => 20,
                    "max" => 45
                ],
                "writable" => true // true di default
            )
        ];
    }

    public function edit($request)
    {
        $row = Personale::find($request["id"])->getOriginal();
        Form::mappingsAssignPost([
            $row
        ], "mod", $request["id"], $this->pk, $this->mappings, $this->page);
        $this->src["rows"] = $row;
        $this->src["view"] = "edit";
        $this->page->assign("src", $this->src);

        $_POST["funzione"] = [];
        foreach (explode(",", $row["funzione"]) as $f)
            $_POST["funzione"][] = $f;
    }

    public function show($request)
    {
        $row = Personale::find($request["id"])->toArray();
        $this->src["rows"] = $row;
        $this->src["view"] = "edit";
        $this->page->assign("src", $this->src);
    }

    public function index($request)
    {
        $rows = Personale::all()->toArray();
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

        $request["funzione"] = implode(",", $request["funzione"]);

        $obj = new Personale();
        foreach ($obj->getFillable() as $field)
            $params[$field] = $request[$field];
        try {

            Personale::where($this->pk, $id)->update($params);
        } catch (\Illuminate\Database\QueryException $ex) {
            $this->page->addError(Language::get("Errore in fase di aggiornamento"));
            return false;
        }
        if ($redirect)
            Page::redirect($this->alias, "", true, Language::get("Personale aggiornato"));
        else
            return true;
    }

    public function store($request, $redirect = true)
    {
        // TODO:
        // Personalizzare se necessario la logica per effettuare l'operazione di Insert
        $obj = new Personale();
        foreach ($obj->getFillable() as $field)
            $params[$field] = $request[$field];
        $newId = $obj->insertGetId($params);
        if (! $newId) {
            $this->page->addError("Errore in fase di registrazione");
            return false;
        }
        if ($redirect)
            Page::redirect($this->alias, "", true, Language::get("Personale registrato"));
        else
            return true;
    }

    public function delete($request)
    {
        $result = false;
        $id = $request["id"];
        // TODO:
        // Personalizzare se necessario la logica per effettuare l'operazione di Delete
        $result = Personale::destroy($id);
        if (! $result) {
            $this->page->addError("Errore in fase di cancellazione");
            return false;
        }
        Page::redirect($this->alias, "", true, Language::get("Personale eliminato"));
    }

    public function store_preview($request)
    {
        $newId = $this->store($request, false);
        if ($newId > 0)
            Page::redirect($this->alias . "/" . $request["id"], "", true, Language::get("Personale inserito"));
    }

    public function store_new($request)
    {
        $newId = $this->store($request, false);
        if ($newId > 0)
            Page::redirect($this->alias . "/create", "", true, Language::get("Personale inserito, procedi con un altro inserimento"));
    }

    public function update_preview($request)
    {
        $result = $this->update($request, false);
        if ($result)
            Page::redirect($this->alias . "/" . $request["id"], "", true, Language::get("Personale aggiornato"));
    }

    public function clone($request)
    {
        // TODO:
        // Personalizzare se necessario la logica per effettuare l'operazione di Clone
        $oldRow = Personale::find($request["id"]);
        $newRow = $oldRow->replicate();
        $obj = new Personale();
        foreach ($obj->getFillable() as $field)
            if (! empty($newRow->$field))
                $newRow->$field = $oldRow->$field . " (" . Language::get("copia") . ") ";
        $newId = $newRow->save();
        if (! $newId) {
            $this->page->addError("Errore in fase di clonazione");
            return false;
        }
        Page::redirect($this->alias, "", true, Language::get("Personale clonato"));
    }
}
