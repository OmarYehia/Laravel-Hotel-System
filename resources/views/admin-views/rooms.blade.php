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
            <tr>
                <th>#</th>
                <th>room number</th>
                <th>room price</th>
                <th>room capacity</th>
                <th>floor id</th>
                @if(Auth::guard("user")->user()->can("manage managers"))
                <th>manager name</th>
                @endif
                <th>is reserved</th>
                <th>actions</th>
            </tr>
        </thead>
    </table>
    <div class="container" style="justify-content: center">
        <a class="btn btn-success" href="javascript:void(0)" id="createNewProduct"> Create New Room</a>
    </div>
    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    
                    <form id="productForm" name="productForm" class="form-horizontal">
                        <input type="hidden" name="room_id" id="room_id">

                        <div class="form-group">
                            <label for="name" class="col-sm-4 control-label">Room Number</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="room_number" placeholder="Enter Name" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-4 control-label">Room Price</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="room_price" placeholder="Enter Name" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-4 control-label">Room Capacity</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="room_capacity" placeholder="Enter Name" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-4 control-label">Floor Name</label>
                            <select class="form-control" id="post_creator"  name="floor_id">
                                @foreach ($floors as $floor)
                                    <option value="{{ $floor->id }}">{{ $floor->floor_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <label for="name" class="col-sm-4 control-label">Manager Name</label>
    
                        <div style="padding-bottom: 20px">
                            <select class="form-control" id="post_creator"  name="created_by">
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

@section('script')
    <script type="text/javascript">
        $(function() {
            var table = $('.data-table').DataTable({
                ajax: "{{ route('manage.rooms') }}",
                dataSrc: 'data',
                columns: [
                    {
                        data: 'DT_RowIndex'
                    },
                    {
                        data: "room_number"
                    },
                    {
                        data : 'room_price'
                    },
                    {
                        data : 'room_capacity'
                    },
                    {
                        data : 'floor_id'
                    },
                    @if(Auth::guard("user")->user()->can("manage managers"))
                    {
                        data : 'creator'
                    },
                    @endif
                    {
                        data : 'is_reserved'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                    }
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
                $('#modelHeading').html("Create New Room");
                $("#updateBtn").hide();
                $('#saveBtn').show();
                $('#saveBtn').val("create-product");
                $('#productForm').trigger("reset");
                $('#modelHeading').html("Create New Product");
                $('#ajaxModel').modal('show');
            });
            
    $('body').on('click', '.editProduct', function () {
      const room_id = $(this).data('id');
      $("#updateBtn").show();
      $('#saveBtn').hide();
      $('#room_id').val($(this).data('id'));
      $.get("api/rooms" +'/' + room_id, function (data) {
          $('#modelHeading').html("Edit Room Data");
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
          url: "{{ route('rooms.store') }}" ,
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
        const room_id = $('#room_id').val();
        console.log(room_id);
        $.ajax({
          data: $('#productForm').serialize(),
          url: "api/rooms"+'/' + room_id ,
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
     
        var room_id = $(this).data("id");
        confirm("Are You sure want to delete !");
      
        $.ajax({
            type: "DELETE",
            url: "api/rooms"+'/'+room_id,
            success: function (data) {
                if (data.message === "Room is reserved Cannot be deleted!")
                {
                    alert("Room is Reserved, Cannot delete it!");
                }else{
                location.reload();
                alert("Room is Deleted Successfully!");

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
