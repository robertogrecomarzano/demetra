<?php
namespace App\Core;

use App\Core\Config;

/**
 */
class Framework
{
    
    static function getCorePath()
    {
        return Config::$serverRoot . DS . "core";
    }
    
    static function getPluginPath()
    {
        return Config::$serverRoot . DS . "components";
    }
    
    /**
     *
     * @param string $plugin
     * @return string
     */
    static function getPluginFolder($plugin)
    {
        return Config::$serverRoot . DS . "components" . DS . "com_" . strtolower($plugin);
    }
}




