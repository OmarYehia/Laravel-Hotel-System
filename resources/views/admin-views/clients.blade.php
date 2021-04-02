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

@if(Auth::guard('user')->user()->banned_at)
    <h1>YOU ARE BANNED, PLEASE CONTACT ADMIN</h1>
    @endsection
@else
    <table id="table" class="display table-bordered data-table">
        <thead>
            <form id="form" name="form">
                <input type="hidden" name="approved_by" id="approved_by">
                <input type="hidden" name="approval_status" id="approval_status">
            </form>
            <tr>
                <th>#</th>
                <th>Client Id</th>
                <th>Client Name</th>
                <th>Country</th>
                <th>Gender</th>
                <th>Phone Number</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>
@endsection
@endif

@section('script')
    <script type="text/javascript">
        $(function() {
            var table = $('.data-table').DataTable({
                ajax: "{{ route('clients.proposals') }}",
                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'id'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: "country"
                    },
                    {
                        data: "gender"
                    },
                    {
                        data: "phone_number"
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });


            $('body').on('click', '.approveClient', function(e) {
                e.preventDefault();
                console.log('inside');
                var product_id = $(this).data("id");
                $('#approved_by').val({{ Auth::guard('user')->user()->id }});
                $('#approval_status').val('approved');
                console.log($('#form').serialize());
                $.ajax({
                    data: $('#form').serialize(),
                    url: "api/users/approve/"+product_id,
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        console.log('success');
                        $('#form').trigger("reset");
                        location.reload();
                        alert("Request Accepted!")
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            });
            $('body').on('click', '.declineClient', function(e) {
                e.preventDefault();
                console.log('inside');
                var product_id = $(this).data("id");
                $('#approved_by').val({{ Auth::guard('user')->user()->id }});
                $('#approval_status').val('denied');
                console.log($('#form').serialize());
                confirm("Are You sure want to decline this client request?");

                $.ajax({
                    data: $('#form').serialize(),
                    url: "api/users/decline/"+product_id,
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        console.log('success');
                        $('#form').trigger("reset");
                        location.reload();
                        alert("Request Denied!")
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            });

            /*
                        $('body').on('click', '.approveClient', function() {
                            var product_id = $(this).data("id");
                            console.log(product_id);
                            confirm("Are You sure want to approve this client?");

                            $.ajax({
                                type: "GET",
                                url: "api/users/approve" + '/' + product_id,
                                success: function(data) {
                                    if (data.message ===
                                        "Client doesnt exist!") {
                                        alert("Couldnt approve client please contatct server admin!");
                                    } else {
                                        location.reload();
                                        alert("Client Request Approved Successfully!");

                                    }
                                },
                                error: function(data) {
                                    console.log('Error:', data);
                                }
                            });
                        });*/
/*
            $('body').on('click', '.declineClient', function() {

                var product_id = $(this).data("id");
                confirm("Are You sure want to decline this client request?");

                $.ajax({
                    type: "GET",
                    url: "api/users/decline" + '/' + product_id,
                    success: function(data) {
                        if (data.message ===
                            "Client doesnt exist!") {
                            alert("Couldnt delete this client, please contact server admin!");
                        } else {
                            location.reload();
                            alert("Client request declined!");

                        }
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            });*/

        })

    </script>
@endsection
