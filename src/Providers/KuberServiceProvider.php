<?php
 
namespace Kuber\Providers;

use Illuminate\Support\Facades\Route;
use Kuber\Console\KuberInstallCommand;
use Kuber\Console\KuberDependencyInstallCommand;
use Kuber\Http\Controllers\AdminLoginController;
use Illuminate\Support\ServiceProvider as SupportServiceProvider;
use Kuber\View\Components\Form;
use Kuber\View\Components\Alerts;

class KuberServiceProvider extends SupportServiceProvider
{
    /**
     * The prefix to use for register/load the package resources.
     *
     * @var string
     */
    protected $prefix = 'kuber';

    /**
     * Array with the available form components.
     *
     * @var array
     */
    protected $formComponents = [
        'button-rounded' => Form\ButtonRounded::class,
        'input-rounded' => Form\InputRounded::class,
    ];

    /**
     * Array with the available form components.
     *
     * @var array
     */
    protected $alertComponents = [
        'alert' => Alerts\Alert::class,
        'alert-error' => Alerts\AlertError::class,
        'alert-errors' => Alerts\AlertErrors::class,
        'alert-info' => Alerts\AlertInfo::class,
    ];

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
        $this->publish();
        $this->loadViews();
        $this->loadTranslations();
        $this->registerCommands();
        $this->loadRoutes();
        $this->loadComponents();
    }
    
    private function packagePath($path): string
    {
        return __DIR__."/../../$path";
    }

    private function publish(): void
    {
        $this->publishes([
            $this->packagePath('config/auth.php') => config_path('auth.php'),
            $this->packagePath('config/kuber.php') => config_path('kuber.php'),
            $this->packagePath('database/migrations/') => database_path('migrations'),
            $this->packagePath('database/seeders/') => database_path('seeders'),
            $this->packagePath('src/Models/') => app_path() . '/Models',
            $this->packagePath('src/Providers/RouteServiceProvider.php') => app_path() . '/Providers/RouteServiceProvider.php',
            $this->packagePath('src/Http/Middleware/RedirectIfAuthenticated.php') => app_path() . '/Http/Middleware/RedirectIfAuthenticated.php',
            $this->packagePath('vite.config.js') => app_path() . '/../vite.config.js',
            $this->packagePath('resources/lang_public/') => app_path() . '/../resources/lang/',
            $this->packagePath('resources/sass/app.scss') => app_path() . '/../resources/sass/app.scss',
            $this->packagePath('resources/js/app.js') => app_path() . '/../resources/js/app.js',
            $this->packagePath('public/css') => app_path() . '/../public/vendor/kuber/css/',
            $this->packagePath('public/js') => app_path() . '/../public/vendor/kuber/js/',
            $this->packagePath('public/images') => app_path() . '/../public/vendor/kuber/images/',
        ], 'kuber-assets');
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

    public function loadComponents()
    {
        // Support of x-components is only available for Laravel >= 7.x
        // versions. So, we check if we can load components.

        $canLoadComponents = method_exists(
            'Illuminate\Support\ServiceProvider',
            'loadViewComponentsAs'
        );

        if (! $canLoadComponents) {
            return;
        }

        // Load all the blade-x components.

        $components = array_merge(
            $this->formComponents,
            $this->alertComponents,
        );

        $this->loadViewComponentsAs($this->prefix, $components);
    }
}