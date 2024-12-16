<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\UpdateThemeSettingRequest;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThemeController extends Controller
{
    public function index()
    {
        return view('back.pages.company.theme');
    }

    public function update(UpdateThemeSettingRequest $request)
    {
        $account = Account::query()->where( 'id',Auth::user()->account->id)->firstOrFail();

        $account->update([
            'header_color' => $request->header_color,
            'body_color' => $request->body_color,
            'text_color' => $request->text_color
        ]);

        return redirect()->back()->with('success', 'Ayarlar başarıyla güncellendi.');
    }
}
