@extends('user.userLayout')

@section('content')

<div class="container my-4">
<div class="row rounded-4 p-3 border shadow-lg text-center g-0 m-0 mb-2">
        <div class="col text-bottom">
            <b>Product name</b>
        </div>
        <div class="col">
            <b>price</b>
        </div>
        <div class="col">
            <b>quantity</b>
        </div>
        <div class="col">
           <b>Status</b>
        </div>
        <div class="col">
         <b>Action</b>
        </div>
    </div>
    @foreach($orders as $order)
    <div class="row rounded-4 p-3 border shadow-lg mb-1 text-center g-0 m-0">
        <div class="col text-bottom">
            <p>{{ $order->name }}</p>
        </div>
        <div class="col">
            <p>{{ $order->price }}</p>
        </div>
        <div class="col">
            <p>{{ $order->quantity }}</p>
        </div>
        <div class="col">
            @if($order->status == "Pending")
            <button class="btn btn-success btn-sm px-3 rounded-pill">{{ $order->status }}</button>
            @endif
        </div>
        <div class="col">
            <button class="btn btn-outline-info btn-sm px-3 rounded-pill">View</button>
            <button class="btn btn-outline-danger btn-sm px-3 rounded-pill">Cancel</button>
        </div>
    </div>
    @endforeach
</div>
@endsection