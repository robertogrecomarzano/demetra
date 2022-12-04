<?php
namespace App\Core\Controller;

use App\Core\BaseController;
use App\Core\Lib\Page;
use App\Core\IController;
use App\Components\Menu;

class AdminController extends BaseController implements IController
{

    public function __construct($alias)
    {
        $this->page = Page::getInstance();
        $this->alias = $alias;
    }

    public function index($request)
    {
        $homeMenu = Menu::styleMenu("top_sezione");
        $this->page->assign("homeMenu", $homeMenu);
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

