<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Categorie extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $appends = ['path','real_path','origin_image'];

    public function scopeAccount($query)
    {
       return $query->where('account_id', Auth::user()->account->id);
    }

    public function category()
    {
       return $this->hasOne('App\Models\Categorie','id','categorie_id');
    }

    public function childs()
    {
        return $this->hasMany('App\Models\Categorie','categorie_id','id')->orderBy('order_id','asc');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product','categorie_id','id')->where('status',1)->orderBy('order_id','asc');
    }

    public function account()
    {
        return $this->hasOne('App\Models\Account','id','account_id');
    }


    public function getPathAttribute()
    {
        $path = $this->name;
        $parent = $this->category;

        while ($parent) {
            $path = ' - ' . $path;
            $parent = $parent->category;
        }

        return $path;
    }
    
    public function getRealPathAttribute()
    {
       $pathParts = [];
       $parent = $this->category;

        while ($parent) {
          array_unshift($pathParts, $parent->name);
          $parent = $parent->category;
        }

        return implode(' / ', $pathParts);
    }

    public function getOriginImageAttribute()
    {
        if(!is_null($this->image))
        {
            if($this->import)
            {
                return $this->image;
            }else{
                return asset('storage/'.$this->image);
            }
        }

        return asset('storage/'.$this->account->placeholder_image);   
    }

}
