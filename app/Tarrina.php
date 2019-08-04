<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tarrina extends Model
{
    //
    use SoftDeletes;
    protected $table = "tarrinas";
}
