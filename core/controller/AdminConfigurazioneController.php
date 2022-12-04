<?php
namespace App\Core\Controller;

use App\Core\App;
use App\Core\BaseController;
use App\Core\Lib\Database;
use App\Core\Lib\Form;
use App\Core\Lib\Language;
use App\Core\Lib\Page;
use App\Core\IController;
use App\Core\Config;
use App\Models\Configurazione;
use Illuminate\Database\Capsule\Manager as DB;

class AdminConfigurazioneController extends BaseController implements IController
{

    public function __construct($alias)
    {
        $this->page = Page::getInstance();
        $this->alias = $alias;

        $this->table = "config";
        $this->pk = "id";

        $this->mappings = [
            "denominazione" => "denominazione",
            "sede" => "sede",
            "telefono" => "telefono",
            "email" => "email",
            "email_support" => "email_support",
            "web" => "web",
            "is_offline" => "is_offline",
            "is_debug" => "is_debug",
            "is_collaudo" => "is_collaudo",
            "mail_enable" => "mail_enable",
            "mail_smtp" => "mail_smtp",
            "mail_smtp_server" => "mail_smtp_server",
            "mail_smtp_auth" => "mail_smtp_auth",
            "mail_smtp_user" => "mail_smtp_user",
            "mail_smtp_password" => "mail_smtp_password",
            "mail_smtp_port" => "mail_smtp_port",
            "mail_smtp_secure" => "mail_smtp_secure",
            "mail_smtp_secure_type" => "mail_smtp_secure_type",
            "mail_smtp_debug" => "mail_smtp_debug"
        ];
    }

    public function edit($request)
    {
        $this->page->assign("debugs", [
            0 => "Disattivato",
            1 => "Messaggi del client",
            2 => "Messaggi del client e del server",
            3 => "Messaggi più informazioni sullo stato della connessione",
            4 => "Livello massimo"
        ]);

        $riga = Configurazione::first()->toArray();

        foreach (array_keys($riga) as $k)
            $_POST["$k"] = $riga["$k"];
    }

    public function show($request)
    {}

    public function index($request)
    {
        $riga = Configurazione::first()->toArray();
        $this->page->assign("row", $riga);
        
        $this->page->assign("debugs", [
            0 => "Disattivato",
            1 => "Messaggi del client",
            2 => "Messaggi del client e del server",
            3 => "Messaggi più informazioni sullo stato della connessione",
            4 => "Livello massimo"
        ]);
    }

    public function create($request)
    {}

    public function update($request, $redirect = true)
    {
        $request["is_offline"] = empty($request["is_offline"]) ? "0" : 1;
        $request["is_collaudo"] = empty($request["is_collaudo"]) ? "0" : 1;
        $request["is_debug"] = empty($request["is_debug"]) ? "0" : 1;

        DB::enableQueryLog();
        DB::table($this->table)->update([
            "denominazione" => $request["denominazione"],
            "sede" => $request["sede"],
            "telefono" => $request["telefono"],
            "email" => $request["email"],
            "email_support" => $request["email_support"],
            "web" => $request["web"],
            "is_offline" => $request["is_offline"],
            "is_debug" => $request["is_debug"],
            "is_collaudo" => $request["is_collaudo"]
        ]);

        App::setConfig(true);

        Page::redirect($this->alias, "", true, Language::get("Dati generali aggiornati"));
    }

    public function email($request, $redirect = true)
    {
        $request["mail_enable"] = empty($request["mail_enable"]) ? "0" : 1;
        $request["mail_smtp_auth"] = empty($request["mail_smtp_auth"]) ? "0" : 1;
        $request["mail_smtp_secure"] = empty($request["mail_smtp_secure"]) ? "0" : 1;

        DB::enableQueryLog();
        DB::table($this->table)->update([

            "mail_enable" => $request["mail_enable"],
            "mail_smtp" => $request["mail_smtp"],
            "mail_smtp_server" => $request["mail_smtp_server"],
            "mail_smtp_auth" => $request["mail_smtp_auth"],
            "mail_smtp_user" => $request["mail_smtp_user"],
            "mail_smtp_password" => $request["mail_smtp_password"],
            "mail_smtp_port" => $request["mail_smtp_port"],
            "mail_smtp_secure" => $request["mail_smtp_secure"],
            "mail_smtp_secure_type" => $request["mail_smtp_secure_type"],
            "mail_smtp_debug" => $request["mail_smtp_debug"]
        ]);

        App::setConfig(true);

        Page::redirect($this->alias, "", true, Language::get("Parametri server di posta aggiornati"));
    }

    public function store($request, $redirect = true)
    {}

    public function delete($request)
    {}
}

