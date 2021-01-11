<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class PassengerNationality.
 *
 * @package namespace App\Models;
 */
class PassengerNationality extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'passenger_id',
        'country_id',
        'passport',
        'passport_expiration_date',
        'visa',
        'visa_expiration_date',
        'ine',
        'curp'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'passport_expiration_date' =>  'datetime',
        'visa_expiration_date'     =>  'datetime',
        'created_at'            =>  'datetime'
    ];

    /**
     * Relations
     */
    public function passenger()
    {
        return $this->belongsTo(Passenger::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }



}
