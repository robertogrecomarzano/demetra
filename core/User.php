<?php
namespace App\Core\Classes;

use App\Core\Config;
use App\Core\Lib\Database;
use App\Core\Lib\Page;
use App\Core\Lib\Permission;
use App\Core\Lib\Servizi;
use App\Components\Menu;
use PDO;

/**
 * Classe di gestione degli utenti del sito
 */
class User
{

    private static $servizi = array();

    private static $ip = "";

    private static $url = "";

    private static $pg = "";

    private static $regione = "";

    /**
     * Cartella installazione
     *
     * @var string
     */
    private static $folder = "";

    /**
     * Inizializzazione pagina, con controllo della sessione ed eventuale redirect
     */
    static function initPage()
    {
        // Operazione da fare come prima
        User::setConfig();

        $page = Page::getInstance();

        User::$pg = $page->alias;

        if (Config::$config["offline"] && ! User::isUserInGroups([
            "superuser",
            "administrator"
        ])) {

            if (User::$pg != "offline")
                Page::redirect("offline");
            else
                User::logout();
        } else {

            if (User::$pg == "notfound")
                return;

            // Controllo session scaduta
            if (! User::isUserLogged()) {

                $apage = explode("/", User::$pg);
                $base = $apage[0];

                if (! in_array(User::$pg, Config::$openPage) && $base != "public") {
                    header("Location: " . Config::$config["web"]);
                }
            }

            // Controllo user simulation - Utente - Gruppo
            if (isset($_POST['userSimSelectGruppo']) && ! empty($_POST['userSimSelectGruppo'])) {

                $simulatedGroup = $_POST['userSimSelectGruppo'];
                User::logUser(User::getLoggedUserId(), $simulatedGroup);
                $_SESSION['user']['simulation']['id'] = User::getLoggedUserId();
                $_SESSION['user']['simulation']['gruppo'] = $simulatedGroup;
                $_SESSION['user']['gruppo'] = $simulatedGroup;
                Page::redirect("home1");
            } else {
                // Controllo user simulation - SuperUser
                if ((isset($_POST['userSimSelect']) && $_POST['userSimSelect'] > 0) || (isset($_POST['form_changeuser']) && ! empty($_POST['form_changeuser']) && $_POST["form_changeuser"] > 0)) {
                    $simulatedUserId = $_POST['userSimSelect'] > 0 ? $_POST['userSimSelect'] : $_POST["form_changeuser"];
                    User::logUser($simulatedUserId);
                    $sql = "SELECT g.nome FROM utenti u JOIN utenti_has_gruppi ug USING(id_utente) LEFT JOIN utenti_gruppi g USING (id_gruppo_utente) WHERE id_utente = ?";
                    $simulatedUserGroup = Database::getField($sql, array(
                        $simulatedUserId
                    ));
                    $_SESSION['user']['simulation']['id'] = $simulatedUserId;
                    $_SESSION['user']['simulation']['gruppo'] = $simulatedUserGroup;
                    $_SESSION['user']['simulation']['superuser'] = true;
                }
            }

            User::online();

            User::hasPermission();

            if (User::isReadOnly())
                $page->addWarning("Accesso in sola lettura, nessuna modifica è concessa.");
        }
    }

    /**
     * Imposta nella variabile Config::$config, il contenuto della tabella config
     */
    static function setConfig($load = false)
    {
        if ($load || empty($_SESSION["configuration"]) || in_array(User::$pg, Config::$openPage)) {
            Config::$config = null;

            $config = Database::getRow("SELECT * FROM config LIMIT 1");
            if (count($config) > 0) {
                $_SESSION["configuration"]["config"] = $config;
                Config::$config = $config;
            }
        } else {
            Config::$config = $_SESSION["configuration"]["config"];
        }
    }

    /**
     * Restituisce il nome dello studio
     *
     * @return string
     */
    static function getStudio()
    {
        return $_SESSION["denominazione"];
    }

