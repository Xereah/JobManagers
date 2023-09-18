<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Company;
class KlientServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        try {
            $companies = Company::all();

            // Check if $RepEquipment is not null before sharing it with the view.
            if (!is_null($companies)) {
                View::share('companies', $companies);
            }
        } catch (\Exception $e) {
            // Handle any exceptions that might occur during data retrieval.
            // You can log the error or take appropriate action here.
            // For debugging purposes, you can also dump the exception message:
            // dd($e->getMessage());
        }
    }
}