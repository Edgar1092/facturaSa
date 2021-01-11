<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class VacationRecord.
 *
 * @package namespace App\Models;
 */
class VacationRecord extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date_start',
        'date_end',
        'days',
        'observation',
        'collaborator_id'
    ];


    /**
     * Relations
     */

    public function collaborator()
    {
        return $this->belongsTo(Collaborator::class);
    }
}
