<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Locale;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function index(string $locale, string $accountSlug)
    {
        $account = Account::query()->where('slug',$accountSlug)->firstOrFail();
        $langs = Locale::query()->where('account_id',$account->id)->pluck('language_code')->toArray();

        if (in_array($locale, $langs)) {
            Session::put('locale', $locale);
        } else {
            Session::put('locale', 'tr');
        }

        $previousRouteName = optional(Route::getRoutes()->match(app('request')->create(url()->previous())))->getName();


        if ($previousRouteName === 'index') {
            return redirect()->route('menu',$accountSlug);
        }

        return redirect()->back();
    }
}
