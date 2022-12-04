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
        $row = Database::getRow("SELECT * FROM $this->table WHERE $this->pk=?", [
            $request["id"]
        ]);
        Form::mappingsAssignPost([
            $row
        ], "mod", $request["id"], $this->pk, $this->mappings, $this->page);

        unset($_POST['gruppo']);
        $gruppo = Database::getRows("SELECT * FROM utenti_gruppi g JOIN utenti_has_gruppi USING(id_gruppo_utente) WHERE id_utente=?", [
            $request["id"]
        ]);
        foreach ($gruppo as $a)
            $_POST['gruppo'][] = $a['id_gruppo_utente'];

        unset($_POST['servizio']);
        $servizio = Database::getRows("SELECT DISTINCT cs.id_servizio,  cs.servizio
			FROM servizi_utenti us
			JOIN servizi cs USING(id_servizio)
			JOIN servizi_config_gruppo USING(id_servizio)
			WHERE id_utente=?", [
            $request["id"]
        ]);
        foreach ($servizio as $ids)
            $_POST['servizio'][] = $ids['id_servizio'];

        $this->page->assign("id", $request["id"]);
        $this->src["rows"] = $row;

        $this->page->assign("src", $this->src);

        $this->assignOthersParams();
    }

    public function show($request)
    {
        $row = Database::getRow("SELECT * FROM $this->table WHERE $this->pk=?", [
            $request["id"]
        ]);

        $gruppo = Database::getRows("SELECT g.nome FROM utenti_gruppi g JOIN utenti_has_gruppi USING(id_gruppo_utente) WHERE id_utente=?", [
            $request["id"]
        ]);
        foreach ($gruppo as $a)
            $row['gruppo'][] = $a['nome'];
        $row["gruppo"] = implode(", ", $row["gruppo"]);

        $servizio = Database::getRows("SELECT DISTINCT cs.id_servizio,  cs.servizio
			FROM servizi_utenti us
			JOIN servizi cs USING(id_servizio)
			JOIN servizi_config_gruppo USING(id_servizio)
			WHERE id_utente=?", [
            $request["id"]
        ]);
        foreach ($servizio as $a)
            $row['servizi'][] = $a['servizio'];
        $row["servizi"] = implode(", ", $row["servizi"]);

        $this->src["rows"] = $row;

        $this->page->assign("src", $this->src);
    }

    public function index($request)
    {
        $sql = "SELECT u.*, GROUP_CONCAT(DISTINCT(g.nome)) AS profili
            FROM utenti u
            LEFT JOIN utenti_has_gruppi ug USING(id_utente)
            LEFT JOIN utenti_gruppi g USING(id_gruppo_utente)
            WHERE u.record_attivo=1
            GROUP BY id_utente
            ORDER BY g.nome ASC";

        $rows = Database::getRows($sql);

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
                echo "$newId,$g,<br>";
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
        
        // TODO: inserire la logica per il DELETE
        Page::redirect($this->alias, "", true, Language::get("Utente eliminato"));
    }

    /**
     * Assegna altre variabili per la creazione o modifica di un record
     */
    private function assignOthersParams()
    {
        foreach (Database::getRows("SELECT id_gruppo_utente,descrizione FROM utenti_gruppi") as $gruppo)
            $gruppi[$gruppo["id_gruppo_utente"]] = $gruppo["descrizione"];
        $this->page->assign("gruppi", $gruppi);

        foreach (Database::getRows("SELECT DISTINCT id_servizio,descrizione FROM servizi_config_gruppo cs JOIN servizi USING(id_servizio)") as $servizio)
            $servizi[$servizio["id_servizio"]] = $servizio["descrizione"];
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

