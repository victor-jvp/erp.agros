<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especiales extends Model
{
    //
    protected $table      = "especiales";
    protected $fillable   = [
        'semana_ini',
        'semana_fin',
        'mail_driver',
        'mail_host',
        'mail_port',
        'mail_username',
        'mail_password'
    ];
}
