@extends('layout.main')

@section('title', 'Hotel Transylvania')
@if(Auth::guard('client')->user()->approval_status==="pending" || Auth::guard('client')->user()->approval_status==="denied")

@section('content-title', 'My Reservations')
@section('content')

<h1>Your request is still pending, Stay tuned!</h1>

@endsection
@else
@section('bread-crumps')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
    <li class="breadcrumb-item active">My Reservations</li>
</ol>
@endsection

@section('content')

<table class="table table-bordered data-table" id="data-table">
    <thead>
        <tr>
            <th>#</th>
            <th>Room Number</th>
            <th>Floor Number</th>
            <th>Paid Price</th>
            <th>Accompany Number</th>
            <th>Reservation Date</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
@endsection

@section('script')
<script>
$(function() {
    var table = $('#data-table').DataTable({
        ajax: "{{ route('client.reservations') }}",
        dataSrc: 'data',
        columns: [{
                data: 'DT_RowIndex'
            },
            {
                data: 'room_number',
            },
            {
                data: 'floor_name',
            },
            {
                data: 'paid_price',
            },
            {
                data: "accompany_number",
            },
            {
                data: "reservation_date",
            },
        ],
    });
});
</script>
@endsection
@endif 
