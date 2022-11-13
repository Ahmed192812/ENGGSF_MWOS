
@extends('layouts.app')

@section('content')

    <section class="vh-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 text-black">
                    <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n2 ">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <h3 class="mb-3 pb-3 fw-bold" style="letter-spacing: 1px;">{{ __('Register To MOWS') }}</h3>
                            <div class="row">
                                <div class="col">
                                    <div class="form-outline mb-3">
                                        <input id="name" type="text" class="form-control @error('Fname') is-invalid @enderror" placeholder="John" name="Fname" value="{{ old('Fname') }}" autocomplete="first name" autofocus />
                                        @error('Fname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <label class="form-label my-1 my-1" for="form2Example18">First Name</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-outline mb-3">
                                        <input id="name" type="text" class="form-control @error('Lname') is-invalid @enderror" placeholder="Doe" name="Lname" value="{{ old('Lname') }}" autocomplete="last name" autofocus />
                                        @error('Lname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <label class="form-label my-1" for="form2Example18">Last Name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-outline mb-3">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="johndoe@email.com" name="email" value="{{ old('email') }}" autocomplete="email" autofocus />
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <label class="form-label my-1" for="form2Example18">Email</label>
                            </div>
                            <div class="form-outline mb-3">
                                <input id="phoneNumber" type="tel" class="form-control @error('phoneNumber') is-invalid @enderror" placeholder="092345678" name="phoneNumber" value="{{ old('phoneNumber') }}" autocomplete="phoneNumber" autofocus />
                                @error('phoneNumber')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <label class="form-label my-1" for="form2Example18">Phone Number</label>
                            </div>
                            <div class="form-outline mb-3">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password" />
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <label class="form-label my-1" for="form2Example28">Password</label>
                            </div>
                            <div class="form-outline mb-3">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" />

                                <label class="form-label my-1" for="form2Example28">Confirm Password</label>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-info w-100" type="submit">Register</button>
                            </div>
                            <p>Don you have an account? <a href="{{route('login')}}" class="link-info">Login </a></p>
                        </form>
                    </div>
                </div>
                <div class="col-sm-6 px-0 d-none d-sm-block">
                    <img src="{{asset('imgs/pg1.jpg')}}" alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
                </div>
            </div>
        </div>
    </section>
    @endsection

<!--register org -->
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label my-1 text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label my-1 text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label my-1 text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->