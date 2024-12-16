<?php

namespace App\Http\Controllers\Back;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\Back\EmailUpdateRequest;
use App\Http\Requests\Back\ProfileUpdateRequest;
use App\Http\Requests\Back\PasswordUpdateRequest;

class ProfileController extends Controller
{
  public function index()
  {
    return view('back.pages.profile.index');
  }

  public function profile_update(ProfileUpdateRequest $request)
  {

    $id = $request->user()->id;
    $user = User::whereId($id)->first();
    $image = $user->profile_image ?? false;

    if ($request->file('profile_image')) {
      if ($image) {
        if (Storage::exists($image)) {
          Storage::delete($image);
        }
      }
      $file = $request->file('profile_image');
      $path = 'profiles/' . Str::slug($request->user()->account->name ?? 'root');
      $image_name = Str::slug($request->name, '-') . '-' . now()->format('Y-m-d_h-i-s') . '.' . $file->getClientOriginalExtension();
      Storage::putFileAs($path, $file, $image_name);
      $image = $path . '/' . $image_name;
    }

    $user->update([
      'name' => $request->name,
      'phone' => $request->phone,
      'profile_image' => $image
    ]);


    return redirect()->back()->with(['profile_success' => 'Profil Başarıyla Güncellendi']);
  }

  public function email_update(EmailUpdateRequest $request)
  {
    $id = $request->user()->id;
    $user = User::query()->where('id', $id)->first();
    if (Hash::check($request->confirmemailpassword, $user->password)) {
      $user->update(['email' => $request->email]);
      return redirect()->back()->with(['email_success' => 'E-posta Adresi Başarıyla Güncellendi']);
    }

    return redirect()->back()->withErrors(['confirmemailpassword' => 'Yanlış parola lütfen tekrar deneyiniz.'])->withInput();
  }

  public function password_update(PasswordUpdateRequest $request)
  {
    $id = $request->user()->id;
    $user = User::query()->where('id', $id)->first();
    if (Hash::check($request->currentpassword, $user->password)) {
      $user->update(['password' => bcrypt($request->password)]);
      $token = Password::broker()->createToken($user);
      // Send a custom notification to the user
      return redirect()->back()->with(['password_success' => 'Parola Başarıyla Güncellendi.']);
    }
    return redirect()->back()->with(['currentpassword' => 'Yanlış parola.']);
  }

}
