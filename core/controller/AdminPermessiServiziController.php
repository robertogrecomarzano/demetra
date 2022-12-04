<?php
namespace App\Core\Controller;

use App\Core\ITableController;
use App\Core\TableController;
use App\Core\Lib\Form;
use App\Core\Lib\Language;
use App\Core\Lib\Page;
use App\Core\Lib\Servizi;
use App\Models\Servizio;

/**
 * Classe controller per la gestione della pagina admin/permessi/servizi
 * Classe autogenerata
 */
class AdminPermessiServiziController extends TableController implements ITableController
{

    public function __construct($alias)
    {
        $this->page = Page::getInstance();
        $this->alias = $alias;

        /**
         * Se la tabella prevede altre tabelle di lookup, usare il template custom (custom_template=true)
         * Esempio, tabella utente che ha gruppi e servizi associati per i quali occorre creare dei check specifici
         */

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

    public function index($request)
    {
        $rows = Servizi::getServiziLista();

        $this->src["rows"] = $rows;
        $this->page->assign("src", $this->src);
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
        $this->src["view"] = "show";
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
        // Inserire qui la logica per effettuare l'operazione di Update
        // Se l'operazione è andata a buon fine eseguire il redirect

        if (! $result)
            return false;

        if ($redirect)
            Page::redirect($this->alias, "", true, Language::get("Servizio aggiornato"));
        else
            return true;
    }

    public function store($request, $redirect = true)
    {
        $result = false;
        $id = null;

        // TODO:
        // Inserire qui la logica per effettuare l'operazione di Insert
        // Se l'operazione è andata a buon fine eseguire il redirect

        if (! $newId)
            return $newId;

        if ($redirect)
            Page::redirect($this->alias, "", true, Language::get("Servizio registrato"));
        else
            return true;
    }

    public function delete($request)
    {
        $result = false;
        $id = $request["id"];

        // TODO:
        // Inserire qui la logica per effettuare l'operazione di Delete
        // Se l'operazione è andata a buon fine eseguire il redirect

        if (! $result)
            return false;

        Page::redirect($this->alias, "", true, Language::get("Servizio eliminato"));
    }

    public function store_preview($request)
    {
        $newId = $this->store($request, false);
        if ($newId > 0)
            Page::redirect($this->alias . "/" . $newId, "", true, Language::get("Servizio inserito"));
    }

    public function update_preview($request)
    {
        $result = $this->update($request, false);
        if ($result)
            Page::redirect($this->alias . "/" . $request["id"], "", true, Language::get("Servizio aggiornato"));
    }

    public function store_new($request)
    {
        $newId = $this->store($request, false);
        if ($newId > 0)
            Page::redirect($this->alias . "/create", "", true, Language::get("Servizio inserito, procedi con un altro inserimento"));
    }

    public function clone($request, $redirect = true)
    {
        // TODO:
        // Inserire qui la logica per effettuare l'operazione di Clone
        // Se l'operazione è andata a buon fine eseguire il redirect
        Page::redirect($this->alias, "", true, Language::get("Servizio clonato"));
    }
}
