<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateLocaleRequest extends FormRequest
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
            'update_name' => 'required|max:255',
            'update_language_code' => [
                'required',
                'string', 
                'size:2', 
                'lowercase',
                Rule::in([
                    'tr', 'en', 'fr', 'de', 'es', 'it', 
                    'ru', 'ar', 'zh', 'ja', 'ko','pt'
                ])
            ],
            'update_flag' => 'nullable|image|mimes:png,jpg,jpeg'
        ];
    }

    public function messages(): array
    {
        return [
            'update_name.required' => 'Dil adı boş bırakılamaz.',
            'update_name.max' => 'Dil adı en fazla 255 karakter olmalıdır.',
            'update_language_code.required' => 'Dil kodu boş bırakılamaz.',
            'update_language_code.string' => 'Lütfen geçerli bir dil kodu giriniz.',
            'update_language_code.size' => 'Dil kodu 2 karakterden oluşmalıdır.',
            'update_language_code.in' => 'Lütfem geçerli bir dil kodu giriniz.',
            'update_flag.required' => 'Bayrak boş bırakılamaz.',
            'update_flag.image' => 'Lütfen geçerli bir resim yükleyiniz.',
            'update_flag.mimes' => 'Resim dosyası yalnızca jpeg, jpg, png formatında olmalıdır.'
        ];
    }
}
