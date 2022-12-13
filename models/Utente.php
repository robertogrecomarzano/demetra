<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Utente extends Eloquent
{

    protected $table = "utenti";

    protected $primaryKey = 'id_utente';

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
        'email',
        'password',
        'readonly',
        'token',
        'default_page'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

        'password'
    ];

    /**
     * Gruppi dell'utente
     */
    public function gruppi()
    {
        return $this->belongsToMany(Gruppo::class, "utenti_has_gruppi", "id_utente", "id_gruppo_utente")->distinct();
    }

    /**
     * Serivizi dell'utente
     */
    public function servizi()
    {
        return $this->belongsToMany(Servizio::class, "servizi_utenti", "id_utente", "id_servizio")->distinct();
    }
}
