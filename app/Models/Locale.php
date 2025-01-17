<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Locale extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeAccount($query)
    {
       return $query->where('account_id', Auth::user()->account->id);
    }
}
