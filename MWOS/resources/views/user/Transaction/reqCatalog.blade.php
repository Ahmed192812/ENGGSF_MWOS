@extends('user.userLayout')

@section('content')
<br>
<div class="row">
    @foreach($posts as $sc)
    <div class="col-4">
        <div class="card" style="width: 15rem;">
            <img src="{{ asset('products/living/sofa1.png') }}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{$sc->name}}</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary btn-sm rounded-pill">Add to Cart</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection