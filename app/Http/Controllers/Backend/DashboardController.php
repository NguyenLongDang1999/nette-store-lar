<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(): string
    {
        return view('backend.dashboard.index');
    }
}
