<?php

namespace App\Providers;

use App\Adapter\CarbonAdapter;
use App\Adapter\DateTimeAdapter;
use App\Adapter\Interfaces\CarbonInterface;
use App\Adapter\Interfaces\DateTimeAdapterInterface;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AdapterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(DateTimeAdapterInterface::class, DateTimeAdapter::class);
        $this->app->bind(CarbonInterface::class, Carbon::class);
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
