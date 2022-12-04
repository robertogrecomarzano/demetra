<?php
namespace App\Core;

use App\Core\Lib\Page;

/**
 * Controller base
 *
 * @author Roberto
 *        
 */
abstract class BaseController
{

    /**
     * Istanza della pagina
     *
     * @var $page
     */
    public $page = null;

    /**
     * Alias della pagina
     *
     * @var $alias
     */
    public $alias = null;

    /**
     * Nome della tabella
     *
     * @var $table
     */
    public $table = null;

    /**
     * Chiave primaria
     *
     * @var $pk
     */
    public $pk = null;

    /**
     * Campi del db
     *
     * @var array
     */
    public $mappings = [
        "sql_column_1" => "html_field_1",
        "sql_column_2" => "html_field_2",
        "sql_column_n" => "html_field_n"
    ];

    /**
     * Eventuali altri campi del db da aggiungere a mappings
     *
     * @var array
     */
    public $other = [];
    
}