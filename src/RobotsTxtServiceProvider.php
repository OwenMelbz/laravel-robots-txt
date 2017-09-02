<?php

namespace OwenMelbz\RobotsTxt;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

/**
 * Service provider for RobotsTxt
 *
 * @author: Owen Melbourne
 */
class RobotsTxtServiceProvider extends ServiceProvider {

    /**
     * This will be used to register config & view
     */
    protected $packageName = 'robots_txt';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish the config
        $this->publishes([
            __DIR__.'/../config/config.php' => config_path($this->packageName.'.php'),
            __DIR__.'/resources/robots.txt' => $this->resource_path('robots.txt')
        ]);

        // Load the routes
        $this->loadRoutesFromLegacy(__DIR__.'/routes.php');

        // We load a custom template if it exists.
        if (file_exists($templatePath = $this->resource_path('robots.txt'))) {
            RobotsTxt::setTemplatePath($templatePath);
        } else {
            RobotsTxt::setTemplatePath(__DIR__.'/resources/robots.txt');
        }

        // We load the blade directive for nofollow/noindex meta tag
        Blade::directive('robotsMeta', function () {
            return "<?php echo (new \OwenMelbz\RobotsTxt\RobotsMeta)->render(); ?>";
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom( __DIR__.'/../config/config.php', $this->packageName);
    }

    protected function resource_path($filename)
    {
        if (function_exists('resource_path')) {
            return resource_path($filename);
        }

        return app_path('resources/' . trim($filename, '/'));
    }

    protected function loadRoutesFromLegacy($path)
    {
        if (method_exists($this, 'loadRoutesFrom')) {
            return $this->loadRoutesFrom($path);
        }

        if (! $this->app->routesAreCached()) {
            require $path;
        }
    }

}
