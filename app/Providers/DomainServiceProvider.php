<?php

namespace App\Providers;

use App\Domain\Interfaces\SettlementDateDomainInterface;
use App\Domain\SettlementDateDomain;
use Illuminate\Support\ServiceProvider;

class DomainServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SettlementDateDomainInterface::class, SettlementDateDomain::class);
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
