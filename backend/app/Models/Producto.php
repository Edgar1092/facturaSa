<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'id',
        'codigo', 'codigo_proveedor', 'nombre', 'costo','precio1','precio2','precio3','departamento',
        'estatus'
    ];
}
