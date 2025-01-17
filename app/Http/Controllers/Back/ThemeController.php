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
            'text_color' => $request->text_color,
            'call_button_color' => $request->call_button_color,
            'whatsapp_button_color' => $request->whatsapp_button_color,
            'map_button_color' => $request->map_button_color,
            'logo_width' => $request->logo_width,
            'category_logo_width' => $request->category_logo_width
        ]);

        return redirect()->back()->with('success', 'Ayarlar başarıyla güncellendi.');
    }
}
