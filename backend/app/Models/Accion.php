<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Accion extends Model
{
    use TransformableTrait, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'referenciaPago',
        'plataforma',
        'idUsuarioFk',
        'idFaseFk',
        'estatus'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [

        'updated_at'        =>  'datetime',
    ];

    // protected $appends = [
    //     'usuario'
    // ];

    // public function quotations()
    // {
    //     return $this->belongsToMany(Calculadora::class);
    // }
    
    // public function user()
    // {
    //     return $this->hasOne(User::class, 'id');
    // }


    public function getusuarioAttribute()
    {
        $usuario = $this->user()->orderBy('created_at','desc')->first();

        if(!empty($usuario))
        {
            return $usuario;
        }else{
            return '';
        }

    }

}
