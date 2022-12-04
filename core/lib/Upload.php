<?php
namespace App\Core\Lib;

use App\Core\Config;
use App\Core\User;

/**
 * Classe per gestire l'upload di documenti
 * Usa una tabella unica "uploads"
 * Salva i file in /public/$folder/$id/filename
 *
 * @author Roberto
 */
class Upload
{

    /**
     * Directory in cui salvare il file
     * Intesa come directory principale
     * all'interno della quale vanno create quelle dinamiche
     * con l'id, ad es.
     * id_notifica
     *
     * @var string
     */
    private $directory = "";

    private $fieldName = "";

    private $fieldDesc = "";

    private $id = "";

    private $readonly = false;

    private $extensions = array(
        '.pdf',
        '.jpg',
        '.jpeg'
    );

    private $fileName = "";

    private $fileDesc = "";

    private $dettaglio = "";

    private $dettaglio2 = "";

    private $serverFile = "";

    private $serverRoot = "";

    public $serverFolder = "";

    private $tipo = "";

    public $destinationFolder = "";

    private $is_public = false;

    /**
     * Tabella in cui si memorizzano tutti gli upload
     * con una colonna tipo per filtrare
     *
     * @var string
     */
    private static $table = "uploads";

    /**
     * Costruttore
     *
     * @param int $id
     * @param string $folder
     * @param boolean $readonly
     * @param string $tipo
     * @param string $fieldName
     * @param string $fieldDesc
     * @param string $dettaglio
     * @param array $extensions
     */
    public function __construct($id, $folder, $readonly = false, $tipo = "", $fieldName = "filename", $fieldDesc = "filedesc", $dettaglio = "dettaglio", array $extensions = null, $options = [])
    {
        $this->directory = $folder;

        if (! empty($fieldName))
            $this->fieldName = $fieldName;

        if (! empty($fieldDesc))
            $this->fieldDesc = $fieldDesc;

        if (! empty($dettaglio))
            $this->dettaglio = $dettaglio;

        $this->dettaglio2 = "dettaglio2";

        if (! empty($tipo))
            $this->tipo = $tipo;

        $this->id = $id;

        if (! is_null($extensions))
            $this->extensions = $extensions;

        if (! is_null($options))
            $this->options = $options;

        $this->readonly = $readonly;

        $destinationFolder = "public" . DS . $this->directory;
        if (! empty($this->id))
            $destinationFolder .= DS . $this->id;
        $this->serverRoot = Config::$serverRoot;
        $this->serverFolder = $destinationFolder;
        $this->destinationFolder = $destinationFolder;
        $filenameRipulito = preg_replace("/[^A-Za-z0-9\.]/", '', isset($_FILES[$this->fieldName]["name"]) ? $_FILES[$this->fieldName]["name"] : null);
        $time = date("dHis");
        $this->fileName = $time . "." . $filenameRipulito;
        $this->serverFile = $this->serverFolder . DS . $this->fileName;
    }

