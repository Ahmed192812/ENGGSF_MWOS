@extends('user.userLayout')

@section('content')
<br>
<div class="row">
    @foreach($filter as $sc)
    <div class="col-4">
        <a href="{{ URL::to('user/Transaction/orderForm/' . $sc->id . '') }}" class="text-decoration-none text-black">
            <div class="card" style="width: 15rem;">
                <img src="{{asset('imgs/products/' . $sc->image)}}" class="card-img-top" alt="...">
                <div class="card-body text-center">
                    <input type="hidden" name="prod_id" value="{{ $sc->id }}">
                    <h5 class="card-title">{{ $sc->name }}</h5>
                    <p class="card-text">₱{{ $sc->price }}</p>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>
@endsection