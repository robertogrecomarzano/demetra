<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;


class Utente extends Eloquent
{

    protected $table = "utenti";

    protected $primaryKey = 'id_utente';
    
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

    /*
     * Get Todo of User
     *
     */
    /*public function todo()

    {
        return $this->hasMany('App\Models\Todo',"user_id");
    }*/
}
