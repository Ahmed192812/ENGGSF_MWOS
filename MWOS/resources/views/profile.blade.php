@extends('layouts.app')
@section('content')
<!-- <link href="{{ asset('css/profile.css') }}" rel="stylesheet"> -->
@if(isset($message))
<div class="alert alert-info alert-dismissible fade show" role="alert">
    <span>{{$message}}</span>
    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to send verification email.') }}</button>.
    </form>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if (session('Success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <span>{{ session('Success') }}</span>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if (session('noNewData'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <span>{{ session('noNewData') }}</span>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<form method="POST" action="{{ route('update.profile') }}">
    @csrf
    <div class="card">
        <div class="card-header">
            Update Account Details
        </div>
        <div class="card-body m-2">

            <input type="text" name="id" value="{{Auth::user()->id}}" hidden>
            <div class="row mt-2">
                <div class="col-md-6">
                    <label class="form-label">First Name</label>
                    <input name="Fname" type="text" class="form-control @error('Fname') is-invalid @enderror" placeholder="first name" value="{{ $user->Fname }}">
                    @error('Fname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Last Name</label>
                    <input type="text" name="Lname" class="form-control @error('Lname') is-invalid @enderror" value="{{ $user->Lname }}" placeholder="surname">
                    @error('Lname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <label class="form-label">Email</label>
                    <input name="email" type="email" class="form-control  @error('email') is-invalid @enderror" placeholder="" value="{{ $user->email }}">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-md-12 mt-3">
                    <label class="form-label">Mobile Number</label>
                    <input name="phoneNumber" type="text" class="form-control  @error('phoneNumber') is-invalid @enderror" placeholder="enter phone number" value="{{ $user->phoneNumber }}">
                    @error('phoneNumber')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-md-12 mt-3">
                    <label class="form-label">Shipping Address</label>
                    <input type="text" name="Address" class="form-control  @error('Address') is-invalid @enderror" value="{{ $user->Address }}">
                    @error('Address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <a class="btn btn-secondary mt-3" href="{{ route('allUsers.changePassword') }}">Change Password</a>
        </div>
        <div class="card-footer text-end">
            <button class="btn btn-success profile-button" type="submit">Save Changes</button>
        </div>
    </div>
</form>
@endsection