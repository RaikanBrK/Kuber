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

    public function updateProfile($request, $image): Admin
    {
        $admin = $this->model->find(Auth::guard('admin')->id());

        $admin->name = $request->name;
        $admin->email = $request->email;

        if ($request->desc == __(config('kuber.admin_desc_default'))) {
            $admin->description = null;
        } else {
            $admin->description = $request->desc;
        }

        if ($image) {
            $admin->image = $image;
        }

        $admin->save();

        return $admin;
    }
}