    public function formUpload($dettaglio = null, $with_form = true)
    {
        if ($this->readonly)
            return;
        $file = HTML::tag("input", array(
            "type" => "file",
            "name" => $this->fieldName,
            "class" => "btn btn-outline btn-default"
        ));
        $desc = HTML::tag("input", array(
            "type" => "textbox",
            "name" => $this->fieldDesc,
            "class" => "form-control",
            "placeholder" => "Una breve descrizione",
            "size" => "40"
        ));
        $hidden = HTML::tag("input", array(
            "type" => "hidden",
            "id" => "dettaglio2",
            "name" => "dettaglio2"
        ));
        if (isset($dettaglio['src'])) {
            $dettaglio["first"] = "true";
            $dettaglio["name"] = "dettaglio";
            $dettaglio['onclick'] = "$('#dettaglio2').val($(this).find(\":selected\").text());";
            $dett = Form::select($dettaglio);
        }

        $this->is_public = isset($dettaglio['public']) && $dettaglio['public'];

        $submit = Form::button(array(
            "name" => "upload",
            "value" => "Allega file",
            "text" => "true",
            "img" => "paperclip",
            "onclick" => "form_add(this)"
        ), $smarty);

        if ($this->options["mini"]) {
            $file = HTML::tag("label", [
                "class" => "btn btn-default",
                "for" => "inputFile"
            ], HTML::tag("input", array(
                "type" => "file",
                "id" => "inputFile",
                "name" => $this->fieldName,
                "class" => "form-control-file",
                "style" => "display:none;"
            )) . "<i class='fas fa-plus'></i>Selezionare un file<span> <i class='fas fa-ellipsis-h'></i></span>");
            $html .= "<div class='form-group'>$file</div>";
            if (! empty($dett))
                $html .= "<div class='form-group'><div  class='col-xs-4 text text-info text-right'>Tipo</div><div class='col-xs-4 text-danger text-left'>$dett</div></div>";
        } else {
            $html = "<label class='text text-info text-right'>Allega un file, formati ammessi:  " . implode(", ", $this->extensions) . "</label>";

            $html .= "<div class='form-group'><label class='control-label col-md-2 col-sm-2 col-xs-12'>Selezionare un file</label><div class='col-md-10 col-sm-10 col-xs-12'>$file</div></div>";
            $html .= "<div class='form-group'><label class='control-label col-md-2 col-sm-2 col-xs-12'>Descrizione</label><div class='col-md-10 col-sm-10 col-xs-12'>$desc$hidden</div></div>";
            if (! empty($dett))
                $html .= "<div class='form-group'><label class='control-label col-md-2 col-sm-2 col-xs-12'>Tipo</label><div class='col-md-10 col-sm-10 col-xs-12'>$dett</div></div>";

            $html .= "<div class='form-group'><label class='control-label col-md-2 col-sm-2 col-xs-12'></label><div class='col-md-10 col-sm-10 col-xs-12'>$submit</div></div>";
        }

        $html_form = HTML::tag("form", array(
            "action" => "",
            "method" => "post",
            "enctype" => "multipart/form-data",
            "id" => "formupload",
            "class" => "form-horizontal"
        ), $html);

        return $with_form ? $html_form : $html;
    }

    private function linkDelete($id)
    {
        if ($this->readonly)
            return;
        return Form::delete(array(
            "id" => "$id"
        ), null);
    }

    private function linkShow($id, $text = "")
    {
        $path = Config::$urlRoot . "/core/download.php?t=a&doc=" . $id;
        $params = array(
            "href" => $path,
            "target" => "_blank",
            "class" => "btn btn-primary btn-xs",
            "title" => "Visualizza $text",
            "value" => "Visualizza $text",
            "text" => false,
            "img" => "download"
        );

        return Form::link($params);
    }

    function link($id)
    {
        if (! empty($id))
            $path = Config::$urlRoot . "/core/download.php?t=a&doc=" . $id;
        return $path;
    }

    /**
     *
     * @param string $where
     * @return number
     */
    public function getCount($where = "1=1")
    {
        $rs = Upload::getList($this->serverFolder, 1, $where);
        return count($rs);
    }

    /**
     *
     * @param string $where
     * @return array
     */
    public function getRows($where = "1=1")
    {
        $rs = Upload::getList($this->serverFolder, 1, $where);
        return $rs;
    }

    /**
     * Elenca tutti i file salvati
     * in $directory
     * con possibilità di filtrare per
     * record_attivo 1|0
     */
    public static function getList($folder, $record_attivo = "1", $where = "1=1")
    {
        $sql = "SELECT *,DATE_FORMAT(orario,'%d/%m/%Y %H.%i.%s') AS orario, IF(dettaglio2='' OR dettaglio2 IS NULL,dettaglio,dettaglio2) AS dettaglio2 FROM " . self::$table . " WHERE $where AND folder=? AND record_attivo=? ";
        $params = array(
            $folder,
            $record_attivo
        );
        $rs = Database::getRows($sql, $params);
        return $rs;
    }

    /**
     * Elenca tutti i file salvati
     * in $directory
     * con possibilità di filtrare per
     * record_attivo 1|0
     */

