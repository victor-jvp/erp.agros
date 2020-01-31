<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table    = 'categorias';
    protected $fillable = ['name'];

    public function compuestos()
    {
        return $this->hasMany(ProductoCompuesto_det::class, 'categoria_id');
    }
}
