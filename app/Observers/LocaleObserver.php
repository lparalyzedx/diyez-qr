<?php

namespace App\Observers;

use App\Models\Locale;
use App\Models\Categorie;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class LocaleObserver
{
    /**
     * Handle the Locale "created" event.
     *
     * @param \App\Models\Locale $locale
     * @return void
     */
    public function created(Locale $locale)
    {
        $defaultLanguage = "tr";
        $categories = Categorie::query()->account()->get();

        foreach ($categories as $category) {
            $names = [
                $defaultLanguage => $category->name,
            ];

            $slugs = [
                $defaultLanguage => $category->slug,
            ];

            $names[$locale->language_code] = $category->name;
            $slugs[$locale->language_code] = $category->slug;

            $category->update([
                "name" => $names,
                "slug" => $slugs,
            ]);
        }
    }

    public function deleted(Locale $locale)
    {
        $categories = Categorie::query()->account()->get();
        $products = Product::query()->account()->get();

        foreach ($categories as $category) {
            $category->forgetAllTranslations($locale->language_code);
            $category->save();
        }

        foreach ($products as $product) {
            $product->forgetAllTranslations($locale->language_code);
            $product->save();
        }
    }
}
