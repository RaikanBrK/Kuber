<?php

namespace App\Repositories\Settings;

use App\Models\Settings;

interface SettingsRepository
{
    public function update($request): Settings;
}
