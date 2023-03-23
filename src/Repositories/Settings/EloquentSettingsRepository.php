<?php

namespace App\Repositories\Settings;

use App\Models\Settings;
use Illuminate\Support\Facades\Hash;

class EloquentSettingsRepository implements SettingsRepository
{
    protected $model;

    protected Settings $settings;

    private $settingsId = 1;

    public function __construct(Settings $model)
    {
        $this->model = $model;
        $this->settings = $this->model->find($this->settingsId);
    }

    public function update($request): Settings
    {
        $this->settings->update([
            'title' => $request->title,
            'description' => $request->description
        ]);
        return $this->settings;
    }
}
