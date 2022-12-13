<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Finanziamento extends Eloquent
{

    protected $table = "progetti_finanziamenti_values";

    protected $primaryKey = 'id_finanziamento';

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
        'acronimo',
        'finanziamento',
        'id_donatore'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function getIdDonatoreAttribute($value)
    {
        return Donatore::find($value)->donatore;
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
