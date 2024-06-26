<?php

namespace Modules\Core\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Laravel\Passport\Passport;
use Modules\Core\Services\Image\IImageService;
use Modules\Core\Services\Image\ImageService;
use Modules\Core\Services\Location\ILocationService;
use Modules\Core\Services\Location\LocationAppMobService;
use Modules\Core\Services\Location\LocationGhnService;
use Modules\Product\Models\ProductCategory;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Core';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'core';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));

        Paginator::defaultView('vendor/pagination/custom');

        $kernel = $this->app->make('Illuminate\Contracts\Http\Kernel');
        $kernel->appendMiddlewareToGroup("web", \Modules\Core\Http\Middleware\CoreMiddleware::class);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        Passport::tokensExpireIn(now()->addHours(2));
        Passport::personalAccessTokensExpireIn(now()->addMinutes(1));
        Passport::refreshTokensExpireIn(now()->addHours(4));
        $this->app->register(RouteServiceProvider::class);
        $this->app->bind(IImageService::class, ImageService::class);
        //location
        $this->app->singleton(ILocationService::class, LocationGhnService::class);
        // $this->app->singleton(ILocationService::class, LocationAppMobService::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
            $this->loadJsonTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, ''), $this->moduleNameLower);
            $this->loadJsonTranslationsFrom(module_path($this->moduleName, ''), $this->moduleNameLower);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }
}
