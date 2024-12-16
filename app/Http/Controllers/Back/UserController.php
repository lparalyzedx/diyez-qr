<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\Back\StoreUserRequest;
use App\Http\Requests\Back\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()->account()->orderBy('id','desc')->get();
        $modals = ['create' => ['name', 'email', 'phone', 'password'], 'edit' => ['update_name', 'update_email', 'update_phone', 'update_password', 'update_admin']];
        return view('back.pages.users.index', compact('users', 'modals'));
    }

    public function store(StoreUserRequest $request)
    {
        $account = Auth::user()->account;

        $user = User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'account_id' => $account->id,
        ]);

        if ($request->admin) {
            $user->syncRoles('superadmin');
        }else
        {
            $user->syncRoles('admin');
        }

       
        return redirect()->back()->with(['success' => 'Kullanıcı başarıyla eklendi.']);
    }
    


    public function update(UpdateUserRequest $request, string $id)
    {
        $user = User::query()->account()->where('id', $id)->firstOrFail();

        $user->update([
            'name' => $request->update_name,
            'email' => $request->update_email,
            'phone' => $request->update_phone,
            'password' => $request->update_password ? bcrypt($request->update_password) : $user->password
        ]);

        if($request->update_admin)
        {
            $user->removeRole('admin');
            $user->syncRoles('superadmin');
        }else{
            $user->removeRole('admin');
            $user->syncRoles('superadmin');
        }

        return redirect()->back()->with(['success' => 'Kullanıcı başarıyla güncellendi.']);
    }

    public function show(string $id)
    {
        $user = User::query()->account()->where('id', $id)->with('roles')->firstOrFail();

        return response()->json([
            'user' => $user
        ], 200);
    }

    public function destroy(string $id)
    {
        $user = User::query()->account()->where('id', $id)->firstOrFail();
        $user->delete();

        return redirect()->back()->with(['success' => 'Kullanıcı başarıyla silindi.']);
    }
}
