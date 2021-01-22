<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $fillable = [
        'id',
        'nombre', 'email', 'direccion', 'estatus'
    ];
}
