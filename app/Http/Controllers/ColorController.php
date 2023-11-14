<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ColorController extends Controller
{
    protected $passingData;
    public function __construct()
    {
        $this->passingData = [
            'name' => 'required',
            'status' => 'required|numeric',
        ];
    }

    public function index(){
        $title = 'Data Color';
        $active = 'color';
        return view('admin.color.index', compact('title', 'active'));
    }

    public function create(){
        $title = 'Create Color';
        $viewType = 'create';
        $active = 'color';
        return view('admin.color.forms', compact('viewType', 'title', 'active'));
    }

    public function show(Color $color){
        $title = 'Show Color';
        $viewType = 'show';
        $active = 'color';
        return view('admin.color.forms', compact('color', 'viewType', 'title', 'active'));
    }

    public function store(Request $request){
        $data = $this->validate($request, $this->passingData);
        $getColor = Color::create($data);
        return redirect(route('panel.color.show', $getColor->id))->with('success', 'Color created successfully');
    }

    public function edit(Color $color){
        $title = 'Edit Color';
        $viewType = 'edit';
        $active = 'color';
        return view('admin.color.forms', compact('color', 'viewType', 'title', 'active'));
    }

    public function update(Color $color, Request $request){
        $data = $this->validate($request, $this->passingData);
        $color->update($data);
        return redirect(route('panel.color.show', $color->id))->with('success', 'Color updated successfully');
    }
    
    public function delete(Color $color){
        $color->delete();
        return redirect(route('panel.color.index'))->with('success', 'Color deleted successfully');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = Color::get();
            return DataTables::of($data)
                ->addIndexColumn()                
                ->rawColumns(['name', 'status', 'action'])
                ->editColumn('status', function ($row) {
                    return [
                        get_list_status()[$row->status],
                    ];
                })
                ->addColumn('action', function ($row) {
                    $btn = '
                    <div class="d-flex align-items-center">
                        <a href="'.route('panel.color.show',[$row->id]).'" class="btn btn-info btn-edit mb-0 me-2"><i class="fas fa-eye"></i></a>
                        <a href="'.route('panel.color.edit',[$row->id]).'" class="btn btn-primary btn-edit mb-0 me-2"><i class="fas fa-edit"></i></a>
                        <form action="'.route('panel.color.delete', [$row->id]).'" method="POST">
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
