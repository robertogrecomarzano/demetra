<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Configurazione extends Eloquent
{

    protected $table = "config";

    protected $primaryKey = 'id_config';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "denominazione",
        "sede",
        "telefono",
        "email",
        "email_support",
        "web",
        "is_offline",
        "is_debug",
        "is_collaudo",
        "mail_enable",
        "mail_smtp",
        "mail_smtp_server",
        "mail_smtp_auth",
        "mail_smtp_user",
        "mail_smtp_password",
        "mail_smtp_port",
        "mail_smtp_secure",
        "mail_smtp_secure_type",
        "mail_smtp_debug"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id'
    ];
}
