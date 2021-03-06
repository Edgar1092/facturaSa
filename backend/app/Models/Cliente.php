<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'first_name', 'avatar', 'email', 'razon_social', 'rif', 'direccion',
        'notas','telefono', 'estatus'
    ];
}
