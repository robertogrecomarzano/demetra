<?php
namespace App\Core\Lib;

use App\Core\Config;

/**
 * Classe per gestire le comunicazioni da verso gli utenti tramite mail
 * e generazione del pdf relativo
 *
 * @author Roberto
 *        
 */
class Message
{

    private $subject;

    private $model;

    private $object;

    private $pdf;

    private $title;

    private $idOggetto;

    private $folder;

    private $barcode_start;

    private $destinatario;

    private $destinatario_email;

    private $params;

    private $message;

    private $allegati;

    /**
     * Crea un messaggio specifico per modello [notifica, pap, comunicazioni, ...], salva l'eventuale Pdf ed invia la mail
     *
     * @param string $model
     * @param int $idOggetto
     * @param string $folder
     * @param string $subject
     * @param string $destinatario
     * @param string $destinatario_email
     * @param array $params
     * @param string $message
     * @param string|array $allegati
     */
    public function __construct($model, $idOggetto, $folder, $subject, $destinatario = null, $destinatario_email = null, $params = array(), $message = null, $allegati = null)
    {
        $this->model = $model;
        $this->subject = empty($subject) ? Config::$config["denominazione"] : $subject;
        $this->folder = $folder;
        $this->idOggetto = $idOggetto;
        $this->params = $params;
        $this->message = $message;
        $this->allegati = ! is_array($allegati) ? [
            $allegati
        ] : $allegati;

        $this->destinatario = $destinatario;
        $this->destinatario_email = $destinatario_email;
    }

    /**
     * Crea il corpo della mail, usando i template
     */
    public function render()
    {
        $info = array(
            "denominazione" => Config::$config["denominazione"],
            "sede" => Config::$config["sede"],
            "tel" => Config::$config["telefono"],
            "fax" => Config::$config["fax"],
            "email" => Config::$config["email"],
            "sito_web" => Config::$config["sito_web"],
            "facebook" => Config::$config["facebook"]
        );
        $page = Page::getInstance();

        $pageMail = new Page();
        $pageMail->template = Config::$serverRoot . DS . "core" . DS . "templates" . DS . "mail" . DS . $this->model . ".tpl";

        $explode = explode('/', $this->model);
        $modello = end($explode);
        $isModello = array_shift($explode) == "modelli";

        $header = $footer = null;

        if (! $isModello) {
            $pageMailHeader = new Page();
            $pageMailHeader->template = Config::$serverRoot . DS . "core" . DS . "templates" . DS . "mail" . DS . "header_mail.tpl";
            $header = $pageMailHeader->render([
                "info" => $info,
                "logo_base64" => base64_encode(file_get_contents(Config::$serverRoot . DS . "core" . DS . "templates" . DS . "img" . DS . "logo.png"))
            ]);

            $pageMailFooter = new Page();
            $pageMailFooter->template = Config::$serverRoot . DS . "core" . DS . "templates" . DS . "mail" . DS . "footer_mail.tpl";
            $footer = $pageMailFooter->render([
                "info" => $info
            ]);
        }

        $retvalue = null;

        if (! file_exists($pageMail->template))
            $page->addWarning("Il template " . $pageMail->template . " non esiste");
        else {

            if (RegExp::checkEmail($this->destinatario_email) && Config::$config["mail_enable"]) {

                $logo = (new Upload(null, "pubblicazioni"))->getPubblicazioneFile("logo");
                if (! is_file($logo))
                    $logo = Config::$serverRoot . "/core/templates/img/logo.png";

                $message = $pageMail->render(array(
                    "info" => $info,
                    "logo_base64" => base64_encode(file_get_contents($logo)),
                    "barcode" => $this->barcode_start . Security::maskId($this->idOggetto),
                    "utente" => array(
                        "utente" => $this->destinatario,
                        "email" => $this->destinatario_email
                    ),
                    "params" => $this->params
                ));

                $retvalue = Mail::sendPHPMailer($this->destinatario_email, $this->subject, $header . $message . $footer, $header . $message . $footer, $this->allegati);

                if ($retvalue['SUCCESS'] == "FALSE")
                    $page->addWarning(Language::get("Errore in fase di invio email all'indirizzo") . " <b>" . $this->destinatario_email) . "</b>";
                else {
                    if ($this->idOggetto > 0 && ! empty($this->folder)) {
                        $Serverpath = Config::$serverRoot . DS . "public" . DS . $this->folder . DS . $this->idOggetto;

                        if (! file_exists($Serverpath))
                            mkdir($Serverpath);
                        file_put_contents($Serverpath . DS . $modello . "_" . date("YmdHis") . ".html", $message);
                    }

                    $page->addMessages(Language::get("Una mail è stata inviata all'indirizzo") . " <b>" . $this->destinatario_email) . "</b>";
                }

                $retvalue["message"] = $message;
            } else {

                $retvalue['SUCCESS'] = "FALSE";

                $page->addWarning(Language::get("Errore in fase di invio email all'indirizzo") . " <b>" . $this->destinatario_email) . "</b>";
            }
        }

        return $retvalue;
    }
}