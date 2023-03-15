<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Category;
use App\Models\Job;
use App\Models\Location;

class SidebarComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('sidebarLocations', Location::withCount('jobs')->whereHas('jobs')->orderBy('jobs_count', 'desc')->get());
        $view->with('sidebarJobs', Job::whereTopRated(true)->orderBy('id', 'desc')->take(5)->get());
        $view->with('sidebarCategories', Category::withCount('jobs')->whereHas('jobs')->orderBy('jobs_count', 'desc')->get());
    }
}