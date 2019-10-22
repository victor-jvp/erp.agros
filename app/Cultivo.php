<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PhpParser\Builder;

class Cultivo extends Model
{
    //
    use SoftDeletes;
    protected $table = "cultivos";

    public function variedades()
    {
        return $this->hasMany(Variedad::class);
    }

    public function productos_compuestos()
    {
        return $this->hasManyThrough(ProductoCompuesto_det::class, ProductoCompuesto_cab::class, 'cultivo_id', 'compuesto_id', 'id');
    }
}
