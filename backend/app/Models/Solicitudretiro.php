<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Solicitudretiro extends Model
{
    public $timestamps = false;
    protected $table= "solicitudRetiro";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'idUserFk',
        'montoSolicitado',
        'plataforma',
        'estatus',
        'cuenta'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'update_at', 'create_at','delete_at'
    ];
}
