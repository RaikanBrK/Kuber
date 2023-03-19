<?php

namespace App\Repositories\Admin;

use App\Models\Admin;

interface AdminRepository
{
    public function create($request): Admin;
    public function update($admin, $request): Admin;
    public function delete($id);
}
