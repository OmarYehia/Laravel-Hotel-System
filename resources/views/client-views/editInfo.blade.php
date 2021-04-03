@extends('layout.main')

@section('title', 'Hotel Transylvania')

@section('content-title', 'Edit Information')

@section('bread-crumps')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="/home">Home</a></li>
    <li class="breadcrumb-item active">Edit Information</li>
</ol>
@endsection
@section('content')

<form action="" method="" class="row justify-content-center" id="form">
    @csrf
    @method('PUT')
    <div class="col-md-5">
        <div class="card card-secondary ">
            <div class="card-header">
                <h3 class="card-title">Edit Information Form</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="errors text-danger mb-2">
                        
                </div>
                <div class="success text-success text-center mb-2">
                        
                </div>
                <!-- Name -->
                <div class="form-group">
                    <label for="name">Name</label>
                    
                    <input type="text" id="name" name="name" class="form-control" value="{{ $client->name }}">
                </div>
                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ $client->email }}">
                </div>
                <!-- Phone Number -->
                <div class="form-group">
                    <label for="email">Phone Number</label>
                    <input type="text" id="phone_number" name="phone_number" class="form-control" value="{{ $client->phone_number }}">
                </div>
                <!-- Avatar Img -->
                <div class="form-group">
                    <label for="avatar-img">Avatar Image (optional)</label>
                    <input id="avatar-img" type="file" class="form-control border-0" name="avatar_image">
                </div>

                <div class="col-4 mx-auto">
                    <button type="submit" id="saveBtn" class="btn btn-dark btn-block">Update Information</button>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</form>

@endsection

@section('script')
<script>
$(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#saveBtn').click(function(e) {
        e.preventDefault();
        $(this).html('Sending..');
        $.ajax({
            data: $('#form').serialize(),
            url: `/clients/{{ Auth::guard('client')->user()->id }}`,
            type: "PUT",
            dataType: 'json',
            success: function(data) {
                $('#form').trigger("reset");
                $('.success').append('<p>Information updated successfully!</p>')
                setTimeout(() => {
                    location.reload();
                }, 1000);
            },
            error: function(data) {
                for (const [key, value] of Object.entries(data.responseJSON.errors)) {
                    $(".errors").append(`${value}<br>`);
                }
            },
        });
    });          
});
</script>
@endsection