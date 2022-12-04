<?php
namespace App\Core\Controller;

use App\Core\BaseController;
use App\Core\Config;
use App\Core\IController;
use App\Core\Lib\Page;

/**
 * Classe controller per la gestione della pagina error
 * Classe autogenerata
 */
class ErrorController extends BaseController implements IController
{

    public function __construct($alias)
    {
        $this->page = Page::getInstance();
        $this->page->template = Config::$serverRoot . DS . "core" . DS . "templates" . DS . "tpl" . DS . "error.tpl";
        $this->alias = $alias;
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
}
