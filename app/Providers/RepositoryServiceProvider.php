<?php

namespace CodeDelivery\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $models = ['Category', 'Product', 'Client', 'Order', 'User'];

        foreach($models as $model){
            $this->app->bind(
                "CodeDelivery\Repositories\\". $model . "Repository",
                "CodeDelivery\Repositories\\" . $model . "RepositoryEloquent"
            );
        }

    }
}
