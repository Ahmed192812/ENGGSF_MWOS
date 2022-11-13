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
        @if(isset($error))
        <span class="text-danger">{{ $error }}</span>        
    @endif
        </div>
        <div class="col-2 text-end">
            <div class="dropdown">
                <button class="btn btn-sm btn-primary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Filter By
                </button>
                <ul class="dropdown-menu">
                @if($Products->isNotEmpty())
             @foreach ($productCategory as $oneProductCategory)
             <li>
                 <form action="{{ route('admin.productsFilter') }}" method="GET">
                     <input type="hidden" name="filter" value="{{$oneProductCategory->productCategoryId}}">
                     <button class="dropdown-item" type="submit">{{$oneProductCategory->prodCategory}}</button></li>
                  </form>
            </li>
             @endforeach
             @else
                    <li>the is no category</li>
                    @endif
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.products') }}" >All products</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-2 text-end">
            <button type="button" class="btn btn-sm btn-primary w-100 Adding" data-bs-toggle="modal" data-bs-target="#ajax-book-model">+ Add Product</button>
        </div>
    </div>

    <br>
    <div class="row mb-2 text-center">
        <div class="col">
            <table class="table table-striped m-0 align-bottom border">
                <thead >
                    <tr >
                        <th class="text-center align-middle" scope="col">RECORDED NO</th>
                        <th class="text-center align-middle" scope="col-4">IMAGE</th>
                        <th class="text-center align-middle" scope="col">PRODUCT NAME</th>
                        <th class="text-center align-middle" scope="col">PRICE</th>
                        <th class="text-center align-middle" scope="col">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                @if($Products->isNotEmpty())
                @php $i=0 @endphp
                @foreach ($Products as $Product)
                    <tr>
                        <td class="col text-center align-middle">{{ ++$i }}</th>
                        <td class="col-4 text-center align-middle">
                            <img src="{{asset('imgs/products/' . $Product->image)}}" style="width: 150px; height: 110px;">
                        </td>
                        <td class="col text-center align-middle">{{ $Product->name}}</td>
                        <td class="col text-center align-middle">{{ $Product->price}}</td>
                        <td class="col text-center align-middle">
                            <a href="javascript:void(0)" type="button" class="btn btn-sm btn-secondary rounded-pill px-3 edit" data-id="{{ $Product->id }}">Edit</a>
                            <a href="javascript:void(0)" type="button" class="btn btn-sm btn-danger rounded-pill px-3 delete" data-id="{{ $Product->id }}">Delete</a>
                        </td>
                    </tr>
                            @endforeach
                        
                        @else
                            <tr>
                            <h2>No record found</h2>
                            </tr>
                            
                            
                        @endif
                </tbody>
            </table>
                 <div style="margin-left: 41%; padding-top: 12px;">
                         {!! $Products->links() !!}
                  </div>

        </div>
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
                    <input type="hidden" name="id" id="id" >

                        <div id="imageDev" class="mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" id="image" name="image" class="form-control inputDis"  placeholder="Upload an Image" >
                            <span class="text-danger error-text image_error errorSpan"></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input name="name" id="name" type="text" class="form-control inputDis" value="">
                            <span class="text-danger error-text name_error errorSpan"></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Product Category</label>
                            <select name="prodCategory_ID" id="prodCategory_ID" class="form-control inputDis">
                                <option value="" selected>select product category</option>
                                @foreach ($productCategory as $oneProductCategory)
                                <option value="{{$oneProductCategory->productCategoryId}}">{{$oneProductCategory->prodCategory}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-text prodCategory_ID_error errorSpan"></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Size(T*W*H)</label>
                            <div class="row">
                                <div class="col-4">
                                    <input type="text" name="tall" id="tall" class="form-control inputDis" placeholder="Tall" value="">
                                    <span class="text-danger error-text tall_error errorSpan"></span>
                                </div>
                                <div class="col-4">
                                    <input type="text" name="width" id="width" class="form-control inputDis" placeholder="Width" value="">
                                    <span class="text-danger error-text width_error errorSpan"></span>
                                </div>
                                <div class="col-4">
                                    <input type="text" name="hight" id="hight" class="form-control inputDis" placeholder="Hight" value="">
                                    <span class="text-danger error-text hight_error errorSpan"></span>
                                </div>
                            </div>
                            <div class="mb-3">
                            <label class="form-label">price</label>
                            <input name="price" id="price" type="number" class="form-control inputDis" value="">
                            <span class="text-danger error-text price_error errorSpan"></span>
                        </div>
                              
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Material</label>
                            <select name="material_ID" id="material_ID" class="form-control inputDis">
                                <option value="" selected>select Material</option>
                                @foreach ($Materials as $Material)
                                <option value="{{$Material->MaterialsId}}">{{$Material->name}}</option>
                                @endforeach

                            </select>
                            <span class="text-danger error-text material_ID_error errorSpan"></span>
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
                            <label class="form-label">Description</label><br>
                            <span class="text-danger error-text description_error errorSpan"></span>
                            <textarea cols="30" rows="10" name="description" id="description" class="form-control inputDis" value=""></textarea>
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



<script type="text/javascript">
          $('body').on('click', '.Adding', function () {
            document.getElementById("addEditBookForm").reset();

        var cellsSpan = document.getElementsByClassName("errorSpan"); 
        for (var i = 0; i < cellsSpan.length; i++) { 

            cellsSpan[i].innerText = span.textContent = '';
        }

         });
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
       

       
        var cellsSpan = document.getElementsByClassName("errorSpan"); 
        for (var i = 0; i < cellsSpan.length; i++) { 

            cellsSpan[i].textContent = '';
            }
        // ajax
        $.ajax({
            type:"POST",
            url: "{{ url('admin/edit-products') }}",
            data: { id: id },
            dataType: 'json',
            success: function(res){
              $('#ajaxBookModel').html("View Product");
              $('#ajax-book-model').modal('show');
              $('#id').val(res.id);
              $('#name').val(res.name);
              $('#prodCategory_ID').val(res.prodCategory_id);
              $('#tall').val(res.tall);
              $('#width').val(res.width);
              $('#hight').val(res.height);
              $('#price').val(res.price);
              $('#material_ID').val(res.material_id );
              $('#description').val(res.description);
              $('#image').val(res.image);
            //   console.log(image);

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
                'Record has been deleted.',
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
         
        // ajax
       
        $.ajax({
            type:"POST",
            url:url,
            data:dataForm,
            contentType: false,
            processData:false,
            cache: false,
            dataType: 'json',
            beforeSend:function(){
                $(document).find('span.error-text').text('');
            },
            success: function(data){
                if (data.status == 0) {
                    $.each(data.error, function(prefix,val){
                        $('span.'+prefix+'_error').text(val[0]);
                    });
                }
                else{
                    window.location.reload();
                    Swal.fire(
                    'Saved',
                    data.msg,
                    'success'
                    )

                }
            // $("#btn-save").html('Submit');
            // $("#btn-save"). attr("disabled", false);
            // window.location.reload();
            
           
           },
         
        
        });
      
    });
    
   
});


</script>
@endsection