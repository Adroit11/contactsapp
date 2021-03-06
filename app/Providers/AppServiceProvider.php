<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Contracts\ContactsRepositoryInterface',
            'App\Repositories\Eloquent\ContactsRepository'
        );

         $this->app->bind(
            'App\Transformers\Eloquent\Contracts\ContactsTransformerInterface',
            'App\Transformers\Eloquent\ContactsTransformer'
        );

         $this->app->bind(
            'App\Validators\Contracts\ContactsValidatorInterface',
            'App\Validators\ContactsValidator'
        );
    }
}
