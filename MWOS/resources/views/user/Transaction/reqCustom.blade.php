<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
            <form method="POST" action="{{ route('user.customAdd') }}" enctype="multipart/form-data" class="p-4 p-md-5 border rounded-3 bg-light">
                @csrf
                <div class=" mb-3 disInput">
                    <label class="form-label">Image Reference</label>
                    <input name="image" type="file" class="form-control @error('image') is-invalid @enderror" id="image">
                    @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-floating mb-3 disInput">
                    <select name="productCategory_id" id="productCategory_id" class="form-control @error('productCategory_id') is-invalid @enderror">
                        <option value="" selected>select product category</option>
                        @foreach ($productCategory as $category)
                        <option value="{{$category->productCategoryId}}">{{$category->prodCategory}}</option>
                        @endforeach
                    </select>
                    @error('productCategory_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <label>Product Category</label>
                </div>
                <div class="form-floating mb-3 disInput">
                    <select name="material_id" id="material_id" class="form-control @error('material_id') is-invalid @enderror">
                        <option value="" selected>select Material</option>
                        @foreach ($Materials as $Material)
                        <option value="{{$Material->MaterialsId}}">{{$Material->name}}</option>
                        @endforeach
                    </select>
                    @error('material_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <label>material</label>
                </div>
                <div class="form-floating mb-3 disInput">
                    <textarea name="desiredMaterial" id="desiredMaterial" class="form-control @error('desiredMaterial') is-invalid @enderror" cols="30" rows="10"></textarea>
                    @error('desiredMaterial')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <label>desired Material</label>
                </div>
                <div class="form-floating mb-3 disInput">
                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="10"></textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <label>description</label>
                </div>
                <div class="form-floating mb-3 disInput">
                    <input name="quantity" id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror">
                    @error('quantity')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <label>quantity</label>
                </div>
                <div id="payment_typeDiv" class="form-floating payment_typeDivClass mb-3">
                    <select name="payment_type" id="payment_type" class="form-control @error('payment_type') is-invalid @enderror">
                        <option value="" selected>select product category</option>
                        <option value="1">cash</option>
                        <option value="2">Gcash</option>
                    </select>
                    @error('payment_type')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <button id="submitBtn" class="w-100 btn btn-lg btn-primary submitBtn" type="submit">Order</button>
            </form>
        </div>
    </div>
</div>



<!-- 
<script type="text/javascript">
        document.getElementById("payment_typeDiv").style.display = "none";
          document.getElementById("submitBtn").style.display = "none";
          document.getElementById("backBtn").style.display = "none";
    $('body').on('click', '.nextBtn', function () {
        var cells = document.getElementsByClassName("disInput"); 
        for (var i = 0; i < cells.length; i++) { 
            cells[i].style.display = "none";
        }
        document.getElementById("payment_typeDiv").style.display = "block";
        document.getElementById("nextBtn").style.display = "none";
        document.getElementById("submitBtn").style.display = "block";
        document.getElementById("backBtn").style.display = "block";


    });
    $('body').on('click', '.backBtn', function () {
        var cells = document.getElementsByClassName("disInput"); 
        for (var i = 0; i < cells.length; i++) { 
            cells[i].style.display = 'block';
        }

         document.getElementById("payment_typeDiv").style.display = "none";
        document.getElementById("nextBtn").style.display = "block";
        document.getElementById("submitBtn").style.display = "none";
        document.getElementById("backBtn").style.display = "none";


    });
        
</script> -->
@endsection