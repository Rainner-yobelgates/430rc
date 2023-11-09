<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
    protected $passingData;
    public function __construct()
    {
        $this->passingData = [
            'title' => 'required',
            'content' => 'required',
            'order' => 'required|numeric',
            'status' => 'required|numeric',
        ];
    }

    public function index(){
        $title = 'Data FAQ';
        $active = 'faq';
        return view('admin.faq.index', compact('title', 'active'));
    }

    public function create(){
        $title = 'Create FAQ';
        $viewType = 'create';
        $active = 'faq';
        return view('admin.faq.forms', compact('viewType', 'title', 'active'));
    }

    public function show(Faq $faq){
        $title = 'Show FAQ';
        $viewType = 'show';
        $active = 'faq';
        return view('admin.faq.forms', compact('faq', 'viewType', 'title', 'active'));
    }

    public function store(Request $request){
        $data = $this->validate($request, $this->passingData);

        $getFaq = Faq::create($data);
        return redirect(route('panel.faq.show', $getFaq->id))->with('success', 'Faq created successfully');
    }

    public function edit(Faq $faq){
        $title = 'Edit FAQ';
        $viewType = 'edit';
        $active = 'faq';
        return view('admin.faq.forms', compact('faq', 'viewType', 'title', 'active'));
    }

    public function update(Faq $faq, Request $request){
        $data = $this->validate($request, $this->passingData);
        
        $faq->update($data);
        return redirect(route('panel.faq.show', $faq->id))->with('success', 'Faq created successfully');
    }
    
    public function delete(Faq $faq){
        $faq->delete();
        return redirect(route('panel.faq.index'))->with('success', 'Faq deleted successfully');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = Faq::get();
            return DataTables::of($data)
                ->addIndexColumn()                
                ->rawColumns(['title', 'order', 'status', 'action'])
                ->editColumn('status', function ($row) {
                    return [
                        get_list_status()[$row->status],
                    ];
                })
                ->editColumn('content', function ($row) {
                    return [
                        Str::limit($row->content,30),
                    ];
                })
                ->addColumn('action', function ($row) {
                    $btn = '
                    <div class="d-flex align-items-center">
                        <a href="'.route('panel.faq.edit',[$row->id]).'" class="btn btn-primary btn-edit mb-0 me-2"><i class="fas fa-edit"></i></a>
                        <form action="'.route('panel.faq.delete', [$row->id]).'" method="POST">
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
