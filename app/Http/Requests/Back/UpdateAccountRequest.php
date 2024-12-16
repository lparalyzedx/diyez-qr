<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountRequest extends FormRequest
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
            'update_company_name' => 'required|max:255|unique:accounts,name,'.$this->company_id.',id',
            'update_email' => 'required|email|max:255|unique:users,email,'.$this->id.',id',
            'update_phone' => 'required|regex:/05[0,3,4,5,6][0-9]\d\d\d\d\d\d\d$/|unique:users,phone,'.$this->id.',id',
            'update_password' => 'nullable|min:8|max:255|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'update_name.required' => 'Ad soyad boş bırakılamaz.',
            'update_name.max' => 'Ad soyad en fazla 255 karakter olmalıdır.',
            'update_company_name.required' => 'Firma ünvanı boş bırakılamaz.',
            'update_company_name.max' => 'Firma ünvanı en fazla 255 karakter olmalıdır.',
            'update_company_name.unique' => 'Firma ünvanı benzersiz olmalıdır.',
            'update_email.required' => 'E-posta adresi boş bırakılamaz.',
            'update_email.email' => 'Lütfen geçerli bir e-posta adresi giriniz.',
            'update_email.unique' => 'E-posta adresi sistemde kayıtlı.',
            'update_email.max' => 'E-posta adresi en fazla 255 karakter olmalıdır.',
            'update_email.regex' => 'Lütfen geçerli bir e-posta adresi giriniz.',
            'update_phone.required' => 'GSM numarası boş bırakılamaz.',
            'update_phone.regex' => 'Lütfen geçerli bir gsm numarası giriniz.',
            'update_phone.unique' => 'Telefon numarası sistemde kayıtlı.',
            'update_password.required' => 'Parola boş bırakılamaz.',
            'update_password.min' => 'Parola en az 8 karakter olmalıdır.',
            'update_password.max' => 'Parola en falza 255 karakter olmalıdır.',
            'update_password.confirmed' => 'Parolalar uyuşmuyor.'
        ];
    }
}
