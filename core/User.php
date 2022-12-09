<?php
namespace App\Core;

use App\Components\Menu;
use App\Core\Lib\Database;
use App\Core\Lib\Language;
use App\Core\Lib\Page;
use App\Core\Lib\Permission;
use Melbahja\Environ\Environ;

/**
 * Classe di gestione degli utenti del sito
 */
class User
{

    private static $servizi = array();

    private static $ip = "";

    private static $url = "";

    private static $pg = "";

    /**
     * Verifica se si hanno i permessi per la pagina
     */
    static function hasPermission()
    {
        if (in_array(App::$pg, Config::$openPage))
            return;

        $apage = explode("/", App::$pg);
        $base = $apage[0];

        if (! User::isUserLogged() && $base != "public") {
            header("Location: " . Config::$urlRoot);
        }

        $has = true;
        $has = Permission::hasPrivileges(App::$pg);

        # if ($has === false)
        # Page::redirect("home", "", true, "<h3 class='text-center'>Non si è autorizzati a visualizzare questa risorsa.</h3>", "danger");
    }

    /**
     * Creazione del menù
     */
    static function createMenu()
    {
        if (User::isUserLogged()) {

            $root = Menu::findRootNode();

            $idUtente = User::getLoggedUserId();
            Menu::appendToNode($root, "user/$idUtente", Language::get("Profilo utente"), Language::get("Gestione dei dati del profilo utente"), Language::get("Gestione dei dati del profilo utente"), "", "", [
                "icon" => "user",
                "icon-color" => "primary"
            ]);
            Menu::hideById("user/$idUtente");

            Menu::appendToNode($root, "home", Language::get("Home"), Language::get("Pagina iniziale"), Language::get("Pagina iniziale"), "", "", [
                "icon" => "dashboard",
                "icon-color" => "primary"
            ]);

            switch (User::getLoggedUserGroup()) {
                case "superuser":
                case "amministratore":

                    $admin = Menu::appendToNode($root, "admin", Language::get("Pannello di controllo"), Language::get("Sezione riservata al superuser"), "", "", "", "cogs");

                    if (User::isSuperUser()) {
                        Menu::appendToNode($admin, "admin/configurazione", Language::get("Configurazione"), Language::get("Configurazione parametri di sistema"), Language::get("Configurazione parametri di sistema"), "", "", "cog");
                        Menu::appendToNode($admin, "admin/avvisi", Language::get("Avvisi/News"), Language::get("Sezione relativa alla gestione degli avvisi da inserire sul portale"), "", "", "", "newspaper");

                        $NodePermessi = Menu::appendToNode($admin, "admin/permessi", Language::get("Servizi e gruppi"), Language::get("Gestione servizi, permessi ed abilitazione profili"), "", "", "", "puzzle-piece");
                        Menu::appendToNode($NodePermessi, "admin/permessi/servizi", Language::get("Servizi"), Language::get("Gestione servizi disponibili"), "", "", "", "bars");
                        Menu::appendToNode($NodePermessi, "admin/permessi/gruppi", Language::get("Gruppi"), Language::get("Gestione gruppi/ruoli"), "", "", "", "users");
                        Menu::appendToNode($NodePermessi, "admin/permessi/associaservizi", Language::get("Abilita servizi per gruppo"), Language::get("Abilitare o disabilitare i servizi per i gruppi"), "", "", "", "list-check");
                        // Menu::appendToNode($NodePermessi, "admin/permessi/pagine", Language::get("Pagine"), Language::get("Gestione permessi singole pagine"), "", "", "", "file");
                    }

                    Menu::appendToNode($admin, "admin/utenti", Language::get("Gestione utenti"), Language::get("Gestione completa degli utenti del sistema"), "", "", "", "user-plus");
                    Menu::appendToNode($admin, "admin/utenti/online", Language::get("Utenti online"), Language::get("Elenco degli utenti on line"), "", "", "", "users");

                    Menu::appendToNode($admin, "admin/testmail", Language::get("Test email"), Language::get("Testare l'invio delle email"), Language::get("Testare l'invio delle email"), "", "", "envelope");

                    // Menu::appendToNode($admin, "admin/editor", "Editor", "Editor file", "Editor file", "", "", "edit");

                    Menu::appendToNode($admin, "admin/avvisi", Language::get("Avvisi"), Language::get("Avvisi"), Language::get("Gestione avvisi da pubblicare sul portale"), "", "", [
                        "icon" => "newspaper",
                        "icon-color" => "purple"
                    ]);

                    $help = Menu::appendToNode($admin, "aiuto", Language::get("Aiuto"), Language::get("Aiuto"), Language::get("Gestione help e avvisi"), "", "", [
                        "icon" => "question-circle",
                        "icon-color" => "blue"
                    ]);

                    Menu::appendToNode($help, "aiuto/faq", Language::get("FAQ"), Language::get("FAQ"), Language::get("Gestione delle FAQ"), "", "", [
                        "icon" => "question-circle",
                        "icon-color" => "blue"
                    ]);
                    Menu::appendToNode($help, "aiuto/pagine", Language::get("Help in linea"), Language::get("Help in linea"), Language::get("Gestionde dell'Help in linea"), "", "", [
                        "icon" => "question-circle",
                        "icon-color" => "blue"
                    ]);

                    break;

                default:
                    break;
            }

            // Menu::hideById("user");
        }

        # Menu::hideById("public/aiuto");
        # Menu::hideById("admin/help");
    }

