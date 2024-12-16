<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;

class SettingUpdateRequest extends FormRequest
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
            'site_name' => 'required|string|max:255',
            'site_description' => 'nullable|string|max:500',
            'logo' => 'nullable|image|max:2048',
            'logo_small' => 'nullable|image|max:2048',
            'email' => 'nullable|email|max:255',
            'facebook' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'address' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:20',
            'user_agreement' => 'nullable|string',
            'lighting_text' => 'nullable|string',
            'privacy_policy' => 'nullable|string',
            'cookie_policy' => 'nullable|string',
        ];
    }


    public function messages(): array
    {
        return [
            'site_name.required' => 'Site adı alanı boş bırakılamaz.',
            'site_name.string' => 'Site adı alanı yalnızca metin içerebilir.',
            'site_name.max' => 'Site adı alanı en fazla 255 karakter olmalıdır.',
            'site_description.max' => 'Site açıklama alanı en fazla 500 karakter olmalıdır.',
            'logo.image' => 'Logo alanı bir resim dosyası olmalıdır.',
            'logo.max' => 'Logo alanı en fazla 2MB boyutunda olabilir.',
            'logo_small.image' => 'Küçük logo alanı bir resim dosyası olmalıdır.',
            'logo_small.max' => 'Küçük logo alanı en fazla 2MB boyutunda olabilir.',
            'email.email' => 'Geçersiz e-posta adresi formatı.',
            'email.max' => 'E-posta adresi en fazla 255 karakter olmalıdır.',
            'github.url' => 'Geçersiz Github URL formatı.',
            'github.max' => 'Github URL\'si en fazla 255 karakter olmalıdır.',
            'twitter.url' => 'Geçersiz Twitter URL formatı.',
            'twitter.max' => 'Twitter URL\'si en fazla 255 karakter olmalıdır.',
            'address.max' => 'Adres alanı en fazla 500 karakter olmalıdır.',
            'phone.max' => 'Telefon numarası en fazla 20 karakter olmalıdır.',
            'user_agreement.string' => 'Kullanıcı sözleşmesi yalnızca metin içerebilir.',
            'lighting_text.string' => 'Aydınlatma metni yalnızca metin içerebilir.',
            'privacy_policy.string' => 'Gizlilik politikası yalnızca metin içerebilir.',
            'cookie_policy.string' => 'Çerez politikası yalnızca metin içerebilir.',
        ];
    }
}
