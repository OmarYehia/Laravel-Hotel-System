@extends('layout.main')

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
            <th width="280px">Actions</th>
        </tr>
    </thead>
</table>

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
                        <label for="name" class="col-sm-6 control-label">Enter the Capacity you want</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="capacity" name="capacity" placeholder="Enter Capacity" value="" maxlength="50" required="">
                        </div>
                    </div>
     
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Price</label>
                        <div class="col-sm-12">
                        <input type="text" class="form-control" id="price" name="price"  maxlength="50" value="John" disabled >
                        </div>
                    </div>
      
                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Book this Room
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
$(function () {
    
    var table = $('#data-table').DataTable({
        ajax: "{{ route('ajaxavailablerooms.index') }}",
        dataSrc: 'data',
        columns: [
            {
                data: 'room_number'
            },
            {
                data: 'room_price'
            },
            {
                data: 'room_capacity'
            },
            {
                data: 'action',
                orderable: false,
                searchable: false
            },
        ]
        
    })
   
    $('body').on('click', '.bookRoom', function () {
      var room_id = $(this).data('id');
      $.get("api/rooms" +'/' + room_id , function (data) {
          console.log(data.data.room_price);
          $('#modelHeading').html("Book the Room");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#room_id').val(data.data.id);
          $('#price').val(data.data.room_price);
      })
   })
   $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Booking..');
    
        $.ajax({
          data: $('#productForm').serialize(),
          url: "/stripe-payment",
          type: "get",
          dataType: 'json',
          success: function (data) {
     
              $('#productForm').trigger("reset");
              $('#ajaxModel').modal('hide');
              table.draw();
         
          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Book this Room');
          }
      });
    });
   
  });
</script>
@endsection