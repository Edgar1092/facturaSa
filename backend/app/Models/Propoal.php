<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Propoal.
 *
 * @package namespace App\Models;
 */
class Propoal extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
        'expiration_date',
        'observation',
        'office_id'
    ];

    public function quotations()
    {
        return $this->hasMany(Quotation::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class)->where('type','propoals');
    }

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function notes()
    {
        return $this->hasMany(PropoalNote::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class,'owner_user_id')
        ->withTrashed();;
    }

    public function files()
    {
        return $this->belongsToMany(File::class,'relation_file','rel_id','file_id')
        ->where('table_name',$this->getTable());
    }

    protected static function boot() {
        parent::boot();

        static::deleting(function($office) {
            $office->quotations()->delete();
            $office->tasks()->delete();
            $office->notes()->delete();
        });
    }

}
