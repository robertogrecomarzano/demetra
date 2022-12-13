<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Core\Lib\Language;
use Illuminate\Database\Eloquent\Model;

class Personale extends Eloquent
{

    protected $table = "progetti_personale_values";

    protected $primaryKey = 'id_personale';

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
    protected $fillable = [
        'cognome',
        'nome',
        'genere',
        'funzione',
        'telefono',
        'email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    protected $ruoli = [
        "communication_officer" => "Communication Officer",
        "coordinatore" => "Coordinatore di progetto",
        "desk_officer" => "Desk Officer",
        "financial_officer" => "Financial Officer",
        "focal_point" => "Focal Point",
        "junior_assistant" => "Junior assistant",
        "project_officer" => "Project officer",
        "redattore" => "Redattore",
        "referente" => "Referente Paese"
    ];

    protected $generi = [];

    function __construct(array $attributes = array())
    {
        $this->generi = [
            "F" => Language::get("Femmina"),
            "M" => Language::get("Maschio"),
            "Altro" => Language::get("Altro"),
            "Non binario" => Language::get("Non binario")
        ];
    }

    function getFunzioneAttribute($value)
    {
        $funzioni = explode(",", $value);
        foreach ($funzioni as $f)
            $funzione_list[] = $this->ruoli[$f];
        return implode("<br />", $funzione_list);
    }

    function getGenereAttribute($value)
    {
        return $this->generi[$value];
    }

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
}
