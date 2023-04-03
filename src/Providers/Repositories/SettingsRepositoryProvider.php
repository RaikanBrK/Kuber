<?php

namespace Kuber\Providers\Repositories;

use App\Repositories\Settings\EloquentSettingsRepository;
use App\Repositories\Settings\SettingsRepository;
use Illuminate\Support\ServiceProvider;

class SettingsRepositoryProvider extends ServiceProvider
{
    public array $bindings = [
        SettingsRepository::class => EloquentSettingsRepository::class,
    ];
}
