<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\View;
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
        //
        $categorys_menu = Category::where('delete_flag', 0)->get();

        View::composer('*', function ($view) use($categorys_menu){
            $view->with('categorys_menu', $categorys_menu);
        });
    }
}