    /**
     * Ritorna true se c'è un utente loggato
     *
     * @return string
     */
    public static function isUserLogged()
    {
        return isset($_SESSION['user']['id']);
    }

    /**
     * Ottiene l'id dell'utente loggato
     */
    public static function getLoggedUserId()
    {
        if (! User::isUserLogged())
            return 0;
        elseif (isset($_SESSION['user']['simulation']['id']))
            return $_SESSION['user']['simulation']['id'];
        else
            return $_SESSION['user']['id'];
    }

    /**
     * Ritorna lo username dell'utente
     */
    public static function getLoggedUserName()
    {
        if (! User::isUserLogged())
            return null;

        return Database::getField("SELECT username FROM utenti WHERE id_utente = ?", array(
            User::getLoggedUserId()
        ));
    }

    /**
     * Ritorna il nome e cognome o il CF se nome e cognome sono vuoti
     *
     * @param int $idUtente
     * @return string
     */
    public static function getLoggedUserNominativo($idUtente = null)
    {
        if (! User::isUserLogged())
            return null;

        if ($idUtente == null)
            $idUtente = User::getLoggedUserId();

        return Database::getField("SELECT CONCAT(cognome, ' ',nome)  FROM utenti WHERE id_utente = ?", array(
            $idUtente
        ));
    }

    /**
     * Logout
     */
    public static function logout($isSvuotaOnline = true)
    {
        if ($isSvuotaOnline)
            User::online("logout");
        session_unset();
    }

    /**
     * Ottiene il gruppo dell'utente loggato, o false se
     * non lo è.
     *
     * @return mixed Stringa col gruppo utente dell'utente o false se utente
     *         non loggato
     */
    public static function getLoggedUserGroup($bypassSimulation = false)
    {
        if (! User::isUserLogged())
            return false;
        elseif (! $bypassSimulation && isset($_SESSION['user']['simulation']['gruppo']))
            return $_SESSION['user']['simulation']['gruppo'];
        else
            return $_SESSION['user']['gruppo'];
    }

    /**
     * Registra in sessione le info utente
     *
     * @param int $userId
     * @param string $gruppo
     */
    public static function logUser($userId, $gruppo = "")
    {
        $rs_gruppi = Database::getRows("SELECT DISTINCT g.nome AS gruppo, ug.id_gruppo_utente AS id_gruppo, g.descrizione AS gruppo_descrizione
				FROM utenti u
				LEFT JOIN utenti_has_gruppi ug USING (id_utente)
				JOIN utenti_gruppi g USING(id_gruppo_utente)
				WHERE u.id_utente = ?
				AND	u.record_attivo=1 ORDER BY id_gruppo_utente ASC", array(
            $userId
        ));

