<?php
namespace App\Core;

/**
 * Classe base per la gestione delle pagine che modificano dati tabellari
 *
 * @author Roberto
 *        
 */
abstract class TableController extends BaseController
{

    /**
     * Booleano per indicare se si ua un template personalizzato oppure no
     *
     * @var boolean
     */
    public $custom_template = false;

   

    /**
     * Array contenente i dati per la gestione delle tabelle
     *
     * @var array
     */
    public $src = [
        "writable" => true | false,
        "rows" => [], // righe ritornate dal db
        "pk" => null, // chiave primaria tabella
        "inline" => true | false,
        "title" => "Aggiungi nuova riga", // Testo del botton per nuovo inserimento (solo con inline=false)
        "id" => 'dataTables', // Per attivare la gestione dataTables
        "custom-template" => true | false, // Per usare dei template custom (table.tpl e add.tpl)
        "writable" => true,
        "edit" => true,
        "delete" => true,
        "add" => true,
        "fields" => array( // fields, usato solo se custom-template è false
            "field_1" => array(
                "label" => "Es. textbox",
                "writable" => true | false // true di default
            ),
            "dettaglio" => array(
                "label" => "Dettaglio"
            ),
            "field_3" => array(
                "label" => "Es. checkbox",
                "type" => "checkbox",
                "others" => array(
                    "required" => "required"
                )
            ),
            "field_4" => array(
                "label" => "Es. select option",
                "type" => "select",
                "others" => array(
                    "src" => array(
                        "1" => "si",
                        "0" => "no"
                    ),
                    "first" => true,
                    "required" => "required"
                )
            ),
            "field_5" => array(
                "label" => "Es. radio",
                "type" => "radio",
                "others" => array(
                    "required" => "required"
                )
            ),
            "field_6" => array(
                "label" => "Es. text con value",
                "value" => "numero_release", // se il campo ritornato dalla query è differente dal nome della colonna
                "type" => "number",
                "others" => array(
                    "size" => 8,
                    "required" => "required",
                    "min" => 1
                )
            )
        )
    ];

    /**
     * Controllo sui campi obbligatori
     *
     * @param array $request
     * @return bool
     */
    function checkRequired($request, $except = [])
    {
        $errors = [];
        foreach ($this->src["fields"] as $key => $field) {
            if ($field["others"]["required"] && empty($request[$key]) && ! in_array($key, $except))

                $errors[] = "Campo " . $field["label"] . " obbligatorio";
        }
        foreach ($errors as $msg)
            $this->page->addError($msg);

        return empty($errors);
    }
}