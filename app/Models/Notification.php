<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function product()
    {
        return $this->hasOne('App\Models\Product','product_id','product_id')->with('market');
    }
}
