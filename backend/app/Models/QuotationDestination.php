<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class QuotationDestination.
 *
 * @package namespace App\Models;
 */
class QuotationDestination extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date'
    ];

    protected $casts = [
        'start_date'        =>  'date',
        'end_date'          =>  'date',
    ];

    /**
     * Relations
     */

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

}
