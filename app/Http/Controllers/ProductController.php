<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Image;
use App\Models\Product;
use App\Models\Attribute;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    protected $passingData;
    protected $passingImageData;
    protected $passingAttributeData;
    public function __construct()
    {
        $this->passingData = [
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,webp|max:3072',
            'category' => 'required',
            'description' => 'required',
            'weight' => 'required|numeric',
            'status' => 'required|numeric',
        ];

        $this->passingAttributeData = [
            'color_id' => 'required|numeric',
            'size' => 'required',
            'order' => 'required|numeric',
            'status' => 'required|numeric',
        ];

        $this->passingImageData = [
            'image' => 'image|mimes:jpeg,png,jpg,webp|max:3072',
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
        $this->passingData['image'] = 'required|image|mimes:jpeg,png,jpg,webp|max:3072';
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
        return redirect(route('panel.product.show', $product->id))->with('success', 'Product updated successfully');
    }
    
    public function delete(Product $product){
        if ($product->image) {
            Storage::delete($product->image);
        }
        $product->delete();
        return redirect(route('panel.product.index'))->with('success', 'Product deleted successfully');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::get();
            return DataTables::of($data)
                ->addIndexColumn()                
                ->rawColumns(['name', 'price', 'image', 'category', 'weight', 'order', 'status', 'created_at', 'action'])
                ->editColumn('image', function ($row) {
                    $image = '<img src="'.asset("storage/". $row->image).'" class="img-fluid" style="width:75px;height:75px;object-fit: contain;" alt="Product image">';
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
                ->editColumn('created_at', function ($row) {
                    return [
                        date('d-m-Y H:i:s', strtotime($row->created_at)),
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

    public function attributeCreate(Product $product){
        $title = 'Create Attribute';
        $viewType = 'create';
        $active = 'product';
        $getColor = Color::where('status', 80)->pluck('name', 'id')->toArray();
        return view('admin.product.attribute.forms', compact('viewType', 'getColor', 'title', 'active', 'product'));
    }

    public function attributeShow(Product $product, Attribute $attribute){
        $title = 'Show Attribute';
        $viewType = 'show';
        $active = 'product';
        $getColor = Color::where('status', 80)->pluck('name', 'id')->toArray();
        return view('admin.product.attribute.forms', compact('product', 'getColor', 'attribute', 'viewType', 'title', 'active'));
    }

    public function attributeStore(Product $product, Request $request){
        $this->passingAttributeData['color_id'] = [
            'required', 
            'numeric', 
            Rule::unique('attributes')->where(function ($query) use($request, $product) {
                return $query->where('color_id', $request->color_id)
                ->where('size', $request->size)
                ->where('product_id', $product->id);
            }),
        ];
        $data = $this->validate($request, $this->passingAttributeData,[
            'color_id.unique' => 'The same color and size already exist',
        ]);
        $data['product_id'] = $product->id;

        $getAttribute = Attribute::create($data);
        return redirect(route('panel.product.attribute.show', [$product->id, $getAttribute->id]))->with('success', 'Attribute created successfully');
    }

    public function attributeEdit(Product $product, Attribute $attribute){
        $title = 'Edit Attribute';
        $viewType = 'edit';
        $active = 'product';
        $getColor = Color::where('status', 80)->pluck('name', 'id')->toArray();
        return view('admin.product.attribute.forms', compact('product', 'getColor', 'attribute', 'viewType', 'title', 'active'));
    }

    public function attributeUpdate(Product $product, Attribute $attribute, Request $request){
        $data = $this->validate($request, $this->passingAttributeData);
        
        $attribute->update($data);
        return redirect(route('panel.product.show', [$product->id, $attribute->id]))->with('success', 'Attribute updated successfully');
    }
    
    public function attributeDelete(Product $product, Attribute $attribute){
        $attribute->delete();
        return redirect(route('panel.product.show', $product->id))->with('success', 'Product deleted successfully');
    }

    public function attributeData(Product $product, Request $request)
    {
        if ($request->ajax()) {
            $data = Attribute::where('product_id', $product->id)->get();
            $getProduct = Product::pluck('name', 'id')->toArray();
            $getColor = Color::pluck('name', 'id')->toArray();
            return DataTables::of($data)
                ->addIndexColumn()                
                ->rawColumns(['product_id', 'color_id', 'size', 'order', 'status', 'action'])
                ->editColumn('product_id', function ($row) use ($getProduct) {
                    return [
                        $getProduct[$row->product_id],
                    ];
                })
                ->editColumn('color_id', function ($row) use ($getColor) {
                    return [
                        $getColor[$row->color_id],
                    ];
                })
                ->editColumn('status', function ($row) {
                    return [
                        get_list_status()[$row->status],
                    ];
                })
                ->addColumn('action', function ($row) use ($product) {
                    $btn = '
                    <div class="d-flex align-items-center">
                        <a href="'.route('panel.product.attribute.show',[$product->id, $row->id]).'" class="btn btn-info btn-edit mb-0 me-2"><i class="fas fa-eye"></i></a>
                        <a href="'.route('panel.product.attribute.edit',[$product->id, $row->id]).'" class="btn btn-primary btn-edit mb-0 me-2"><i class="fas fa-edit"></i></a>
                        <form action="'.route('panel.product.attribute.delete', [$product->id, $row->id]).'" method="POST">
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

    public function imageCreate(Product $product){
        $title = 'Create Gallery Image';
        $viewType = 'create';
        $active = 'product';
        return view('admin.product.image.forms', compact('viewType', 'title', 'active', 'product'));
    }

    public function imageShow(Product $product, Image $image){
        $title = 'Show Gallery Image';
        $viewType = 'show';
        $active = 'product';
        return view('admin.product.image.forms', compact('product', 'image', 'viewType', 'title', 'active'));
    }

    public function imageStore(Product $product, Request $request){
        $this->passingImageData['image'] = 'required|image|mimes:jpeg,png,jpg,webp|max:3072';
        $data = $this->validate($request, $this->passingImageData);
        $data['product_id'] = $product->id;
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/product/gallery');
        }
        $getImage = Image::create($data);
        return redirect(route('panel.product.image.show', [$product->id, $getImage->id]))->with('success', 'Gallery Image created successfully');
    }

    public function imageEdit(Product $product, Image $image){
        $title = 'Edit Gallery Image';
        $viewType = 'edit';
        $active = 'product';
        return view('admin.product.image.forms', compact('product', 'image', 'viewType', 'title', 'active'));
    }

    public function imageUpdate(Product $product, Image $image, Request $request){
        $data = $this->validate($request, $this->passingImageData);
        if ($request->hasFile('image')) {
            Storage::delete($image->image);
            $data['image'] = $request->file('image')->store('uploads/product/gallery');
        }
        $image->update($data);
        return redirect(route('panel.product.show', [$product->id, $image->id]))->with('success', 'Gallery Image updated successfully');
    }
    
    public function imageDelete(Product $product, Image $image){
        if ($image->image) {
            Storage::delete($image->image);
        }
        $image->delete();
        return redirect(route('panel.product.show', $product->id))->with('success', 'Gallery Image deleted successfully');
    }

    public function imageData(Product $product, Request $request)
    {
        if ($request->ajax()) {
            $data = Image::where('product_id', $product->id)->get();
            $getProduct = Product::pluck('name', 'id')->toArray();
            $getColor = Color::pluck('name', 'id')->toArray();
            return DataTables::of($data)
                ->addIndexColumn()                
                ->rawColumns(['product_id', 'image', 'status', 'action'])
                ->editColumn('product_id', function ($row) use ($getProduct) {
                    return [
                        $getProduct[$row->product_id],
                    ];
                })
                ->editColumn('image', function ($row) {
                    $image = '<img src="'.asset("storage/". $row->image).'" class="img-fluid" style="width:75px;height:75px;object-fit: contain;" alt="Gallery image product">';
                    return $image;
                })
                ->editColumn('status', function ($row) {
                    return [
                        get_list_status()[$row->status],
                    ];
                })
                ->addColumn('action', function ($row) use ($product) {
                    $btn = '
                    <div class="d-flex align-items-center">
                        <a href="'.route('panel.product.image.show',[$product->id, $row->id]).'" class="btn btn-info btn-edit mb-0 me-2"><i class="fas fa-eye"></i></a>
                        <a href="'.route('panel.product.image.edit',[$product->id, $row->id]).'" class="btn btn-primary btn-edit mb-0 me-2"><i class="fas fa-edit"></i></a>
                        <form action="'.route('panel.product.image.delete', [$product->id, $row->id]).'" method="POST">
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
