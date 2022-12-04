<?php
namespace App\Core\Controller;

use App\Core\BaseController;
use App\Core\Config;
use App\Core\User;
use App\Core\Lib\Database;
use App\Core\Lib\Page;
use App\Core\Lib\Servizi;
use App\Core\IController;

class AuthenticationLogoutController extends BaseController implements IController
{

    public function __construct($alias)
    {
        $this->page = Page::getInstance();
        $this->page->template = Config::$serverRoot . DS . "core" . DS . "templates" . DS . "authentication" . DS . "tpl" . DS . "login.tpl";
        $this->alias = $alias;
    }

    public function index($request)
    {
        User::logout();
        header("Location: " . Config::$urlRoot . "/authentication/login");
        die();
    }

    public function edit($request)
    {}

    public function show($request)
    {}

    public function create($request)
    {}

    public function update($request, $redirect = true)
    {}

    public function store($request, $redirect = true)
    {}

    public function delete($request)
    {}
}

