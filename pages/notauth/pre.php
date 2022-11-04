<?php
use App\Core\Lib\Page;

$templateFile = $mainTemplateDir . DS . "tpl" . DS . "notauth.tpl";
$page->template = $templateFile;

$check = $_GET['param'];
if (empty($check))
    Page::redirect("user");