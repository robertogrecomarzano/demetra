<?php
namespace App\Components;

/**
 * SimpleCaptcha class
 */
use App\Core\Lib\Language;
use App\Core\Lib\Plugin;

class Captcha extends Plugin
{

    public $css = array(
        "captcha.css"
    );

    public $scripts = array(
        "captcha.js"
    );

    public $template = array();

    public function init()
    {
        ;
    }

    public function __construct($config = array())
    {
        ;
    }

    function Draw()
    {
        $placeholder = Language::get("Inserire il codice captcha");
        return '<div id="captcha">
                <label>Captcha:</label>

                <!-- input captcha -->
                <div class="captcha-code">
                    <div class="code">
                        <div class="dynamic-code"></div>
                    </div>
                    <div class="captcha-reload">
                        <span class="material-icons">refresh</span>
                    </div>
                </div>
                <div class="captcha-input">
                    <input type="text" class="form-control" id="captcha-input"  required autocomplete="off"  placeholder="' . $placeholder . '">
                    <span id="errCaptcha"></span>
                </div>
                </div>';
    }
}