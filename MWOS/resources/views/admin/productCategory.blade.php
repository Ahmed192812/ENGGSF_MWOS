<!DOCTYPE html>
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
        <div class="col-3">
        <form action="{{ route('admin.productCategorySearch') }}" method="GET">
                <div class="row">
                    <div class="col-10">
                    <input type="search" name="search" class="form-control col-8" placeholder="you can search for any record">
                    </div>
                    <div class="col-2">
                    <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
                </form>
        </div>
        <div class="col-1">
     
        </div>
        <div class="col-5">
        @if(isset($NoFound))
<div class="alert alert-danger ml-5 mr-5">
        {{ $NoFound }}
  </div>
  @elseif(isset($found))
  <div class="alert alert-success ml-5 mr-5">
       {{$found}}
    </div>
    @endif
        </div>
        
        <div class="col-3 text-end">
            <button id="addNewBook" type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#ajax-book-model">+ Add Product Type</button>
        </div>
    </div>

    <br>

    <div class="row mb-2 text-center">
        <div class="col">
            <table class="table table-striped m-0 align-bottom border">
                <thead>
                    <tr>
                        <th scope="col">PRODUCT ID</th>
                        <th scope="col">PRODUCT NAME</th>
                        <th scope="col">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                @if($product_category->isNotEmpty())
                @foreach ($product_category as $oneProductCategory)
                    <tr>
                        <td class="col-2">{{ $oneProductCategory->id}}</th>
                        <td class="col-6">{{ $oneProductCategory->prodCategory}}</td>
                        <td class="col-4">
                            <a href="javascript:void(0)" type="button" class="btn btn-sm btn-secondary rounded-pill px-3 edit" data-id="{{ $oneProductCategory->id }}">Edit</a>
                            <a href="javascript:void(0)" type="button" class="btn btn-sm btn-danger rounded-pill px-3 delete" data-id="{{ $oneProductCategory->id }}">Delete</a>
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
        </div>
    </div>
</div>



<div class="modal fade" id="ajax-book-model" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="ajaxBookModel"></h4>
          </div>
                      
          <div class="modal-body">
          <form action="javascript:void(0)" id="addEditBookForm" name="addEditBookForm" class="form-horizontal" method="POST" >
          
          <span id="message" class="invalid-feedback" role="alert" red>
                  
                  </span>
              <input type="hidden" name="id" id="id">
              <div class="form-group">
                <label for="productCategory" class="col-sm-4 control-label">product Category</label>
                <div class="col-sm-12 mt-2">
                  <input id="prodCategory" name="prodCategory" type="text" class="form-control form-control-lg @error('productCategory') is-invalid @enderror" value="">
                  @error('productCategory')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>error</strong>
                                    </span>
                                @enderror
                </div>
              </div>  
              <div class="col-sm-offset-2 col-sm-10 mt-2">
                <button type="submit" class="btn btn-primary" id="btn-save" value="addNewBook">Save changes
                </button>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            
          </div>
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
       $('#ajaxBookModel').html("Add product Category");
       $('#ajax-book-model').modal('show');
    });
 
    $('body').on('click', '.edit', function () {
        var id = $(this).data('id');
         console.log(id);
        // ajax
        $.ajax({
            type:"POST",
            url: "{{ route('admin.edit-productCategory') }}",
            data: { id:id },
            dataType: 'json',
            success: function(res){
              $('#ajaxBookModel').html("Edit product Category");
              $('#ajax-book-model').modal('show');
              $('#id').val(res.id);
              $('#prodCategory').val(res.prodCategory);
             
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
                        url: "{{ route('admin.delete-productCategory') }}",
                        data: { id: id },
                        dataType: 'json',
                        success: function(res){
                        window.location.reload();
                        }
                    });
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
            }
            })

    });

//1st one

// $('body').on('click', '#btn-save', function (e) {
//            e.preventDefault()
//             var url = "{{route('admin.add-update-productCategory')}}";
//             let myForm = document.getElementById('addEditBookForm');
//             let dataForm = new FormData(myForm);
//           $("#btn-save").html('Please Wait...');
//           $("#btn-save"). attr("disabled", true);
//         // ajax
       
//         $.ajax({
//             type:"POST",
//             url:url,
//             data:dataForm,
//             contentType: false,
//             processData:false,
//             cache: false,
//             dataType: 'json',

//             success: function(res){
//             $("#btn-save").html('Submit');
//             $("#btn-save"). attr("disabled", false);
//             window.location.reload();
//             Swal.fire(
//             'Saved',
//             'airline information have been saved successfully',
//             'success'
//             )
//            },
           
//            error: function(res){
//             Swal.fire({
//                 icon: 'error',
//                 title: 'Save failed',
//                 text: 'All fields are required',
//               })   
//               $("#btn-save").html('Save');
//              $("#btn-save"). attr("disabled", false);
     
//              }
        
//         });
      
//     });
    




//2ed one 

    $('body').on('click', '#btn-save', function (event) {
          var id = $("#id").val();
          var prodCategory = $("#prodCategory").val();
          $("#btn-save").html('Please Wait...');
          $("#btn-save").attr("disabled", true);
            alert(prodCategory);
        // ajax
       
        $.ajax({
            type:"POST",
            url: "{{ route('admin.add-update-productCategory') }}",
            data:{
              id:id,
              prodCategory:prodCategory,
            },
            dataType: 'json',
            success: function(res){
             window.location.reload();
            $("#btn-save").html('Submit');
            $("#btn-save").attr("disabled", false);
            Swal.fire(
            'Saved successfully',
            'product Category information saved',
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