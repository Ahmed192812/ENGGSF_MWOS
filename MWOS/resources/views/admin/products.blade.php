<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
@extends('layouts.app')
@section('content')
<br>
<div class="container">
    <div class="row">
        <div class="col-4">
        </div>
        <div class="col-4">
        </div>
        <div class="col-2 text-end">
            <div class="dropdown">
                <button class="btn btn-sm btn-primary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Filter
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
            </div>
        </div>
        <div class="col-2 text-end">
            <button type="button" class="btn btn-sm btn-primary w-100" data-bs-toggle="modal" data-bs-target="#ajax-book-model">+ Add Product</button>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="ajax-book-model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ajaxBookModel">Add Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0)" id="addEditBookForm" name="addEditBookForm" method="POST" enctype="multipart/form-data">
                    <span id="message" class="invalid-feedback" role="alert" red></span>
                    <input type="hidden" name="id" id="id" >

                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" id="image" name="image" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input name="name" id="name" type="text" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Product Category</label>
                            <select name="prodCategory_ID" id="prodCategory_ID" class="form-control">
                                <option value="" selected>select product category</option>
                                @foreach ($productCategory as $oneProductCategory)
                                <option value="{{$oneProductCategory->productCategoryId}}">{{$oneProductCategory->prodCategory}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Size(T*W*H)</label>
                            <div class="row">
                                <div class="col-4"><input type="text" name="tall" id="tall" class="form-control" placeholder="Tall" value=""></div>
                                <div class="col-4"><input type="text" name="width" id="width" class="form-control" placeholder="Width" value=""></div>
                                <div class="col-4"><input type="text" name="hight" id="hight" class="form-control" placeholder="Hight" value=""></div>
                            </div>
                              
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <input type="number" name="priceFull" id="priceFull" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Downpayment</label>
                            <input type="number" name="priceDp" id="priceDp" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Material</label>
                            <select name="material_ID" id="material_ID" class="form-control">
                                <option value="" selected>select Material</option>
                                @foreach ($Materials as $Material)
                                <option value="{{$Material->MaterialsId}}">{{$Material->name}}</option>
                                @endforeach

                            </select>
                        </div>
                        
                        <!-- <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="Status" id="Status" class="form-control">
                                <option selected value="">Status</option>
                                <option value="1">Published</option>
                                <option value="2">unpublished</option>

                            </select>
                        </div> -->
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea cols="30" rows="10" name="description" id="description" class="form-control" value=""></textarea>
                        </div>
                       
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="btn-save" value="addNewBook">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <br>
    @if($Products->isNotEmpty())
    @foreach ($Products as $Product)
    <div class="row mb-3">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4 text-center align-middle">
                            <img src="{{asset('imgs/products/' . $Product->image)}}" style="width: 250px;">
                        </div>
                        <div class="col-8">
                            <div class="row">
                                <div class="col">
                                    <h2>{{$Product->name}}</h2>
                                </div>
                                <div class="col text-end">
                                    <a href="javascript:void(0)" type="button" class="btn btn-sm btn-info edit" data-id="{{ $Product->id }}">Edit</a>
                                    <a href="javascript:void(0)" type="button" class="btn btn-sm btn-danger delete" data-id="{{ $Product->id }}">Delete</a>
                                </div>
                            </div>

                            <p class="text-muted fst-italic">{{$Product->materialName}} {{$Product->prodCategory}}</p>

                            <p>Height:{{$Product->hight}} | Width:{{$Product->width}} | Tall:{{$Product->tall}} |  </p>
                            <p>
                            {{$Product->description}}   
                            </p>
                            <br>
                            <p>Price| <strong>{{$Product->priceFull}}</strong> </p>
                            <p>Down Payment| <strong>{{$Product->priceDp}}</strong> </p>

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
                        
                        @else
                            <h2>there is No products. add One</h2>
                        @endif
</div>

<!-- <table class="table table-striped m-0 align-middle border">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">IMAGE</th>
                        <th scope="col">NAME</th>
                        <th scope="col">CATEGORY</th>
                        <th scope="col">PRICE</th>
                        <th scope="col">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="col">1</th>
                        <td class="col">
                            <img src="{{asset('imgs/products/p_stand.png')}}" style="width: 100px;">
                        </td>
                        <td class="col">Plywood TV Stand</th>
                        <td class="col">Table</td>
                        <td class="col">P7,000</th>
                        <td class="col">
                            <button type="button" class="btn btn-sm btn-info rounded-pill px-3">View</button>
                            <button type="button" class="btn btn-sm btn-warning rounded-pill px-3">Edit</button>
                            <button type="button" class="btn btn-sm btn-danger rounded-pill px-3">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="col">2</th>
                        <td class="col">
                            <img src="{{asset('imgs/products/sofa_bed.png')}}" style="width: 100px;">
                        </td>
                        <td class="col">Wooden Sofa Bed</th>
                        <td class="col">Chair</td>
                        <td class="col">P10,000</th>
                        <td class="col">
                            <button type="button" class="btn btn-sm btn-info rounded-pill px-3">View</button>
                            <button type="button" class="btn btn-sm btn-warning rounded-pill px-3">Edit</button>
                            <button type="button" class="btn btn-sm btn-danger rounded-pill px-3">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="col">3</th>
                        <td class="col">
                            <img src="{{asset('imgs/products/wooden_bed.png')}}" style="width: 100px;">
                        </td>
                        <td class="col">Wooden Bed (with Headboard)</th>
                        <td class="col">Bed</td>
                        <td class="col">P15,000</th>
                        <td class="col">
                            <button type="button" class="btn btn-sm btn-info rounded-pill px-3">View</button>
                            <button type="button" class="btn btn-sm btn-warning rounded-pill px-3">Edit</button>
                            <button type="button" class="btn btn-sm btn-danger rounded-pill px-3">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="col">4</th>
                        <td class="col">
                            <img src="{{asset('imgs/products/sala_set.png')}}" style="width: 100px;">
                        </td>
                        <td class="col">Wooden Sala Set</th>
                        <td class="col">Chair</td>
                        <td class="col">P25,000</th>
                        <td class="col">
                            <button type="button" class="btn btn-sm btn-info rounded-pill px-3">View</button>
                            <button type="button" class="btn btn-sm btn-warning rounded-pill px-3">Edit</button>
                            <button type="button" class="btn btn-sm btn-danger rounded-pill px-3">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="col">5</th>
                        <td class="col">
                            <img src="{{asset('imgs/products/dining_chairs.png')}}" style="width: 100px;">
                        </td>
                        <td class="col">Dining Chairs</th>
                        <td class="col">Chair</td>
                        <td class="col">P10,000</th>
                        <td class="col">
                            <button type="button" class="btn btn-sm btn-info rounded-pill px-3">View</button>
                            <button type="button" class="btn btn-sm btn-warning rounded-pill px-3">Edit</button>
                            <button type="button" class="btn btn-sm btn-danger rounded-pill px-3">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="col">6</th>
                        <td class="col">
                            <img src="{{asset('imgs/products/shelf.png')}}" style="width: 100px;">
                        </td>
                        <td class="col">Bookshelf</th>
                        <td class="col">Shelf</td>
                        <td class="col">P8,000</th>
                        <td class="col">
                            <button type="button" class="btn btn-sm btn-info rounded-pill px-3">View</button>
                            <button type="button" class="btn btn-sm btn-warning rounded-pill px-3">Edit</button>
                            <button type="button" class="btn btn-sm btn-danger rounded-pill px-3">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="col">7</th>
                        <td class="col">
                            <img src="{{asset('imgs/products/bench.png')}}" style="width: 100px;">
                        </td>
                        <td class="col">Bench</th>
                        <td class="col">Chair</td>
                        <td class="col">P4,000</th>
                        <td class="col">
                            <button type="button" class="btn btn-sm btn-info rounded-pill px-3">View</button>
                            <button type="button" class="btn btn-sm btn-warning rounded-pill px-3">Edit</button>
                            <button type="button" class="btn btn-sm btn-danger rounded-pill px-3">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table> -->
</div>
</div>
</div>


<script type="text/javascript">
 $(document).ready(function($){
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#addNewBook').click(function () {
       $('#addEditBookForm').trigger("reset");
       $('#ajaxBookModel').html("Add Product");
       $('#ajax-book-model').modal('show');
    });
 
    $('body').on('click', '.edit', function () {
        var id = $(this).data('id');
         alert(id);
        // ajax
        $.ajax({
            type:"POST",
            url: "{{ url('admin/edit-products') }}",
            data: { id: id },
            dataType: 'json',
            success: function(res){
              $('#ajaxBookModel').html("Edit material");
              $('#ajax-book-model').modal('show');
              $('#id').val(res.id);
              $('#image').val(res.image);
              $('#name').val(res.name);
              $('#tall').val(res.tall);
              $('#hight').val(res.hight);
              $('#width').val(res.width);
              $('#priceFull').val(res.priceFull);
              $('#priceDp').val(res.priceDp);
              $('#material_ID').val(res.material_ID);
              $('#description').val(res.description);

              
           }
              
        });
          
    });
    
    $('body').on('click', '.delete', function () {


                    Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                var id = $(this).data('id');
                    // ajax
                    $.ajax({
                        type:"POST",
                        url: "{{ url('admin/delete-products') }}",
                        data: { id: id },
                        dataType: 'json',
                        success: function(res){
                        window.location.reload();
                        }
                    });
                Swal.fire(
                'Deleted!',
                'YRecord has been deleted.',
                'success'
                )
            }
            })

    });

    $('body').on('click', '#btn-save', function (e) {
           e.preventDefault()
            var url = "{{ url('admin/add-update-products') }}";
            let myForm = document.getElementById('addEditBookForm');
            let dataForm = new FormData(myForm);
          $("#btn-save").html('Please Wait...');
          $("#btn-save"). attr("disabled", true);
         alert(res.dataForm);
        // ajax
       
        $.ajax({
            type:"POST",
            url:url,
            data:dataForm,
            contentType: false,
            processData:false,
            cache: false,
            dataType: 'json',
            success: function(res){
            $("#btn-save").html('Submit');
            $("#btn-save"). attr("disabled", false);
            window.location.reload();
            Swal.fire(
            'Saved',
            'Product information have been saved successfully',
            'success'
            )
           
           },
           error: function(res){
            Swal.fire({
                icon: 'error',
                title: 'Save failed',
                text: 'All fields are required',
              })   
              $("#btn-save").html('Save');
             $("#btn-save"). attr("disabled", false);
     
             }
        
        });
      
    });
    
   
});
</script>
@endsection