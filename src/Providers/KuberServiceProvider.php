<?php
 
namespace Kuber\Providers;

use Illuminate\Support\Facades\Route;
use Kuber\Console\KuberInstallCommand;
use Kuber\Console\KuberDependencyInstallCommand;
use Kuber\Http\Controllers\AdminLoginController;
use Illuminate\Support\ServiceProvider as SupportServiceProvider;

class KuberServiceProvider extends SupportServiceProvider
{
    /**
     * The prefix to use for register/load the package resources.
     *
     * @var string
     */
    protected $prefix = 'kuber';

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        $this->loadViews();
        $this->loadTranslations();
        $this->registerCommands();
        $this->loadRoutes();
    }
    
    private function packagePath($path): string
    {
        return __DIR__."/../../$path";
    }

    private function publish(): void
    {
        $this->publishConfigs();
        $this->publishMigrations();
        $this->publishModels();
    }

    private function publishConfigs(): void
    {
        $this->publishes([
            $this->packagePath('config/auth.php') => config_path('auth.php'),
        ], 'kuber-auth-config');
    }

    private function publishMigrations(): void
    {
        $this->publishes([
            $this->packagePath('database/migrations/') => database_path('migrations')
        ], 'kuber-auth-migrations');
    }

    private function publishModels(): void
    {
        $this->publishes([
            $this->packagePath('src/Models/') => app_path() . '/Models',
        ], 'kuber-auth-models');
    }

    private function loadViews(): void
    {
        $viewsPath = $this->packagePath('resources/views');
        $this->loadViewsFrom($viewsPath, $this->prefix);
    }

    private function loadTranslations(): void
    {
        $translationsPath = $this->packagePath('resources/lang');
        $this->loadTranslationsFrom($translationsPath, $this->prefix);
    }

    private function registerCommands(): void
    {
        $this->commands([
            KuberDependencyInstallCommand::class,
            KuberInstallCommand::class,
        ]);
    }

    private function loadRoutes(): void
    {
        $routesPath = $this->packagePath('routes/web.php');
        $this->loadRoutesFrom($routesPath);
    }    
}