<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class UserGoal.
 *
 * @package namespace App\Models;
 */
class UserGoal extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'start_date',
        'end_date',
        'description',
        'amount',
        'office_id',
        'status_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'amount'            =>  'float',
        'start_date'        =>  'datetime',
        'end_date'          =>  'datetime',
        'created_at'        =>  'datetime',
        'updated_at'        =>  'datetime',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

}
