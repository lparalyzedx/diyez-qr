<?php

namespace App\Providers;

use App\Models\Account;
use App\Models\Locale;
use App\Observers\AccountObserver;
use App\Observers\LocaleObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Account::observe(AccountObserver::class);
        Locale::observe(LocaleObserver::class);
    }
}
