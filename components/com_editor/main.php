<?php
use App\Core\Config;
use App\Core\Lib\Page;
use App\Core\Lib\Plugin;

define('MAIN_DIR', __DIR__);
define('VERSION', '2.0.0');
define('EDITABLE_FORMATS', 'tpl'); // empty means all types
define('LOG_FILE', MAIN_DIR . DS . '.phedlog');
define('SHOW_PHP_SELF', false);

class Editor extends Plugin
{

    public $css = array();

    public $scripts = array(
        "editor.js"
    );

    public $template = array();

    private $parameters = [];

    private $title = "";

    private $subtitle = "";

    private $directory;

    function __construct()
    {
        $params = func_get_args();
        $params = $params[0];
        $this->directory = $params;
    }

    function init()
    {
        if (file_exists(LOG_FILE)) {
            $log = unserialize(file_get_contents(LOG_FILE));

            if (empty($log)) {
                $log = [];
            }

            foreach ($log as $key => $value) {
                if (time() - $value['time'] > 86400) {
                    unset($log[$key]);

                    $log_updated = true;
                }
            }

            if (isset($log_updated)) {
                file_put_contents(LOG_FILE, serialize($log));
            }
        }

        $page = Page::getInstance();

        $page->css->addCSS(Config::$urlRoot . DS . "core" . DS . "templates" . DS . "vendor" . DS . "codemirror" . DS . "codemirror.min.css", Config::$serverRoot . DS . "core" . DS . "templates" . DS . "vendor" . DS . "codemirror" . DS . "codemirror.min.css");
        $page->css->addJS(Config::$urlRoot . DS . "core" . DS . "templates" . DS . "vendor" . DS . "codemirror" . DS . "codemirror.min.js", Config::$serverRoot . DS . "core" . DS . "templates" . DS . "vendor" . DS . "codemirror" . DS . "codemirror.min.js");

        $page->css->addJS(Config::$urlRoot . DS . "core" . DS . "templates" . DS . "vendor" . DS . "codemirror" . DS . "mode" . DS . "smarty.min.js", Config::$serverRoot . DS . "core" . DS . "templates" . DS . "vendor" . DS . "codemirror" . DS . "mode" . DS . "smarty.min.js");

        $page->css->addCSS(Config::$urlRoot . DS . "core" . DS . "templates" . DS . "vendor" . DS . "jstree" . DS . "jstree.min.css", Config::$serverRoot . DS . "core" . DS . "templates" . DS . "vendor" . DS . "jstree" . DS . "jstree.min.css");
        $page->css->addJS(Config::$urlRoot . DS . "core" . DS . "templates" . DS . "vendor" . DS . "jstree" . DS . "jstree.min.js", Config::$serverRoot . DS . "core" . DS . "templates" . DS . "vendor" . DS . "jstree" . DS . "jstree.min.js");
    }

    function show()
    {
        $html = '<div class="container-fluid">
               <div class="dropdown float-left">
                    <button class="btn btn-primary save" type="button" id="fileMenu">Salva</button>
                    <span id="path" class="btn float-left"></span>
                </div>
                <hr />
    <div class="row p-3">
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div id="files">';

        foreach ($this->directory as $directory)
            $html .= '<div class="card-block">' . $this->getListFiles($directory["label"], $directory["path"]) . '</div>';

        $html .= '
            </div>
         </div>
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
            <textarea id="editor" data-file="" class="form-control"></textarea>
        </div>
    </div>
</div>';

        return $html;
    }

    function process($params = [])
    {
        $action = $params["action"];
        $filename = $params["file"];
        $content = $params["data"];

        if (isset($action)) {
            if (isset($filename) && empty($filename) === false) {
                $formats = explode(',', EDITABLE_FORMATS);

                if (($position = strrpos($filename, '.')) !== false) {
                    $extension = substr($filename, $position + 1);
                } else {
                    $extension = null;
                }

                if (empty(EDITABLE_FORMATS) === false && empty($extension) === false && in_array(strtolower($extension), $formats) !== true) {
                    die('INVALID_EDITABLE_FORMAT');
                }

                if (strpos($filename, '../') !== false || strpos($filename, '..\'') !== false) {
                    die('INVALID_FILE_PATH');
                }
            }

            switch ($action) {
                case 'open':
                    $filename = urldecode($filename);

                    if (isset($filename) && file_exists($filename))
                        echo file_get_contents($filename);

                    break;

                case 'save':
                    $file = $filename;

                    if (isset($filename) && isset($content) && (file_exists($file) === false || is_writable($file))) {
                        if (file_exists($file) === false) {
                            file_put_contents($file, $content);

                            $this->file_to_public($file, $content);

                            echo 'success|File salvato correttamente';
                        } else if (is_writable($file) === false) {
                            echo 'danger|File non modificabile (non scrivibile)';
                        } else {

                            file_put_contents($file, $content);

                            $this->file_to_public($file, $content);

                            echo 'success|File salvato correttamente';
                        }
                    }
                    break;

                case 'reload':
                    // echo files(MAIN_DIR);
                    $html = "";
                    foreach ($this->directory as $directory)
                        $html .= $this->getListFiles($directory["label"], $directory["path"]);
                    echo $html;
                    break;
            }

            exit();
        }
    }

    private function getListFiles($label, $dir, $first = true)
    {
        $data = '';

        if ($first === true) {
            $data .= '<ul><li><a href="javascript:void(0);" class="open-dir" data-dir="/">' . $label . '</a>';
        }

        $formats = empty(EDITABLE_FORMATS) ? [] : explode(',', EDITABLE_FORMATS);
        $data .= '<ul class="files">';
        $files = array_slice(scandir($dir), 2);

        asort($files);

        foreach ($files as $key => $file) {
            if ((SHOW_PHP_SELF === false && $dir . DS . $file == __FILE__) || (SHOW_HIDDEN_FILES === false && substr($file, 0, 1) === '.')) {
                continue;
            }

            if (is_dir($dir . DS . $file))
                $data .= '<li class="dir"><a href="javascript:void(0);" class="open-dir" data-dir="/' . $dir . '/">' . $file . '</a>' . $this->getListFiles($label, $dir . DS . $file, false) . '</li>';
            else {
                $file_path = $dir . DS . $file;

                $is_editable = count($formats) < 1 || strpos($file, '.') === false || in_array(substr($file, strrpos($file, '.') + 1), $formats);

                $data .= '<li class="file ' . ($is_editable ? 'editable' : null) . '" data-jstree=\'{ "icon" : "jstree-file" }\'><a href="javascript:void(0);" data-file="' . $file_path . '"' . ($is_editable ? ' class="open-file"' : null) . '>' . pathinfo($file)['filename'] . '</a></li>';
            }
        }

        $data .= '</ul>';

        if ($first === true) {
            $data .= '</li></ul>';
        }

        return $data;
    }

    private function file_to_public($file)
    {
        $file_name = basename($file);

        $ini = strpos($file, "templates");

        $ini += strlen("templates") + 1;
        $len = strpos($file, $file_name, $ini) - $ini - 1;
        $file_dir = substr($file, $ini, $len);

        $file_public_dir = Config::$publicRoot . DS . $file_dir;

        if (file_exists($file_public_dir) === false || is_dir($file_public_dir) === false)
            mkdir($file_public_dir, 0777, true);

        copy($file, $file_public_dir . DS . $file_name);
    }
}