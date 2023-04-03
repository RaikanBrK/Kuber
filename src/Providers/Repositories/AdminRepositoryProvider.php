<?php

namespace Kuber\Providers\Repositories;

use App\Repositories\Admin\AdminRepository;
use App\Repositories\Admin\EloquentAdminRepository;
use Illuminate\Support\ServiceProvider;

class AdminRepositoryProvider extends ServiceProvider
{
    public array $bindings = [
        AdminRepository::class => EloquentAdminRepository::class
    ];
}
