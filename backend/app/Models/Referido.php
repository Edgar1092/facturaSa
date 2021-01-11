<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Referido extends Model
{
    public $timestamps = false;
    protected $table= "referido";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'idAccionFk',
        'idUserReferidoFk',
        'idUsuarioDuenoFk',
        'idAccionReferidoFk'
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
