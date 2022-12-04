<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Gruppo extends Eloquent
{

    protected $table = "utenti_gruppi";

    protected $primaryKey = 'id_gruppo_utente';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "nome",
        "descrizione"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    
    
    /**
     * Create a new Eloquent model instance.
     *
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        $this->bootIfNotBooted();
        
        $this->initializeTraits();
        
        $this->syncOriginal();
        
        $this->fill($attributes);
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
