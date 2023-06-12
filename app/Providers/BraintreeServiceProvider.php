<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BraintreeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Braintree\Gateway', function ($app) {
            return new \Braintree\Gateway([
                'environment' => 'sandbox',
                'merchantId'  => '8myhdh8gnnwnq32v',
                'publicKey'   => 'nctbpjqys9ryn8y7',
                'privateKey'  => '5ac4c9baa0e8ef5db39ef7b42add3b39',
            ]);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
