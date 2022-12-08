<?php
namespace App\Core\Controller;

use App\Core\BaseController;
use App\Core\IController;
use App\Core\Lib\Database;
use App\Core\Lib\Language;
use App\Core\Lib\Page;

/**
 * Classe controller per la gestione della pagina admin/utenti/online
 * Classe autogenerata
 */
class AdminUtentiOnlineController extends BaseController implements IController
{

    public function __construct($alias)
    {
        $this->page = Page::getInstance();
        $this->alias = $alias;
        $this->src["alias"] = $alias;
    }

    public function edit($request)
    {}

    public function show($request)
    {}

    public function index($request)
    {
        $rows = Database::getRows("SELECT u.*,o.*,
             CONCAT(cognome,' ',u.nome) AS utente,
             GROUP_CONCAT(g.nome SEPARATOR ', ') AS gruppo,
             DATE_FORMAT(tm,'%d/%m/%Y %H.%i.%s') AS orario
             FROM utenti u
             JOIN utenti_has_gruppi USING(id_utente)
             JOIN utenti_gruppi g USING(id_gruppo_utente)
             JOIN utenti_online o USING(id_utente)
             WHERE o.status=1
             GROUP BY u.id_utente ORDER BY tm DESC");

        $this->page->assign("righe", $rows);
    }

    public function create($request)
    {}

    public function update($request, $redirect = true)
    {}

    public function store($request, $redirect = true)
    {}

    public function delete($request)
    {}
}
