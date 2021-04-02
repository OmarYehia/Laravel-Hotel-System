@extends('layout.main')

@if(Auth::guard('client')->user()->approval_status==="pending")
@section('title', 'Hotel Transylvania')

@section('content-title', 'My Reservations')
@section('content')

<h1>Your request is still pending, Stay tuned!</h1>

@endsection
@else
    
@section('title', 'Hotel Transylvania')

@section('content-title', 'My Reservations')

@section('bread-crumps')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="/home">Home</a></li>
    <li class="breadcrumb-item active">Available Rooms</li>
</ol>
@endsection
@section('content')
<table id="data-table" class="table table-bordered data-table">
    <thead>
        <tr>
            <th>Room Number</th>
            <th>Room Price</th>
            <th>Room Capacity</th>
        </tr>
    </thead>
</table>
@endsection

@section('script')
<script type="text/javascript">
$(function () {
    
    var table = $('#data-table').DataTable({
        ajax: "{{ route('ajaxavailablerooms.index') }}",
        dataSrc: 'data',
        columns: [
            {data: 'room_number'},
            {data: 'room_price'},
            {data: 'room_capacity'},
        ]
        
    });
    
  });
</script>
@endsection
@endif
