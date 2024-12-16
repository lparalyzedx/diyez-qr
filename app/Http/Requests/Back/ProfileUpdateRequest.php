<?php

namespace App\Http\Requests\Back;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'profile_img' => 'nullable|image|mimes:png,jpg,jpeg',
            'name' => 'required|max:255',
            'phone' => 'required|regex:/05[0,3,4,5,6][0-9]\d\d\d\d\d\d\d$/|unique:users,phone,'.Auth::user()->id.',id'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Ad Soyad boş bırakılamaz.',
            'name.max' => 'Ad Soyad en fazla 255 karakter olmalıdır.',
            'phone.required' => 'Telefon numarası boş bırakılamaz.',
            'phone.regex' => 'Lütfen geçerli bir telefon numarası giriniz.',
            'phone.unique' => 'Telefon numarası sistemde kayıtlı.'
        ];
    }
}
