
@extends('user.userLayout')

@section('content')
<div class="container my-4">
    <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-4 border shadow-lg">
        <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
            <h1 class="display-4 fw-bold lh-1">E-CATALOG</h1>
            <p class="lead">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
                <button href="{{ route('user.catalog') }}" type="button" class="btn btn-primary px-4 me-md-2 fw-bold">Learn More</button>
            </div>
        </div>
        <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden text-center">
            <img class="rounded-lg-4" src="{{ asset('user/catalog.jpg') }}" alt="" width="450">
        </div>
    </div>
</div>

<br>

<div class="container my-4">
    <div class="row p-4 pb-0 ps-lg-0 pt-lg-5 align-items-center rounded-4 border shadow-lg">
        <div class="col-lg-4 p-0 overflow-hidden text-center">
            <img class="rounded-lg-4" src="{{ asset('user/repair.jpg') }}" alt="" width="450">
        </div>
        <div class="col-lg-7 p-3 p-lg-5 pt-lg-3 pe-lg-0 ps-lg-6 text-end">
            <h1 class="display-4 fw-bold lh-1">REPAIR</h1>
            <p class="lead">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-4 mb-lg-3">
                <button href="{{ route('user.repair') }}" type="button" class="btn btn-primary px-4 me-md-2 fw-bold">Learn More</button>
            </div>
        </div>
    </div>
</div>

<br>

<div class="container my-4">
    <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-4 border shadow-lg">
        <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
            <h1 class="display-4 fw-bold lh-1">CUSTOM</h1>
            <p class="lead">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
                <button href="{{ route('user.custom') }}" type="button" class="btn btn-primary px-4 me-md-2 fw-bold">Learn More</button>
            </div>
        </div>
        <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden text-center">
            <img class="rounded-lg-4" src="{{ asset('user/custom.jpg') }}" alt="" width="450">
        </div>
    </div>
</div>
@endsection