<?php
namespace App\Providers;

use App\Models\Product;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use App\Services\GlobalsService;
use App\Models\User;
use App\Models\Order;
use App\Observers\UserObserver;
use App\Observers\OrderObserver;
use App\Observers\ProductObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(GlobalsService::class, function ($app) {
            return new GlobalsService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(GlobalsService $globalsService): void
    {

        //\View::share('geoData', $globalsService->getGlobals()['geoData']);
        try {
            \View::share('languages', $globalsService->getLanguages());
            \View::share('menuTop', $globalsService->getMenuTop());
            \View::share('currencies', $globalsService->getCurrencies());
            \View::share('countries', $globalsService->getCountries());
            \View::share('activeLanguage', $globalsService->getActiveLanguage());
            \View::share('activeCurrency', $globalsService->getActiveCurrency());
            \View::share('siteSettings', $globalsService->getGlobals()['siteSettings']);

            // Set language globally
            App::setLocale(strtolower($globalsService->getActiveLanguageCode()));
        } catch (\Exception $e) {
            // Handle the exception here
            // You can log the error or display a custom error message
            // Example: Log::error($e->getMessage());
        }

        // Observers
        User::observe(UserObserver::class);
        Order::observe(OrderObserver::class);
        Product::observe(ProductObserver::class);

    }
}
