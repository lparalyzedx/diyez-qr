<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\UpdateSettingRequest;
use App\Models\Account;
use App\Models\City;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class CompanyController extends Controller
{
    public function index()
    {
        $cities = City::query()->get();
        $districts = District::query()->get();

        return view('back.pages.company.general',compact('cities','districts'));
    }

    public function update(UpdateSettingRequest $request)
    {
        $account = Account::query()->where('id',Auth::user()->account->id)->firstOrFail();
        $logo = $account->logo;
        $banner_image = $account->banner_image;
        $banner_logo = $account->banner_logo;
        $placeholder_image = $account->placeholder_image;

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $file_name = Str::slug($request->name . uniqid()) . '.' . $file->getClientOriginalExtension();
            Storage::putFileAs('accounts', $file, $file_name);
            $logo = 'accounts/' . $file_name;
        }

        if ($request->hasFile('banner_image')) {
            $file = $request->file('banner_image');
            $file_name = Str::slug($request->name . uniqid()) . '.' . $file->getClientOriginalExtension();
            Storage::putFileAs('accounts', $file, $file_name);
            $banner_image = 'accounts/' . $file_name;
        }

        if ($request->hasFile('banner_logo')) {
            $file = $request->file('banner_logo');
            $file_name = Str::slug($request->name . uniqid()) . '.' . $file->getClientOriginalExtension();
            Storage::putFileAs('accounts', $file, $file_name);
            $banner_logo = 'accounts/' . $file_name;
        }
        
        if ($request->hasFile('placeholder_image')) {
            $file = $request->file('placeholder_image');
            $file_name = Str::slug($request->name . uniqid()) . '.' . $file->getClientOriginalExtension();
            Storage::putFileAs('accounts', $file, $file_name);
            $placeholder_image = 'accounts/' . $file_name;
        }

        $account->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'logo' =>  $logo,
            'banner_image' => $banner_image,
            'banner_logo' => $banner_logo,
            'placeholder_image' => $placeholder_image,
            'city_id' => $request->city_id,
            'district_id' => $request->district_id,
            'adress' => $request->adress,
            'phone' => $request->phone,
            'whatsapp' => $request->whatsapp ?? null,
            'map_url' => $request->map_url ?? null,
            'facebook' => $request->facebook ?? null,
            'instagram' => $request->instagram ?? null,
            'twitter' => $request->twitter ?? null,
            'website' => $request->website ?? null,
        ]);

        return redirect()->back()->with('success', 'Ayarlar başarıyla güncellendi.');
    }

    public function remove_logo()
    {
        $account = Account::query()->where('id',Auth::user()->account->id)->firstOrFail();
        $account->update(['logo' => null]);
        return redirect()->back()->with('success', 'Logo başarıyla kaldırıldı.');
    }
    
    public function remove_banner()
    {
        $account = Account::query()->where('id',Auth::user()->account->id)->firstOrFail();
        $account->update(['banner_image' => null]);
        return redirect()->back()->with('success', 'Banner başarıyla kaldırıldı.');
    }
    
    public function remove_banner_logo()
    {
        $account = Account::query()->where('id',Auth::user()->account->id)->firstOrFail();
        $account->update(['banner_logo' => null]);
        return redirect()->back()->with('success', 'Banner logo başarıyla kaldırıldı.');
    }
    
    
    public function remove_placeholder()
    {
        $account = Account::query()->where('id',Auth::user()->account->id)->firstOrFail();
        $account->update(['placeholder_image' => null]);
        return redirect()->back()->with('success', 'Placeholder başarıyla kaldırıldı.');
    }

    public function district(Request $request)
    {
        $districts = District::where('city_id', $request->id)->get();
        return response()->json([
            'districts' => $districts
        ], 200);
    }
}
