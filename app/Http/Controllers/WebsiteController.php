<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Gallery;
use Illuminate\Support\Facades\Cache;

class WebsiteController extends Controller
{
    protected $setting;
    public function __construct(Request $request)
    {
        $this->setting = Setting::pluck('value', 'key')->toArray();
        
    }
    public function home(){
        $getFaq = Faq::where('status', 80)->orderBy('order', 'ASC')->get();
        $setting = $this->setting;
        return view('website.home', compact('setting', 'getFaq'));
    }
    public function about(){
        $setting = $this->setting;
        return view('website.about', compact('setting'));
    }
    public function gallery(){
        $getGallery = Gallery::where('status', 80)->orderBy('order', 'ASC')->limit(20)->get();
        $setting = $this->setting;
        return view('website.gallery', compact('setting', 'getGallery'));
    }
    public function products(){
        return view('website.products');
    }
    public function detail(){
        return view('website.detail');
    }
    public function cart(){
        return view('website.cart');
    }
}
