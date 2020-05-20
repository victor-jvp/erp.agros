<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TzArticulo extends Model
{
    //
    use SoftDeletes;
    protected $table = "tz_articulos";
    protected $fillable = [
        "articulo"
    ];
}
