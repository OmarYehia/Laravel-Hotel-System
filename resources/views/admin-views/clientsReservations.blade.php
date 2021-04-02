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
    <table id="table" class="display table-bordered data-table">
        <thead>
            <form id="form" name="form">
                <input type="hidden" name="approved_by" id="approved_by">
                <input type="hidden" name="approval_status" id="approval_status">
            </form>
            <tr>
                <th>#</th>
                <th>Room Id</th>
                <th>Client Id</th>
                <th>Client Name</th>
                <th>Client Phone no.</th>
                <th>Paid Price</th>
                <th>Accompany Number</th>
                <th>Reservation Date</th>
            </tr>
        </thead>
    </table>
@endsection

@section('script')
    <script type="text/javascript">
        $(function() {
            var table = $('.data-table').DataTable({
                ajax: "{{ route('reservations',['receptionistID' => Auth::guard('user')->user()->id]) }}",
                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'room_id'
                    },
                    {
                        data: 'client_id'
                    },
                    {
                        data: "client name"
                    },
                    {
                        data: "client phone number"
                    },
                    {
                        data: "paid_price"
                    },
                    {
                        data: "accompany_number"
                    },
                    {
                        data: "reservation_date"
                    },
                ]
            });
        })

    </script>
@endsection
