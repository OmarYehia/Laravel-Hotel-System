@if(Auth::guard("user")->user()->can("manage managers"))
@extends('layout.main')

@section('title', 'Hotel Transylvania')

@section('bread-crumps')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
    <li class="breadcrumb-item active">Manager List</li>
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

<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <div class="errors text-danger mb-2">
                        
                </div>
                <form id="managerForm" name="managerForm" class="form-horizontal">
                   <input type="hidden" name="manager_id" id="manager_id">
                    <div class="form-group">
                        <label for="name" class="col-5 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-5control-label">Email</label>
                        <div class="col-sm-12">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-5 control-label">National ID</label>
                        <div class="col-sm-12">
                            <input type="email" class="form-control" id="national_id" name="national_id" placeholder="National ID" value="" maxlength="50" required="">
                        </div>
                    </div>
      
                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
$(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var table = $('#data-table').DataTable({
        ajax: "{{ route('managers.index') }}",
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
         // Conditions applies to only managers
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
    });
        
    $('body').on('click', '.editManager', function() {
    const managerID = $(this).data('id');
    $.get(`/managers/${managerID}`, function(data) {
        $('#modelHeading').html("Edit Manager Data");
        $('#saveBtn').val("edit-user");
        $('#ajaxModel').modal('show');
        $('#manager_id').val(data.data.id);
        $('#name').val(data.data.name);
        $('#email').val(data.data.email);
        $('#national_id').val(data.data.national_id);
        })
    });
                
    $('#saveBtn').click(function(e) {
        e.preventDefault();
        $(this).html('Sending..');
        $.ajax({
            data: $('#managerForm').serialize(),
            url: `/managers/${$('#manager_id').val()}`,
            type: "PUT",
            dataType: 'json',
            success: function(data) {
                $('#managerForm').trigger("reset");
                $('#ajaxModel').modal('hide');
                location.reload();
            },
            error: function(data) {
                for (const [key, value] of Object.entries(data.responseJSON.errors)) {
                    $(".errors").append(`${value}<br>`);
                }
                $('#saveBtn').html('Save Changes');
            },
        });
    });
                
    $('body').on('click', '.deleteManager', function() {
        const managerID = $(this).data("id");
        const agree = confirm("Are You sure want to delete ?");
        if(agree){
            $.ajax({
                type: "DELETE",
                url: `/managers/${managerID}`,
                success: function(data) {
                    location.reload();
                },
                error: function(data) {
                    alert(data.responseJSON.message);
                    console.log('Error:', data);
                }
            });
        }
    });
                    
});
</script>
@endsection
@endif 