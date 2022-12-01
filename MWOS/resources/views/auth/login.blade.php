
@extends('user.userLayout')




@section('content')
    <section class="vh-100 ">
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
    </section>
    <script type="text/javascript">
      
    </script>
    @endsection






<!-- login org -->
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label my-1 text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label my-1 text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->