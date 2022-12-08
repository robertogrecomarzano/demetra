<?php
namespace App\Core;

class Config
{

    /**
     * Config table data
     *
     * @var array
     */
    public static $config = array();

    // ------------------
    // Languages settings
    // ------------------

    /**
     * App name
     *
     * @var string
     */
    public static $app = "Square App";

    /**
     * Default language
     *
     * @var string
     */
    public static $defaultLocale = "it_IT";

    /**
     * Available languages
     *
     * @var array
     */
    public static $languages = [
        "it_IT" => [
            "code" => "it",
            "label" => "Italiano"
        ],
        "en_US" => [
            "code" => "en",
            "label" => "English"
        ]
    ];

    /**
     * Switch language enable/disable
     *
     * @var bool
     */
    public static $switchLanguage = true;

    /**
     * Google Cloud translation API JSON Key
     */
    public static $googleCloudTranslationApiProjectId = "ciheam";

    public static $googleCloudTranslationApiKey = "ciheam-a73c7da039cb";

    // ------------------------------------
    // Compressione script
    // ------------------------------------

    /**
     * Unione e compressione (minify) dei javascript
     * FIXME: ancora non funzionante !!!!
     *
     * @var bool
     */
    public static $uniteAndCompressJS = false;

    /**
     * Unione e compressione (minify) dei CSS
     *
     * @var bool
     */
    public static $uniteAndCompressCSS = true;

    // -----
    // Paths
    // -----

    /**
     * Installation root (server/local)
     *
     * @var string
     */
    public static $serverRoot = 'D:\wamp\www\square-app';

    /**
     * Public folder
     *
     * @var string
     */
    public static $publicRoot = 'D:\wamp\www\square-app\public';

    /**
     * Installation root (web/URL)
     *
     * @var string
     */
    public static $urlRoot = "http://localhost/square-app";

    // --------
    // Security
    // --------

    /**
     * Tempo di expire del token delle form
     *
     * @var int
     */
    public static $formtokenMaxTime = 3600;

    /**
     * Pagine che non hanno necessita di avere SESSION settata
     *
     * @var array string
     */
    public static $openPage = array(
        "authentication/login",
        "authentication/register",
        "authentication/confirm",
        "authentication/passwordrecovery",
        "authentication/logout",
        "offline",
        "error"
    );
}
