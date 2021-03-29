@extends('layout.main')

@section('title', 'Hotel Transylvania')

@section('content-title', 'My Reservations')

@section('bread-crumps')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="/home">Home</a></li>
    <li class="breadcrumb-item active">My Reservations</li>
</ol>
@endsection
@section('content')
<table id="table" class="display data-table">
    <thead>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>manager</th>
            <th>created by</th>
            <th>actions</th>
        </tr>
    </thead>

</table>
@endsection

@section('script')
<script type="text/javascript">
$(function () {
    
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'floor_name', name: 'floor_name'},
            {data: 'floor_manager', name: 'floor_manager'},
            {data: 'created_by', name: 'created_by'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
  });
</script>
@endsection