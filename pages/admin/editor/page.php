<?php
$directory = [
    [
        "label" => "<b>MODELLI EMAIL</b>",
        "path" => Config::$serverRoot . DS . "core" . DS . "templates" . DS . "mail"
    ],
    [
        "label" => "<b>MODELLI PDF</b>",
        "path" => Config::$serverRoot . DS . "core" . DS . "templates" . DS . "pdf"
    ],
    [
        "label" => "<label class='text-primary'>Email personalizzate</label>",
        "path" => Config::$publicRoot . DS . "mail"
    ],
    [
        "label" => "<label class='text-primary'>Pdf personalizzati</label>",
        "path" => Config::$publicRoot . DS . "pdf"
    ]
];

$editor = $page->addPlugin("editor", $directory);
$editor->init();

$page->assign("editor", $editor->show());