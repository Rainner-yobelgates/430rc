<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerEmail;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class CustomerEmailController extends Controller
{
    public function index(){
        $title = 'Data Customer Email';
        $active = 'customer-email';
        return view('admin.customer_email.index', compact('title', 'active'));
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = CustomerEmail::get();
            return DataTables::of($data)
                ->addIndexColumn()                
                ->rawColumns(['email', 'created_at'])
                ->editColumn('created_at', function ($row) {
                    return [
                        date('d-m-Y H:i:s', strtotime($row->created_at)),
                    ];
                })
                ->make(true);
        }
    }
}
