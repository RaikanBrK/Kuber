<?php

namespace App\Repositories\Admin;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EloquentAdminRepository implements AdminRepository
{
    protected $model;

    public function __construct(Admin $model)
    {
        $this->model = $model;
    }

    public function create($request): Admin
    {
        return $this->model->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    }

    public function update(Admin $admin, $request): Admin
    {
        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return $admin;
    }

    public function delete($admin): Array
    {
        $array = $admin->toArray();
        
        $admin->delete();

        return $array;
    }

    public function updateProfile($request): Admin
    {
        $admin = $this->model->find(Auth::guard('admin')->id());

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'description' => $request->desc,
        ]);

        return $admin;
    }
}
