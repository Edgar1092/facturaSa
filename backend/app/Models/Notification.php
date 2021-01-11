<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Notification.
 *
 * @package namespace App\Models;
 */
class Notification extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title','body'];

    /**
     * Relations
     */
    public function users()
    {
        return $this->belongsToMany(User::class)
        ->withPivot('viewed', 'viewed_on');;
    }
}
