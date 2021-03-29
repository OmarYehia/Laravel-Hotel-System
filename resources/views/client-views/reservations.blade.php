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
<table id="table" class="display">
    <thead>
        <tr>
            <th>Room Number</th>
            <th>Floor Name</th>
            <th>Paid Price</th>
            <th>Accompany Number</th>
            <th>Reservation Date</th>
        </tr>
    </thead>
</table>
@endsection

@section('script')
<script>
$(document).ready(function() {

    $('#table').DataTable({
        ajax: "/api/clients/{{ Auth::guard('client')->user()->id }}/reservations",
        columns: [{
                "data": "room.room_number"
            },
            {
                "data": "room.floor.floor_name"
            },
            {
                "data": "paid_price"
            },
            {
                "data": "accompany_number"
            },
            {
                "data": "reservation_date"
            }
        ]
    });
});
</script>
@endsection