<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class PaymentMethod.
 *
 * @package namespace App\Models;
 */
class PaymentMethod extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }
}
