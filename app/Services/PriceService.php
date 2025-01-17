<?php

namespace App\Services;

class PriceService 
{
    public function updatePrice($originalPrice, $updateType, $operationType, $value, $roundingOption = false, $roundingAmount = 0)
    {
        $price = $this->getTranslatedPrice($originalPrice);
        
        $adjustedPrice = $this->calculateNewPrice($price, $updateType, $operationType, $value);
        
        if ($roundingOption && $roundingAmount > 0) {
            $adjustedPrice = round($adjustedPrice / $roundingAmount) * $roundingAmount;
        }
        
        // Round to nearest whole number
        $adjustedPrice = round($adjustedPrice / 1) * 1;
        
        $adjustedPrice = max($adjustedPrice, 0);
        
        return is_numeric($originalPrice) 
            ? number_format($adjustedPrice, 2, '.', '') 
            : $this->setTranslatedPrice($originalPrice, $adjustedPrice);
    }

    private function calculateNewPrice($price, $updateType, $operationType, $value)
    {
        if ($updateType === "amount") {
            return $operationType === "increase" 
                ? $price + $value 
                : $price - $value;
        }
        
        return $operationType === "increase"
            ? $price * (1 + $value / 100)
            : $price * (1 - $value / 100);
    }

    private function getTranslatedPrice($price)
    {
        if (is_string($price)) {
            try {
                $priceData = json_decode($price, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($priceData)) {
                    return floatval(reset($priceData));
                }
            } catch (\Exception $e) {
                return floatval($price);
            }
        }
        return floatval($price);
    }

    private function setTranslatedPrice($originalPrice, $newPrice)
    {
        if (is_string($originalPrice)) {
            try {
                $priceData = json_decode($originalPrice, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($priceData)) {
                    foreach ($priceData as $locale => $value) {
                        $priceData[$locale] = number_format($newPrice, 2, '.', '');
                    }
                    return json_encode($priceData);
                }
            } catch (\Exception $e) {
                return number_format($newPrice, 2, '.', '');
            }
        }
        return number_format($newPrice, 2, '.', '');
    }
}