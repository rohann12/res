<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $modules = config('module.modules');

        foreach ($modules as $module) {
            // Load web routes
            if (file_exists(base_path('modules/' . $module . '/Routes/web.php'))) {
                $this->app['router']->group(['middleware' => ['web']], function () use ($module) {
                    $this->loadRoutesFrom(base_path('modules/' . $module . '/Routes/web.php'));
                });
            }

            // Load views
            if (is_dir(base_path('modules/' . $module . '/Views'))) {
                $this->loadViewsFrom(base_path('modules/' . $module . '/Views'), $module);
            }
        }
    }
}
