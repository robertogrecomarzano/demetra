<?php
namespace App\Models;

use App\Components\Menu;
use App\Core\Lib\Language;
use App\Core\Lib\Page;
use Illuminate\Database\Eloquent\Model as Eloquent;
use IMenu;
use IPermissions;

class Progetto extends Eloquent implements IMenu, IPermissions
{

    protected $table = "";

    protected $primaryKey = '';

    /**
     * Impostato a false per disattivare i campi created_at e updated_at
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Esempio di funzione OneToOne (rinominarla in base al campo da restituire)
     *
     * Esempio di chiamata: _GenericModel::find(1)->OneToOne_function;
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function hasOne_function()
    {
        return $this->hasOne('App\Models\ModelClassName', "fk");
    }

    /**
     * Defisce l'inverso di one-to-one o one-to-many
     */
    public function belongsTo_function()
    {
        return $this->belongsTo('App\Models\ModelClassName::class');
    }

    /**
     * Esempio di funzione OneToMany (rinominarla in base al campo da restituire)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hasMany_function()
    {
        return $this->hasMany('App\Models\ModelClassName', "fk");
    }

    /**
     * Defisce l'inverso di one-to-one o one-to-many
     */
    public function belongsToMany_function()
    {
        return $this->belongsToMany('App\Models\ModelClassName::class');
    }

    public static function getAll($id)
    {}

    public function isUserOwner()
    {}

    public function isWritable($groups)
    {}

    public static function addInMenuTree()
    {
        $obj = new self();
        
        $page = Page::getInstance();
        $id = Page::getId();
        
        $root = Menu::findRootNode();
        
        $tabelleNode = Menu::appendToNode($root, "progetti/tabelle", Language::get("Tabelle"), Language::get("TABELLE"), Language::get("Gestione voci menù a tendina"), "", "", [
            "icon" => "table",
            "icon-color" => "red"
        ]);
        
        Menu::appendToNode($tabelleNode, "progetti/tabelle/donatori", Language::get("Donatori"), Language::get("Donatori"), Language::get("Gestione elenco donatori"), "", "", [
            "icon" => "award",
            "icon-color" => "red"
        ]);
        Menu::appendToNode($tabelleNode, "progetti/tabelle/aree", Language::get("Aree tematiche"), Language::get("Aree tematiche"), Language::get("Gestione elenco aree tematiche"), "", "", [
            "icon" => "vector-square",
            "icon-color" => "red"
        ]);
        Menu::appendToNode($tabelleNode, "progetti/tabelle/finanziamenti", Language::get("Programmi di finanziamento"), Language::get("Programmi di finanziamento"), Language::get("Gestione elenco programmi di finanziamento"), "", "", [
            "icon" => "coins",
            "icon-color" => "red"
        ]);
        
        Menu::appendToNode($tabelleNode, "progetti/tabelle/partner", Language::get("Partner"), Language::get("Partner"), Language::get("Gestione partner"), "", "", [
            "icon" => "handshake",
            "icon-color" => "red"
        ]);
        Menu::appendToNode($tabelleNode, "progetti/tabelle/personale", Language::get("Personale"), Language::get("Personale"), Language::get("Gestione nominativi personale"), "", "", [
            "icon" => "users",
            "icon-color" => "red"
        ]);
        
        $progettiNode = Menu::appendToNode($root, "progetti", Language::get("Progetti"), Language::get("Progetti"), Language::get("Gestione progetti"), "", "", [
            "icon" => "project-diagram",
            "icon-color" => "green"
        ]);
        
        Menu::appendToNode($progettiNode, "progetti/progetto", Language::get("Nuovo progetto"), Language::get("Dati progetto"), Language::get("Dati progetto"), "", "", [
            "icon-style" => "fas",
            "icon" => "plus",
            "icon-color" => "green"
        ]);
        
        switch ($page->alias) {
            case "progetti/progetto":
                
                if ($id > 0) {
                    Page::$wizard = array();
                    
                    Menu::appendToNode($progettiNode, "progetti/progetto/$id", Language::get("Progetto"), Language::get("Dati progetto"), Language::get("Dati progetto"), "", "", [
                        "icon-style" => "fas",
                        "icon" => "play",
                        "icon-color" => "green"
                    ]);
                }
                break;
        }
        
        Menu::appendToNode($progettiNode, "progetti/report", Language::get("Ricerca"), Language::get("Ricerca progetti"), Language::get("Ricerca progetti"), "", "", [
            "icon-style" => "fas",
            "icon" => "search",
            "icon-color" => "green"
        ]);
        Menu::appendToNode($progettiNode, "progetti/charts", Language::get("Analisi"), Language::get("Analisi progetti"), Language::get("Analisi progetti"), "", "", [
            "icon-style" => "fas",
            "icon" => "pie-chart",
            "icon-color" => "green"
        ]);
    }

    public function isReadable()
    {}
}
