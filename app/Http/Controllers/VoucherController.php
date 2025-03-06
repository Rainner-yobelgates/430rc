<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class VoucherController extends Controller
{
    protected $passingData;
    public function __construct()
    {
        $this->passingData = [
            'name' => 'required',
            'code' => 'required',
            'amount' => 'required|numeric',
            'status' => 'required|numeric',
        ];
    }

    public function index(){
        $title = 'Data Voucher';
        $active = 'voucher';
        return view('admin.voucher.index', compact('title', 'active'));
    }

    public function create(){
        $title = 'Create Voucher';
        $viewType = 'create';
        $active = 'voucher';
        return view('admin.voucher.forms', compact('viewType', 'title', 'active'));
    }

    public function show(Voucher $voucher){
        $title = 'Show Voucher';
        $viewType = 'show';
        $active = 'voucher';
        return view('admin.voucher.forms', compact('voucher', 'viewType', 'title', 'active'));
    }

    public function store(Request $request){
        $data = $this->validate($request, $this->passingData);
        $getVoucher = Voucher::create($data);
        return redirect(route('panel.voucher.show', $getVoucher->id))->with('success', 'Voucher created successfully');
    }

    public function edit(Voucher $voucher){
        $title = 'Edit Voucher';
        $viewType = 'edit';
        $active = 'voucher';
        return view('admin.voucher.forms', compact('voucher', 'viewType', 'title', 'active'));
    }

    public function update(Voucher $voucher, Request $request){
        $data = $this->validate($request, $this->passingData);
        $voucher->update($data);
        return redirect(route('panel.voucher.show', $voucher->id))->with('success', 'Voucher updated successfully');
    }
    
    public function delete(Voucher $voucher){
        if ($voucher->image) {
            Storage::delete($voucher->image);
        }
        $voucher->delete();
        return redirect(route('panel.voucher.index'))->with('success', 'Voucher deleted successfully');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = Voucher::get();
            return DataTables::of($data)
                ->addIndexColumn()                
                ->rawColumns(['name', 'code', 'amount', 'status', 'action'])
                ->editColumn('amount', function ($row) {
                    return [
                        'Rp. ' . number_format($row->amount),
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
                        <a href="'.route('panel.voucher.show',[$row->id]).'" class="btn btn-info btn-edit mb-0 me-2"><i class="fas fa-eye"></i></a>
                        <a href="'.route('panel.voucher.edit',[$row->id]).'" class="btn btn-primary btn-edit mb-0 me-2"><i class="fas fa-edit"></i></a>
                        <form action="'.route('panel.voucher.delete', [$row->id]).'" method="POST">
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
