<?php

namespace App\Models;

trait ProductPriceScope
{
    public function scopeFilterByCategories($query, array $categoryIds)
    {
        if (!empty($categoryIds)) {
            return $query->whereIn("categorie_id", $categoryIds);
        }
        return $query;
    }

    public function getVariantPriceFields()
    {
        $variantFields = [];
        for ($i = 1; $i <= 15; $i++) {
            $field = "variant_price_" . $i;
            if (!is_null($this->$field) && !empty($this->$field)) {
                $variantFields[] = $field;
            }
        }
        return $variantFields;
    }
}