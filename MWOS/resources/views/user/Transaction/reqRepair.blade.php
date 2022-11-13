@extends('user.userLayout')

@section('content')
<div class="container my-4">
    <div class="row align-items-center rounded-4 p-5 border shadow-lg">
        <div class="col-lg-7 text-center text-lg-start">
            <h1 class="display-4 fw-bold lh-1 mb-3">Let’s start working on your idea.</h1>
            <p class="col-lg-10 lead">
                We at Mondale Woodworks will help you create a look that fits the standard you require! We will find the right solution for your space, from kitchen to living room, bedroom and even to your office.
                <br>
                We will be here to guide you through the whole process.
                <br>
                Give us a call or fill out the form and we will contact you the soonest possible so we can set a meeting to discuss things further.
            </p>
        </div>
        <div class="col-md-10 mx-auto col-lg-5">
            <form class="p-4 p-md-5 border rounded-3 bg-light">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Send Inquiry</button>
            </form>
        </div>
    </div>
</div>
@endsection