    /**
     * Elenca tutti i file salvati in $directory con possibilità di filtrare per record_attivo 1|0
     *
     * @param string $record_attivo
     * @param array $fields
     * @param bool $showMessage
     * @param array $rs
     * @param string $cancellabile_field
     *            (campo da usare insieme ad $rs per indicare se la riga è cancellabile, se il campo $cancellabile_field di $rs è NUll, viene attivata la X per eliminare la riga)
     */
    public function getListTable($record_attivo = "1", $fields = null, $showMessage = true, $rs = null, $cancellabile_field = null)
    {
        if (empty($rs))
            $rs = Upload::getList($this->serverFolder, $record_attivo);

        if (empty($fields))
            $fields = array(
                "filename" => "File",
                "dettaglio2" => "Tipo",
                "descrizione" => "Descrizione",
                "orario" => "Data invio"
            );
        $header = "";
        foreach ($fields as $fld => $label)
            $header .= HTML::tag("th", array(), $label);
        $header .= HTML::tag("th", array(), "&nbsp;");

        $table = "";
        $rowsOut = "";

        if (count($rs) > 0) {
            foreach ($rs as $row) {

                if (file_exists($this->serverRoot . DS . $this->serverFolder . DS . $row['filename'])) {
                    $rowOut = "";
                    foreach ($fields as $fld => $label) {
                        if ($fld != "id_upload")
                            $rowOut .= HTML::tag("td", array(), $row[$fld]);
                    }
                    if (is_null($cancellabile_field))
                        $delete = $this->linkDelete($row["id_upload"]);
                    else
                        $delete = array_key_exists($cancellabile_field, $row) ? (! $this->readonly && is_null($row[$cancellabile_field])) ? $this->linkDelete($row["id_upload"]) : "" : "";
                    $rowOut .= HTML::tag("td", array(), $this->linkShow($row["id_upload"]) . $delete);
                    $rowOut = HTML::tag("tr", array(), $rowOut);
                    $rowsOut .= $rowOut;
                }
            }
            $header = HTML::tag("tr", array(), $header);
            $header = HTML::tag("thead", array(), $header);
            $table = HTML::tag("table", array(
                "class" => "table table-striped table-hover dataTable no-footer dtr-inline"
            ), $header . $rowsOut);
        } else if ($showMessage) {
            $page = Page::getInstance();
            $page->addWarning("Al momento non sono presenti documenti.");
        }

        return $table;
    }

    /**
     * Elenca tutti i file salvati
     * in $directory
     * con possibilità di filtrare per
     * record_attivo 1|0
     */
    public function getListMiniTable($record_attivo = "1")
    {
        $rs = Upload::getList($this->serverRoot . DS . $this->serverFolder, $record_attivo);

        $table = "";
        if (count($rs) > 0) {
            foreach ($rs as $row) {
                if (file_exists($this->serverRoot . DS . $this->serverFolder . DS . $row['desc'])) {
                    $rowOut = "";
                    $rowOut .= HTML::tag("td", array(), $this->linkShow($row["id_upload"], $row['dettaglio2']));
                    $rowOut = HTML::tag("tr", array(), $rowOut);
                    $rowsOut .= $rowOut;
                }
            }
        }
        return $rowsOut;
    }

    /**
     * ritorn bool se si tratta di upload oppure no
     *
     * @return boolean
     */
    private function isUpload()
    {
        return (! empty($_FILES[$this->fieldName]['name']) && $_FILES[$this->fieldName]['error'] == 0 && $_FILES[$this->fieldName]['size'] > 0);
    }

    /**
     * Controlla estensione del file
     *
     * @return boolean
     */
    private function checkExtension()
    {
        $extension = strtolower(strrchr($_FILES[$this->fieldName]['name'], '.'));
        return in_array($extension, $this->extensions);
    }

