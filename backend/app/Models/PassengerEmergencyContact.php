<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class PassengerEmergencyContact.
 *
 * @package namespace App\Models;
 */
class PassengerEmergencyContact extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'passenger_id',
        'first_name',
        'last_name',
        'email',
        'phone_1',
        'phone_2'
    ];

    public function passenger()
    {
        return $this->belongsTo(Passenger::class);
    }

}
