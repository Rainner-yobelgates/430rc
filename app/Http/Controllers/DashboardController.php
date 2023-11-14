<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Color;
use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function dashboard(){
        $active = 'dashboard';
        $countGallery = Gallery::count();
        $countProduct = Product::count();
        $countFaq = Faq::count();
        $countColor = Color::count();
        return view('admin.dashboard', compact('active','countGallery', 'countProduct', 'countFaq','countColor'));
    }
}
