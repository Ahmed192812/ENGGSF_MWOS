@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
        {{ __('Change Password') }}
    </div>
    <div class="card-body m-2">
        <form action="updateChangePassword" method="POST">
            @csrf
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
                <p><a href="{{ route('allUsers.profile') }}"> Go pack to profile page</a></p>
            </div>
            @elseif (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
            @endif
            <div class="mb-3">
                <label for="oldPasswordInput" class="form-label">Old Password</label>
                <input name="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" id="oldPasswordInput" placeholder="Old Password">
                @error('old_password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="newPasswordInput" class="form-label">New Password</label>
                <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" id="newPasswordInput" placeholder="New Password">
                @error('new_password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="confirmNewPasswordInput" class="form-label">Confirm New Password</label>
                <input name="new_password_confirmation" type="password" class="form-control" id="confirmNewPasswordInput" placeholder="Confirm New Password">
            </div>
        </form>
    </div>
    <div class="card-footer text-end">
        <a href="{{route('allUsers.profile')}}" class="btn btn-light">Back</a>
        <button class="btn btn-success">Submit</button>
    </div>
</div>
@endsection