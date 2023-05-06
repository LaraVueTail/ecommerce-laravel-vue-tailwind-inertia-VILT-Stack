<?php

namespace App\Http\Controllers;
use Inertia\Inertia;

class AdminDashboardController extends Controller
{
    //
    public function index()
    {
        return Inertia::render('AdminDashboard/Index');
    }

}