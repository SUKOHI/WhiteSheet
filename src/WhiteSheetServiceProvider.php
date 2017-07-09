<?php namespace Sukohi\WhiteSheet;

use Illuminate\Support\ServiceProvider;

class WhiteSheetServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var  bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Code
        $this->app->singleton('command.db:code', function ($app) {

            return $app['Sukohi\WhiteSheet\Commands\CodeCommand'];

        });
        $this->commands('command.db:code');
        $this->loadViewsFrom(__DIR__.'/views', 'white-sheet');

        // Find
        $this->app->singleton('command.db:find', function ($app) {

            return $app['Sukohi\WhiteSheet\Commands\FindCommand'];

        });
        $this->commands('command.db:find');

        // Fields
        $this->app->singleton('command.db:fields', function ($app) {

            return $app['Sukohi\WhiteSheet\Commands\FieldsCommand'];

        });
        $this->commands('command.db:fields');

        // Count
        $this->app->singleton('command.db:count', function ($app) {

            return $app['Sukohi\WhiteSheet\Commands\CountCommand'];

        });
        $this->commands('command.db:count');

        // Tail
        $this->app->singleton('command.db:tail', function ($app) {

            return $app['Sukohi\WhiteSheet\Commands\TailCommand'];

        });
        $this->commands('command.db:tail');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['white-sheet'];
    }

}