@extends('user.userLayout')

@section('content')
<form method="POST" action="{{ route('order.store') }}">
@csrf
    <input type="text" name="user_id" value="{{ Auth::user()->id }}">
    <input type="text" name="product_id" value="{{ $products->id }}">
    <input type="text" name="quantity">
    <input type="text" name="payment_type">
    <input type="text" name="order">
    <input type="text" name="rating">
    <input type="text" name="review">
    <button type="submit">Submit</button>
</form>
@endsection