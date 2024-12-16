<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVariantRequest extends FormRequest
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
            'update_size' => 'required|max:255',
            'update_price' => 'required|numeric|regex:/^\d{1,10}(\.\d{1,2})?$/',
        ];
    }

    public function messages(): array
    {
        return [
            'update_size.required' => 'Varyant adı boş bırakılamaz.',
            'update_size.max' => 'Varyant adı en fazla 255 karakter olmalıdır.',
            'update_price.required' => 'Fiyat boş bırakılamaz.',
            'update_price.numeric' => 'Lütfen geçerli bir fiyat giriniz.',
            'update_price.regex' => 'Lütfen geçerli bir fiyat giriniz.',
        ];
    }
}
