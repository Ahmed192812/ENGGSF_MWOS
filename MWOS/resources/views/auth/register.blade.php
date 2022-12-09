@extends('user.userLayout')

@section('content')
<div class="container my-4">
    <div class="row align-items-center rounded-4 p-5 border shadow-lg">
        <div class="col-lg-7 text-center text-lg-start">
            <h1 class="display-4 fw-bold lh-1 mb-3">Found something you like?</h1>
            <p class="col-lg-10 lead">
                Register to Mondale Woodworks to order now!
            </p>
        </div>
        <div class="col-md-10 mx-auto col-lg-5">
            <form method="POST" action="{{ route('register') }}" class="p-4 p-md-5 border rounded-3 bg-light">
                @csrf
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
                <div class="form-outline mb-3">
                    <select name="verifiedBy" id="verifiedBy" class="form-select inputDis @error('verifiedBy') is-invalid @enderror">
                        <option value="" disabled="true" selected>Select verification method...</option>
                        <option value="1">Email</option>
                        <option value="2">Phone number</option>
                    </Select>
                    @error('verifiedBy')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <button class="btn btn-lg btn-primary w-100" type="submit">Register</button>
                <p class="my-3 text-center">Already have an account? <a href="{{route('login')}}" class="link-info">Login </a></p>
            </form>
        </div>
    </div>
</div>
<!-- <section class="vh-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 text-black">
                <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n2 ">
                    <form method="POST" action="{{ route('register') }}" class="p-4 p-md-5 border rounded-3 bg-light">
                        @csrf
                        <h3 class="mb-3 pb-3 fw-bold" style="letter-spacing: 1px;">{{ __('Register To MWOS') }}</h3>
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
                        <div class="form-outline mb-3">
                            <select name="verifiedBy" id="verifiedBy" class="form-control inputDis @error('verifiedBy') is-invalid @enderror">
                                <option value="" disabled="true" selected>Select verify method </option>
                                <option value="1">email</option>
                                <option value="2">phone number</option>
                            </Select>
                            @error('verifiedBy')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <label class="form-label my-1" for="form2Example28">verify By</label>
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
</section> -->
@endsection