<?php

namespace App\Repositories\Admin;

use App\Models\Admin;

interface AdminRepository
{
    public function create($request): Admin;
    public function update($id, $request, $imagePath = false): Admin;
    public function delete($id);
}
