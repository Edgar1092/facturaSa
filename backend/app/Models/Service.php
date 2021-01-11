<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Service.
 *
 * @package namespace App\Models;
 */
class Service extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'office_id',
        'name',
        'description',
        'utility',
        'operator_commission'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'utility'               =>  'boolean',
        'operator_commission'   =>  'boolean'
    ];

    /**
     * Relations
     */

    public function quotation_details()
    {
        return $this->hasMany(Quotation::class);
    }

    public function office()
    {
        return $this->belongsTo(Office::class);
    }
}