        $res = (new self())->getUserData($userId);

        $tot = count($res);

        if ($tot > 0) {

            $gruppi = array();
            foreach ($rs_gruppi as $row_gruppo) {
                $gruppi[] = array(
                    "id_gruppo" => $row_gruppo['id_gruppo'],
                    "gruppo" => $row_gruppo['gruppo'],
                    "gruppo_desc" => $row_gruppo['gruppo_descrizione']
                );
            }

            if (! empty($gruppo))
                $g = $gruppo;
            else
                $g = $gruppi[0]['gruppo'];

            $_SESSION['user'] = array(
                'id' => $res['id_utente'],
                'username' => $res['username'],
                'nome' => $res['nome'],
                'cognome' => $res['cognome'],
                'gruppo' => $g,
                'gruppi' => $gruppi,
                'readonly' => $res['readonly'],
                'nazione' => $res['nazione'],
                'email' => $res['email'],
                'heartbeat' => time()
            );

            $_SESSION['denominazione'] = $res[0]['denominazione'];
            $_SESSION['user']['permessi'] = Permission::getPrivileges();

            User::online("login");
        }
    }

    /**
     * Ritorna tutti i dati dell'utente
     *
     * @return array
     */
    public static function getUserData($idUtente)
    {
        return Database::getRow("SELECT *,
                                IF(CONCAT(cognome,nome)='' OR CONCAT(cognome,nome) IS NULL,username,CONCAT(cognome,' ', nome)) AS utente
                                FROM utenti
                                WHERE id_utente=?", array(
            $idUtente
        ));
    }

    /**
     * Login dell'utente con verifica credenziali
     *
     * @param string $username
     * @param string $password
     * @return boolean
     */
    public static function preLogin($username, $password, $cf = "", $is_superuser = false)
    {
        $sql = "SELECT *
					FROM	utenti u
                    WHERE	BINARY u.username = ?
					AND		BINARY u.password = ?
					AND		record_attivo = 1";

        $password = trim($password);
        $passCrypt = User::saltPassword($password);

        $user = Database::getRow($sql, array(
            trim($username),
            $passCrypt
        ));
        return $user;
    }

    /**
     * Login dell'utente con verifica credenziali
     *
     * @param string $username
     * @param string $password
     * @return boolean
     */
    public static function login($username, $password, $cf = "", $is_superuser = false)
    {
        $sqlSuper = null;
        if ($is_superuser) {
            $idGruppoSuper = User::getIdGruppo("superuser");
            $sqlSuper = " AND ug.id_gruppo_utente = $idGruppoSuper";
        }

        $sql = "SELECT DISTINCT id_utente
					FROM	utenti u 
                    JOIN    utenti_has_gruppi ug USING(id_utente)
					WHERE	(BINARY u.username = ? OR BINARY u.email = ?)
					AND		BINARY u.password = ?
					AND		record_attivo = 1
					$sqlSuper";

        $password = trim($password);
        $passCrypt = User::saltPassword($password);

        $userId = Database::getField($sql, array(
            trim($username),
            trim($username),
            $passCrypt
        ));

        if ($userId && ! isset($_SESSION['user']['simulation'])) {
            User::logUser($userId, $_SESSION['user']['gruppo']);
            return true;
        } else
            return false;
    }

    /**
     * Hashing della password con salt
     *
     * @param string $clearPassword
     *            Password in chiaro
     * @return string Password hashata
     */
    static function saltPassword($clearPassword)
    {
        return sha1(Environ::get('APP_KEY') . $clearPassword);
    }

    /**
     * Ritorna true se l'utente è superuser
     *
     * @param bool $by
     * @return boolean
     */
    static function isSuperUser($bypassSimulation = false)
    {
        return User::getLoggedUserGroup($bypassSimulation) == "superuser";
    }

    /**
     * Accetta una lista di gruppi utente e ritorna true se l'utente è
     * classificato in uno di questi
     *
     * @param array $argomenti
     *            [opzionale, può essere usata una lista di parametri separati da virgola invece di questo array]
     * @return boolean
     */
    static function isUserInGroups($argomenti = null)
    {
        if (is_array($argomenti))
            return in_array(User::getLoggedUserGroup(), $argomenti);
        else
            return in_array(User::getLoggedUserGroup(), func_get_args());
    }

    /**
     * Ritorna true se l'utente è in sola ettura
     *
     * @param bool $by
     * @return boolean
     */
    static function isReadOnly()
    {
        return $_SESSION['user']['readonly'] == 1;
    }

    /**
     * Ritoran l'id_gruppo a partire dal nome del gruppo
     *
     * @return int
     */
    static function getIdGruppo($gruppo)
    {
        $sql = "SELECT id_gruppo_utente FROM utenti_gruppi WHERE nome=?";
        return Database::getField($sql, array(
            $gruppo
        ));
    }

    /**
     * Ritorna il nome del gruppo utente partendo dall'id_utente
     *
     * @param int $id_utente
     * @return string
     */
    static function getGruppoUtente($idUtente)
    {
        $sql = "SELECT descrizione FROM
				utenti_gruppi ug JOIN utenti_has_gruppi has USING(id_gruppo_utente)
				WHERE id_utente=?
				LIMIT 1";
        return Database::getField($sql, array(
            $idUtente
        ));
    }

    /**
     * Aggiorna la tabella utenti_online
     *
     * @param string $stato
     *            [login|logout]
     */
    public static function online($stato = "")
    {
        User::$ip = $_SERVER['REMOTE_ADDR'];

        switch ($stato) {
            case "login":
                $tm = date("Y-m-d H:i:s");
                Database::delete("DELETE FROM utenti_online WHERE id_utente=? AND ip=?", array(
                    User::getLoggedUserId(),
                    User::$ip
                ));
                $tot = Database::getCount("utenti_online", "id=?", [
                    session_id()
                ]);
                if (empty($tot))
                    Database::insert("INSERT INTO utenti_online (id,id_utente,ip,tm,page,url) VALUES(?,?,?,?,?,?)", array(
                        session_id(),
                        User::getLoggedUserId(),
                        User::$ip,
                        $tm,
                        App::$pg,
                        User::$url
                    ));
                else
                    Database::update("UPDATE utenti_online SET id_utente=?, ip=?,tm=?,page=?,url=? WHERE id=?", [
                        User::getLoggedUserId(),
                        User::$ip,
                        $tm,
                        App::$pg,
                        User::$url,
                        session_id()
                    ]);

                break;
            case "logout":
                Database::update("UPDATE  utenti_online SET status=0 WHERE id_utente=? AND ip=?", array(
                    User::getLoggedUserId(),
                    User::$ip
                ));
                break;
            default:
                // Aggiorno tabella Utenti on line
                User::$url = Config::$urlRoot . "/index.php";
                if ($_SERVER["QUERY_STRING"] != "")
                    User::$url .= "?" . $_SERVER["QUERY_STRING"];
                if (isset($_SESSION['user']))
                    Database::update("UPDATE  utenti_online SET tm=NOW(), status=1, page=?, url=? WHERE id_utente=? AND ip=?", array(
                        App::$pg,
                        User::$url,
                        User::getLoggedUserId(),
                        User::$ip
                    ));
                // Ad ogni caricamento di una pagina aggiorno la tabella degli utenti online
                // Eliminando quelli per cui si è verificato un timeout [ad esempio che abbiano chiuso senza fare logout]
                // Attivo solo per gli amministratori, per non sovraccaricare il server di query
                $page = Page::getInstance();
                if (User::isSuperUser() && $page->alias == "admin/utenti/online") {
                    $gap = 5; // tempo di attesa in minuti
                    Database::update("UPDATE  utenti_online SET status=0 WHERE tm < DATE_SUB(NOW(), INTERVAL $gap MINUTE);");
                }

                break;
        }
    }
}
