<?php

namespace Kuber\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kuber\Http\Requests\SettingsUpdateRequest;
use \App\Repositories\Settings\SettingsRepository;

class SettingsController extends Controller
{
    public function __construct(private SettingsRepository $repository)
    {}

    public function index(Request $request)
    {
        return view('kuber::admin.site.index', ["settings" => $request->settings]);
    }

    public function store(SettingsUpdateRequest $request)
    {
        $this->repository->update($request);

        return to_route('admin.settings.site.index')->withToast_success(__('kuber::admin/site/update.settings_update'));
    }
}
