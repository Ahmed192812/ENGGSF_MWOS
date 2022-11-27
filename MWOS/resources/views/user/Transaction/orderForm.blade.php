@extends('user.userLayout')

@section('content')
@if (session('login'))
<div class="alert alert-info alert-dismissible fade show" role="alert">
    <span>{{ session('login') }}</span>

    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="container my-4">
    <div class="row rounded-4 border shadow-lg">
        <div class="col-6 p-5 pe-lg-2">
            <img src="{{ asset('imgs/products/' . $products->image . '') }}" alt="..." class="w-100">
        </div>
        <div class="col-6 p-5">
            <form method="POST" action="{{ route('order.store') }}">
                @csrf
                <div class="row">
                    <div class="col">
                        <h2 class="m-0">{{ $products->name }}</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p class="mb-1">PHP {{$products->price}}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <p class="mb-1">{{ $products->description }}</p>
                        <p class="mb-1">Size: L{{ $products->tall }} H{{ $products->height }} W{{ $products->width }}</p>
                        <p class="mb-1" id="downpayment"></p>
                    </div>
                </div>
                <hr>
                <div class="row mt-2">
                    <div class="col">
                        <h4>Quantity</h4>
                        <div class="row my-3">
                            <div class="col text-center">
                                <input type="number" name="quantity" class="form-control" min="1" value="1">
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row mt-2">
                    <div class="col">
                        <h4>Payment Type</h4>
                        <div class="row my-3">
                            <div class="col text-center">
                                <input type="text" name="payment_type" class="form-control">
                            </div>
                            @error('payment_type')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <!-- Payment type of what? staggered? shouyld the price be distributed? breakdown fo statement? -->
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row mt-2">
                    <div class="col">
                        <p class="mb-1"><i class="bi bi-box-seam"></i> Delivery: Free shipping</p>
                        <P><i class="bi bi-info-circle"></i> Downpayment must be paid first to start with the production of order.</P>
                        @if(Auth::check())
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        @endif
                        <input type="hidden" name="product_id" value="{{ $products->id }}">
                        <button type="submit" class="btn btn-primary w-100 fw-bold">PRE-ORDER</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    let price = '{{$products->price}}';
    var percent = (50 / 100) * price;
    var dprice = Math.trunc(percent)
    document.getElementById("downpayment").innerHTML = "Downpayment: PHP " + dprice;
</script>
@endsection