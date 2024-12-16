<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;

class StoreVariantRequest extends FormRequest
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
            'size' => 'required|max:255',
            'price' => 'required|numeric|regex:/^\d{1,10}(\.\d{1,2})?$/',
        ];
    }

    public function messages(): array
    {
        return [
            'size.required' => 'Varyant adı boş bırakılamaz.',
            'size.max' => 'Varyant adı en fazla 255 karakter olmalıdır.',
            'price.required' => 'Fiyat boş bırakılamaz.',
            'price.numeric' => 'Lütfen geçerli bir fiyat giriniz.',
            'price.regex' => 'Lütfen geçerli bir fiyat giriniz.',
        ];
    }
}
