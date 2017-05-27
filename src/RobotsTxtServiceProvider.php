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
     * This will be used to register config & view in
     * your package namespace.
     *
     * --> Replace with your package name <--
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
            __DIR__.'/resources/robots.txt' => resource_path('robots.txt')
        ]);

        // Load the routes
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        // We load a custom template if it exists.
        if (file_exists($templatePath = resource_path('robots.txt'))) {
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

}
