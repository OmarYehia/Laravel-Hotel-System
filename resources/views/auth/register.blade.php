@extends('auth.layout.main')

@section('title', 'Hotel Transylvania | Register')

@section('content')
<div class="register-box my-5">
    <div class="register-logo mt-5">
        <a href="/"><b>Hotel</b>Transylvania</a>
    </div>


    <div class="card w-100 mb-5">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Register a new membership</p>

            <form action="{{route ('register')}}" method="post" enctype="multipart/form-data">
                @csrf
                <!-- Name Field -->
                @error('name')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('name') border-danger @enderror "
                        value="{{old('name')}}" placeholder="Full name" name="name">
                    <div class="input-group-append">
                        <div class="input-group-text @error('name') border-danger @enderror">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>

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


                <!-- Phone Number Field -->
                @error('phone_number')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('phone_number') border-danger @enderror "
                        value="{{old('phone_number')}}" placeholder="Phone-Number" name="phone_number">
                    <div class="input-group-append">
                        <div class="input-group-text @error('phone_number') border-danger @enderror">
                            <span class="fas fa-phone"></span>
                        </div>

                    </div>


                </div>
                <!-- Password Fields -->
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
                    <input type="password" class="form-control" placeholder="Retype password"
                        name="password_confirmation">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>

                </div>

                @error('gender')
                <div class="text-danger">
                    {{$message}}
                </div>
                @enderror
                <div class="input-group mb-3 d-flex justify-content-around align-items-center">
                    <!-- Gender Field -->
                    <div>

                        <input type="radio" id="male" name="gender" value="male">
                        <label for="male" class="mb-0">Male</label>
                    </div>
                    <div>

                        <input type="radio" id="female" name="gender" value="female">
                        <label for="female" class="mb-0">Female</label>
                    </div>
                </div>

                <!-- Country Field -->
                <div class="input-group mb-3">
                    @error('country')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                    @enderror
                    <div class="input-group mb-3">
                        <select class="form-control border-right @error('country') border-danger @enderror"
                            value="{{old('country')}}" name="country">
                            @foreach ($countries as $country)
                            <option value="{{$country ['name'] }}"> {{$country ['name'] }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Avatar Field -->

                <div class="input-group mb-3">
                    @error('avatar_image')
                    <div class="text-danger">
                        {{$message}}
                    </div>
                    @enderror
                    <label for="avatar" class="form-label text-md-right">{{ __('Avatar (optional)') }}</label>
                    <div class="w-100">
                        <input id="avatar" type="file" class="form-control border-0" name="avatar_image">
                    </div>
                </div>
                <div class="row ">
                    <!-- /.col -->
                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <div class="social-auth-links text-center">
                <p>- OR -</p>
                <a href="#" class="btn btn-block btn-danger">
                    <i class="fab fa-google-plus mr-2"></i>
                    Sign up using Google+
                </a>
            </div>

            <a href="{{ route('login') }}" class="text-center">I already have a membership</a>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
@endsection