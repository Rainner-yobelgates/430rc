<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    protected $passingData;
    public function __construct()
    {
        $this->passingData = [
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg|max:3072',
            'category' => 'required',
            'description' => 'required',
            'weight' => 'required|numeric',
            'status' => 'required|numeric',
        ];
    }

    public function index(){
        $title = 'Data Product';
        $active = 'product';
        return view('admin.product.index', compact('title', 'active'));
    }

    public function create(){
        $title = 'Create Product';
        $viewType = 'create';
        $active = 'product';
        return view('admin.product.forms', compact('viewType', 'title', 'active'));
    }

    public function show(Product $product){
        $title = 'Show Product';
        $viewType = 'show';
        $active = 'product';
        return view('admin.product.forms', compact('product', 'viewType', 'title', 'active'));
    }

    public function store(Request $request){
        $this->passingData['image'] = 'required|image|mimes:jpeg,png,jpg|max:3072';
        $data = $this->validate($request, $this->passingData);
        $data['slugs'] = Str::slug($data['name']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/product');
        }
        $getProduct = Product::create($data);
        return redirect(route('panel.product.show', $getProduct->id))->with('success', 'Product created successfully');
    }

    public function edit(Product $product){
        $title = 'Edit Product';
        $viewType = 'edit';
        $active = 'product';
        return view('admin.product.forms', compact('product', 'viewType', 'title', 'active'));
    }

    public function update(Product $product, Request $request){
        $data = $this->validate($request, $this->passingData);
        $data['slugs'] = Str::slug($data['name']);
        if ($request->hasFile('image')) {
            Storage::delete($product->image);
            $data['image'] = $request->file('image')->store('uploads/presenter');
        }
        $product->update($data);
        return redirect(route('panel.product.show', $product->id))->with('success', 'Product created successfully');
    }
    
    public function delete(Product $product){
        $product->delete();
        return redirect(route('panel.product.index'))->with('success', 'Product deleted successfully');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::get();
            return DataTables::of($data)
                ->addIndexColumn()                
                ->rawColumns(['name', 'price', 'image', 'category', 'weight', 'order', 'status', 'action'])
                ->editColumn('image', function ($row) {
                    $image = '<img src="'.asset("storage/". $row->image).'" class="img-fluid" style="width:75px;height:75px;object-fit: contain;" alt="user photo">';
                    return $image;
                })
                ->editColumn('price', function ($row) {
                    return [
                        'Rp. ' . number_format($row->price),
                    ];
                })
                ->editColumn('status', function ($row) {
                    return [
                        get_list_status()[$row->status],
                    ];
                })
                ->addColumn('action', function ($row) {
                    $btn = '
                    <div class="d-flex align-items-center">
                        <a href="'.route('panel.product.show',[$row->id]).'" class="btn btn-info btn-edit mb-0 me-2"><i class="fas fa-eye"></i></a>
                        <a href="'.route('panel.product.edit',[$row->id]).'" class="btn btn-primary btn-edit mb-0 me-2"><i class="fas fa-edit"></i></a>
                        <form action="'.route('panel.product.delete', [$row->id]).'" method="POST">
                            '.csrf_field().'
                            '.method_field ("delete").'
                            <button type="submit" class="btn btn-danger mb-0">
                            <i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                    ';
                    return $btn;
                })
                ->make(true);
        }
    }
}
