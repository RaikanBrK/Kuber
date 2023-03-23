<?php
 
namespace Kuber\Providers;

use Kuber\View\Components\Form;
use Kuber\View\Components\Alerts;
use Kuber\View\Components\Tables;
use Kuber\View\Components\Widget;
use Kuber\Console\KuberInstallCommand;
use Kuber\Console\KuberPublishCommand;
use Kuber\Console\KuberAddSettingsCommand;
use Kuber\Console\KuberAddSweetAlertCommand;
use Kuber\Console\KuberCreateRepositoryCommand;
use Kuber\Console\KuberDependencyInstallCommand;
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
    protected $alertsComponents = [
        'alert' => Alerts\Alert::class,
        'alert-error' => Alerts\AlertError::class,
        'alert-errors' => Alerts\AlertErrors::class,
        'alert-info' => Alerts\AlertInfo::class,
    ];

    /**
     * Array with the available form components.
     *
     * @var array
     */
    protected $tablesComponents = [
        'datatables' => Tables\Datatables::class,
    ];

     /**
     * Array with the available form components.
     *
     * @var array
     */
    protected $widgetComponents = [
        'card' => Widget\Card::class,
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
        $this->loadMigrations();
        $this->loadViews();
        $this->loadTranslations();
        $this->registerCommands();
        $this->loadRoutes();
        $this->loadComponents();
        $this->loadMiddleware();
    }

    private function packagePath($path): string
    {
        return __DIR__."/../../$path";
    }

    private function publish(): void
    {
        $this->publishes([
            $this->packagePath('database/seeders/') => database_path('seeders'),
            $this->packagePath('src/Models/') => app_path() . '/Models',
            $this->packagePath('src/Providers/RouteServiceProvider.php') => app_path() . '/Providers/RouteServiceProvider.php',
            $this->packagePath('src/Http/Middleware/RedirectIfAuthenticated.php') => app_path() . '/Http/Middleware/RedirectIfAuthenticated.php',
            $this->packagePath('src/Http/Middleware/Authenticate.php') => app_path() . '/Http/Middleware/Authenticate.php',
            $this->packagePath('src/Http/Middleware/AddSettings.php') => app_path() . '/Http/Middleware/AddSettings.php',

            $this->packagePath('src/Repositories/') => app_path() . '/Repositories/',

            $this->packagePath('vite.config.js') => app_path() . '/../vite.config.js',

            $this->packagePath('resources/public/sass/') => app_path() . '/../resources/sass/',
            $this->packagePath('resources/public/js/') => app_path() . '/../resources/js/',

            $this->packagePath('resources/public/lang/') => app_path() . '/../resources/lang/',
            $this->packagePath('resources/public/views/') => app_path() . '/../resources/views/',

            $this->packagePath('public/css/') => app_path() . '/../public/vendor/kuber/css/',
            $this->packagePath('public/js/') => app_path() . '/../public/vendor/kuber/js/',
            $this->packagePath('public/images/') => app_path() . '/../public/vendor/kuber/images/',           

            $this->packagePath('config/auth.php') => config_path('auth.php'),
            $this->packagePath('config/kuber.php') => config_path('kuber.php'),
            $this->packagePath('config/adminlte.php') => config_path('adminlte.php'),
            $this->packagePath('config/sweetalert.php') => config_path('sweetalert.php'),
            $this->packagePath('config/app.php') => config_path('app.php'),

        ], 'kuber-assets');
    }

    private function loadMigrations(): void
    {
        $this->loadMigrationsFrom($this->packagePath('database/migrations'));
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
            KuberPublishCommand::class,
            KuberCreateRepositoryCommand::class,
        ]);
    }

    private function loadRoutes(): void
    {
        $routesPath = $this->packagePath('routes/web.php');
        $this->loadRoutesFrom($routesPath);
    }

    public function loadComponents()
    {
        $canLoadComponents = method_exists(
            'Illuminate\Support\ServiceProvider',
            'loadViewComponentsAs'
        );

        if (! $canLoadComponents) {
            return;
        }

        $components = array_merge(
            $this->formComponents,
            $this->alertsComponents,
            $this->tablesComponents,
            $this->widgetComponents,
        );

        $this->loadViewComponentsAs($this->prefix, $components);
    }

    private function loadMiddleware()
    {
        $this->app['router']->pushMiddlewareToGroup('web', \Kuber\Http\Middleware\AddSettings::class);
        $this->app['router']->pushMiddlewareToGroup('web', \RealRashid\SweetAlert\ToSweetAlert::class);
    }
}