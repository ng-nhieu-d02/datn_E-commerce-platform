<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    public function __construct()
    {
        
    }
    public function dashboard()
    {
        return view('dashboard.layout.main');
    }
}
