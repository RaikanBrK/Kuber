<?php

namespace Kuber\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Admin\AdminRepository;
use Kuber\Http\Requests\Admin\AdminProfileUpdateRequest;

class AdministratorProfileController extends Controller
{
    public function __construct(private AdminRepository $repository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $administrator = Auth::guard('admin')->user();

        return view('kuber::admin.profile.index', compact('administrator'));
    }

    public function store(AdminProfileUpdateRequest $request)
    {
        $this->repository->updateProfile($request);

        return to_route('admin.profile.index');
    }    
}
