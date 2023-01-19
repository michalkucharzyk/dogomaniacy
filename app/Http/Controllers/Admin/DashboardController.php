<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;

class DashboardController extends AdminController
{


    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('admin.dashboard');
    }
}