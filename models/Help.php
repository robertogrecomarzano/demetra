<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Help extends Eloquent
{

    protected $table = "help";

    protected $primaryKey = 'id';

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
        "alias",
        "title",
        "text",
        "stato",
        "id_gruppo"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $maps = [];

    protected $hidden = [];

    protected $appends = [];

    public function getIdGruppoAttribute($value)
    {
        return Gruppo::find($value)->descrizione;
    }
}
