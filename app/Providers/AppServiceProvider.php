<?php

namespace App\Providers;

use App\Models\AdminSetting;
use App\Models\WebLanguage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        if (env('DB_USERNAME')) {
        View::share('admin_setting', AdminSetting::get());
        View::share('weblang', WebLanguage::get());
        }
    }
}