    /**
     * Verifica se si hanno i permessi per la pagina
     */
    static function hasPermission()
    {
        if (in_array(User::$pg, Config::$openPage))
            return;

        $apage = explode("/", User::$pg);
        $base = $apage[0];

        if (! User::isUserLogged() && $base != "public") {
            header("Location: " . Config::$urlRoot);
        }

        $has = true;
        $has = Permission::hasPrivileges(User::$pg);

        # if ($has === false)
        # Page::redirect("home", "", true, "<h3 class='text-center'>Non si è autorizzati a visualizzare questa risorsa.</h3>", "danger");
    }

    /**
     * Restituisce l'HTML che permette al superuser di selezionare
     * l'utente da simulare in modalità User Simulation
     *
     * @return string
     */
    static function userSimulationSuperUserHtml()
    {
        if (! User::isSuperUser() && ! $_SESSION['user']['simulation']['superuser'])
            return "";

        $sql = "SELECT u.*,g.nome AS gruppo,
		CONCAT(IFNULL(u.cognome,''), ' ',IFNULL(u.nome,'')) AS username
		FROM utenti u
		JOIN utenti_has_gruppi ug USING(id_utente)
		JOIN utenti_gruppi g USING(id_gruppo_utente)
		WHERE u.record_attivo=1 
		GROUP BY id_utente
		ORDER BY g.nome, username";

        $utenti = Database::getRows($sql);
        if (count($utenti) == 0)
            return;

        $gr = "";
        $out = '<li class="dropdown">
							<a class="dropdown-toggle"	data-toggle="dropdown" href="#">
								<i class="fas fa-users fa-2x"></i>
								<i class="fas fa-caret-down"></i>
							</a>
						   <form id="userSimFormSuper" method="post" style="display:inline;">
				   			<input type="hidden" name="userSimSelect" id="userSimSelect"/>
							</form>
							<ul class="dropdown-menu scrollable-menu" role="menu">';
        foreach ($utenti as $g) {
            if ($gr != $g["gruppo"]) {
                $out .= '<li class=\'active\'><a href="#"><strong>' . strtoupper($g["gruppo"]) . '</strong></a></li>';
                $gr = $g["gruppo"];
            }
            $class = null;
            if (isset($_SESSION['user']['simulation']))
                $class = $_SESSION['user']['simulation']['id'] == $g["id_utente"] ? "active" : "";

            $out .= '<li><a class="' . $class . '" href="#" onclick="$(\'#userSimSelect\').val(\'' . $g["id_utente"] . '\'); $(\'#userSimFormSuper\').submit()"><i class="fas fa-user fa"></i> ' . $g["username"] . '</a></li>';
        }
        $out .= "</ul></li>";

        return $out;
    }

    /**
     * Restituisce l'HTML che permette all'utente di cambiare profilo
     *
     * @return string
     */
    static function userSimulationUserProfiloHtml()
    {
        if (! User::isUserLogged())
            return "";
        $gruppi = $_SESSION['user']['gruppi'];
        if (count($gruppi) == 1)
            return "";

        $out = '<li class="dropdown">
							<a class="dropdown-toggle"	data-toggle="dropdown" href="#">
								<i class="fas fa-refresh fa-2x"></i>
								<i class="fas fa-caret-down"></i>
							</a>
						   <form id="userSimForm" method="post" style="display:inline;">
				   			<input type="hidden" name="userSimSelectGruppo" id="userSimSelectGruppo"/>
							</form>
							<ul class="dropdown-menu dropdown-user">';
        foreach ($gruppi as $g) {
            $class = $_SESSION['user']['gruppo'] == $g["gruppo"] ? "active" : "";
            $out .= '<li><a class="' . $class . '" href="#" onclick="$(\'#userSimSelectGruppo\').val(\'' . $g["gruppo"] . '\'); $(\'#userSimForm\').submit()"><i class="fas fa-user fa-2x"></i>' . $g["gruppo_desc"] . '</a></li>';
        }
        $out .= "</ul></li>";

        return $out;
    }

