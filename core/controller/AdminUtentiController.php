<?php
namespace App\Core\Controller;

use App\Core\Lib\Database;
use App\Core\Lib\Form;
use App\Core\Lib\Language;
use App\Core\Lib\Page;
use App\Core\Lib\Servizi;
use App\Core\TableController;
use App\Core\User;
use App\Core\Lib\Message;
use App\Core\ITableController;
use App\Models\Servizio;
use App\Models\Utente;
use App\Models\Gruppo;
use Illuminate\Support\Facades\DB;

class AdminUtentiController extends TableController implements ITableController
{

    public function __construct($alias)
    {
        $this->page = Page::getInstance();
        $this->alias = $alias;

        /**
         * Se la tabella prevede altre tabelle di lookup, usare il template custom (custom_template=true)
         * Esempio, tabella utente che ha gruppi e servizi associati per i quali occorre creare dei check specifici
         */

        $this->custom_template = true;

        $this->table = "utenti";
        $this->pk = "id_utente";

        $this->mappings = [
            "cognome" => "cognome",
            "nome" => "nome",
            "username" => "username",
            "email" => "email",
            "readonly" => "readonly"
        ];

        $this->other = [
            "record_attivo" => 1
        ];

        $this->src["title"] = Language::get("Registra nuovo utente");
        $this->src["alias"] = $this->alias;
        $this->src["pk"] = $this->pk;
        $this->src["custom-template"] = $this->custom_template;
        $this->src["writable"] = true;
        $this->src["edit"] = true;
        $this->src["delete"] = true;
        $this->src["add"] = true;
        $this->src["fields"] = [
            "cognome" => [
                "label" => Language::get("Cognome"),
                "writable" => true,
                "others" => [
                    "required" => "required"
                ]
            ],
            "nome" => [
                "label" => Language::get("Nome"),
                "writable" => true,
                "others" => [
                    "required" => "required"
                ]
            ],
            "username" => [
                "label" => Language::get("Username"),
                "writable" => true,
                "others" => [
                    "required" => "required"
                ]
            ],
            "password" => [
                "label" => Language::get("Password"),
                "writable" => true,
                "others" => [
                    "hidden" => true,
                    "required" => "required"
                ]
            ],
            "email" => [
                "label" => Language::get("Email"),
                "writable" => true,
                "others" => [
                    "required" => "required"
                ]
            ],
            "sola_lettura" => array(
                "label" => Language::get("Accesso in sola lettura"),
                "type" => "checkbox"
            )
        ];
    }

    public function edit($request)
    {
        $row = Utente::find($request["id"])->toArray();
        Form::mappingsAssignPost([
            $row
        ], "mod", $request["id"], $this->pk, $this->mappings, $this->page);

        $utente = Utente::find($request["id"]);

        unset($_POST['gruppo']);
        $gruppi = $utente->gruppi()->get();
        foreach ($gruppi as $a)
            $_POST['gruppo'][] = $a['id_gruppo_utente'];

        unset($_POST['servizio']);
        $servizi = $utente->servizi()->get();
        foreach ($servizi as $ids)
            $_POST['servizio'][] = $ids['id_servizio'];

        $this->page->assign("id", $request["id"]);
        $this->src["rows"] = $row;

        $this->page->assign("src", $this->src);

        $this->assignOthersParams();
    }

    public function show($request)
    {
        $row = Utente::find($request["id"])->toArray();

        $utente = Utente::find($request["id"]);

        $gruppi = $utente->gruppi()->get();
        foreach ($gruppi as $gruppo)
            $row["gruppi"][] = $gruppo->descrizione;
        $row["gruppo"] = implode(", ", $row["gruppi"]);

        $servizi = $utente->servizi()->get();
        foreach ($servizi as $servizio)
            $row["servizi"][] = $servizio->descrizione;
        $row["servizi"] = implode(", ", $row["servizi"]);

        $this->src["rows"] = $row;

        $this->page->assign("src", $this->src);
    }

    public function index($request)
    {
        $rows = Utente::all()->where("record_attivo", "=", 1)->toArray();
        foreach ($rows as &$row) {
            $utente = Utente::find($row["id_utente"]);

            $gruppi = $utente->gruppi()->get();
            foreach ($gruppi as $gruppo)
                $row["gruppi"][] = $gruppo->descrizione;
            $row["profili"] = implode(", ", $row["gruppi"]);

            $servizi = $utente->servizi()->get();
            foreach ($servizi as $servizio)
                $row["servizi"][] = $servizio->descrizione;
            $row["servizi"] = implode(", ", $row["servizi"]);
        }

        $this->src["rows"] = $rows;
        $this->page->assign("src", $this->src);
    }

    public function create($request)
    {
        $this->page->assign("src", $this->src);
        $this->assignOthersParams();
    }

