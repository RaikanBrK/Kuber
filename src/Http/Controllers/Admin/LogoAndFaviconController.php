<?php

namespace Kuber\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Settings\SettingsRepository;
use Kuber\Http\Requests\Admin\LogoAndFaviconRequest;

class LogoAndFaviconController extends Controller
{
    public function __construct(private SettingsRepository $repository)
    {}
    
    public function index(Request $request)
    {
        return view('kuber::admin.assets.index', ["settings" => $request->settings]);
    }

    public function store(LogoAndFaviconRequest $request)
    {
        $pathLogo = $request->file('logo') ? $this->updateLogo($request->file('logo')) : false;

        $pathFavicon = $request->file('favicon') ? $this->updateFavicon($request->file('favicon')) : false;

        $this->repository->updateLogoAndFavicon($pathLogo, $pathFavicon);
        
        return to_route('admin.settings.assets.index')->withToast_success(__('kuber::admin/assets/store.updateLogoAndFavicon'));
    }

    protected function imageMake($image)
    {
        return Image::make($image)->encode('webp', 80);
    }

    protected function updateLogo($image)
    {
        $img = $this->imageMake($image);
        $path = 'images/logo.webp';

        Storage::disk('public')->put($path, $img);
        return $path;
    }

    protected function updateFavicon($image)
    {
        $img = $this->imageMake($image);
        $path = 'images/favicon.webp';

        Storage::disk('public')->put($path, $img);
        return $path;
    }
}
