<?php
namespace App\Core\Classes;

use App\Core\Lib\Database;
use App\Core\Lib\OrmObj;
use PDO;

/**
 * Classe istat per la gestione della tabella comuni
 *
 * @author Roberto
 *        
 */
class Istat extends OrmObj
{

    public $orm_table = "istat_comuni";

    public $orm_pk_field = "id";

    /**
     * Costruttore
     */
    public function __construct()
    {
        ;
    }

    public function all($filter = null)
    {
        if (! empty($filter))
            return $this->orm_all($filter);
        return $this->orm_all([
            "record_attivo" => "1"
        ]);
    }

    public function allKeyPair($label, $filter = null)
    {
        if (! empty($filter))
            return $this->orm_all_key_pair($label, $filter);
        return $this->orm_all_key_pair($label, [
            "record_attivo" => "1"
        ]);
    }

    public function get($id)
    {
        $this->orm_pk_value = $id;
        return $this->orm_get();
    }

    // --------------------------------------------------------------------
    // Funzioni per ricavare i codici istat dati vari parametri di partenza
    // --------------------------------------------------------------------

    /**
     * Ottiene un array con i dati della nazione al quale appartiene il codice ISTAT
     * fornito
     *
     * @param string $istat
     * @return string
     */
    public static function getNazione($istat)
    {
        return Database::getRow("SELECT * FROM istat_nazioni WHERE codice = ?", array(
            $istat
        ));
    }

    /**
     * Ottiene un array con i dati della regione al quale appartiene il codice ISTAT
     * fornito
     *
     * @param string $istat
     * @return string
     */
    public static function getDenominazioneRegioneFromCode($codRegione)
    {
        $sql = "SELECT * FROM istat_regioni WHERE istat_regione = ?";
        return Database::getRow($sql, array(
            $codRegione
        ));
    }

    /**
     * Ottiene un array con i dati della nazione al quale appartiene il codice fornito
     *
     * @param string $istat
     * @return string
     */
    public static function getDenominazioneNazioneFromCode($idNazione, $field = "id")
    {
        $sql = "SELECT descrizione FROM istat_nazioni WHERE $field = ?";
        return Database::getField($sql, array(
            $idNazione
        ));
    }

    /**
     * Ricava il campo $f dalla tabella istat_comuni dove istat_comune=$c
     * SELECT $f FROM istat_comuni WHERE $where = $c
     *
     * @param string $c
     * @param string $f
     * @param string $anno
     * @return string
     */
    public static function getIstat($c, $f, $anno = "", $tab = "istat_comuni", $where = "istat_comune")
    {
        $sql = "SELECT $f FROM istat_comuni WHERE $where = ? AND data_fine IS NULL";
        return Database::getField($sql, [
            $c
        ]);
    }

    /**
     * Ritorna il codice istat della provincia partendo dalla sigla di default
     *
     * @param string $value
     * @param string $field
     * @return string
     */
    public static function getIstatProv($value, $field = "sigla")
    {
        $sql = "SELECT codice_prov AS istat FROM istat_province WHERE $field = ?";
        return Database::getField($sql, [
            $value
        ]);
    }

    /**
     * Ritorna il codice belfiore del comune partendo dall'istat
     *
     * @param string $istat
     * @return string
     */
    public static function getBelfiore($istat)
    {
        $sql = "SELECT codice_comune FROM istat_comuni WHERE istat_comune = ? AND data_fine IS NULL";
        return Database::getField($sql, array(
            $istat
        ));
    }

    /**
     * Ritorna la sifla di una provincia partendo dal codice istat
     *
     * @param string $codice
     * @return string
     */
    public static function getIstatProvSigla($codice)
    {
        $sql = "SELECT sigla AS istat FROM istat_province WHERE codice_prov = ?";
        return Database::getField($sql, [
            $codice
        ]);
    }

    /**
     *
     * @param string $istat
     * @return string
     */
    public static function getNomeComune($istat)
    {
        if (empty($istat))
            return "";

        $sql = "SELECT citta FROM istat_comuni JOIN istat_province ON codice_provincia=codice_prov WHERE istat_comune=?";
        return Database::getField($sql, array(
            $istat
        ));
    }

