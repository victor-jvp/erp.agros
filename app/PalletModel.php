<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PalletModel extends Model
{
    //
    use SoftDeletes;
    protected $table = "pallets_models";
}
