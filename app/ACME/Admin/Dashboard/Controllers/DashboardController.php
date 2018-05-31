<?php

namespace App\ACME\Admin\Authentication\Controllers;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin']);
    }
    
    public function index()
    {
        return view('Admin.Dashboard.Views.dashboard');
    }
}