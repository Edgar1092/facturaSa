<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $fillable = [
        'id',
        'producto_id', 'entrada', 'salida', 'monto'
    ];
}
