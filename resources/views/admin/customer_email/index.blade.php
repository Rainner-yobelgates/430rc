@extends('admin.layouts')
@section('title', $title)
@section('content')
<h1 class="h3 mb-3">Customer Email</h1>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="mb-0">{{$title}}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Email</th>
                                <th>Created At</th>
                            </tr>
                        </thead>                
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        function datatable() {
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('panel.customerEmail.data') }}/",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', class:"align-middle"},
                    {data: 'email', name: 'email', class:"align-middle"},
                    {data: 'created_at', name: 'created_at', class:"align-middle"},
                ]
            }); 
        }
        datatable()
    </script>
@endsection