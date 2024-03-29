<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoCompuesto_det extends Model
{
    protected $table = "productoscompuestos_det";

    public function caja()
    {
        return $this->belongsTo(Caja::class);
    }

    public function tarrinas()
    {
        return $this->hasMany(ProductoCompuesto_tarrinas::class, 'det_id');
    }

    public function auxiliares()
    {
        return $this->hasMany(ProductoCompuesto_auxiliares::class, 'det_id');
    }

    public function palets_auxiliares()
    {
        return $this->hasMany(ProductoCompuesto_palets_auxiliares::class, 'det_id');
    }

    public function compuesto()
    {
        return $this->belongsTo(ProductoCompuesto_cab::class, 'compuesto_id');
    }

    public function cajas()
    {
        return $this->hasMany(ProductoCompuesto_cajas::class, 'det_id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
