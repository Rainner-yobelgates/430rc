<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        return view('website.home');
    }
    public function about(){
        return view('website.about');
    }
    public function gallery(){
        return view('website.gallery');
    }
    public function products(){
        return view('website.products');
    }
    public function detail(){
        return view('website.detail');
    }
}
