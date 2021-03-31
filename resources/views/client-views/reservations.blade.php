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
            @if (\Request::route()->getName() == "manage.floors")
            <th>id</th>
            <th>name</th>
            <th>manager</th>
            <th>created by</th>
            @role('admin')
            <th>actions</th>
            @endrole
            @endif
            @if (\Request::route()->getName() == "manage.rooms")
            <th>id</th>
            <th>room number</th>
            <th>room price</th>
            <th>room capacity</th>
            @if(Auth::guard('user')->user()->can('manage managers'))
                <th>actions</th>
            @endif
            @endif
            @if (\Request::route()->getName() == "manage.receptionists")
            <th>id</th>
            <th>name</th>
            <th>email</th>
            @role('admin')
            <th>created by</th>
            @endrole
            <th>actions</th>
            @endif
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
        @if (\Request::route()->getName() == "manage.floors")
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'floor_name', name: 'floor_name'},
            {data: 'floor_manager', name: 'floor_manager'},
            {data: 'created_by', name: 'created_by'},
            @role('admin')
            {data: 'action', name: 'action', orderable: false, searchable: false},
            @endrole
        ]
        @endif
        @if (\Request::route()->getName() == "manage.rooms")
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'room_number', name: 'room_number'},
            {data: 'room_price', name: 'room_price'},
            {data: 'room_capacity', name: 'room_capacity'},
            @if(Auth::guard('user')->user()->can('manage managers'))
            {data: 'action', name: 'action', orderable: false, searchable: false},
            @endif
        ]
        @endif
        @if (\Request::route()->getName() == "manage.receptionists")
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            @role('admin')
            {data: 'created_by', name: 'created_by'},
            @endrole
            {data: 'action', name: 'action', orderable: false, searchable: false},
           
        ]
        @endif
    });
    
  });
</script>
@endsection