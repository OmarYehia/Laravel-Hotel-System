<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admin-lte-resources/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('admin-lte-resources/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin-lte-resources/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="/"><b>Hotel</b>Transylvania</a>
  </div>
  @if(session('status'))
    <div class="text-danger">
      {{session('status')}}
    </div>

@endif  
  <!-- /.login-logo -->
  <div class="card p-4">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="{{route ('login') }}" method="post">
      @csrf
        @error('email')
        <div class="text-danger">
        {{$message}}
        </div>
        @enderror
        <div class="input-group mb-3">
          <input type="email" class="form-control @error('email') border-danger @enderror " value="{{old('email')}}" placeholder="Email" name="email">
          <div class="input-group-append">
            <div class="input-group-text @error('email') border-danger @enderror">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        @error('password')
         <div class="text-danger">
        {{$message}}
         </div>
         @enderror
        <div class="input-group mb-3">
          <input type="password" class="form-control @error('password') border-danger @enderror " placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text @error('email') border-danger @enderror">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" name="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="/">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="/" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('/admin-lte-resources/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('/admin-lte-resources/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/admin-lte-resources/dist/js/adminlte.min.js') }}"></script>
</body>
</html>