    /**
     * Esegue l'upload del file
     * in $directory/dinamic_folder/filaname
     */
    public function save()
    {
        $action = isset($_POST['form_action']) ? $_POST['form_action'] : "";

        if ($action == "del")
            return;

        // parsare filename per evitare caratteri strani
        // controllare l'estensione
        $pagina = Page::getInstance();

        if ($this->isUpload()) {
            if ($this->checkExtension()) {
                if (! is_dir($this->serverRoot . DS . $this->serverFolder))
                    mkdir($this->serverRoot . DS . $this->serverFolder, 0755, TRUE);

                if (move_uploaded_file($_FILES[$this->fieldName]["tmp_name"], $this->serverFile)) {
                    // registro anche il record in tabella
                    // $this->fileName = strtolower(str_replace(" ","_",$_FILES[$this->fieldName]["name"]));
                    $this->fileDesc = $_POST[$this->fieldDesc];
                    $this->dettaglio = isset($_POST[$this->dettaglio]) ? $_POST[$this->dettaglio] : $this->tipo;
                    $this->dettaglio2 = isset($_POST[$this->dettaglio2]) ? $_POST[$this->dettaglio2] : $this->dettaglio;
                    $this->insertDb();
                    if (empty(Page::$sqlError))
                        $pagina->addMessages("File caricato con successo");
                } else
                    $pagina->addWarning("UPLOAD_ERROR", array(
                        $_FILES[$this->fieldName]["error"]
                    ));
            } else
                $pagina->addWarning("UPLOAD_ERROR", array(
                    "Tipo file non ammesso. Caricare solo file con estensione [" . implode(", ", $this->extensions) . "]"
                ));

            $db = Database::getDb();
            return $db->lastInsertId();
        } elseif (isset($_FILES[$this->fieldName]['size']) && $_FILES[$this->fieldName]['size'] == 0)
            $pagina->addWarning("UPLOAD_ERROR", array(
                "dimensione non valida"
            ));

        return - 1;
    }

    public function processAction()
    {
        $action = isset($_POST['form_action']) ? $_POST['form_action'] : "";
        $actionId = isset($_POST['form_id']) ? $_POST['form_id'] : 0;

        if ($action == "del") {
            $this->deleteDb($actionId);
        }

        return $actionId;
    }

    /**
     * Inserisce record nella relativa tabella
     */
    public function insertDb()
    {
        $sql = "INSERT INTO " . self::$table . " SET orario=NOW(), filename=?, id_utente=?, descrizione=?, tipo=?, folder=?, dettaglio=?,dettaglio2=?, is_public=?";
        Database::insert($sql, array(
            $this->fileName,
            User::getLoggedUserId(),
            $this->fileDesc,
            $this->directory,
            $this->serverFolder,
            $this->dettaglio,
            $this->dettaglio2,
            $this->is_public
        ));
    }

    /**
     * Elimina record nella relativa tabella
     *
     * @param int $id:
     *            id record tabella uploads
     * @param bool $deleteFile:
     *            true=>elimina file dal server
     */
    public function deleteDb($id, $deleteFile = true)
    {
        $sql = "UPDATE " . self::$table . " SET record_attivo=0 WHERE id_upload=?";
        Database::update($sql, array(
            $id
        ));

        $this->serverFile = Database::getField("SELECT filename FROM " . self::$table . " WHERE id_upload=?", array(
            $id
        ));
        if ($deleteFile && file_exists($this->serverRoot . DS . $this->serverFolder . DS . $this->serverFile))
            unlink($this->serverRoot . DS . $this->serverFolder . DS . $this->serverFile);
    }

    /**
     * Ritorna il path di un file caricato nel modulo pubblicazioni
     *
     * @param string $dettaglio
     * @return string
     */
    public function getPubblicazioneFile($dettaglio)
    {
        $sql = "SELECT * 
                FROM " . self::$table . " 
                WHERE dettaglio=? AND folder=? AND record_attivo=1 
                ORDER BY id_upload DESC LIMIT 1";
        $params = array(
            $dettaglio,
            $this->serverFolder
        );
        $row = Database::getRow($sql, $params);

        return Config::$serverRoot . DS . $row["folder"] . DS . $row["filename"];
    }

    /**
     * Ritorna il link al file caricato nel modulo pubblicazioni
     *
     * @param string $dettaglio
     * @return string
     */
    public function getPubblicazioneLink($dettaglio)
    {
        $sql = "SELECT *
                FROM " . self::$table . "
                WHERE dettaglio=? AND folder=? AND record_attivo=1
                ORDER BY id_upload DESC LIMIT 1";
        $params = array(
            $dettaglio,
            $this->serverFolder
        );
        $row = Database::getRow($sql, $params);

        return Config::$urlRoot . "/core/download.php?t=a&doc=" . $row["id_upload"];
    }
}