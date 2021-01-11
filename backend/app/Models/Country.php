<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Country.
 *
 * @package namespace App\Models;
 */
class Country extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Relations
     */
    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function nationalities()
    {
        return $this->hasMany(ClientNationality::class);
    }

    public function companies()
    {
        return $this->hasMany(Company::class);
    }



}
