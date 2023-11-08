@extends('admin.layouts')
@section('title', $title)
@section('content')
<h1 class="h3 mb-3">FAQ</h1>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="mb-0">{{$title}}</h4>
                <a href="{{route('panel.faq.create')}}" class="btn btn-primary"><i class="fas fa-plus text-white ml-0"></i> Create</a>        
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Content</th>
                                <th>Order</th>
                                <th>Status</th>
                                <th>Aksi</th>
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
                ajax: "{{ route('panel.faq.data') }}/",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', class:"align-middle"},
                    {data: 'title', name: 'title', class:"align-middle"},
                    {data: 'content', name: 'content', class:"align-middle"},
                    {data: 'order', name: 'order', class:"align-middle"},
                    {data: 'status', name: 'status', class:"align-middle"},
                    {data: 'action', name: 'action', class:"align-middle"},
                ]
            }); 
        }
        datatable()
    </script>
@endsection