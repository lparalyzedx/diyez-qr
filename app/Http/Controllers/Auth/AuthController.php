<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\auth\LoginRequest;
use App\Http\Requests\auth\RegisterRequest;
use App\Models\Account;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
     
     public function login(LoginRequest $request)
    {
        $user = User::query()->where('email',$request->email)->first();
        
        if(!$user->account || $user->account->status)
        {
               if(Auth::attempt(['email'=> $request->email,'password'=>$request->password]))
                {
                    return redirect()->route('dashboard');
                }
        }else{
            return redirect()->back()->withErrors(['password' => 'Hesabınız devre dışı bırakılmıştır. Lütfen daha sonra tekrar deneyiniz veya altyapı sağlayıcınız ile İletişime geçiniz.'])->withInput();
        }
        
        return redirect()->back()->withErrors(['password' => 'Hatalı şifre! lütfen tekrar deneyiniz.'])->withInput();
    }
    
    
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function register()
    {
        $setting = Setting::query()->where('id',1)->first();
        return view('auth.register',compact('setting'));
    }

    public function register_post(RegisterRequest $request)
    {
        $user = User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password)
        ]);
        
        Account::query()->create([
            'name' => $request->company_name,
            'slug' => Str::slug($request->company_name),
            'owner_id' => $user->id,
            'terminate_at'=> now()->addDay(14)
        ]);


        $user->syncRoles('superadmin');

        
        $user->update(['last_activity' => now()]);
        Auth::login($user);
        

        return redirect()->route('dashboard');
    }
    
    
    public function generateToken($userId)
    {
       $payload = [
          'user_id' => $userId,
          'expires_at' => Carbon::now()->addMinutes(30)->timestamp
       ];

        $token = Crypt::encrypt($payload);
        
        return response()->json(['token' => $token]);
    }
    
    public function loginWithToken(Request $request)
    {
        $token = $request->query('token');

        try {
            $payload = Crypt::decrypt($token);

            if (Carbon::now()->timestamp > $payload['expires_at']) {
                return response('Token süresi dolmuş', 401);
            }
             $user = User::findOrFail($payload['user_id']);
             Auth::login($user);
             return redirect()->route('dashboard');
        } catch (\Exception $e) {
             return response('Token geçersiz', 401);
    }
    }

}
