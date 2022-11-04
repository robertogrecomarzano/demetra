<?php
namespace App\Core\Lib;

use App\Core\Config;

define('FIRSTKEY', 'Lk5Uz3slx3BrAghS1aaW5AYgWZRV0tIX5eI0yPchFz4=');
define('SECONDKEY', 'EZ44mFi3TlAey1b2w4Y7lVDuqO+SRxGXsa7nctnr/JmMrA2vN6EJhrvdVZbxaQs5jpSe34X3ejFK/o9+Y5c83w==');

/**
 * Interfaccia per metodi utility rivolti alla sicurezza.
 * Metodi implementati:
 * 1- Gestione Cross Site Request Forgery tramite token nei form
 */
class Security
{

    const CIPHERING_METHOD = "BF-ECB";

    const ENCRYPTION_KEY = "nubooking.squareSrls";

    /**
     * Integer obfuscation, lavora fino a 24bit.
     * Variante dell'algoritmo
     * moltiplicativo di Knuth basato su un numero primo.
     *
     * @param int $id
     *            Intero da offuscare
     * @param bool $from
     *            Criptazione (true) o decriptazione (false)
     * @return string
     */
    static function maskId($id, $from = true, $padding = true)
    {
        if (empty($id))
            return "";

        $prime = 1580030173;
        $prime_inv = 59260789;
        $maxid = pow(2, 24) - 1;

        $value = $from ? sprintf("%u", ($id * $prime) & $maxid) : sprintf("%u", ($id * $prime_inv) & $maxid);
        return $padding ? str_pad($value, 10, "0", STR_PAD_LEFT) : $value;
    }

    /**
     * Genera il token anti-CSRF random
     *
     * @return string
     */
    static function getAndStoreCSRFToken()
    {
        $token = md5(uniqid(rand(), true));
        $_SESSION['token'] = $token;
        $_SESSION['token_time'] = time();
        return $token;
    }

    /**
     * Genera l'HTML che contiene il token anti-CSRF
     *
     * @param string $token
     * @return string
     */
    static function htmlCSRFToken($token)
    {
        $args = array(
            "type" => "hidden",
            "name" => "formtoken",
            "value" => $token
        );
        return HTML::tag("input", $args);
    }

    /**
     * Controlla che il token anti-CSRF sia presente e corretto
     *
     * @param string $formToken
     * @return boolean
     */
    static function checkCSRFToken($formToken = null)
    {
        if (Config::$config["debug"])
            return true;

        if (! $formToken)
            $formToken = isset($_POST['formtoken']) ? $_POST['formtoken'] : null;

        if (empty($formToken))
            return true;

        if (isset($_SESSION["token"]) && isset($formToken) && ! empty($_SESSION["token"]) && ! empty($formToken) && ($_SESSION["token"] == $formToken) && (time() - $_SESSION["token_time"]) <= Config::$formtokenMaxTime) {
            return true;
        } else {
            $page = Page::getInstance();
            $page->addError("Errore, si è tentato di effettuare un refresh della pagina, operazione annullata.");
            unset($_POST);
            return false;
        }
    }

    /**
     * Restituisce cripta una stringa
     *
     * @param string $string
     *
     * @return string
     */
    static function encrypt($data)
    {
        $key = self::ENCRYPTION_KEY;

        $l = strlen($key);
        if ($l < 16)
            $key = str_repeat($key, ceil(16 / $l));

        if ($m = strlen($data) % 8)
            $data .= str_repeat("\x00", 8 - $m);

        if (function_exists('mcrypt_encrypt'))
            $val = mcrypt_encrypt(MCRYPT_BLOWFISH, $key, $data, MCRYPT_MODE_ECB);
        else
            $val = openssl_encrypt($data, self::CIPHERING_METHOD, self::ENCRYPTION_KEY, OPENSSL_RAW_DATA | OPENSSL_NO_PADDING);

        return bin2hex($val);
    }

    /**
     * Restituisce la stringa originale a partire da quella criptata
     *
     * @param string $string
     *
     * @return string
     */
    static function decrypt($data)
    {
        $data = hex2bin($data);
        $key = self::ENCRYPTION_KEY;

        $l = strlen($key);
        if ($l < 16)
            $key = str_repeat($key, ceil(16 / $l));

        if (function_exists('mcrypt_encrypt'))
            $val = mcrypt_decrypt(MCRYPT_BLOWFISH, $key, $data, MCRYPT_MODE_ECB);
        else
            $val = openssl_decrypt($data, self::CIPHERING_METHOD, self::ENCRYPTION_KEY, OPENSSL_RAW_DATA | OPENSSL_NO_PADDING);

        return trim($val);
    }
}
