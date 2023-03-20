<?php

namespace App\Repositories\Admin;

use App\Models\Admin;

interface AdminRepository
{
    public function create($request): Admin;
    public function update(Admin $admin, $request): Admin;
    public function delete(Admin $admin): Array;
}
