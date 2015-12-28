<?php

namespace Mnabialek\LaravelMultiDomain;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Mnabialek\LaravelMultiDomain\Console\Commands\ChangeDefaultPaths;

class MultiDomainServiceProvider extends BaseServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // create singleton so we can use it anywhere
        $this->app->singleton(MultiDomain::class, function ($app) {
            return new MultiDomain($app);
        });

        /** @var MultiDomain $multiConfig */
        $multiConfig = $this->app->make(MultiDomain::class);

        // publish default config into valid file
        $this->publishes([
            $multiConfig->getDefaultConfigFilePath() => $multiConfig->getConfigFilePath(),
        ]);

        $this->commands(ChangeDefaultPaths::class);
    }
}
