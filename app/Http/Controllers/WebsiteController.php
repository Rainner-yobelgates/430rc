<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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
        $getProduct = Product::with(['attributes' => function($query){
            $query->whereIn('id', function ($subquery) {
                $subquery->select(DB::raw('MIN(id)'))
                    ->from('attributes')
                    ->where('status', 80)
                    ->groupBy('size');
            });
        }])->orderBy('created_at', 'DESC')->limit(8)->get();
        $setting = $this->setting;
        return view('website.home', compact('setting', 'getFaq', 'getProduct'));
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

    public function products(Request $request){
        $setting = $this->setting;
        $getProduct = Product::with(['attributes' => function($query){
            $query->whereIn('id', function ($subquery) {
                $subquery->select(DB::raw('MIN(id)'))
                    ->from('attributes')
                    ->where('status', 80)
                    ->groupBy('size');
            })->orderBy('order', 'ASC');
        }]);
        if ($request->ajax()) {
            if($request->search != ''){
                $getProduct = $getProduct->where('name', 'LIKE', '%' . $request->search . '%')->paginate(15);
            }else{
                $getProduct = $getProduct->paginate(15);
            }
            return $getProduct;
        } else if ($request->filter == 'latest') {
            $getProduct = $getProduct->latest()->paginate(15);
        } else if ($request->filter == 'az') {
            $getProduct = $getProduct->orderBy('name', 'ASC')->paginate(15);
        } else if ($request->filter == 'za') {
            $getProduct = $getProduct->orderBy('name', 'DESC')->paginate(15);
        } else if ($request->filter == 'low_price') {
            $getProduct = $getProduct->orderBy('price', 'ASC')->paginate(15);
        } else if ($request->filter == 'high_price') {
            $getProduct = $getProduct->orderBy('price', 'DESC')->paginate(15);
        } else if ($request->min && $request->max) {
            $getProduct = $getProduct->wherebetween('price', [$request->min, $request->max])->paginate(15);
        } else if (in_array($request->filter, list_size_product())){
            $getProduct = $getProduct->whereHas('attributes', function($query) use ($request) {
                $query->where('attributes.size', $request->filter)
                ->where('status', 80);
            })->paginate(15);
        } else {
            $getProduct = $getProduct->paginate(15);
        }
        return view('website.products', compact('setting', 'getProduct'));
    }
    public function detail(Product $product){
        $setting = $this->setting;

        return view('website.detail', compact('setting', 'product'));
    }
    public function cart(){
        return view('website.cart');
    }
}
