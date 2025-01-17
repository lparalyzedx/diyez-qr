<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasFactory, HasTranslations, ProductPriceScope;
    protected $guarded = [];
    protected $appends = ['is_variant','variants','image_url','origin_image'];

    protected $casts = ['price' => 'array'];
    protected $translatable = [
        'name',
        'slug',
        'contents',
        'allergens',
        'currency',
        'price',
        'variant_name_1',
        'variant_name_2',
        'variant_name_3',
        'variant_name_4',
        'variant_name_5',
        'variant_name_6',
        'variant_name_7',
        'variant_name_8',
        'variant_name_9',
        'variant_name_10',
        'variant_name_11',
        'variant_name_12',
        'variant_name_13',
        'variant_name_14',
        'variant_name_15',
        'variant_price_1',
        'variant_price_2',
        'variant_price_3',
        'variant_price_4',
        'variant_price_5',
        'variant_price_6',
        'variant_price_7',
        'variant_price_8',
        'variant_price_9',
        'variant_price_10',
        'variant_price_11',
        'variant_price_12',
        'variant_price_13',
        'variant_price_14',
        'variant_price_15'
    ];

    public function scopeAccount($query)
    {
       return $query->where('account_id', Auth::user()->account->id);
    }

    public function category()
    {
        return $this->hasOne('App\Models\Categorie','id','categorie_id');
    }

    public function account()
    {
        return $this->hasOne('App\Models\Account','id','account_id');
    }
    
    public function getImageUrlAttribute()
    {
        $images = json_decode($this->images);

        return is_array($images) && !empty($images)
            ? $images[0]
            : null;
    }


    public function getOriginImageAttribute()
    {

        $images = json_decode($this->images) ?? [];

    if (!empty($images)) {
        if ($this->import) {
            return $images[0];
        } else {
            return asset('storage/'.$images[0]);
        }
    }
    return asset('storage/'.$this->account->placeholder_image);
    }
    
    public function getIsVariantAttribute()
    {
        $variantColumns = [
        ['variant_name_1', 'variant_price_1'],
        ['variant_name_2', 'variant_price_2'],
        ['variant_name_3', 'variant_price_3'],
        ['variant_name_4', 'variant_price_4'],
        ['variant_name_5', 'variant_price_5'],
        ['variant_name_6', 'variant_price_6'],
        ['variant_name_7', 'variant_price_7'],
        ['variant_name_8', 'variant_price_8'],
        ['variant_name_9', 'variant_price_9'],
        ['variant_name_10', 'variant_price_10'],
        ['variant_name_11', 'variant_price_11'],
        ['variant_name_12', 'variant_price_12'],
        ['variant_name_13', 'variant_price_13'],
        ['variant_name_14', 'variant_price_14'],
        ['variant_name_15', 'variant_price_15']
    ];

       foreach ($variantColumns as $columns) {
        $nameColumn = $columns[0];  
       
        if (!is_null($this->{$nameColumn}) && $this->{$nameColumn} !== '') {
            return true;
        }
    }

        return false;
    }

    public function getVariantsAttribute()
    {
        $variants = [];

        $variantColumns = [
            ['name' => 'variant_name_1', 'price' => 'variant_price_1'],
            ['name' => 'variant_name_2', 'price' => 'variant_price_2'],
            ['name' => 'variant_name_3', 'price' => 'variant_price_3'],
            ['name' => 'variant_name_4', 'price' => 'variant_price_4'],
            ['name' => 'variant_name_5', 'price' => 'variant_price_5'],
            ['name' => 'variant_name_6', 'price' => 'variant_price_6'],
            ['name' => 'variant_name_7', 'price' => 'variant_price_7'],
            ['name' => 'variant_name_8', 'price' => 'variant_price_8'],
            ['name' => 'variant_name_9', 'price' => 'variant_price_9'],
            ['name' => 'variant_name_10', 'price' => 'variant_price_10'],
            ['name' => 'variant_name_11', 'price' => 'variant_price_11'],
            ['name' => 'variant_name_12', 'price' => 'variant_price_12'],
            ['name' => 'variant_name_13', 'price' => 'variant_price_13'],
            ['name' => 'variant_name_14', 'price' => 'variant_price_14'],
            ['name' => 'variant_name_15', 'price' => 'variant_price_15']
        ];

        foreach ($variantColumns as $variant) {
            $name = $this->{$variant['name']};
            $price = $this->{$variant['price']};

            if (!is_null($name) && $name !== '') {
                $variantObject = (object)[
                    'name' => $name,
                    'price' => $price,
                ];

                if (!$this->variantExists($variants, $variantObject)) {
                    $variants[] = $variantObject;
                }
            }
        }

        return collect($variants);
    }

    private function variantExists($variants, $newVariant)
    {
        foreach ($variants as $variant) {
            if ($variant->name === $newVariant->name && $variant->price === $newVariant->price) {
                return true;
            }
        }
        return false;
    }

}
