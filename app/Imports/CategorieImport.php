<?php

namespace App\Imports;

use App\Models\Categorie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;

class CategorieImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if($row[0] && $row[0] != 'Kategori Adı' && $row[1] && $row[1] != 'Kategori Resmi')
        {
            return new Categorie(attributes: [
                'name' => $row[0],
                'slug' => Str::slug($row[0]),
                'image' => $row[1],
                'account_id' => Auth::user()->account->id,
                'import' => true
            ]);
        }
        
    }
}
