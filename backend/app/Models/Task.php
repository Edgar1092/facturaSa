<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Task.
 *
 * @package namespace App\Models;
 */
class Task extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'expiration_date',
        'task_type_id',
        'name',
        'description',
        'client_id',
        'status_id',
        'propoal_id',
        'office_id',
        'owner_user_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'expiration_date'   =>  'date',
        'created_at'        =>  'datetime',
        'updated_at'        =>  'datetime',
    ];
    /**
     * Relations
     */

    public function task_type()
    {
        return $this->belongsTo(TaskType::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class)
        ->where('type','tasks');
    }

    public function owner()
    {
        return $this->belongsTo(User::class,'owner_user_id')
        ->withTrashed();;
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function propoal()
    {
        return $this->belongsTo(Propoal::class);
    }

    public function files()
    {
        return $this->belongsToMany(File::class,'relation_file','rel_id','file_id')
        ->where('table_name',$this->getTable());
    }

}
