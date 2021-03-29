@extends('auth.layout.main')

@section('title', 'Hotel Transylvania | Reset Password')

@section('content')


@if (session('status'))
    <div class="alert alert-success" role="alert">
      {{ session('status') }}
    </div>
   @endif
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>

      <form action="{{ route ('reset-password') }}" method="post">

      @csrf
      <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group row">
       <!-- Email Field -->
       @error('email')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror
                <div class="input-group mb-3">
                    <input type="email" class="form-control @error('email') border-danger @enderror "
                        value="{{old('email')}}" placeholder="Email" name="email">
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
          <input type="password" class="form-control @error('password') border-danger @enderror"
           placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text @error('password') border-danger @enderror">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Confirm Password"  name="password_confirmation">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Change password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="login.html">Login</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

@endsection