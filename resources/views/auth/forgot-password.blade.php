@extends('layout.main')

@section('title', 'Hotel Transylvania | forgot password')

@section('content')

  @if (session('status'))
    <div class="alert alert-success" role="alert">
      {{ session('status') }}
    </div>
   @endif

  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

      <form action="{{ route ('forget-password') }}" method="post">
        @csrf
        @error('email')
          <div class="text-danger">
            {{$message}}
          </div>
            @enderror
        <div class="input-group mb-3">
          <input type="email" class="form-control @error('email') border-danger @enderror " placeholder="Email" name="email">
          <div class="input-group-append">
            <div class="input-group-text @error('email') border-danger @enderror">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Request new password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="{{ route ('login.client') }}">Login</a>
      </p>
      <p class="mb-0">
        <a href="{{ route ('register') }}" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
@endsection

