<?php
namespace App\Components;

use App\Core\Classes\User;
use App\Core\Lib\Database;
use App\Core\Lib\HTML;
use App\Core\Lib\Page;
use App\Core\Lib\Plugin;

class Help extends Plugin
{

    public $css = array(
        "help.css",
        "animate.min.css"
    );

    public $scripts = array(
        "help.js"
    );

    public $template = array(
        "help.tpl"
    );

    /**
     * Visualizza link Help "?"
     *
     * @return string
     */
    function renderLittleHelpButton()
    {
        $page = Page::getInstance();
        $alias = $page->alias;
        
        $helpRow = $this->get($alias);
        
        $help = $helpRow["text"];
        $title = $helpRow["title"];
        
        $noHelp = empty($title) || empty($help);
        
        $a = array(
            "border" => 0,
            "alt" => "Help",
            "title" => "Help",
            "src" => $this->webFolder() . "/css/help.png"
        );
        $i = HTML::tag("i", array(
            "class" => "fas fa-question-circle fa-2x"
        ), " ");
        
        $b = array(
            "id" => "helpinline",
            "title" => "Clicca per accedere alla guida",
            "href" => "javascript:void(0);",
            "onclick" => "showHelp('$alias')"
        );
        $link = $noHelp ? "" : HTML::tag("a", $b, $i);
        
        $hidden = HTML::tag("input", array(
            "type" => "hidden",
            "value" => $noHelp ? "" : $alias,
            "id" => "aliasHelp"
        ));
        
        return $link . $hidden;
    }

    function init()
    {
        $this->assign("plgHelpMini", $this->renderLittleHelpButton());
        $this->assign("plgHelpDiv", "");
    }

    function get($alias)
    {
        $sql = "SELECT title,text FROM help WHERE alias=? AND id_gruppo=? AND stato=?";
        
        $help = Database::getRow($sql, array(
            $alias,
            User::getIdGruppo(User::getLoggedUserGroup()),
            'Pubblicato'
        ));
        
        return $help;
    }

    /**
     * Popola div help con il testo preso
     * dal Db tramite ajax
     *
     * @param string $alias
     */
    function show($alias)
    {
        $help = $this->get($alias);
        echo json_encode($help);
    }

    /**
     * Inserisce record in help se non è presente
     */
    static function insertRecord()
    {
        $page = Page::getInstance();
        $alias = $page->alias;
        $sql = "INSERT INTO help SET alias=?";
        Database::query($sql, array(
            $alias
        ));
    }
}