    public function update($request, $redirect = true)
    {
        $_POST = $request;

        if (! isset($_POST['readonly']))
            $_POST["readonly"] = "0";

        $check = $this->checkRequired($_POST, [
            "password"
        ]);
        if (! $check) {
            $this->edit($request);
            return;
        }

        $newId = $request["id"];
        $newId = Form::processAction("mod2", $newId, $this->table, $this->pk, $this->mappings, $this->other);

        Database::delete("DELETE FROM utenti_has_gruppi WHERE id_utente=?", array(
            $newId
        ));

        if (isset($request['gruppo']))
            foreach ($request['gruppo'] as $g) {
                Database::insert("INSERT INTO utenti_has_gruppi SET id_utente=?, id_gruppo_utente=?", [
                    $newId,
                    $g
                ]);
            }

        Database::delete("DELETE FROM servizi_utenti WHERE id_utente=?", [
            $newId
        ]);
        if (isset($request['servizio']))
            foreach ($request['servizio'] as $ids)
                Servizi::addServizioUtente($newId, $ids);

        $subject = Language::get("Registrazione utente");

        /**
         * Invio mail
         */
        $msg = new Message("registrazione", null, null, $subject, $request['cognome'] . " " . $request['nome'], $request['email'], array(
            "username" => $request["username"],
            "password" => $request["password"],
            "nominativo" => $request['cognome'] . " " . $request['nome']
        ));
        $msg->render();

        if ($redirect)
            Page::redirect($this->alias, "", true, Language::get("Utente aggiornato"));
        else
            return $newId;
    }

    public function store($request, $redirect = true)
    {
        $_POST = $request;

        $password = null;
        if (! empty($_POST['password'])) {
            $password = User::saltPassword($_POST['password']);
            $this->other["password"] = $password;
        }

        if (! isset($_POST['readonly']))
            $_POST["readonly"] = "0";

        $check = $this->checkRequired($_POST);
        if (! $check) {
            $this->create($request);
            return;
        }

        $newId = 0;
        $newId = Form::processAction("add2", $newId, $this->table, $this->pk, $this->mappings, $this->other);

        Database::delete("DELETE FROM utenti_has_gruppi WHERE id_utente=?", array(
            $newId
        ));

        if (isset($request['gruppo']))
            foreach ($request['gruppo'] as $g)
                Database::insert("INSERT INTO utenti_has_gruppi SET id_utente=?, id_gruppo_utente=?", array(
                    $newId,
                    $g
                ));

        Database::delete("DELETE FROM servizi_utenti WHERE id_utente=?", array(
            $newId
        ));
        if (isset($request['servizio']))
            foreach ($request['servizio'] as $ids)
                Servizi::addServizioUtente($newId, $ids);

        $subject = Language::get("Registrazione utente");

        /**
         * Invio mail
         */
        $msg = new Message("registrazione", null, null, $subject, $request['cognome'] . " " . $request['nome'], $request['email'], array(
            "username" => $request["username"],
            "password" => $request["password"],
            "nominativo" => $request['cognome'] . " " . $request['nome']
        ));
        $msg->render();

        if ($redirect)
            Page::redirect($this->alias, "", true, Language::get("Utente inserito"));
        else
            return $newId;
    }

    public function store_preview($request)
    {
        $_POST = $request;
        $newId = $this->store($request, false);
        if ($newId > 0)
            Page::redirect($this->alias . "/$newId", "", true, Language::get("Utente inserito"));
    }

    public function store_new($request)
    {
        $_POST = $request;
        $newId = $this->store($request, false);
        if ($newId > 0)
            Page::redirect($this->alias . "/create", "", true, Language::get("Utente inserito"));
    }

    public function delete($request)
    {
        $utente = Utente::find($request["id"]);
        if ($utente) {
            $utente->record_attivo = 0;
            $utente->save();
        }

        Page::redirect($this->alias, "", true, Language::get("Utente eliminato"));
    }

    /**
     * Assegna altre variabili per la creazione o modifica di un record
     */
    private function assignOthersParams()
    {
        $gruppi = [];

        foreach (Gruppo::all()->pluck('descrizione', 'id_gruppo_utente') as $key => $gruppo)
            $gruppi[$key] = $gruppo;
        $this->page->assign("gruppi", $gruppi);

        $servizi = Servizio::all()->pluck('descrizione', 'id_servizio');
        foreach ($servizi as $key => $servizio)
            $servizi[$key] = $servizio;
        $this->page->assign("servizi", $servizi);
    }

    public function update_preview($request)
    {
        $_POST = $request;
        $newId = $this->update($request, false);
        if ($newId > 0)
            Page::redirect($this->alias . "/$newId", "", true, Language::get("Utente aggiornato"));
    }
}

