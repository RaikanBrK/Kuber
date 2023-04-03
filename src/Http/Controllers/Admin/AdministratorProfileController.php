<?php

namespace Kuber\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
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
        $image = $request->file('image') != null 
            ? $this->newImgProfile($request->file('image'))
            : false;

        $this->repository->updateProfile($request, $image);

        return to_route('admin.profile.index')->withToast_success(__('kuber::admin/profile/store.updateProfile'));
    }

    private function newImgProfile($image)
    {
        $img = Image::make($image)
        ->fit(205)
        ->encode('webp',80);

        $filename = uniqid() . Str::random(20) . '.webp';
        $path = "admins/avatar/";

        $nameImg = $path . $filename;
        $validation = Storage::disk('public')->put($nameImg, $img);

        $imageUser = Auth::guard('admin')->user()->image;
        if ($imageUser) {
            Storage::disk('public')->delete($imageUser);
        }

        return $validation ? $nameImg : $validation;
    }
}
