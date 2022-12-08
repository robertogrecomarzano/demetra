<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Carbon\Carbon;

class Avviso extends Eloquent
{

    protected $table = "avvisi";

    protected $primaryKey = 'id_avviso';

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
        "titolo",
        "descrizione",
        "descrizione_lunga",
        "dal",
        "al"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Ritorna il campo della data di inizio "dal" in formato dd/mm/yyyy
     *
     * @param string $value
     * @return string
     */
    public function getDalAttribute($value)
    {
        return (new Carbon($value))->format('d/m/Y');
    }

    /**
     * Ritorna il campo della data di inizio "al" in formato dd/mm/yyyy
     *
     * @param string $value
     * @return string
     */
    public function getAlAttribute($value)
    {
        return (new Carbon($value))->format('d/m/Y');
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
