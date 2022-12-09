@extends('user.userLayout')
@section('content')
<div class="container my-4">
    <div class="row align-items-center rounded-4 p-5 border shadow-lg">
        <div class="col-lg-7 text-center text-lg-start">
            <h1 class="display-4 fw-bold lh-1 mb-3">Welcome Back!</h1>
            <p class="col-lg-10 lead">
                Login to your account with your account details to enter. You may use your email or phone number to enter.
            </p>
        </div>
        <div class="col-md-10 mx-auto col-lg-5">
            <form id="loginForm" method="POST" action="{{ route('login') }}" class="p-4 p-md-5 border rounded-3 bg-light">
                @csrf
                <div id="emailDiv" class="form-outline mb-3">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="johndoe@email.com" autofocus />
                    @error('email')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    <br>
                    @enderror
                    <label class="form-label my-1" for="form2Example18">Email</label>
                </div>
                <div id="phoneDiv" class="form-outline mb-3">
                    <input id="phoneNumber" type='text' class="form-control" name="phoneNumber" value="{{ old('phone') }}" autocomplete="phone" placeholder="0912345678" autofocus />
                    @error('phoneNumber')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    <br>
                    @enderror
                    <label class="form-label my-1" for="form2Example18">Phone Number</label>
                </div>
                <div class="form-outline mb-3">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password" />
                    @error('password')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    <br>
                    @enderror
                    <label class="form-label my-1" for="form2Example28">Password</label>
                </div>
                <button id="submitBtn" class="w-100 btn btn-lg btn-primary submitBtn" type="submit">Login</button>
                <p class="my-3 text-center"><a class="text-muted" href="{{route('password.request')}}">Forgot password?</a></p>
                <p class="my-3 text-center">Don't have an account? <a href="{{route('register')}}" class="link-info">Register here</a></p>
            </form>
        </div>
    </div>
</div>

<!-- <section class="vh-100 ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 text-black">
                <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n2 ">
                    @error('attempt')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <form id="loginForm" method="POST" action="{{ route('login') }}">
                        @csrf
                        <h3 class="mb-3 pb-3 fw-bold" style="letter-spacing: 1px;">{{ __('Login') }}</h3>
                        <div id="emailDiv" class="form-outline mb-3">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="johndoe@email.com" autofocus />
                            @error('email')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            <br>
                            @enderror
                            <label class="form-label my-1" for="form2Example18">Email</label>
                        </div>
                        <h5 class="mt-2 mb-4 ml-3"><b>Or</b></h5>
                        <div id="phoneDiv" class="form-outline mb-3">
                            <input id="phoneNumber" type='text' class="form-control" name="phoneNumber" value="{{ old('phone') }}" autocomplete="phone" placeholder="Phone Number" autofocus />
                            @error('phoneNumber')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            <br>
                            @enderror
                            <label class="form-label my-1" for="form2Example18">Phone Number</label>
                        </div>
                        <div class="form-outline mb-3">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password" />
                            @error('password')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            <br>
                            @enderror
                            <label class="form-label my-1" for="form2Example28">Password</label>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-info w-100 btn-block" type="submit">Login</button>
                        </div>
                        <p class="small mb-2 pb-lg-2"><a class="text-muted" href="{{route('password.request')}}">Forgot password?</a></p>
                        <p>Don't have an account? <a href="{{route('register')}}" class="link-info">Register here</a></p>
                    </form>
                </div>
            </div>
            <div class="col-sm-6 px-0 d-none d-sm-block">
                <img src="{{asset('imgs/pg1.jpg')}}" alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
            </div>
        </div>
    </div>
</section> -->
@endsection