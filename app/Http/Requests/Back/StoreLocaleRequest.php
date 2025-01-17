<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreLocaleRequest extends FormRequest
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
            'name' => 'required|max:255',
            'language_code' => [
                'required',
                'string', 
                'size:2', 
                'lowercase',
                Rule::in([
                    'tr', 'en', 'fr', 'de', 'es', 'it', 
                    'ru', 'ar', 'zh', 'ja', 'ko','pt'
                ])
            ],
            'flag' => 'required|image|mimes:png,jpg,jpeg'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Dil adı boş bırakılamaz.',
            'name.max' => 'Dil adı en fazla 255 karakter olmalıdır.',
            'language_code.required' => 'Dil kodu boş bırakılamaz.',
            'language_code.string' => 'Lütfen geçerli bir dil kodu giriniz.',
            'language_code.size' => 'Dil kodu 2 karakterden oluşmalıdır.',
            'language_code.in' => 'Lütfem geçerli bir dil kodu giriniz.',
            'flag.required' => 'Bayrak boş bırakılamaz.',
            'flag.image' => 'Lütfen geçerli bir resim yükleyiniz.',
            'flag.mimes' => 'Resim dosyası yalnızca jpeg, jpg, png formatında olmalıdır.'
        ];
    }
}
