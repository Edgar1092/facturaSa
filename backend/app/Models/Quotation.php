<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Quotation.
 *
 * @package namespace App\Models;
 */
class Quotation extends Model implements Transformable
{
    use TransformableTrait, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tax',
        'client_id',
        'currency_id',
        'propoal_id',
        'status_id',
        'expiration_date',
        'observation',
        'quantity_childrens',
        'quantity_adults',
        'quantity_elderly',
        'start_date',
        'end_date',
        'exchange_rate'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'expiration_date'   =>  'datetime',
        'start_date'        =>  'datetime',
        'end_date'          =>  'datetime',
        'created_at'        =>  'datetime',
        'updated_at'        =>  'datetime',
        'exchange_rate'     =>  'float',
        'quantity_childrens'=>  'integer',
        'quantity_adults'   =>  'integer',
        'quantity_elderly'  =>  'integer',

    ];

    protected $appends = ['balance','total_pesos'];

    /**
     * Relations
     */
    public function created_by()
    {
        return $this->belongsTo(User::class,'created_by_user_id','id')
        ->withTrashed();;
    }
    public function rejected_or_authorized_by()
    {
        return $this->belongsTo(User::class,'rejected_or_authoryzed_by_user_id','id')
        ->withTrashed();;
    }

    public function status()
    {
        return $this->belongsTo(Status::class)->where('type','quotations');
    }

    public function client()
    {
        return $this->belongsTo(Client::class,'client_id');

    }
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function destinations()
    {
        return $this->hasMany(QuotationDestination::class);
    }

    public function propoal()
    {
        return $this->belongsTo(Propoal::class);
    }

    public function details()
    {
        return $this->hasMany(QuotationDetail::class);
    }

    public function passengers()
    {
        return $this->belongsToMany(Passenger::class);
    }

    public function notes()
    {
        return $this->hasMany(QuotationNote::class);
    }

    public function files()
    {
        return $this->belongsToMany(File::class,'relation_file','rel_id','file_id')
        ->where('table_name',$this->getTable());
    }

    public function getBalanceAttribute()
    {
        return ($this->total-$this->payments->sum('import'));
    }

    public function getTotalPesosAttribute()
    {
        return ($this->total*$this->exchange_rate);
    }

    protected static function boot() {
        parent::boot();

        static::deleting(function($office) {
            $office->payments()->delete();
            $office->destinations()->delete();
            $office->details()->delete();
            $office->notes()->delete();
            $office->files()->sync([]);
        });
    }
}
