<?php
namespace App\Core\Lib;

use App\Core\Config;

/**
 * Classe che permette di recuperare il contenuto da inserire in una mail o pdf dal modello originale oppure dal file modificato
 *
 * @author Roberto
 *        
 */
class Stampa
{

    function __construct()
    {}

    /**
     * Ritorna l'Html del template popolato con i parametri
     *
     * Utilizza un file da public se esiste, altrimenti il file originale da core/templates
     *
     * @param string $template
     * @param string $folder
     * @param array $parametri
     * @return string
     */
    function getContent($template, $folder, $parametri)
    {
        $pageContent = new Page();

        $pageContent->template = Config::$serverRoot . DS . "core" . DS . "templates" . DS . $folder . DS . $template;

        return $pageContent->render($parametri);
    }
}