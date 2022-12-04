<?php
namespace App\Core\Lib;

/**
 * Classe per la gestione della Lingua e localizzazione per il Db
 *
 * @author Roberto
 *        
 */
use App\Core\Config;
use Google\Cloud\Translate\V2\TranslateClient;

/**
 * Classe per la gestione della Lingua, traduzioni e localizzazione per il Db
 *
 * @author Roberto
 *        
 */
class Language
{

    /**
     * Ritorna la lingua corrente
     *
     * @return string
     */
    static function getCurrentLocale()
    {
        return (isset($_SESSION['locale']) && $_SESSION['locale'] != "") ? $_SESSION['locale'] : Config::$defaultLocale;
    }

    /**
     * Imposta la lingua corrente
     *
     * @param string $locale
     */
    static function setCurrentLocale($locale)
    {
        if (! empty($locale))
            $_SESSION['locale'] = $locale;
        else
            $_SESSION['locale'] = Config::$defaultLocale;

        Database::setLocale($_SESSION['locale']);
        setlocale(LC_TIME, null, $_SESSION['locale'] . ".UTF-8");
    }

    /**
     * Ritorna la descrizione di un messaggio in base alla lingua corrente
     *
     * @param string $translationAlias
     * @param array $arguments
     * @return string
     */
    static function get($translationAlias, $arguments = array())
    {
        if (empty($translationAlias))
            return null;

        if (Language::getCurrentLocale() == "it_IT" && empty($arguments))
            return $translationAlias;

        $traduzioni = isset($_SESSION['user']['traduzioni']) ? $_SESSION['user']['traduzioni'] : null;

        if (empty($traduzioni))
            $traduzioni = self::getTraduzioni();

        $translation = $translationAlias;

        if (Config::$switchLanguage) {
            $trovato = false;
            foreach ($traduzioni as $row)
                if (strtolower($row["alias"]) == strtolower($translationAlias)) {
                    $translation = $row[Language::getCurrentLocale()];
                    $trovato = true;
                    break;
                }

            if (! $trovato) {

                /**
                 * Se il record non è presente, viene inserito automaticamente
                 */

                $googleTranslate = self::translate($translationAlias);
                $query = "INSERT IGNORE INTO traduzioni SET alias=? ";
                $params = [
                    $translationAlias
                ];

                foreach ($googleTranslate as $lang => $translate) {
                    if ($lang == "it_IT")
                        continue;
                    $query .= ", $lang=?";
                    $params[] = $translate;
                }

                Database::insert($query, $params);
            } elseif (empty($translation)) {

                /**
                 * Se il record è presente, viene solo aggiornato
                 */

                $googleTranslate = self::translate($translationAlias);
                $query = "UPDATE traduzioni SET ";
                $params = [];
                foreach ($googleTranslate as $lang => $translate) {
                    if ($lang == "it_IT")
                        continue;
                    $fields[] = " $lang=?";
                    $params[] = $translate;
                }
                $query .= " " . implode(" , ", $fields);
                $query .= " WHERE alias=?";
                $params[] = $translationAlias;

                if (! empty($fields))
                    Database::update($query, $params);
            }
        }
        $translation = vsprintf($translation, $arguments);

        return $translation;
    }

    /**
     * Ritorna le traduzioni in base alla lingua corrente
     *
     * @return array
     */
    static function getTraduzioni()
    {
        if (Language::getCurrentLocale() == "it_IT")
            return;

        $field = Language::getCurrentLocale();

        $traduzioni = Database::getRows("SELECT alias,$field FROM traduzioni");
        return $traduzioni;
    }

    /**
     * Setta le traduzioni nella sessione utente
     */
    static function setTraduzioni($forse = false)
    {
        if (Language::getCurrentLocale() == "it_IT")
            return;

        if (Language::getCurrentLocale() == Config::$defaultLocale && ! $forse)
            return null;

        $field = Language::getCurrentLocale();
        $traduzioni = Database::getRows("SELECT alias,$field FROM traduzioni");
        $_SESSION['user']['traduzioni'] = $traduzioni;
    }

    /**
     * Traduce un testo in una o più lingue usando Google Translate
     *
     * @param string $text
     * @return array
     */
    static function translate($text)
    {
        // Google Cloud Platform project ID and Credentials
        $projectId = Config::$googleCloudTranslationApiProjectId;
        $projectKey = Config::$googleCloudTranslationApiKey;

        putenv("GOOGLE_APPLICATION_CREDENTIALS=" . Config::$serverRoot . "/$projectKey.json");

        // Instantiates a client
        $translate = new TranslateClient([
            'projectId' => $projectId
        ]);

        // Detect the language of a string.
        // $result = $translate->detectLanguage($text);
        // $language = $result['languageCode'];

        foreach (Config::$languages as $lang => $value) {
            $code = $value["code"];
            // if ($language == $code)
            // continue;

            $translation = $translate->translate($text, [
                'target' => $code
            ]);

            $translations[$lang] = $translation['text'];
        }

        return $translations;
    }
}
