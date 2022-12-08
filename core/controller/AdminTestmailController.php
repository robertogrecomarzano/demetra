<?php
namespace App\Core\Controller;

use App\Core\BaseController;
use App\Core\Config;
use App\Core\IController;
use App\Core\Lib\Language;
use App\Core\Lib\Page;
use App\Core\Lib\Message;

/**
 * Classe controller per la gestione della pagina admin/testmail
 * Classe autogenerata
 */
class AdminTestmailController extends BaseController implements IController
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
    {}

    public function create($request)
    {}

    public function update($request, $redirect = true)
    {}

    public function store($request, $redirect = true)
    {}

    public function delete($request)
    {}

    public function send($request)
    {
        $oggetto = $request["oggetto"];
        $testo = str_replace("\n", '<br/>', $request["messaggio"]);
        $destinatario = $request["destinatario"];
        $email_destinatario = empty($request["email"]) ? Config::$config["email"] : $request["email"];

        $msg = new Message("test", null, null, $oggetto, $destinatario, $email_destinatario, [
            "oggetto" => $oggetto,
            "testo" => $testo
        ]);
        $ret = $msg->render();

        if ($ret["SUCCESS"] === "FALSE") {

            $this->page->assign("return", print_r($ret["ERROR"], true));
            $this->page->assign("debug_message", $ret["DEBUG"]);
        }

        $this->page->assign("return", print_r($ret["ERROR"], true));
        $this->page->assign("debug_message", $ret["DEBUG"]);
    }
}
