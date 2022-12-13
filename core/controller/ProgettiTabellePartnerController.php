<?php
namespace App\Core\Controller;

use App\Core\IController;
use App\Core\ITableController;
use App\Core\Lib\Form;
use App\Core\Lib\Istat;
use App\Core\Lib\Language;
use App\Core\Lib\Page;
use App\Core\TableController;
use App\Models\Paese;
use App\Models\Partner;

/**
 * Classe controller per la gestione della pagina progetti/tabelle/partner
 * Classe autogenerata
 */
class ProgettiTabellePartnerController extends TableController implements IController, ITableController
{

    public function __construct($alias)
    {
        $this->page = Page::getInstance();
        $this->alias = $alias;
        $this->src["alias"] = $alias;
        $this->custom_template = false;
        $this->table = "progetti_partner_values";
        $this->pk = "id_partner";
        $this->mappings = [
            'acronimo' => 'acronimo',
            'denominazione' => 'denominazione',
            'ufficio' => 'ufficio',
            'referente' => 'referente',
            'telefono' => 'telefono',
            'email' => 'email',
            'paese' => 'paese'
        ];
        $this->other = [];
        $this->src["alias"] = $alias;
        $this->src["title"] = Language::get("Registra nuovo partner");
        $this->src["pk"] = $this->pk;
        $this->src["custom-template"] = $this->custom_template;
        $this->src["writable"] = true;
        $this->src["edit"] = true;
        $this->src["delete"] = true;
        $this->src["add"] = true;
        $this->src["clone"] = true;

        $this->src["fields"] = [
            "denominazione" => array(
                "label" => Language::get("Nome completo"),
                "type" => "text",
                "others" => [
                    "size" => 80,
                    "max" => 100,
                    "required" => true
                ],
                "writable" => true // true di default
            ),
            "acronimo" => array(
                "label" => Language::get("Acronimo"),
                "type" => "text",
                "others" => [
                    "size" => 20,
                    "max" => 45
                ],
                "writable" => true // true di default
            ),
            "paese" => array(
                "label" => Language::get("Paese"),
                "type" => "select",
                "others" => array(
                    "src" => [],
                    "first" => true,
                    "required" => "required",
                    "class" => "selectpicker",
                    "data-width" => "auto",
                    "data-live-search" => true
                )
            ),
            "ufficio" => array(
                "label" => Language::get("Ufficio"),
                "type" => "text",
                "others" => [
                    "size" => 50,
                    "max" => 100
                ],
                "writable" => true // true di default
            ),
            "referente" => array(
                "label" => Language::get("Referente"),
                "type" => "text",
                "others" => [
                    "size" => 50,
                    "max" => 45,
                    "placeholder" => "Cognome e nome"
                ],
                "writable" => true // true di default
            ),
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
                "type" => "email",
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
        $paesi = Paese::all()->sortBy('denominazione_it_IT');

        $this->src["fields"]["paese"] = [
            "label" => Language::get("Paese"),
            "type" => "select",
            "others" => [
                "src" => $paesi,
                "key" => "codice_istat_lungo",
                "label" => "denominazione_it_IT",
                "first" => true,
                "required" => "required",
                "class" => "selectpicker",
                "data-width" => "auto",
                "data-live-search" => "true",
                "mwc" => false
            ]
        ];

        $row = Partner::find($request["id"])->getOriginal();
        Form::mappingsAssignPost([
            $row
        ], "mod", $request["id"], $this->pk, $this->mappings, $this->page);
        $this->src["rows"] = $row;
        $this->src["view"] = "edit";
        $this->page->assign("src", $this->src);
    }

    public function show($request)
    {
        $row = Partner::find($request["id"])->toArray();
        $this->src["rows"] = $row;
        $this->src["view"] = "edit";
        $this->page->assign("src", $this->src);
    }

    public function index($request)
    {
        $rows = Partner::all()->toArray();
        $this->src["rows"] = $rows;
        $this->page->assign("src", $this->src);
    }

    public function create($request)
    {
        $paesi = Paese::all()->sortBy('denominazione_it_IT');

        $this->src["fields"]["paese"] = [
            "label" => Language::get("Paese"),
            "type" => "select",
            "others" => [
                "src" => $paesi,
                "key" => "codice_istat_lungo",
                "label" => "denominazione_it_IT",
                "first" => true,
                "required" => "required",
                "class" => "selectpicker",
                "data-width" => "auto",
                "data-live-search" => "true",
                "mwc" => false
            ]
        ];
        $this->page->assign("src", $this->src);
    }

    public function update($request, $redirect = true)
    {
        $result = false;
        $id = $request["id"];
        // TODO:
        // Personalizzare se necessario la logica per effettuare l'operazione di Update
        // Se l'operazione è andata a buon fine eseguire il redirect
        $obj = new Partner();
        foreach ($obj->getFillable() as $field)
            $params[$field] = $request[$field];
        try {
            Partner::where($this->pk, $id)->update($params);
        } catch (\Illuminate\Database\QueryException $ex) {
            $this->page->addError(Language::get("Errore in fase di aggiornamento"));
            return false;
        }
        if ($redirect)
            Page::redirect($this->alias, "", true, Language::get("Partner aggiornato"));
        else
            return true;
    }

    public function store($request, $redirect = true)
    {
        // TODO:
        // Personalizzare se necessario la logica per effettuare l'operazione di Insert
        $obj = new Partner();
        foreach ($obj->getFillable() as $field)
            $params[$field] = $request[$field];
        $newId = $obj->insertGetId($params);
        if (! $newId) {
            $this->page->addError("Errore in fase di registrazione");
            return false;
        }
        if ($redirect)
            Page::redirect($this->alias, "", true, Language::get("Partner registrato"));
        else
            return true;
    }

    public function delete($request)
    {
        $result = false;
        $id = $request["id"];
        // TODO:
        // Personalizzare se necessario la logica per effettuare l'operazione di Delete
        $result = Partner::destroy($id);
        if (! $result) {
            $this->page->addError("Errore in fase di cancellazione");
            return false;
        }
        Page::redirect($this->alias, "", true, Language::get("Partner eliminato"));
    }

    public function store_preview($request)
    {
        $newId = $this->store($request, false);
        if ($newId > 0)
            Page::redirect($this->alias . "/" . $request["id"], "", true, Language::get("Partner inserito"));
    }

    public function store_new($request)
    {
        $newId = $this->store($request, false);
        if ($newId > 0)
            Page::redirect($this->alias . "/create", "", true, Language::get("Partner inserito, procedi con un altro inserimento"));
    }

    public function update_preview($request)
    {
        $result = $this->update($request, false);
        if ($result)
            Page::redirect($this->alias . "/" . $request["id"], "", true, Language::get("Partner aggiornato"));
    }

    public function clone($request)
    {
        // TODO:
        // Personalizzare se necessario la logica per effettuare l'operazione di Clone
        $oldRow = Partner::find($request["id"]);
        $newRow = $oldRow->replicate();

        $obj = new Partner();
        foreach ($obj->getFillable() as $field)
            if (! empty($newRow->$field))
                $newRow->$field = $oldRow->$field . " (" . Language::get("copia") . ") ";

        $newId = $newRow->save();
        if (! $newId) {
            $this->page->addError("Errore in fase di clonazione");
            return false;
        }
        Page::redirect($this->alias, "", true, Language::get("Partner clonato"));
    }
}
