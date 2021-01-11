<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Payment.
 *
 * @package namespace App\Models;
 */
class Payment extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
        'quotation_id',
        'payment_method_id',
        'date_payment',
        'concept',
        'import',
        'user_id',
        'folio_number',
        'currency_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'date_payment'      =>  'date',
        'created_at'        =>  'datetime',
        'import'            =>  'float'
    ];

    /**
     * Relations
     */

    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function files()
    {
        return $this->belongsToMany(File::class,'relation_file','rel_id','file_id')
        ->where('table_name',$this->getTable());
    }

}
