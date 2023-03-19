<?php

namespace App\Repositories\Admin;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Admin\AdminRepository;

class EloquentAdminRepository implements AdminRepository
{
    public function create($request): Admin
    {
        return Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    }

    public function update($admin, $request): Admin
    {
        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return $admin;
    }

    public function delete($id)
    {
        $user = Admin::find($id);
        
        $user->delete();
    }
}
