<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\CategoryParent;
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
        $hot_line = '0918.736.212';
        $categorys_menu = CategoryParent::with([
            'category'=>function($q){
                $q->where('delete_flag', 0);
            }])
            ->where('delete_flag', 0)
            ->get();

        View::composer('*', function ($view) use($categorys_menu, $hot_line){
            $view->with('hot_line', $hot_line);
            $view->with('categorys_menu', $categorys_menu);
        });
    }
}
