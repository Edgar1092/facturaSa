<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Collaborator.
 *
 * @package namespace App\Models;
 */
class Collaborator extends Model implements Transformable
{
    use TransformableTrait,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'work_place',
        'birthdate',
        'ine',
        'passport',
        'nss',
        'curp',
        'rfc',
        'visa',
        'blood_type_id',
        'holydays',
        'salary',
        'contract_conditions',
        'date_admission',
        'office_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'date_admission'    =>  'date',
        'birthdate'         =>  'date',
        'created_at'        =>  'datetime',
        'updated_at'        =>  'datetime',
        'salary'            =>  'float',
        'holydays'          =>  'integer'
    ];

    protected $appends = ['holydays_pending'];


    /**
     * Realations
     */

    public function vacation_records()
    {
        return $this->hasMany(VacationRecord::class);
    }

    public function blood_type()
    {
        return $this->belongsTo(BloodType::class);
    }

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class)
        ->where('type','collaborators');
    }

    /**
     * Attributes
     */

    public function getHolydaysPendingAttribute()
    {
        $days = 0;
        $days = $this->vacation_records()->whereYear('date_start','=',date('Y'))->sum('days');

        return ($this->holydays - $days);
    }

    protected static function boot() {
        parent::boot();

        static::deleting(function($office) {
            $office->vacation_records()->delete();
        });
    }
}
