<?php
namespace App\Core\Controller;

use App\Core\BaseController;
use App\Core\Lib\Page;
use App\Core\IController;

class HomeController extends BaseController implements IController
{

    function __construct($alias)
    {
        $this->page = Page::getInstance();
        $this->alias = $alias;
    }

    function index($request)
    {
        $this->page->assign("label", $this->alias);
    }

    public function edit($request)
    {}

    public function show($request)
    {}

    public function create($request)
    {}

    public function delete($request)
    {}

    public function update($request, $redirect = true)
    {}

    public function store($request, $redirect = true)
    {}

    public function action1($request)
    {
        // Inserire la lagica della singola richiesta
        var_dump($request);

        // Reindirizzare alla pagina
        Page::redirect($this->alias);
    }

    public function confirm($request)
    {
        // Inserire la lagica della singola richiesta
        var_dump($request);

        // Reindirizzare alla pagina
        Page::redirect($this->alias);
    }
}

