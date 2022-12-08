<?php
namespace App\Components;

use App\Core\Lib\Plugin;
use App\Core\Lib\Language;

class Calendar extends Plugin
{

    public $scripts = [
        "calendar.js"
    ];

    function init()
    {

        /*
         * FIXME: CAPIRE come fare per evitare di inserirlo nel file calendar.js
         *
         * Per le pagine caricate tramite ajax, va inserito questo codice alla fine del file .tpl
         *
         * $js = <<<JS
         * <script type='text/javascript'>
         * $(document).ready(function() {
         * $('.input-group.date').datepicker({
         * calendarWeeks : true,
         * format: 'dd/mm/yyyy',
         * autoclose : true,
         * todayHighlight : true,
         * language: "it"
         * });
         * });
         * </script>
         *
         * JS;
         * echo $js;
         */
    }

    /**
     * Inserisce del codice javasccript alla fine della pagina
     */
    function addInlineJs()
    {
        $lang = str_replace("_", "-", Language::getCurrentLocale());
        $js = <<<JS
        
        $(document).ready(function() {
        	$(".calendar").each(function(index) {
        		new Litepicker({
        			element: this,
        			format: 'DD/MM/YYYY',
        			lang : '$lang'
        		});
        	});
        	
        });
        
        JS;
        return $js;
    }
}