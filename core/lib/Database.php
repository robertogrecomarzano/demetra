<?php
namespace App\Core\Lib;

use App\Core\Config;
use App\Core\User;
use Melbahja\Environ\Environ;
use Exception;
use PDO;
use Illuminate\Database\Capsule\Manager as DB;

/**
 * Classe wrapper per accedere al Database
 */
class Database
{

    private static $caller;

    /**
     * Imposta la lingua locale
     *
     * @param string $locale
     */
    public static function setLocale($locale)
    {
        $db = DB::connection();
        $db->statement("SET lc_time_names = ?", [
            $locale
        ]);
    }

    /**
     * Ritorna il messaggio di errore SQL
     * Se non SuperUser ritorna un semplice messaggio senza il dettaglio dell'errore.
     *
     * @param string $error
     */
    static function setSqlError($error)
    {
        $db = DB::connection();

        if ($db->transactionLevel() > 0) {
            $page = Page::getInstance();
            $page->addError("Transazione annullata");
            $db->rollBack();
        }

        $debug = Config::$config["debug"];

        $message = "ERRORE SQL<br />" . $error . "<br />" . self::$caller[0]["file"] . " alla linea " . self::$caller[0]["line"] . "";
        if ($debug)
            print("<pre class='alert alert-danger'>$message</pre>");
        else {
            if (User::isSuperUser())
                print("<pre class='alert alert-danger'>$message</pre>");
            else {
                $page = Page::getInstance();
                $utente = User::getLoggedUserName();
                Mail::sendPHPMailer(Config::$config["email_support"], "Errore SQL - [$utente]", $message);
                Page::redirect("home", "", true, "<h3 class='text-center'>Si è verificato un errore, l'operazione è stata annullata ed una e-mail di segnalazione è stata inviata al supporto tecnico.</h3>", "danger");
            }
        }
    }

    /**
     * Restituisce il numero di righe data una query in ingresso
     *
     * @param string $table
     * @param string $where
     * @param array $parameters
     *
     * @return int
     */
    public static function getCount($table, $where = "", $parameters = null)
    {
        $sql = "SELECT COUNT(*) FROM $table";
        if (! empty($where))
            $sql .= " WHERE $where";

        return self::getField($sql, $parameters);
    }

    /**
     * Restituisce una riga data una query in ingresso
     *
     * @param string $sql
     * @param array $parameters
     *
     * @return array
     */
    public static function getRow($sql, array $parameters = [], $mode = PDO::FETCH_ASSOC)
    {
        try {
            $row = DB::connection()->selectOne($sql, $parameters);
            return json_decode(json_encode($row), true);
        } catch (Exception $e) {
            $callers = debug_backtrace();
            self::$caller = $callers;
            self::setSqlError($e->getMessage());
            return null;
        }
    }

    /**
     * Restituisce un campo data una query in ingresso
     *
     * @param string $sql
     * @param array $parameters
     * @return string
     */
    public static function getField($sql, array $parameters = [])
    {
        try {
            return reset(DB::connection()->select($sql, $parameters)[0]);
        } catch (Exception $e) {
            $callers = debug_backtrace();
            self::$caller = $callers;
            self::setSqlError($e->getMessage());
            return null;
        }
    }

    /**
     * Esegue una query e restituisce il resultset come array, o false se c'è errore
     *
     * @param string $sql
     * @param array $parameters
     * @return array
     */
    static function getRows($sql, array $parameters = [])
    {
        try {
            $rows = DB::connection()->select($sql, $parameters);
            return json_decode(json_encode($rows), true);
        } catch (Exception $e) {
            $callers = debug_backtrace();
            self::$caller = $callers;
            self::setSqlError($e->getMessage());
            return null;
        }
    }

    /**
     * Esegue una query di INSERT
     *
     * @param string $sql
     * @param array $parameters
     * @return bool true|false
     */
    static function insert($sql, array $parameters = [])
    {
        try {
            return DB::connection()->insert($sql, $parameters);
        } catch (Exception $e) {
            $callers = debug_backtrace();
            self::$caller = $callers;
            self::setSqlError($e->getMessage());
            return null;
        }
    }

    /**
     * Esegue una query di UPDATE
     *
     * @param string $sql
     * @param array $parameters
     * @return bool true|false
     */
    static function update($sql, array $parameters = [])
    {
        try {
            return DB::connection()->update($sql, $parameters);
        } catch (Exception $e) {
            $callers = debug_backtrace();
            self::$caller = $callers;
            self::setSqlError($e->getMessage());
            return null;
        }
    }

    /**
     * Esegue una query di DELETE
     *
     * @param string $sql
     * @param array $parameters
     * @return bool true|false
     */
    static function delete($sql, array $parameters = [])
    {
        try {
            return DB::connection()->delete($sql, $parameters);
        } catch (Exception $e) {
            $callers = debug_backtrace();
            self::$caller = $callers;
            self::setSqlError($e->getMessage());
            return null;
        }
    }

    /**
     * Ritorna i campi di una tabella
     *
     * @param string $table
     * @param array $except
     */
    static function getFieldsString($table, $except = [])
    {
        Environ::load(".");
        $db = Environ::get('DATABASE')["DBNAME"];
        $mark = array();
        $parameters = [
            $table,
            $db
        ];

        foreach ($except as $o) {
            $mark[] = "column_name!=?";
            array_push($parameters, $o);
        }

        $mark = ! empty($mark) ? "AND " . implode(" AND ", $mark) : "";

        $sql = "SELECT GROUP_CONCAT(column_name) AS campi FROM information_schema.columns WHERE table_name=? AND table_schema=? $mark";
        return self::getField($sql, $parameters);
    }

    /**
     * Ritorna i campi di una tabella
     *
     * @param string $table
     * @param array $except
     * @param string $start_with
     * @return array
     */
    static function describeTableFields($table, $except = [], $start_with = null)
    {
        $fields = [];
        $sql = "SHOW FULL COLUMNS FROM $table";
        $rows = self::getRows($sql);
        foreach ($rows as $r) {
            if (! in_array($r["Field"], $except))
                if (! empty($start_with)) {
                    $length = strlen($start_with);
                    $startOfHaystack = substr($r["Field"], 0, $length);
                    if (strcasecmp($startOfHaystack, $start_with) == 0)
                        $fields[] = $r;
                } else
                    $fields[] = $r;
        }
        return $fields;
    }

    /**
     * Ritorna i valori di un campo ENUM in Mysql
     *
     * @param string $table
     * @param string $column
     * @return array
     */
    static function getEnumValues($table, $column)
    {
        $values = array();
        $sql = 'SHOW COLUMNS FROM ' . $table . ' WHERE field="' . $column . '"';
        $row = self::getRow($sql);
        $type = $row['Type'];
        $pos = strpos($type, "'") + 1;
        foreach (explode("','", substr($type, $pos, - 2)) as $option)
            $values["$option"] = $option;
        return $values;
    }

    /**
     * Controlla se la tabella esiste
     *
     * @param string $table
     * @param string $db
     *
     * @return bool
     */
    static function table_exist($table, $db = null)
    {
        if (empty($db)) {
            Environ::load(".");
            $db = Environ::get('DATABASE')["DBNAME"];
        }
        $tot = self::getCount("information_schema.tables", "table_schema = ? AND table_name = ?", array(
            $db,
            $table
        ));
        return $tot > 0;
    }

    /**
     * Restituisce l'ultimo autoincremente creto
     *
     * @return string
     */
    static function getLastIsertId()
    {
        return DB::connection()->getPdo()->lastInsertId();
    }
}