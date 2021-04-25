<?php

namespace App\Providers;

use Core\Menu\Entities\Menu;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
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
        if(env('REDIRECT_HTTPS'))
        {
            URL::forceScheme('https');
        }

        view()->composer('*', function($view){
            if (Session::has('admin_menus') && !empty(Session::get('admin_menus'))) {
                $menus =  Session::get('admin_menus');
            }else{
                $menus = Menu::getAllMenuBuilded();
                Session::put('admin_menus',$menus);
            }
            $view->with('admin_menus', $menus );
        });
    }
}
