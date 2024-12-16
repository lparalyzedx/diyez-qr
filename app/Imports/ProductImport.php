<?php

namespace App\Imports;

use App\Models\Categorie;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ($row[0] == 'Ürün Adı' || empty($row[0])) {
            return null;
        }

        $accountId = Auth::user()->account->id;

        $category = Categorie::where('account_id', $accountId)
            ->where('slug', str::slug($row[2]))
            ->first();

        if (!$category) {
            $category = Categorie::firstOrCreate(
                [
                    'account_id' => $accountId,
                    'name' => 'IMPORT',
                ],
                [
                    'slug' => Str::slug('IMPORT'),
                    'image' => null, 
                    'import' => true
                ]
            );
        }


        $images = !empty($row[1]) ? json_encode(explode(',', $row[1])) : null;

        $product = new Product([
            'name' => $row[0],
            'slug' => Str::slug($row[0]),
            'contents' => $row[37] ?? null, 
            'allergens' => $row[38] ?? null,
            'images' => $images,
            'price' => $row[3] ?? null, 
            'currency' => $row[4] ?? 'TL', 
            'status' => $row[39] ?? 1,
            'import' => true,
            'categorie_id' => $category->id,
            'account_id' => $accountId
        ]);

        for ($i = 0; $i < 15; $i++) {
            $nameIndex = 5 + ($i * 2); 
            $priceIndex = 6 + ($i * 2);

            if (!empty($row[$nameIndex]) && !empty($row[$priceIndex])) {
                $variantKey = 'variant_name_' . ($i + 1);
                $priceKey = 'variant_price_' . ($i + 1);
                $product->$variantKey = $row[$nameIndex];
                $product->$priceKey = $row[$priceIndex];
            }
        }

        $product->save();

        return $product;
    }
}
