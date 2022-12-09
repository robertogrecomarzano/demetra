<?php
namespace App\Core\Lib;

/**
 */
class HTML
{

    /**
     * Escaping dei valori valido per gli attributi dei tag HTML
     *
     * @param string $value
     * @return string
     */
    static function HTMLAttributeValue($value)
    {
        if (is_array($value))
            return null;
        return htmlspecialchars((string) $value);
    }

    /**
     * Escaping della coppia attributo/valore attributo per un tag HTML
     *
     * @param string $key
     * @param string $value
     * @return string
     */
    static function HTMLAttribute($key, $value)
    {
        if (is_bool($value))
            return $key;
        else
            return $key . "=\"" . HTML::HTMLAttributeValue($value) . "\"";
    }

    /**
     * Generazione da funzione di un tag HTML.
     * Gli attributi sono forniti come stringa (ma bisogna fare attenzione perché
     * non verrà fatto nessun escaper di caratteri problematici) o come array
     * chiave/valore dei vari attributi.
     * Se è presente del contenuto, verrà inserito e il tag sarà chiuso con </tag>,
     * in caso contrario sarà chiuso con "/>".
     *
     * @param string $tag
     *            Nome del tag
     * @param mixed $arguments
     *            Attributi in forma di stringa o array
     * @param string $content
     *            Eventuale contenuto
     * @return string
     */
    static function tag($tag, $arguments = "", $content = "", $alwaysClosingTag = false)
    {
        $tagOpener = "<";
        $jargs = "";

        if (is_array($arguments)) {
            $args = array_map(array(
                "App\Core\Lib\HTML",
                "HTMLAttribute"
            ), array_keys($arguments), $arguments);

            $jargs = " " . implode(" ", $args);
        } elseif (! empty($arguments)) {
            $jargs = " " . $arguments;
        }

        if (! empty($content) || $alwaysClosingTag) {
            $tagClosed = "</" . $tag . ">";
            $tagCloser = ">";
        } else {
            $tagCloser = " />";
            $tagClosed = "";
        }

        return $tagOpener . $tag . $jargs . $tagCloser . $content . $tagClosed;
    }

    /**
     * Crea una select option da un array
     *
     * @param array $data
     * @param string $valueField
     * @param string $labelField
     * @param string $selectedValue
     * @param string $extra
     * @param boolean $first
     * @param boolean $groups
     *
     * @return string
     */
    static function selectFromArray($data, $valueField, $labelField, $selectedValue = null, $extra = array(), $first = true, $groups = true)
    {
        $firstOption = "";

        if ($first)
            $firstOption .= HTML::tag("option");

        foreach ($data as $gruppo => $options) {
            $option = "";
            foreach ($options as $o) {
                $oArgs = array(
                    "value" => $o[$valueField],
                    "data-subtext" => $o["subtext"]
                );
                if (! empty($selectedValue) && $selectedValue == $o[$valueField])
                    $oArgs['selected'] = "selected";

                $option .= HTML::tag("option", $oArgs, $o[$labelField]);
            }
            if ($groups)
                $out .= HTML::tag("optgroup", [
                    "label" => $gruppo
                ], $option);
            else
                $out .= $option;
        }

        $extra["class"] = ! isset($extra["class"]) ? "form-control" : $extra["class"];

        return HTML::tag("select", $extra, $firstOption . $out);
    }

    /**
     * Ritorna un colore esadecimala a partire da un stringa qualunque
     *
     * @param string $str
     * @return string
     */
    static function stringToColorCode($str)
    {
        $code = dechex(crc32($str));
        $code = substr($code, 0, 6);
        return "#$code";
    }
}