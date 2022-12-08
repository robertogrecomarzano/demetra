<?php
namespace App\Core\Controller;

use App\Core\BaseController;
use App\Core\IController;
use App\Core\Lib\Database;
use App\Core\Lib\Language;
use App\Core\Lib\Page;

/**
 * Classe controller per la gestione della pagina admin/permessi/associaservizi
 * Classe autogenerata
 */
class AdminPermessiAssociaserviziController extends BaseController implements IController
{

    public function __construct($alias)
    {
        $this->page = Page::getInstance();
        $this->alias = $alias;

        $this->table = "servizi_config_gruppo";
        $this->pk = "id";

        $this->mappings = [
            "id_gruppo_utente" => "gruppo",
            "id_servizio" => "servizio",
            "is_attivo" => "attivo"
        ];
    }

    public function edit($request)
    {
        $data = [];
        $gruppi = Database::getRows("SELECT id_gruppo_utente,descrizione FROM utenti_gruppi");
        foreach ($gruppi as $gruppo) {
            $sql = "SELECT r.id,
                	IF(is_attivo,CONCAT('<b>',s.menu,'</b>'),CONCAT('<i>',s.menu,'</i>')) AS servizio,
                	s.descrizione,
                	id_servizio,is_attivo
                	FROM servizi s
                	LEFT JOIN $this->table r USING(id_servizio)
                	LEFT JOIN servizi_default d USING(id_servizio)
                	LEFT JOIN utenti_gruppi g USING(id_gruppo_utente)
                	WHERE  id_gruppo_utente=?
                	ORDER BY servizio";
            $rows = Database::getRows($sql, [
                $gruppo["id_gruppo_utente"]
            ]);
            $data[$gruppo["descrizione"]]["servizi"] = $rows;
            $data[$gruppo["descrizione"]]["tot"] = count($rows);
        }

        $this->page->assign("righe", $data);

        // --
        // Il valore del POST va impostato dopo assign template
        // --
        $attivi = Database::getRows("SELECT t.id FROM  $this->table  t WHERE is_attivo=1");
        foreach ($attivi as $a) {
            $id = $a['id'];
            $_POST["attivo[$id]"] = "1";
        }
    }

    public function show($request)
    {}

    public function index($request)
    {
        $data = [];
        $gruppi = Database::getRows("SELECT id_gruppo_utente,descrizione FROM utenti_gruppi");
        foreach ($gruppi as $gruppo) {
            $sql = "SELECT r.id,
                	IF(is_attivo,CONCAT('<b>',s.menu,'</b>'),CONCAT('<i>',s.menu,'</i>')) AS servizio,
                	s.descrizione,
                	id_servizio,is_attivo
                	FROM servizi s
                	LEFT JOIN $this->table r USING(id_servizio)
                	LEFT JOIN servizi_default d USING(id_servizio)
                	LEFT JOIN utenti_gruppi g USING(id_gruppo_utente)
                	WHERE  id_gruppo_utente=?
                	ORDER BY servizio";
            $rows = Database::getRows($sql, [
                $gruppo["id_gruppo_utente"]
            ]);
            $data[$gruppo["descrizione"]]["servizi"] = $rows;
            $data[$gruppo["descrizione"]]["tot"] = count($rows);
        }

        $this->page->assign("righe", $data);
    }

    public function create($request)
    {}

    public function update($request, $redirect = true)
    {
        Database::update("UPDATE $this->table SET is_attivo=0"); // Disattivo tutti i servizi per il sito

        $permessi = $request['attivo']; // prendo i servizi da attivare per i rispettivi gruppi
        if (count($permessi) > 0)
            foreach ($permessi as $k => $p) {
                Database::update("UPDATE  $this->table SET is_attivo=1 WHERE id=?", array(
                    $k
                )); // Attivo i servizi per il sito

                $row = Database::getRow("SELECT id_gruppo_utente,id_servizio FROM servizi_config_gruppo WHERE id=?", array(
                    $k
                ));
                $id_gruppo = $row["id_gruppo_utente"];
                $id_servizio = $row["id_servizio"];

                // prendo gli utenti del gruppo [per il sito in quetione]
                $utenti = Database::getRows("SELECT DISTINCT id_utente FROM utenti_has_gruppi JOIN utenti u USING(id_utente) WHERE id_gruppo_utente=?", array(
                    $id_gruppo
                ));

                foreach ($utenti as $u) {
                    Database::insert("INSERT IGNORE INTO servizi_utenti SET id_utente=?, id_servizio=?, id_gruppo=?", array(
                        $u['id_utente'],
                        $id_servizio,
                        $id_gruppo
                    ));
                }
            }

        // Disabilito i servizi_utenti per gli utenti dei gruppi che non sono chekkati
        $disabilitati = Database::getRows("SELECT id from $this->table WHERE is_attivo=0");
        foreach ($disabilitati as $d) {
            $row = Database::getRow("SELECT id_gruppo_utente,id_servizio FROM servizi_config_gruppo WHERE id=?", array(
                $d["id"]
            ));
            $id_gruppo = $row["id_gruppo_utente"];
            $id_servizio = $row["id_servizio"];
            // prendo gli utenti del gruppo
            $utenti = Database::getRows("SELECT DISTINCT id_utente FROM utenti_has_gruppi JOIN utenti u USING(id_utente) WHERE id_gruppo_utente=?", array(
                $id_gruppo
            ));
            foreach ($utenti as $u) {
                Database::delete("DELETE FROM servizi_utenti WHERE id_utente=? AND id_servizio=? AND id_gruppo=?", array(
                    $u["id_utente"],
                    $id_servizio,
                    $id_gruppo
                ));
            }
        }

        if ($redirect)
            Page::redirect($this->alias, "", true, Language::get("Record aggiornato"));
        else
            return true;
    }

    public function store($request, $redirect = true)
    {}

    public function delete($request)
    {}
}
