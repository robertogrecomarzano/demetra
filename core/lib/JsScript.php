<?php
namespace App\Core\Lib;

class JsScript
{

    /**
     *
     * @var string
     */
    public $webPath;

    /**
     *
     * @var string
     */
    public $serverPath;

    /**
     *
     * @param string $webPath
     * @param string $serverPath
     */
    public function JsScript($webPath, $serverPath)
    {
        $this->webPath = $webPath;
        $this->serverPath = $serverPath;
    }

    /**
     *
     * @return string
     */
    public function getHeadLink()
    {
        return empty($this->webPath) ? "" : '<script src="' . $this->webPath . '" type="text/javascript"></script>' . "\n";
    }
}