@extends('layouts.app')



@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your phone Number Address') }}</div>

                <div class="card-body">
              
                 
                 
                 @if ($verifiedFailed = Session::get('message'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>    
                        <span>{{ $verifiedFailed }} </span>
                    </div>
                 @endif

                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh Code has been sent to your Phone Number.') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-3"></div>
                        <div class="col-9"><span></span>{{ __('If you did not receive the SMS') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form></div>

                    </div>
                    
                    <br>
                    <form action="{{ route('allUsers.verifyCode') }}" method="post">
                    @csrf
                    <div class="mb-3">
                            <label class="form-label">code</label>
                            <input id="code" name="code" type="text" class="form-control" required>
                            @error('code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>

                        <button class="btn btn-primary" type="submit">submit</button>
                    </form>

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
