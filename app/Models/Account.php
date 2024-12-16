<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $dates = ['terminate_at'];
    protected $casts = ['terminate_at' => 'datetime','city_id' => 'integer','district_id' => 'integer'];

    public function dates($date)
    {
        return Carbon::parse($date)->setTimezone('Europe/Istanbul') ?? null;
    }

    public function users()
    {
        return $this->hasMany('App\Models\User', 'account_id', 'id');
    }

    public function city()
    {
        return $this->hasOne('App\Models\City', 'id', 'city_id');
    }

    public function district()
    {
        return $this->hasOne('App\Models\District', 'id', 'district_id');
    }
    
    public function owner()
    {
        return $this->hasOne('App\Models\User', 'id', 'owner_id');
    }

    public function locales()
    {
        return $this->hasMany('App\Models\Locale','account_id','id');
    }
}
