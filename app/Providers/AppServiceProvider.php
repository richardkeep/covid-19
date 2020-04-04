<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('collection.multiSort', function ($app, $criteria) {
            return function ($first, $second) use ($criteria) {
                foreach ($criteria as $key => $orderType) {
                    // normalize sort direction
                    $orderType = strtolower($orderType);
                    if ($first[$key] < $second[$key]) {
                        return $orderType === 'asc' ? -1 : 1;
                    } elseif ($first[$key] > $second[$key]) {
                        return $orderType === 'asc' ? 1 : -1;
                    }
                }
                // all elements were equal
                return 0;
            };
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
