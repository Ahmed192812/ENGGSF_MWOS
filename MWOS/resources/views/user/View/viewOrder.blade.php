@extends('user.userLayout')

@section('content')

<div class="container my-4">
    @foreach($pending as $sc)
    <div class="row rounded-4 p-3 border shadow-lg text-center g-0 m-0">
        <div class="col text-bottom">
            <p>{{ $sc->name }}</p>
        </div>
        <div class="col">
            <p>{{ $sc->price }}</p>
        </div>
        <div class="col">
            <p>{{ $sc->quantity }}</p>
        </div>
        <div class="col">
            <button class="btn btn-success btn-sm px-3 rounded-pill">{{ $sc->status }}</button>
        </div>
        <div class="col">
            <button class="btn btn-outline-info btn-sm px-3 rounded-pill">View</button>
            <button class="btn btn-outline-danger btn-sm px-3 rounded-pill">Cancel</button>
        </div>
    </div>
    @endforeach
</div>
@endsection