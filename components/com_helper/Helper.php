<?php
namespace App\Components;

use App\Core\User;
use App\Core\Lib\Database;
use App\Core\Lib\HTML;
use App\Core\Lib\Language;
use App\Core\Lib\Page;
use App\Core\Lib\Plugin;

class Helper extends Plugin
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
        if ($noHelp)
            return null;

        return '<!-- Helper modal -->
                <!-- Button that triggers the modal dialog-->
                <button class="btn btn-primary btn-icon" type="button" data-bs-toggle="modal" data-bs-target="#helpModal"><i class="material-icons">question_mark</i></button>
                <!-- Modal-->
                <div class="modal fade" id="helpModal" tabindex="-1" aria-labelledby="helpModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="helpModalLabel">' . $title . '</h5>
                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="' . Language::get("Chiudi") . '"></button>
                            </div>
                            <div class="modal-body">' . $help . '</div>
                            <div class="modal-footer">
                                <button class="btn btn-text-primary me-2" type="button" data-bs-dismiss="modal">' . Language::get("Chiudi") . '</button>
                            </div>
                        </div>
                    </div>
                </div>';
        
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
        Database::insert($sql, array(
            $alias
        ));
    }
}