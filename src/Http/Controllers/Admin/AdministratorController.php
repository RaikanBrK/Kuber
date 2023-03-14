<?php

namespace Kuber\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\AdminRepository;
use Kuber\Http\Requests\Admin\AdminCreateRequest;

class AdministratorController extends Controller
{
    public function __construct(private AdminRepository $repository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = Admin::all();
        $head = ['id', 'name', 'email', 'created_at', 'updated_at'];

        return view('kuber::admin.administrators.index', compact('users', 'head'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kuber::admin.administrators.create');
    }

    public function store(AdminCreateRequest $request)
    {
        $this->repository->create($request);

        return to_route('admin.administrators.create')->withSuccess(__('admin/administrators/create.user_create'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
