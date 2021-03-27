@extends('layout.main')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Registration Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
  
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>


  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form action="{{route ('register')}}" method="post" enctype="multipart/form-data">
      @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control @error('name') border-danger @enderror " value="{{old('name')}}"  placeholder="Full name" name="name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          @error('name')
           <div class="text-danger">
          {{$message}}
           </div>
           @enderror
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control @error('email') border-danger @enderror " value="{{old('email')}}"  placeholder="Email" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          @error('email')
           <div class="text-danger">
          {{$message}}
           </div>
           @enderror
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control @error('phone_number') border-danger @enderror " value="{{old('phone_number')}}"  placeholder="Phone-Number" name="phone_number">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
          @error('phone_number')
           <div class="text-danger">
          {{$message}}
           </div>
           @enderror
        </div>
        <div class="input-group mb-3">
           <input type="radio" id="male" name="gender" value="male">
           <label for="male">Male</label>
           <input type="radio" id="female" name="gender" value="female">
           <label for="female">Female</label>
           @error('gender')
           <div class="text-danger">
          {{$message}}
           </div>
           @enderror
        </div> 
        
        <div class="input-group mb-3">
            <select class="form-control @error('country') border-danger @enderror " value="{{old('country')}}"  name="country" >
             @foreach ($countries as $country)
             <option  value="{{$country ['name'] }}"> {{$country ['name'] }} </option>
             @endforeach
            </select> 
            @error('country')
           <div class="text-danger">
          {{$message}}
           </div>
           @enderror
        </div>
        <div class="input-group mb-3">
            <label for="avatar" class="form-label text-md-right">{{ __('Avatar (optional)') }}</label>
              
            <input id="avatar" type="file" class="form-control" name="avatar_image" >
            @error('avatar_image')
           <div class="text-danger">
          {{$message}}
           </div>
           @enderror  
        </div>

        <input type="password" class="form-control @error('password') border-danger @enderror "  placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          @error('password')
           <div class="text-danger">
          {{$message}}
           </div>
           @enderror
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Retype password" name="password_confirmation">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div>

      <a href="login.html" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>

@endsection