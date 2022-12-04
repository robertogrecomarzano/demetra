<?php
namespace App\Core\Controller;

use App\Core\BaseController;
use App\Core\Config;
use App\Core\User;
use App\Core\Lib\Database;
use App\Core\Lib\Page;
use App\Core\Lib\Servizi;
use App\Core\IController;

class AuthenticationLoginController extends BaseController implements IController
{

    public function __construct($alias)
    {
        $this->page = Page::getInstance();
        $this->page->template = Config::$serverRoot . DS . "core" . DS . "templates" . DS . "tpl" . DS . "authentication" . DS . "login.tpl";
        $this->alias = $alias;
    }

    public function index($request)
    {}

    public function edit($request)
    {}

    public function show($request)
    {}

    public function create($request)
    {}

    public function update($request, $redirect = true)
    {}

    public function store($request, $redirect = true)
    {
        if (User::isUserLogged())
            Page::redirect("home");

        if (isset($request['username']) && isset($request['password'])) {
            $isValidLogin = User::login($request['username'], $request['password']);

            if (! $isValidLogin)
                $this->page->addError("Errore di login");
            else {
                $idUtente = User::getLoggedUserId();

                // Abilito i servizi per l'utente, sistemando così eventuali problemi di associazioni mancanti
                $default = Servizi::getServiziDefault("id_servizio", true);
                $idUtente = $_SESSION['user']["id"];

                foreach ($default as $s)
                    Servizi::addServizioUtente($idUtente, $s);

                $default_page = Database::getField("SELECT default_page FROM utenti WHERE id_utente=?", array(
                    $idUtente
                ));
                $default_page = is_null($default_page) ? "user/$idUtente" : $default_page;

                Page::redirect($default_page);
            }
        }

        # Page::redirect("home");
    }

    public function delete($request)
    {}
}

