<?php

namespace App\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
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
            'name' => 'required|max:255|unique:accounts,name,'.auth()->user()->account->id.',id',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,webp,svg',
            'banner_image' => 'nullable|image|mimes:png,jpg,jpeg,webp',
            'banner_logo' => 'nullable|image|mimes:png,jpg,jpeg,webp,svg',
            'placeholder_image' => 'nullable|image|mimes:png,jpg,jpeg,webp,svg',
            'city_id' => 'nullable|exists:cities,id',
            'district_id' => 'nullable|exists:districts,id',
            'phone' => 'nullable|regex:/05[0,3,4,5,6][0-9]\d\d\d\d\d\d\d$/',
            'whatsapp' => 'nullable|regex:/05[0,3,4,5,6][0-9]\d\d\d\d\d\d\d$/',
            'map_url' => 'nullable|active_url|max:255',
            'facebook' => 'nullable|active_url|max:255',
            'instagram' => 'nullable|active_url|max:255',
            'twitter' => 'nullable|active_url|max:255',
            'website' => 'nullable|active_url|max:255',
            'header_color' => 'nullable|max:255',
            'body_color' => 'nullable|max:255',
            'text_color' => 'nullable|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Firma ünvanı boş bırakılamaz.',
            'name.max' => 'Firma ünvanı en fazla 255 karakter olmalıdır.',
            'name.unique' => 'Firma ünvanı kullanılıyor.',
            'logo.image' => 'Lütfen geçerli bir resim yükleyiniz.',
            'logo.mimes' => 'Logo sadece .jpg, .jpeg, .png, .svg veya .webp türünde olmalıdır.',
            'banner_image.image' => 'Lütfen geçerli bir resim yükleyiniz.',
            'banner_image.mimes' => 'Banner resmi sadece .jpg, .jpeg, .png veya .webp türünde olmalıdır.',
            'banner_logo.image' => 'Lütfen geçerli bir resim yükleyiniz.',
            'banner_logo.mimes' => 'Logo sadece .jpg, .jpeg, .png, .svg veya .webp türünde olmalıdır.',
            'placeholder_image.image' => 'Lütfen geçerli bir resim yükleyiniz.',
            'placeholder_image.mimes' => 'Resim dosyası sadece .jpg, .jpeg, .png veya .webp türünde olmalıdır.',
            'city_id.exists' => 'İl bulunamadı.',
            'district_id.exists' => 'İlçe bulunamadı.',
            'phone.regex' => 'Lütfen geçerli bir telefon giriniz.',
            'facebook.active_url' => 'Lütfen geçerli bir url giriniz.',
            'facebook.max' => 'Lütfen geçerli bir url giriniz.',
            'instagram.active_url' => 'Lütfen geçerli bir url giriniz.',
            'instagram.max' => 'Lütfen geçerli bir url giriniz.',
            'twitter.active_url' => 'Lütfen geçerli bir url giriniz.',
            'twitter.max' => 'Lütfen geçerli bir url giriniz.',
            'website.active_url' => 'Lütfen geçerli bir url giriniz.',
            'website.max' => 'Website adresi en fazla 255 karakter olmalıdır.',
            'header_color.max' => 'Header rengi en fazla 255 karakter olmalıdır.',
            'body_color.max' => 'Body rengi en fazla 255 karakter olmalıdır.',
            'text_color.max' => 'Yazı rengi en fazla 255 karakter olmalıdır.'
         ];
    }
}
