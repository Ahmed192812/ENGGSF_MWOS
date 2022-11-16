
@extends('layouts.app')




@section('content')
<link href="{{ asset('css/profile.css') }}" rel="stylesheet">
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        
        <div class="col-md-12 border-right">
        <!-- @if(isset($message))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
        <span>{{$message}}</span> 
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to send verification email.') }}</button>.
                    </form>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div> -->
       
       
    @endif
    @if(isset($Success))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <span>{{$Success}}</span> 
                    
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
       
    @endif
       
   
       
        
            <div class="p-3 py-5">
            <form method="POST" action="{{ route('update.profile') }}" >
       
                @csrf
                <input type="text" name="id" value="{{Auth::user()->id}}" hidden>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label class="labels">First Name</label>
                    <input name="Fname" type="text" class="form-control @error('Fname') is-invalid @enderror" placeholder="first name" value="{{ $user->Fname }}">
                    @error('Fname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>
                    <div class="col-md-6">
                        <label class="labels">Last Name</label>
                        <input type="text" name="Lname" class="form-control @error('Lname') is-invalid @enderror" value="{{ $user->Lname }}" placeholder="surname">
                        @error('Lname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                </div>
                <div class="row mt-3">
                <div class="col-md-12">
                    <label class="labels">Email </label>
                    <input name="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="" value="{{ $user->email }}">
                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>
                    <div class="col-md-12">
                        <label class="labels">Mobile Number</label>
                        <input name="phoneNumber" type="number" class="form-control form-control-lg @error('phoneNumber') is-invalid @enderror" placeholder="enter phone number" value="{{ $user->phoneNumber }}">
                        @error('phoneNumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="labels">Full Address</label>
                        <input type="text" name="Address" class="form-control form-control-lg @error('Address') is-invalid @enderror" placeholder="enter address line 1" value="{{ $user->Address }}">
                        @error('Address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                   
                </div>
                <div class="mt-5 text-center"><button class="btn btn-dark profile-button" type="submit">Save Profile</button></div>
           </form>
           <div class="row">
            <div class="col-10"></div>
            <div class="col-2"><a href="{{ route('allUsers.changePassword') }}" >change password</a></div>
           </div>
            </div>
        </div>
      
    </div>
</div>
</div>
</div>
@endsection
