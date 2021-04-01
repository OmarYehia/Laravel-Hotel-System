@if(Auth::guard("user")->user()->can("manage receptionists"))
@extends('layout.main')

@section('title', 'Hotel Transylvania')

@section('bread-crumps')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
    <li class="breadcrumb-item active">Receptionist List</li>
</ol>
@endsection

@section('content')

<table class="table table-bordered data-table" id="data-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>National ID</th>
            <th>Created By</th>
            <th width="280px">Actions</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

@endsection

@section('script')
<script>
$(function() {

    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });

    var table = $('#data-table').DataTable({
        ajax: "{{ route('receptionists.index') }}",
        dataSrc: 'data',
        columns: [{
                data: 'id'
            },
            {
                data: 'name',
            },
            {
                data: 'email',
            },
            {
                data: 'national_id',
            },
            {
                data: "created_by.name",
            },
            {
                data: 'action',
                orderable: false,
                searchable: false
            },
        ],
        // This condition to show the buttons for only the person who created user or if he's a super admin
        @if(!Auth::guard("user")->user()->can("manage managers"))// Conditions applies to only managers
        initComplete: function(settings, json) {
            const currentUserID = "{{ Auth::guard('user')->user()->id }}";
            const actionBtns = Array.from(document.getElementsByClassName("actionBtn"))
            actionBtns.forEach(btn => {
                // Buttons are removed if he's not the person who created the users
                if (currentUserID !== btn.getAttribute('created-by')) {
                    $(btn).remove();
                }
            })
        }
        @endif
    });
    
    
    // $('#createNewProduct').click(function() {
        //     $('#saveBtn').val("create-product");
        //     $('#product_id').val('');
        //     $('#productForm').trigger("reset");
        //     $('#modelHeading').html("Create New Product");
        //     $('#ajaxModel').modal('show');
        // });
        
        // $('body').on('click', '.editProduct', function() {
            //     var product_id = $(this).data('id');
            //     $.get("" + '/' + product_id + '/edit', function(data) {
                //         $('#modelHeading').html("Edit Product");
                //         $('#saveBtn').val("edit-user");
                //         $('#ajaxModel').modal('show');
                //         $('#product_id').val(data.id);
                //         $('#name').val(data.name);
                //         $('#detail').val(data.detail);
                //     })
                // });
                
                // $('#saveBtn').click(function(e) {
                    //     e.preventDefault();
                    //     $(this).html('Sending..');
                    
                    //     $.ajax({
                        //         data: $('#productForm').serialize(),
                        //         url: "",
                        //         type: "POST",
                        //         dataType: 'json',
                        //         success: function(data) {
                            
                            //             $('#productForm').trigger("reset");
                            //             $('#ajaxModel').modal('hide');
                            //             table.draw();
                            
                            //         },
                            //         error: function(data) {
                                //             console.log('Error:', data);
                                //             $('#saveBtn').html('Save Changes');
                                //         }
                                //     });
                                // });
                                
                                // $('body').on('click', '.deleteProduct', function() {
                                    
                                    //     var product_id = $(this).data("id");
                                    //     confirm("Are You sure want to delete !");
                                    
                                    //     $.ajax({
                                        //         type: "DELETE",
                                        //         url: "" + '/' + product_id,
                                        //         success: function(data) {
                                            //             table.draw();
                                            //         },
                                            //         error: function(data) {
                                                //             console.log('Error:', data);
                                                //         }
                                                //     });
                                                // });
                                                
                                            });
</script>
@endsection
@endif 