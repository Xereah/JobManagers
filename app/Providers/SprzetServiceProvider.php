<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\RepEquipment;
use App\Models\User;
use Auth;
class SprzetServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        try {
            $RepEquipment1 = RepEquipment::all()->where('is_loan','!=',1)->where('eq_active','!=',1);
            $user_all = User::all();
            $loggedInUserId = Auth::user();

            // Check if $RepEquipment is not null before sharing it with the view.
            if (!is_null($RepEquipment1)) {
                View::share('RepEquipment1', $RepEquipment1);
                View::share('user_all', $user_all);
                View::share('loggedInUserId', $loggedInUserId);
            }
        } catch (\Exception $e) {
            // Handle any exceptions that might occur during data retrieval.
            // You can log the error or take appropriate action here.
            // For debugging purposes, you can also dump the exception message:
            // dd($e->getMessage());
        }
    }
}