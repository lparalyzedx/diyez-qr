<?php

namespace App\Http\Requests\auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required'     => 'E-posta adresi boş bırakılamaz.',
            'email.email'        => 'Lütfen geçerli bir e-posta adresi giriniz.',
            'email.exists'       => 'E-posta adresi sistemde kayıtlı değil.',
            'password.required'  => 'Şifre boş bırakılamaz.',
            'password.min'       => 'Şifre en az 6 karakter olabilir.',
            'password.confirmed' => 'Şifreler uyuşmuyor.'

        ];
    }
}
