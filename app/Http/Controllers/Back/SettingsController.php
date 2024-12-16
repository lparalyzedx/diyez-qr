<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\SettingUpdateRequest;
use App\Http\Requests\Back\StoreCategoryRequest;
use App\Http\Requests\Back\UpdateCategoryRequest;
use Illuminate\Support\Str;
use App\Models\Categorie;
use App\Models\City;
use App\Models\District;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        $setting = Setting::query()->where('id',1)->first();
        return view('back.pages.setting.index',compact('setting'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function update(SettingUpdateRequest $request)
    {
        $setting = Setting::query()->where('id', 1)->first();

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $exception = $file->getClientOriginalExtension();
            $path = 'uploads';
            $file_name = Str::slug(uniqid() . '-logo') . '.' . $exception;
            Storage::putFileAs($path, $file, $file_name);
            $logo = $path . '/' . $file_name;
            $setting->update([
                'logo' => $logo
            ]);
        }

        if ($request->hasFile('logo_small')){
            $file = $request->file('logo_small');
            $exception = $file->getClientOriginalExtension();
            $path = 'uploads';
            $file_name = Str::slug(uniqid() . '-logo_small') . '.' . $exception;
            Storage::putFileAs($path, $file, $file_name);
            $logo_small = $path . '/' . $file_name;
            $setting->update([
                'logo_small' => $logo_small
            ]);
        }

        $setting->update([
            'site_name' => $request->site_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'address' => $request->address,
            'site_description' => $request->site_description,
            'user_agreement' => $request->user_agreement,
            'privacy_policy' => $request->privacy_policy,
            'cookie_policy' =>  $request->cookie_policy,
            'lighting_text' => $request->lighting_text,
            'version' => $request->version,
            'android_app_id' => $request->android_app_id,
            'ios_app_id' => $request->ios_app_id
        ]);

        return redirect()->back()->with(['profile_success' => 'Sistem Ayarları Başarıyla Güncellendi']);
    }
}
