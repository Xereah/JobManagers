<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\RepEquipment;
class SprzetServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        try {
            $RepEquipment1 = RepEquipment::all()->where('is_loan','!=',1)->where('eq_active','!=',1);

            // Check if $RepEquipment is not null before sharing it with the view.
            if (!is_null($RepEquipment1)) {
                View::share('RepEquipment1', $RepEquipment1);
            }
        } catch (\Exception $e) {
            // Handle any exceptions that might occur during data retrieval.
            // You can log the error or take appropriate action here.
            // For debugging purposes, you can also dump the exception message:
            // dd($e->getMessage());
        }
    }
}