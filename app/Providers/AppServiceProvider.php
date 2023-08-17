<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

use Auth;
use App\Models\Profile;
use DB;
use Illuminate\Support\Facades\View;

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
        View::composer('*', function ($view) {
            $user = Auth::user();

            if ($user) {
                $profile = DB::table('profiles')
                    ->where('user_id', $user->id)
                    ->whereNotNull('image_path')
                    ->latest()
                    ->first();

                $gloData = array('profile' => $profile);
                $view->with('gloData', $gloData);
            }
        });

        Paginator::useBootstrap();
    }
}