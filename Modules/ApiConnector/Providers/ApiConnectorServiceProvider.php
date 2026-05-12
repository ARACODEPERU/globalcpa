<?php

namespace Modules\ApiConnector\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class ApiConnectorServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'ApiConnector';
    protected string $moduleNameLower = 'apiconnector';

    public function boot(): void
    {
        $this->registerCommands();
        $this->registerCommandSchedules();
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
    }

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->bind('apiconnector', function () {
            return new \Modules\ApiConnector\Services\ApiConnectorService();
        });
    }

    protected function registerCommands(): void
    {
    }

    protected function registerCommandSchedules(): void
    {
    }

    protected function registerTranslations(): void
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);
        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
            $this->loadJsonTranslationsFrom($langPath);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
            $this->loadJsonTranslationsFrom(module_path($this->moduleName, 'Resources/lang'));
        }
    }

    protected function registerConfig(): void
    {
        $this->publishes([module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php')], 'config');
        $this->mergeConfigFrom(module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower);
    }

    public function registerViews(): void
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);
        $sourcePath = module_path($this->moduleName, 'Resources/views');
        $this->publishes([$sourcePath => $viewPath], ['views', $this->moduleNameLower . '-module-views']);
        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
        $componentNamespace = str_replace('/', '\\', config('modules.namespace') . '\\' . $this->moduleName . '\\' . config('modules.paths.generator.component-class.path'));
        Blade::componentNamespace($componentNamespace, $this->moduleNameLower);
    }

    public function provides(): array
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (config('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }
}
