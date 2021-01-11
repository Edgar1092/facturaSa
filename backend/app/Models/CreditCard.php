<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class CreditCard.
 *
 * @package namespace App\Models;
 */
class CreditCard extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'card_number',
        'expiration_year',
        'expiration_month',
        'cvc',
        'client_id'
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'expired_date'  =>  'datetime',
        'created_at'    =>  'datetime'
    ];

    /**
     * Relations
     */

    public function client()
    {
        return $this->hasOne(Client::class);
    }

}
