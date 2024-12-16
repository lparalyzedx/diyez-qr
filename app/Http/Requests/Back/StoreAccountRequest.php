<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;

class StoreAccountRequest extends FormRequest
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
            'company_name' => 'required|max:255|unique:accounts,name',
            'email' => 'required|email|unique:users,email|max:255',
            'phone' => 'required|regex:/05[0,3,4,5,6][0-9]\d\d\d\d\d\d\d$/|unique:users,phone',
            'password' => 'required|min:8|max:255|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Ad soyad boş bırakılamaz.',
            'name.max' => 'Ad soyad en fazla 255 karakter olmalıdır.',
            'company_name.required' => 'Firma ünvanı boş bırakılamaz.',
            'company_name.max' => 'Firma ünvanı en fazla 255 karakter olmalıdır.',
            'company_name.unique' => 'Firma ünvanı benzersiz olmalıdır.',
            'email.required' => 'E-posta adresi boş bırakılamaz.',
            'email.email' => 'Lütfen geçerli bir e-posta adresi giriniz.',
            'email.unique' => 'E-posta adresi sistemde kayıtlı.',
            'email.max' => 'E-posta adresi en fazla 255 karakter olmalıdır.',
            'email.regex' => 'Lütfen geçerli bir e-posta adresi giriniz.',
            'phone.required' => 'GSM numarası boş bırakılamaz.',
            'phone.regex' => 'Lütfen geçerli bir gsm numarası giriniz.',
            'phone.unique' => 'Telefon numarası sistemde kayıtlı.',
            'password.required' => 'Parola boş bırakılamaz.',
            'password.min' => 'Parola en az 8 karakter olmalıdır.',
            'password.max' => 'Parola en falza 255 karakter olmalıdır.',
            'password.confirmed' => 'Parolalar uyuşmuyor.'
        ];
    }
}
