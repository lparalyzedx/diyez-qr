<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\auth\ResetPasswordRequest;
use App\Notifications\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;

class ResetPasswordController extends Controller
{
    public function forgot()
    {
        return view('auth.reset');
    }

    public function forgot_post(Request $request)
    {
        $request->validate(
            ['email' => 'required|exists:users,email'],
            [
                'email.required' => 'E-posta adresi boş bırakılamaz.',
                'email.exists' => 'E-posta adresi sistemde kayıtlı değil.'
            ]
        );

        $email = $request->only('email');

        $status = Password::sendResetLink(
            $email
        );

        return $status === Password::RESET_LINK_SENT
            ?  redirect()->back()->with(['success' => 'BŞA'])->withInput()
            : back()->withErrors(['email' => __($status)]);
    }

    public function reset_request($token)
    {
        return view('auth.new-password', ['token' => $token]);
    }

    public function reset(ResetPasswordRequest $request)
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ]);

                $user->save();
                
                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]])->withInput();
    }

    public function password_send($email)
    {
        $user = User::where('email', $email)->first() ?? abort(404);
        return redirect()->back()->withInput();
    }
}