    /**
     *
     * @param string $istat
     * @return string
     */
    public static function getNomeComuneProvincia($istat)
    {
        if (empty($istat))
            return "";

        $sql = "SELECT CONCAT(citta, ' (',provincia,')') AS citta FROM istat_comuni JOIN istat_province ON codice_provincia=codice_prov WHERE istat_comune=?";
        return Database::getField($sql, array(
            $istat
        ));
    }

    // ---------------------------
    // RESTITUISCE L'OGGETTO $row
    // CON LE INFO SUL COMUNE
    // ---------------------------
    /**
     * Ritorna la riga relativa al comune
     *
     * @param $istat string
     * @return array
     */
    public static function getComune($istat)
    {
        $sql = "SELECT * 
        FROM istat_comuni i 
        JOIN istat_province p ON i.codice_provincia = p.codice_prov
		WHERE istat_comune = ?";
        return Database::getRow($sql, [
            $istat
        ]);
    }

    /**
     * Ritorna la sigla della provincia partendo dal codice
     *
     * @param string $codice
     * @return string
     */
    public static function getSiglaProvincia($codice)
    {
        $sql = "SELECT sigla FROM istat_province WHERE codice_prov=?";
        return Database::getField($sql, [
            $codice
        ]);
    }

    /**
     * Ritorna l'array dei comuni di una provincia
     *
     * @param string $prov
     * @param boolean $ass
     * @return array
     */
    public static function getComuni($prov, $ass = true)
    {
        $comuni = array();

        if (empty($prov))
            $res = Database::getRows("SELECT DISTINCT citta,istat_comune FROM istat_comuni WHERE data_fine IS NULL ORDER BY citta ASC");
        else {
            $sql = "SELECT DISTINCT citta,istat_comune FROM istat_comuni WHERE codice_provincia=? AND data_fine IS NULL ORDER BY citta ASC";
            $res = Database::getRows($sql, [
                $prov
            ]);
        }
        foreach ($res as $row) {
            if (! $ass)
                array_push($comuni, $row['istat_comune']);
            else
                $comuni[$row['istat_comune']] = $row['citta'];
        }
        return $comuni;
    }

    /**
     * Ritorna i comuni filtrando per testo
     *
     * @param string $filter
     * @return array|NULL
     */
    public static function getComuniFilter($filter)
    {
        $comuni = array();

        $res = Database::getRows("SELECT DISTINCT istat_comune, CONCAT(citta, ' (',provincia,')') AS citta FROM istat_comuni WHERE data_fine IS NULL AND citta LIKE ? ORDER BY citta ASC", [
            $filter . "%"
        ]);

        foreach ($res as $row)
            $comuni[$row['istat_comune']] = $row['citta'];
        return $comuni;
    }

    /**
     * ottiene l'array delle nazioni
     *
     * @param bool $ass
     * @return array
     */
    public static function getNazioni($ass = true)
    {
        $sql = "SELECT DISTINCT codice,descrizione FROM istat_nazioni ORDER BY descrizione ASC";
        $rows = Database::getRows($sql, null, $ass ? PDO::FETCH_KEY_PAIR : PDO::FETCH_ASSOC);
        return $rows;
    }

    /**
     * ottiene l'array delle province ( [0]=AA [1]=BB etc.)
     * A differenza di getProvinceRegione, usa codice_prov,sigla
     * invece di sigla, sigla
     *
     * @param bool $ass
     * @param string $regione
     * @return multitype:unknown
     */
    public static function getProvince($ass = true, $regione = null)
    {
        $params = array();
        $sqlRegione = null;
        if (! empty($regione)) {
            $sqlRegione = "AND codice_regione=?";
            $params = array(
                $regione
            );
        }
        $sql = "SELECT DISTINCT codice_prov,sigla FROM istat_comuni i LEFT JOIN istat_province p ON codice_provincia=codice_prov WHERE codice_prov IS NOT NULL $sqlRegione ORDER BY sigla ASC";
        $rows = Database::getRows($sql, $params, $ass ? PDO::FETCH_KEY_PAIR : PDO::FETCH_ASSOC);
        return $rows;
    }

    /**
     * Ritorna l'array delle province estere
     *
     * @return array
     */
    public static function getProvinceExt()
    {
        return Istat::getProvince(true);
    }
}