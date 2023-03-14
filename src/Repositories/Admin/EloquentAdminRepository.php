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

    public function update($id, $request, $imagePath = false): Admin
    {
        $user = Admin::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender_id = $request->gender;
        
        if($user->desc() != $request->desc) {
            $user->description = $request->desc;
        }

        if ($request->checkBoxChangePassword) {
            $user->password = Hash::make($request->password);
        }

        if ($imagePath) {
            $user->image = $imagePath;
        }

        $user->save();
        
        return $user;
    }

    public function delete($id)
    {
        $user = Admin::find($id);
        
        $user->delete();
    }
}