    /**
     * Creazione del menù
     */
    static function createMenu()
    {
        if (User::isUserLogged()) {

            $root = Menu::findRootNode();

            Menu::appendToNode($root, "user", "Il mio profilo", "Profilo utente", "I dati del mio profilo", "", "", [
                "icon" => "user",
                "icon-color" => "purple"
            ]);

            Menu::appendToNode($root, "home", "Home", "Home", "Pagina iniziale", "", "", [
                "icon" => "tachometer-alt",
                "icon-color" => "red"
            ]);

            switch (User::getLoggedUserGroup()) {
                case "superuser":
                case "amministratore":

                    $admin = Menu::appendToNode($root, "admin", "Pannello di controllo", "Sezione riservata al superuser", "", "", "", "cogs");

                    if (User::isSuperUser()) {
                        Menu::appendToNode($admin, "admin/configurazione", "Configurazione", "Configurazione parametri di sistema", "Configurazione parametri di sistema", "", "", "cog");
                        Menu::appendToNode($admin, "admin/avvisi", "Avvisi/News", "Sezione relativa alla gestione degli avvisi da inserire sul portale.", "", "", "", "newspaper");

                        $NodePermessi = Menu::appendToNode($admin, "admin/permessi", "Servizi e permessi", "Gestione servizi, permessi ed abilitazione profili.", "", "", "", "puzzle-piece");
                        Menu::appendToNode($NodePermessi, "admin/permessi/servizi", "Servizi", "Gestione servizi disponibili", "", "", "", "bars");
                        Menu::appendToNode($NodePermessi, "admin/permessi/gruppi", "Gruppi", "Gestione gruppi", "", "", "", "users");
                        Menu::appendToNode($NodePermessi, "admin/permessi/associaservizi", "Associa Servizi|Gruppi", "Abilitare o disabilitare i servizi per i gruppi", "", "", "", "angle-double-right");
                        Menu::appendToNode($NodePermessi, "admin/permessi/pagine", "Pagine", "Gestione permessi singole pagine", "", "", "", "file");

                        $aiuto = Menu::appendToNode($admin, "admin/help", "Help/Faq", "Gestione Help in linea e Faq", "", "", "", "question");
                        Menu::appendToNode($aiuto, "admin/help/pagine", "Help pagine", "Gestione help in linea per singola pagina", "", "", "", "question");
                        Menu::appendToNode($aiuto, "admin/help/faq", "Gestisci Faq", "Gestione delle Faq", "", "", "", "question");

                        Menu::appendToNode($admin, "admin/testfatturaelettronica", "Test fattura", "Test fattura elettronica", "Pagina di test servizio fattura24", "", "", "cog");
                    }

                    Menu::appendToNode($admin, "admin/utenti", "Gestione utenti", "Gestione completa degli utenti del sistema", "", "", "", "user-plus");
                    Menu::appendToNode($admin, "admin/utenti/online", "Utenti online", "Elenco degli utenti on line", "", "", "", "users");

                    Menu::appendToNode($admin, "admin/testmail", "Test email", "Testare l'invio delle email", "Testare l'invio delle email", "", "", "envelope");

                    Menu::appendToNode($admin, "admin/editor", "Editor", "Editor file", "Editor file", "", "", "edit");

                    $help = Menu::appendToNode($root, "public/aiuto", "Aiuto", "Aiuto", "Sezione di aiuto", "", "", [
                        "icon" => "question-circle",
                        "icon-color" => "blue"
                    ]);
                    Menu::appendToNode($help, "public/aiuto/news", "Avvisi", "Avvisi", "Sezione avvisi e news", "", "", [
                        "icon" => "newspaper",
                        "icon-color" => "blue"
                    ]);
                    Menu::appendToNode($help, "public/aiuto/faq", "Faq", "Faq", "Consulta le faq (domande frequenti)", "", "", [
                        "icon" => "question-circle",
                        "icon-color" => "blue"
                    ]);
                    Menu::appendToNode($help, "public/aiuto/ticket", "Ticket", "Ticket", "Richiedi assistenza aprendo un ticket", "", "", [
                        "icon" => "ticket-alt",
                        "icon-color" => "blue"
                    ]);

                    break;

                case "operatore":
                    Menu::appendToNode($root, "suoli", "DB Suoli", "Procedura di allineamento del db suoli", "Procedura di allineamento del db suoli", "", "", "attach");
                    break;
                default:
                    break;
            }
        }
        # Menu::hideById("user");
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
                'email' => $res['email']
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
					WHERE	BINARY u.username = ?
					AND		BINARY u.password = ?
					AND		record_attivo = 1
					$sqlSuper";

        $password = trim($password);
        $passCrypt = User::saltPassword($password);

        $userId = Database::getField($sql, array(
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
     * Setta i servizi di default
     *
     * @param array $servizi
     */
    static function setServiziDefault($servizi = array())
    {
        User::$servizi = $servizi;
    }

    /**
     * Carica per l'utente i servizi di default
     * ad esempio Notifica, Pap
     *
     * @param int $idUtente
     *            [optional]
     */
    static function associaServiziDefault($idUtente)
    {
        $default = ! empty(User::$servizi) ? User::$servizi : Servizi::getServiziDefault();
        $res = true;
        // TOTO: capire come mai arriva default vuoto
        foreach ($default as $d) {
            $Servizio = Servizi::get("servizio", $d);
            $idServizio = $Servizio['id_servizio'];
            $res = $res && Servizi::addServizioUtente($idUtente, $idServizio);
        }
        return $res;
    }

    static function createRandomPassword()
    {
        $chars = "abcdefghijkmnopqrstuvwxyz023456789";
        srand((float) microtime() * 1000000);
        $i = 0;
        $pass = '';
        while ($i <= 7) {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $pass = $pass . $tmp;
            $i ++;
        }
        return $pass;
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
        return sha1(Config::$passwordSalt . $clearPassword);
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
     * Ritoran un'array con le tipologie di utenti
     * Tecnico, Titolare, Altro ...
     *
     * @return array
     */
    static function getTipologia()
    {
        $sql = "SELECT id_tipologia_utente, nome FROM utenti_tipologia";
        $data = Database::getRows($sql, null, PDO::FETCH_KEY_PAIR);
        return $data;
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
                Database::query("DELETE FROM utenti_online WHERE id_utente=? AND ip=?", array(
                    User::getLoggedUserId(),
                    User::$ip
                ));
                Database::query("INSERT INTO utenti_online (id,id_utente,ip,tm,page,url) VALUES(?,?,?,?,?,?)", array(
                    session_id(),
                    User::getLoggedUserId(),
                    User::$ip,
                    $tm,
                    User::$pg,
                    User::$url
                ));

                break;
            case "logout":
                Database::query("UPDATE utenti_online SET status=0 WHERE id_utente=? AND ip=?", array(
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
                    Database::query("UPDATE utenti_online SET tm=NOW(), status=1, page=?, url=? WHERE id_utente=? AND ip=?", array(
                        User::$pg,
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
                    Database::query("UPDATE utenti_online SET status=0 WHERE tm < DATE_SUB(NOW(), INTERVAL $gap MINUTE);");
                }

                break;
        }
    }

    /**
     * Creo il menù relativo alle pagine aperte, senza login
     * Le voci sono registrate in una tabella "pubblicazioni"
     */
    static function pubblicazioni()
    {
        $pubb = Database::getRows("SELECT * FROM pubblicazioni");

        if (count($pubb) > 0) {
            $pubbnode = Menu::findNodeById("public");
            foreach ($pubb as $purl)
                Menu::appendToNode($pubbnode, "public/" . $purl["url"], $purl["titolo"], $purl["descrizione"], "", "", "", "file");
        }
    }

   
}
