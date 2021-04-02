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
            <tr>
                <th>#</th>
                <th>Floor Id</th>
                <th>Floor Name</th>
                <th>Created By</th>
                <th>Actions</th>
                @if(Auth::guard("user")->user()->can("manage managers"))
                <th>Manager Name</th>
                @endif

            </tr>
        </thead>
    </table>
    <div class="container" style="justify-content: center">
        <a class="btn btn-success" href="javascript:void(0)" id="createNewProduct"> Create New Floor</a>
    </div>
    
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="productForm" name="productForm" class="form-horizontal">
                   <input type="hidden" name="created_by" id="created_by">
                   <input type="hidden" name="floor_id" id="floor_id">

                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">FLoor Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="floor_name" placeholder="Enter Name" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <label for="name" class="col-sm-4 control-label">Manager Name</label>

                    <div style="padding-bottom: 20px">
                        <select class="form-control" id="post_creator"  name="floor_manager">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    </div>
                    
      
                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                     </button>
                     <button type="submit" class="btn btn-primary" id="updateBtn" value="create">Save updates
                    </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@endif

@section('script')
    <script type="text/javascript">
        $(function() {
            var table = $('.data-table').DataTable({
                ajax: "{{ route('manage.floors') }}",
                dataSrc: 'data',
                columns: [{
                        data: 'DT_RowIndex'
                    },
                    {
                        data: 'id'
                    },
                    {
                        data: 'floor_name'
                    },
                    {
                        data: "creator"
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                    @if(Auth::guard("user")->user()->can("manage managers"))
                    {
                        data: 'Manager Name'
                    },
                    @endif
                ],

                @if(!Auth::guard("user")->user()->can("manage managers"))

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

            $('#createNewProduct').click(function () {
                const currentUserID = "{{ Auth::guard('user')->user()->id }}";
                $("#updateBtn").hide();
                $('#saveBtn').show();
                $('#saveBtn').val("create-product");
                $('#created_by').val(currentUserID);
                $('#productForm').trigger("reset");
                $('#modelHeading').html("Create New Product");
                $('#ajaxModel').modal('show');
            });
            
    $('body').on('click', '.editProduct', function () {
      const floor_id = $(this).data('id');
      $("#updateBtn").show();
      $('#saveBtn').hide();
      $('#floor_id').val($(this).data('id'));
      $('#created_by').val($(this).attr('created-by'));
      $.get("api/floors" +'/' + floor_id, function (data) {
          $('#modelHeading').html("Edit Floor Data");
          $('#saveBtn').val("edit-floor");
          $('#ajaxModel').modal('show');
          $('#floor_name').val(data.name);
          $('#detail').val(data.detail);
      })
   });
    
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
        console.log($('#productForm').serialize());
        $.ajax({
          data: $('#productForm').serialize(),
          url: "{{ route('floors.store') }}" ,
          type: "POST",
          dataType: 'json',
          success: function (data) {
     
              $('#productForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              location.reload();
         
          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
      });
    });

    $('#updateBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
        const floor_id = $('#floor_id').val();
        console.log(floor_id);
        $.ajax({
          data: $('#productForm').serialize(),
          url: "api/floors"+'/' + floor_id ,
          type: "PUT",
          dataType: 'json',
          success: function (data) {
     
              $('#productForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              location.reload();
         
          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
      });
    });

    $('body').on('click', '.deleteProduct', function () {
     
        var product_id = $(this).data("id");
        confirm("Are You sure want to delete !");
      
        $.ajax({
            type: "DELETE",
            url: "api/floors"+'/'+product_id+'/delete',
            success: function (data) {
                if (data.message === "There are rooms associated with this floor, can not delete it!")
                {
                    alert("Floor is not empty, couldnt delete it!");
                }else{
                location.reload();
                alert("Floor is Deleted Successfully!");

                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

        });

    </script>
@endsection
