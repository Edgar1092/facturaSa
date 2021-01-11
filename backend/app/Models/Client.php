<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Client.
 *
 * @package namespace App\Models;
 */
class Client extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'is_prospect',
        'type',
        'name',
        'contact_person',
        'mobile',
        'phone',
        'email',
        'observation',
        'country_id',
        'city',
        'street',
        'colony',
        'zip_code',
        'payment_method_id',
        'date_client',
        'date_prospect',
        'parent_id',
        'rfc',
        'office_id'
    ];

    protected $casts = [
        'updated_at'    =>  'datetime',
        'created_at'    =>  'datetime',
        'date_client'   =>  'datetime',
        'date_prospect' =>  'datetime',
        'is_prospect'   =>  'boolean'
    ];

    protected $appends = [
        'LastDestination'
    ];
    /**
     * Relations
     */
    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function credit_cards()
    {
        return $this->hasMany(CreditCard::class);
    }

    public function quotations()
    {
        return $this->hasMany(Quotation::class);
    }

    public function propoals()
    {
        return $this->hasMany(Propoal::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function parent()
    {
        return $this->belongsTo(Client::class,'parent_id','id');
    }

    public function getLastDestinationAttribute()
    {
        $quotation = $this->quotations()->whereHas('status',function($q){
            $q->whereIn('name',['Aprobada','Aprobada y pagada']);
        })->orderBy('approved_date','desc')->first();

        if(!empty($quotation))
        {
            return $quotation->destinations->last()->name;
        }else{
            return '';
        }

    }

    /**
     * Attributes
     */

    public function getBalanceAttribute()
    {

    }

    protected static function boot() {
        parent::boot();

        static::deleting(function($office) {
            $office->propoals()->delete();
            $office->tasks()->delete();
            $office->credit_cards()->delete();
        });
    }
}
