<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        $active = 'dashboard';
        return view('admin.dashboard', compact('active'));
    }
}
