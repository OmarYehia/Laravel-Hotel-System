@extends('auth.layout.main')

@section('title', 'Hotel Transylvania | Login')

@section('content')
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
            @isset($url)
            <form action='{{ url("login/$url") }}' method="POST">
                @else
                <form method="POST" action="{{ route('login') }}">
                    @endisset
                    @csrf
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
                        <input type="password" class="form-control @error('password') border-danger @enderror "
                            placeholder="Password" name="password">
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
            <a href="{{route ('forget-password') }}">I forgot my password</a>
        </p>
        <p class="mb-0">
            <a href="{{ route ('register') }}" class="text-center">Register a new membership</a>
        </p>
    </div>
    <!-- /.login-card-body -->
</div>
</div>
@endsection