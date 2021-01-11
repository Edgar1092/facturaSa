<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Status.
 *
 * @package namespace App\Models;
 */
class Status extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','type'];

    /**
     * Relations
     */

    public function quotations()
    {
        return $this->hasMany(Quotation::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
