<?php

namespace App\Providers;
use App\Models\Slide;
use View;
use Illuminate\Support\ServiceProvider;

class ViewShareProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.guest.master',function($view){
            $slide = Slide::all();
            $view->with(['slide'=>$slide]);
        });   
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
