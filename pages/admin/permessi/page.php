<?php
use App\Components\Menu;

$topMenu = Menu::styleMenu("top_sezione");
$page->assign("homeMenu", $topMenu);
