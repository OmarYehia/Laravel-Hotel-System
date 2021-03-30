@extends('layout.main')

@section('title', 'Hotel Transylvania')

@section('bread-crumps')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
    <li class="breadcrumb-item active">Register Staff</li>
</ol>
@endsection

@section('content')
<div class="">
    <form action="{{ route('admin.store') }}" method="POST" class="row justify-content-center">
        @csrf
        <div class="col-md-8">
            <div class="card card-secondary ">
                <div class="card-header">
                    <h3 class="card-title">Add a new staff member</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                            <i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Name -->
                    <div class="form-group">
                        <label for="employee-name">Employee Name</label>
                        <input type="text" id="employee-name" name="name" class="form-control">
                    </div>
                    <!-- Email -->
                    <div class="form-group">
                        <label for="employee-email">Employee Email</label>
                        <input type="email" id="employee-email" name="email" class="form-control">
                    </div>
                    <!-- Password -->
                    <div class="form-group">
                        <label for="employee-password">Password</label>
                        <input type="password" id="employee-password" name="password" class="form-control">
                    </div>
                    <!-- National ID -->
                    <div class="form-group">
                        <label for="employee-nid">National ID</label>
                        <input type="text" id="employee-nid" name="national_id" class="form-control">
                    </div>
                    <!-- Avatar Img -->
                    <div class="form-group">
                        <label for="avatar-img">Avatar Image (optional)</label>
                        <input id="avatar-img" type="file" class="form-control border-0" name="avatar_image">
                    </div>
                    <!-- Role -->
                    <div class="form-group">
                        <label for="role">Employee Role</label>
                        <select class="form-control custom-select" name="role">
                            @if(Auth::guard('user')->user()->can('manage managers'))
                            <option>Manager</option>
                            @endif
                            @if(Auth::guard('user')->user()->can('manage receptionists'))
                            <option>Receptionist</option>
                            @endif
                        </select>
                    </div>

                    <div class="col-4 mx-auto">
                        <button type="submit" class="btn btn-dark btn-block">Add Staff Member</button>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </form>
</div>
@endsection