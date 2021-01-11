<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class QuotationDetail.
 *
 * @package namespace App\Models;
 */
class QuotationDetail extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'service_id',
        'quantity',
        'price',
        'description',
        'confirm'
    ];

    protected $appends = ['import'];
    protected $casts = [
        'price'     =>  'float',
        'confirm'   =>  'boolean'
    ];
    /**
     * Relations
     */

    public function service()
    {
        return $this->belongsTo(Service::class)
        ->withTrashed();;
    }

    public function quotation()
    {
        return $this->hasOne(Quotation::class);
    }

    public function getImportAttribute()
    {
        return ($this->quantity * $this->price);
    }

}
