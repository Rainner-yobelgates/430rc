<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\City;
use App\Models\Color;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Province;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

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
        $getColor = Color::pluck('name', 'id')->toArray();

        $newProduct = Product::with(['attributes' => function($query){
            $query->whereIn('id', function ($subquery) {
                $subquery->select(DB::raw('MIN(id)'))
                    ->from('attributes')
                    ->where('status', 80)
                    ->groupBy('size');
            })->orderBy('order', 'ASC');
        }])->orderBy('created_at', 'DESC')->limit(4)->get();
        return view('website.detail', compact('setting', 'product', 'newProduct', 'getColor'));
    }
    public function checkAvailable(Request $request){
        if($request->ajax()){
            if($request->type == 'size'){
                $availableColor = Attribute::where('product_id', $request->productId)->where('size', $request->value)->where('status', 80)->groupBy('color_id')->pluck('color_id');
                return response()->json([
                    'type' => $request->type,
                    'data' => $availableColor
                ]);
            }else{
                $availableSize = Attribute::where('product_id', $request->productId)->where('color_id', $request->value)->where('status', 80)->groupBy('size')->pluck('size');
                return response()->json([
                    'type' => $request->type,
                    'data' => $availableSize
                ]);
            }
        }
    }

    public function addToCart(Request $request){
        $product = Product::find($request->product_id);

        if (!$product) {
            return redirect()->route('products')->with('error', 'Product Not Found');
        }

        $cart = $request->session()->get('cart', []);

        $cartItem = [
            'product_id' => $request->product_id,
            'name' => $product->name,
            'slugs' => $product->slugs,
            'price' => $product->price,
            'image' => $product->image,
            'color' => $request->color,
            'size' => $request->size,
            'weight' => $product->weight,
        ];

        $existingItem = collect($cart)->first(function ($item) use ($request) {
            return $item['product_id'] === $request->product_id 
                && $item['size'] === $request->size 
                && $item['color'] === $request->color;
        });

        if (!$existingItem) {
            $cart[] = $cartItem;
            $request->session()->put('cart', $cart);
            return redirect()->route('detail',$product->slugs)->with('success', 'Product was successfully added to cart');
        } else {
            return redirect()->route('detail',$product->slugs)->with('error', 'Product is already in the cart');
        }
    }
    
    public function cart(){
        $setting = $this->setting;
        $getCart = Session::get('cart');
        $getColor = Color::pluck('name', 'id')->toArray();
        $getProvince = Province::pluck('province', 'id')->toArray();

        $newProduct = Product::with(['attributes' => function($query){
            $query->whereIn('id', function ($subquery) {
                $subquery->select(DB::raw('MIN(id)'))
                    ->from('attributes')
                    ->where('status', 80)
                    ->groupBy('size');
            })->orderBy('order', 'ASC');
        }])->orderBy('created_at', 'DESC')->limit(4)->get();
        $totalPrice = 0;
        $countProduct = 0;
        $totalWeight = 0;
        if ($getCart) {
            foreach ($getCart as $product) {
                $totalWeight += $product['weight'];
                $countProduct += 1;
                $totalPrice += $product['price'];
            }
        }

        return view('website.cart', compact('getCart', 'setting', 'getColor', 'newProduct', 'totalPrice', 'totalWeight', 'countProduct', 'getProvince'));
    }

    public function deleteCart($id){
        $cart = Session::get('cart', [$id]);

        if (isset($cart[$id])) {
            unset($cart[$id]); // Menghapus elemen sesuai dengan indeks yang dipilih
            Session::put('cart', $cart); // Memperbarui session 'cart' setelah menghapus elemen
            return redirect()->route('cart')->with('success', 'Product deleted successfuly');
        } else {
            return redirect()->route('cart')->with('error', 'Product deleted failed');
        }
    }

    public function getCities(Request $request){
        $getCity = City::where('province_id', $request->province_id)->get();
        $result = '';
        foreach ($getCity as $city) {
            $result .= '<option value="' . $city->id . '">' . $city->type . ' ' . $city->city . '</option>';
        }
        return response()->json(['result' => $result]);
    }

    public function getCourier(Request $request){
        $setting = $this->setting;

        $response = get_courier($setting['city'], $request->city_id ?? 17, $request->weight, 'jne');

        $list = '<option value="" hidden>Choose Courier</option>';

        if (isset($response)) {
            foreach ($response as $data) {
                $list .= '<option value="' . $data['cost'][0]['value'] . '">' . "JNE | " . " " . $data['description'] . " (" . $data['service'] . ")" . '</option>';
            };
        }
        return response()->json(['list' => $list]);
    }
}
