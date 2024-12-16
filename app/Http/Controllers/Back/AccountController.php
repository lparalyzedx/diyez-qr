<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\StoreAccountRequest;
use App\Http\Requests\Back\UpdateAccountRequest;
use App\Models\Account;
use App\Models\User;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    public function index()
    {
        $modals = ['create' => ['company_name','name', 'email', 'phone', 'password'], 'edit' => ['update_company_name','update_name', 'update_email', 'update_phone', 'update_password', 'update_admin']];
        $accounts = Account::query()->get();
        return view('back.pages.accounts.index', compact('accounts','modals'));
    }

    public function store(StoreAccountRequest $request)
    {
        $user = User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password)
        ]);
        
        $account = Account::query()->create([
            'name' => $request->company_name,
            'slug' => Str::slug($request->company_name),
            'owner_id' => $user->id,
            'terminate_at'=> now()->addDay(14)
        ]);

        $user->syncRoles('superadmin');
        $user->update(['last_activity' => now()]);

        return redirect()->back()->with('success','Kullanıcı başarıyla eklendi.');
    }

    public function show(string $id)
    {
        $account = Account::query()->where('id',$id)->with('owner')->first();

        return response()->json([
            'account' => $account
        ],200);
    }

    public function update(UpdateAccountRequest $request, string $id)
    {
        $account = Account::query()->where('id',$id)->firstOrFail();
        $user = User::query()->where('id',$account->owner_id)->firstOrFail();

        $account->update([
            'name' => $request->update_company_name,
            'slug' => Str::slug($request->update_company_name),
        ]);

        $user->update([
            'name' => $request->update_name,
            'email' => $request->update_email,
            'phone' => $request->update_phone,
            'password' => $request->update_password ? bcrypt($request->update_password) : $user->password
        ]);

        return redirect()->back()->with('success','Kullanıcı başarıyla güncellendi.');
    }
    
    public function updateStatus(string $id)
    {

        $account = Account::query()->findOrFail($id);
        $account->status = request()->input('status');
        $account->save();

        return response()->json([
            'success' => true,
            'message' => 'Hesap durumu başarıyla güncellendi.'
        ]);
    }

    public function destroy(string $id)
    {
        $account = Account::query()->where('id',$id)->firstOrFail();
        $account->delete();

        return redirect()->back()->with('success','Kullanıcı başarıyla silindi.');
    }
}
