<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'update_'.app()->getLocale().'_name' => 'required|max:255',
            'update_'.app()->getLocale().'_contents' => 'nullable',
            'update_'.app()->getLocale().'_allergens' => 'nullable',
            'update_images.*' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp,avif|max:2048',
            'update_categorie_id' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ($value == null || $value == 0  || !\DB::table('categories')->where('id', $value)->exists()) {
                        $fail('Kategori bulunamadı.');
                    }
                },
            ],
            'update_'.app()->getLocale().'_price' => 'nullable|numeric|regex:/^\d{1,10}(\.\d{1,2})?$/',
            'update_'.app()->getLocale().'_currency' => 'nullable|max:255',
            'update_'.app()->getLocale().'_variant_name_1' => 'nullable|max:255',
            'update_'.app()->getLocale().'_variant_price_1' => 'nullable|numeric|regex:/^\d{1,10}(\.\d{1,2})?$/',
            'update_'.app()->getLocale().'_variant_name_2' => 'nullable|max:255',
            'update_'.app()->getLocale().'_variant_price_2' => 'nullable|numeric|regex:/^\d{1,10}(\.\d{1,2})?$/',
            'update_'.app()->getLocale().'_variant_name_3' => 'nullable|max:255',
            'update_'.app()->getLocale().'_variant_price_3' => 'nullable|numeric|regex:/^\d{1,10}(\.\d{1,2})?$/',
            'update_'.app()->getLocale().'_variant_name_4' => 'nullable|max:255',
            'update_'.app()->getLocale().'_variant_price_4' => 'nullable|numeric|regex:/^\d{1,10}(\.\d{1,2})?$/',
            'update_'.app()->getLocale().'_variant_name_5' => 'nullable|max:255',
            'update_'.app()->getLocale().'_variant_price_5' => 'nullable|numeric|regex:/^\d{1,10}(\.\d{1,2})?$/',
            'update_'.app()->getLocale().'_variant_name_6' => 'nullable|max:255',
            'update_'.app()->getLocale().'_variant_price_6' => 'nullable|numeric|regex:/^\d{1,10}(\.\d{1,2})?$/',
            'update_'.app()->getLocale().'_variant_name_7' => 'nullable|max:255',
            'update_'.app()->getLocale().'_variant_price_7' => 'nullable|numeric|regex:/^\d{1,10}(\.\d{1,2})?$/',
            'update_'.app()->getLocale().'_variant_name_8' => 'nullable|max:255',
            'update_'.app()->getLocale().'_variant_price_8' => 'nullable|numeric|regex:/^\d{1,10}(\.\d{1,2})?$/',
            'update_'.app()->getLocale().'_variant_name_9' => 'nullable|max:255',
            'update_'.app()->getLocale().'_variant_price_9' => 'nullable|numeric|regex:/^\d{1,10}(\.\d{1,2})?$/',
            'update_'.app()->getLocale().'_variant_name_10' => 'nullable|max:255',
            'update_'.app()->getLocale().'_variant_price_10' => 'nullable|numeric|regex:/^\d{1,10}(\.\d{1,2})?$/',
            'update_'.app()->getLocale().'_variant_name_11' => 'nullable|max:255',
            'update_'.app()->getLocale().'_variant_price_11' => 'nullable|numeric|regex:/^\d{1,10}(\.\d{1,2})?$/',
            'update_'.app()->getLocale().'_variant_name_12' => 'nullable|max:255',
            'update_'.app()->getLocale().'_variant_price_12' => 'nullable|numeric|regex:/^\d{1,10}(\.\d{1,2})?$/',
            'update_'.app()->getLocale().'_variant_name_13' => 'nullable|max:255',
            'update_'.app()->getLocale().'_variant_price_13' => 'nullable|numeric|regex:/^\d{1,10}(\.\d{1,2})?$/',
            'update_'.app()->getLocale().'_variant_name_14' => 'nullable|max:255',
            'update_'.app()->getLocale().'_variant_price_14' => 'nullable|numeric|regex:/^\d{1,10}(\.\d{1,2})?$/',
            'update_'.app()->getLocale().'_variant_name_15' => 'nullable|max:255',
            'update_'.app()->getLocale().'_variant_price_15' => 'nullable|numeric|regex:/^\d{1,10}(\.\d{1,2})?$/'
        ];
    }

    public function messages(): array
    {
        return [
            'update_'.app()->getLocale().'_name.required' => 'Ürün adı boş bırakılamaz.',
            'update_'.app()->getLocale().'_name.max' => 'Ürün adı en fazla 255 karakter olmalıdır.',
            'update_categorie_id.required' => 'Kategori boş bırakılamaz.',
            'update_images.*.required' => 'Her bir resim yüklenmelidir.',
            'update_images.*.image' => 'Lütfen geçerli bir resim yükleyiniz.',
            'update_images.*.mimes' => 'Resim formatı yalnızca jpg, jpeg, png, ve gif olabilir.',
            'update_images.*.max' => 'Her bir resim boyutu 2MB\'ı geçmemelidir.',
            'update_'.app()->getLocale().'_price.required' => 'Fiyat boş bırakılamaz.',
            'update_'.app()->getLocale().'_price.numeric' => 'Lütfen geçerli bir fiyat giriniz.',
            'update_'.app()->getLocale().'_price.regex' => 'Lütfen geçerli bir fiyat giriniz.',
            'update_'.app()->getLocale().'_currency.max' => 'Lütfen geçerli bir birim giriniz.',
            'update_'.app()->getLocale().'_variant_name_1.max' => 'Varyant adı en fazla 255 karakter olmalıdır.',
            'update_'.app()->getLocale().'_variant_price_1.required_with' => 'Varyant fiyatı boş bırakılamaz.',
            'update_'.app()->getLocale().'_variant_price_1.numeric' => 'Lütfen geçerli bir varyant fiyatı giriniz.',
            'update_'.app()->getLocale().'_variant_price_1.regex' => 'Lütfen geçerli bir varyant fiyatı giriniz.',
            'update_'.app()->getLocale().'_variant_name_2.max' => 'Varyant adı en fazla 255 karakter olmalıdır.',
            'update_'.app()->getLocale().'_variant_price_2.required_with' => 'Varyant fiyatı boş bırakılamaz.',
            'update_'.app()->getLocale().'_variant_price_2.numeric' => 'Lütfen geçerli bir varyant fiyatı giriniz.',
            'update_'.app()->getLocale().'_variant_price_2.regex' => 'Lütfen geçerli bir varyant fiyatı giriniz.',
            'update_'.app()->getLocale().'_variant_name_3.max' => 'Varyant adı en fazla 255 karakter olmalıdır.',
            'update_'.app()->getLocale().'_variant_price_3.required_with' => 'Varyant fiyatı boş bırakılamaz.',
            'update_'.app()->getLocale().'_variant_price_3.numeric' => 'Lütfen geçerli bir varyant fiyatı giriniz.',
            'update_'.app()->getLocale().'_variant_price_3.regex' => 'Lütfen geçerli bir varyant fiyatı giriniz.',
            'update_'.app()->getLocale().'_variant_name_4.max' => 'Varyant adı en fazla 255 karakter olmalıdır.',
            'update_'.app()->getLocale().'_variant_price_4.required_with' => 'Varyant fiyatı boş bırakılamaz.',
            'update_'.app()->getLocale().'_variant_price_4.numeric' => 'Lütfen geçerli bir varyant fiyatı giriniz.',
            'update_'.app()->getLocale().'_variant_price_4.regex' => 'Lütfen geçerli bir varyant fiyatı giriniz.',
            'update_'.app()->getLocale().'_variant_name_5.max' => 'Varyant adı en fazla 255 karakter olmalıdır.',
            'update_'.app()->getLocale().'_variant_price_5.required_with' => 'Varyant fiyatı boş bırakılamaz.',
            'update_'.app()->getLocale().'_variant_price_5.numeric' => 'Lütfen geçerli bir varyant fiyatı giriniz.',
            'update_'.app()->getLocale().'_variant_price_5.regex' => 'Lütfen geçerli bir varyant fiyatı giriniz.',
            'update_'.app()->getLocale().'_variant_name_6.max' => 'Varyant adı en fazla 255 karakter olmalıdır.',
            'update_'.app()->getLocale().'_variant_price_6.required_with' => 'Varyant fiyatı boş bırakılamaz.',
            'update_'.app()->getLocale().'_variant_price_6.numeric' => 'Lütfen geçerli bir varyant fiyatı giriniz.',
            'update_'.app()->getLocale().'_variant_price_6.regex' => 'Lütfen geçerli bir varyant fiyatı giriniz.',
            'update_'.app()->getLocale().'_variant_name_7.max' => 'Varyant adı en fazla 255 karakter olmalıdır.',
            'update_'.app()->getLocale().'_variant_price_7.required_with' => 'Varyant fiyatı boş bırakılamaz.',
            'update_'.app()->getLocale().'_variant_price_7.numeric' => 'Lütfen geçerli bir varyant fiyatı giriniz.',
            'update_'.app()->getLocale().'_variant_price_7.regex' => 'Lütfen geçerli bir varyant fiyatı giriniz.',
            'update_'.app()->getLocale().'_variant_name_8.max' => 'Varyant adı en fazla 255 karakter olmalıdır.',
            'update_'.app()->getLocale().'_variant_price_8.required_with' => 'Varyant fiyatı boş bırakılamaz.',
            'update_'.app()->getLocale().'_variant_price_8.numeric' => 'Lütfen geçerli bir varyant fiyatı giriniz.',
            'update_'.app()->getLocale().'_variant_price_8.regex' => 'Lütfen geçerli bir varyant fiyatı giriniz.',
            'update_'.app()->getLocale().'_variant_name_9.max' => 'Varyant adı en fazla 255 karakter olmalıdır.',
            'update_'.app()->getLocale().'_variant_price_9.required_with' => 'Varyant fiyatı boş bırakılamaz.',
            'update_'.app()->getLocale().'_variant_price_9.numeric' => 'Lütfen geçerli bir varyant fiyatı giriniz.',
            'update_'.app()->getLocale().'_variant_price_9.regex' => 'Lütfen geçerli bir varyant fiyatı giriniz.',
            'update_'.app()->getLocale().'_variant_name_10.max' => 'Varyant adı en fazla 255 karakter olmalıdır.',
            'update_'.app()->getLocale().'_variant_price_10.required_with' => 'Varyant fiyatı boş bırakılamaz.',
            'update_'.app()->getLocale().'_variant_price_10.numeric' => 'Lütfen geçerli bir varyant fiyatı giriniz.',
            'update_'.app()->getLocale().'_variant_price_10.regex' => 'Lütfen geçerli bir varyant fiyatı giriniz.',
            'update_'.app()->getLocale().'_variant_name_11.max' => 'Varyant adı en fazla 255 karakter olmalıdır.',
            'update_'.app()->getLocale().'_variant_price_11.required_with' => 'Varyant fiyatı boş bırakılamaz.',
            'update_'.app()->getLocale().'_variant_price_11.numeric' => 'Lütfen geçerli bir varyant fiyatı giriniz.',
            'update_'.app()->getLocale().'_variant_price_11.regex' => 'Lütfen geçerli bir varyant fiyatı giriniz.',
            'update_'.app()->getLocale().'_variant_name_12.max' => 'Varyant adı en fazla 255 karakter olmalıdır.',
            'update_'.app()->getLocale().'_variant_price_12.required_with' => 'Varyant fiyatı boş bırakılamaz.',
            'update_'.app()->getLocale().'_variant_price_12.numeric' => 'Lütfen geçerli bir varyant fiyatı giriniz.',
            'update_'.app()->getLocale().'_variant_price_12.regex' => 'Lütfen geçerli bir varyant fiyatı giriniz.',
            'update_'.app()->getLocale().'_variant_name_13.max' => 'Varyant adı en fazla 255 karakter olmalıdır.',
            'update_'.app()->getLocale().'_variant_price_13.required_with' => 'Varyant fiyatı boş bırakılamaz.',
            'update_'.app()->getLocale().'_variant_price_13.numeric' => 'Lütfen geçerli bir varyant fiyatı giriniz.',
            'update_'.app()->getLocale().'_variant_price_13.regex' => 'Lütfen geçerli bir varyant fiyatı giriniz.',
            'update_'.app()->getLocale().'_variant_name_14.max' => 'Varyant adı en fazla 255 karakter olmalıdır.',
            'update_'.app()->getLocale().'_variant_price_14.required_with' => 'Varyant fiyatı boş bırakılamaz.',
            'update_'.app()->getLocale().'_variant_price_14.numeric' => 'Lütfen geçerli bir varyant fiyatı giriniz.',
            'update_'.app()->getLocale().'_variant_price_14.regex' => 'Lütfen geçerli bir varyant fiyatı giriniz.',
            'update_'.app()->getLocale().'_variant_name_15.max' => 'Varyant adı en fazla 255 karakter olmalıdır.',
            'update_'.app()->getLocale().'_variant_price_15.required_with' => 'Varyant fiyatı boş bırakılamaz.',
            'update_'.app()->getLocale().'_variant_price_15.numeric' => 'Lütfen geçerli bir varyant fiyatı giriniz.',
            'update_'.app()->getLocale().'_variant_price_15.regex' => 'Lütfen geçerli bir varyant fiyatı giriniz.'
        ];
    }
}
