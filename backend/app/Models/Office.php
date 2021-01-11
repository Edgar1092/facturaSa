<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Office.
 *
 * @package namespace App\Models;
 */
class Office extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    public $timestamps = true;
    protected $softDelete = true;
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at'        =>  'datetime'
    ];

    protected $fillable  = [
        'name',
        'contact',
        'email',
        'phone_1',
        'phone_2',
        'zip_code',
        'city',
        'street',
        'colony',
        'observation',
        'responsible_id',
    ];

 
    
}
