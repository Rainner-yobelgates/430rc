<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class GalleryController extends Controller
{
    protected $passingData;
    public function __construct()
    {
        $this->passingData = [
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'order' => 'required|numeric',
            'status' => 'required|numeric',
        ];
    }

    public function index(){
        $title = 'Data Gallery';
        $active = 'gallery';
        return view('admin.gallery.index', compact('title', 'active'));
    }

    public function create(){
        $title = 'Create Gallery';
        $viewType = 'create';
        $active = 'gallery';
        return view('admin.gallery.forms', compact('viewType', 'title', 'active'));
    }

    public function show(Gallery $gallery){
        $title = 'Show Gallery';
        $viewType = 'show';
        $active = 'gallery';
        return view('admin.gallery.forms', compact('gallery', 'viewType', 'title', 'active'));
    }

    public function store(Request $request){
        $this->passingData['image'] = 'required|image|mimes:jpeg,png,jpg|max:3072';
        $data = $this->validate($request, $this->passingData);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/gallery');
        }
        $getGallery = Gallery::create($data);
        return redirect(route('panel.gallery.show', $getGallery->id))->with('success', 'Gallery created successfully');
    }

    public function edit(Gallery $gallery){
        $title = 'Edit Gallery';
        $viewType = 'edit';
        $active = 'gallery';
        return view('admin.gallery.forms', compact('gallery', 'viewType', 'title', 'active'));
    }

    public function update(Gallery $gallery, Request $request){
        $data = $this->validate($request, $this->passingData);
        if ($request->hasFile('image')) {
            Storage::delete($gallery->image);
            $data['image'] = $request->file('image')->store('uploads/presenter');
        }
        $gallery->update($data);
        return redirect(route('panel.gallery.show', $gallery->id))->with('success', 'Gallery updated successfully');
    }
    
    public function delete(Gallery $gallery){
        $gallery->delete();
        return redirect(route('panel.gallery.index'))->with('success', 'Gallery deleted successfully');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = Gallery::get();
            return DataTables::of($data)
                ->addIndexColumn()                
                ->rawColumns(['image', 'order', 'status', 'action'])
                ->editColumn('image', function ($row) {
                    $image = '<img src="'.asset("storage/". $row->image).'" class="img-fluid" style="width:75px;height:75px;object-fit: contain;" alt="user photo">';
                    return $image;
                })
                ->editColumn('status', function ($row) {
                    return [
                        get_list_status()[$row->status],
                    ];
                })
                ->addColumn('action', function ($row) {
                    $btn = '
                    <div class="d-flex align-items-center">
                        <a href="'.route('panel.gallery.show',[$row->id]).'" class="btn btn-info btn-edit mb-0 me-2"><i class="fas fa-eye"></i></a>
                        <a href="'.route('panel.gallery.edit',[$row->id]).'" class="btn btn-primary btn-edit mb-0 me-2"><i class="fas fa-edit"></i></a>
                        <form action="'.route('panel.gallery.delete', [$row->id]).'" method="POST">
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
