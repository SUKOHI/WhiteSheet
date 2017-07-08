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
        $this->app->singleton('command.db:code', function ($app) {

            return $app['Sukohi\WhiteSheet\Commands\CodeCommand'];

        });
        $this->commands('command.db:code');
        $this->app->singleton('command.db:find', function ($app) {

            return $app['Sukohi\WhiteSheet\Commands\FindCommand'];

        });
        $this->commands('command.db:find');
        $this->loadViewsFrom(__DIR__.'/views', 'white-sheet');
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