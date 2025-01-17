<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\StoreLocaleRequest;
use App\Http\Requests\Back\UpdateLocaleRequest;
use App\Models\Locale;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class LocaleController extends Controller
{
    public function index()
    {
        $locales = Locale::query()->account()->orderBy('id','desc')->get();
        $modals = ['create' => ['name', 'language_code', 'flag', 'is_default','status'], 'edit' => ['update_name', 'update_language_code', 'update_flag', 'update_is_default','update_status']];
        return view('back.pages.locales.index', compact('locales', 'modals'));
    }

    public function store(StoreLocaleRequest $request)
    {
        $account = Auth::user()->account;
        $locale = Locale::query()->account()->where('language_code',$request->language_code)->first();

        if($locale)
        {
            return redirect()->back()->withErrors(['language_code' => 'Dil desteği zaten mevcut.'])->withInput();
        }



        $flag = null;

        if ($request->hasFile('flag')) {
            $file = $request->file('flag');
            $file_name = Str::slug($request->language_code . uniqid()) . '.' . $file->getClientOriginalExtension();
            Storage::putFileAs('locales', $file, $file_name);
            $flag = 'locales/' . $file_name;
        }

        Locale::query()->create([
            'name' => $request->name,
            'language_code' => $request->language_code,
            'flag' => $flag,
            'is_default' => $request->is_default ? true : false,
            'status' => $request->status ? true : false,
            'account_id' => $account->id
        ]);

       
        return redirect()->back()->with(['success' => 'Dil desteği başarıyla eklendi.']);
    }
    


    public function update(UpdateLocaleRequest $request, string $id)
    {
        $locale = Locale::query()->account()->where('id', $id)->firstOrFail();
        $otherLocale = Locale::query()->account()->whereNot('id',$locale->id)->where('language_code',$request->update_language_code)->first();


        if($otherLocale)
        {
            return redirect()->back()->withErrors(['language_code' => 'Dil desteği zaten mevcut.'])->withInput();
        }

        $flag = $locale->flag;

        if ($request->hasFile('update_flag')) {
            $file = $request->file('update_flag');
            $file_name = Str::slug($request->update_language_code . uniqid()) . '.' . $file->getClientOriginalExtension();
            Storage::putFileAs('locales', $file, $file_name);
            $flag = 'locales/' . $file_name;
        }

        $status = $locale->is_default || ($request->update_status ? true : false);

        $locale->update([
            'name' => $request->update_name,
            'language_code' => $request->update_language_code,
            'flag' => $flag,
            'status' => $status
        ]);


        return redirect()->back()->with(['success' => 'Dil desteği başarıyla güncellendi.']);
    }

    public function show(string $id)
    {
        $locale = Locale::query()->account()->where('id', $id)->firstOrFail();

        return response()->json([
            'locale' => $locale
        ], 200);
    }

    public function destroy(string $id)
    {
        $locale = Locale::query()->account()->where('id', $id)->firstOrFail();

        if($locale->is_default)
        {
          return redirect()->back()->withErrors(['warning' => 'Varsayılan dil silinemez.']);
        }

        if(app()->getLocale() == $locale->language_code)
        {
            Session::put('locale', 'tr');
        }

        $locale->delete();

        return redirect()->back()->with(['success' => 'Dil desteği başarıyla silindi.']);
    }
}
