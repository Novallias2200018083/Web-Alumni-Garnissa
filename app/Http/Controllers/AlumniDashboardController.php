<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlumniDashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.alumni.index');
    }
}
