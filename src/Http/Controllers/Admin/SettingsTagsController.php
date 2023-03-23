<?php

namespace Kuber\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Repositories\Settings\SettingsRepository;
use Kuber\Http\Requests\Admin\AdminTagsUpdateRequest;

class SettingsTagsController extends Controller
{
    public function __construct(private SettingsRepository $repository)
    {}

    public function index(Request $request)
    {
        return view('kuber::admin.tags.index', ["settings" => $request->settings]);
    }

    public function store(AdminTagsUpdateRequest $request)
    {
        $this->repository->updateTags($request);

        return to_route('admin.settings.tags.index')->withToast_success(__('kuber::admin/tags/update.tags_update'));
    }
}
