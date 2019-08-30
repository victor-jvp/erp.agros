<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Inventario extends Model
{
    protected $table = "inventario";

    public function scopeStock($query)
    {
        $query = 'SELECT
                    inv.categoria,
                    inv.categoria_id,
                    (CASE 
                        WHEN inv.categoria = "Caja" THEN (SELECT CONCAT(formato," | ", modelo) as formato FROM cajas WHERE cajas.id = inv.categoria_id)
                        WHEN inv.categoria = "Palet" THEN (SELECT formato FROM pallets WHERE pallets.id = inv.categoria_id)
                        WHEN inv.categoria = "Cubre" THEN (SELECT formato FROM cubres WHERE cubres.id = inv.categoria_id)
                        WHEN inv.categoria = "Auxiliar" THEN (SELECT modelo FROM auxiliares WHERE auxiliares.id = inv.categoria_id)
                        WHEN inv.categoria = "Tarrina" THEN (SELECT modelo FROM tarrinas WHERE tarrinas.id = inv.categoria_id)
                        ELSE ""
                    END) AS material,
                    (SELECT SUM(inventario.cantidad) FROM inventario WHERE inventario.tipo_mov = "E" AND inventario.categoria_id = inv.categoria_id) AS entradas,
                    (SELECT SUM(inventario.cantidad) FROM inventario WHERE inventario.tipo_mov = "S" AND inventario.categoria_id = inv.categoria_id) AS salidas
                FROM
                    inventario as inv
                GROUP BY
                    inv.categoria,
                    inv.categoria_id';
        return DB::select($query);
    }
}
