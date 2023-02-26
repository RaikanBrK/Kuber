<?php
 
namespace Kuber\Providers;

use Illuminate\Support\Facades\Route;
use Kuber\Console\KuberDependencyInstallCommand;
use Illuminate\Support\ServiceProvider as SupportServiceProvider;

class ServiceProvider extends SupportServiceProvider
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

    private function packagePath($path)
    {
        return __DIR__."/../../$path";
    }

    private function loadViews(): void
    {
        $viewsPath = $this->packagePath('resources/views');
        $this->loadViewsFrom($viewsPath, $this->prefix);
    }

    public function loadTranslations(): void
    {
        $translationsPath = $this->packagePath('resources/lang');
        $this->loadTranslationsFrom($translationsPath, $this->prefix);
    }

    public function registerCommands(): void
    {
        $this->commands([
            KuberDependencyInstallCommand::class,
        ]);
    }

    public function loadRoutes(): void
    {
        $routesPath = $this->packagePath('routes/web.php');
        $this->loadRoutesFrom($routesPath);
    }

    
}