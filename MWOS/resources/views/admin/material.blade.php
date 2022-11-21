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
        <form action="{{ route('admin.materialSearch') }}" method="GET">
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
            <button id="addNewBook" type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#ajax-book-model">+ Add Material</button>
        </div>
    </div>

     <!-- Add Modal -->
     <div class="modal fade" id="ajax-book-model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ajaxBookModel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                     <form action="javascript:void(0)" id="addEditBookForm" name="addEditBookForm" method="POST" enctype="multipart/form-data" >
                     <span  class="invalid-feedback errorSpan" role="alert" red></span>
                      <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            <input id="image" name="image" type="file" class="form-control" value="" >
                            <span  class="text-danger error-text image_error errorSpan"></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input id="name" name="name" type="text" class="form-control" value="" required>
                            <span class="text-danger error-text name_error errorSpan"></span>

                        </div>
                        <div class="mb-3">
                            <label class="form-label">Cost Per Unit</label>
                            <input id="costPerUnit" name="costPerUnit" type="number" class="form-control" value="" required>
                            <span class="text-danger error-text costPerUnit_error errorSpan"></span>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary"  id="btn-save" value="addNewBook">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <br>

    <div class="row mb-2 text-center">
        <div class="col">
            <table class="table table-striped m-0 align-bottom border">
                <thead>
                    <tr>
                        <th scope="col">MATERIAL ID</th>
                        <th scope="col-4">IMAGE</th>
                        <th scope="col">MATERIAL NAME</th>
                        <th scope="col">COST PER UNIT</th>
                        <th scope="col">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                @if($Materials->isNotEmpty())
                @foreach ($Materials as $Material)
                    <tr>
                        <td class="col text-center align-middle">{{ $Material->id}}</th>
                        <td class="col-4 text-center align-middle">
                            <img src="{{asset('imgs/materials/' . $Material->image)}}" style="width: 200px; height: 150px;">
                        </th>
                        <td class="col text-center align-middle">{{ $Material->name}}</td>
                        <th class="col text-center align-middle">{{ $Material->costPerUnit}}</th>
                        <td class="col text-center align-middle">
                        <a href="javascript:void(0)" type="button" class="btn btn-sm btn-secondary rounded-pill px-3 edit" data-id="{{ $Material->id }}">Edit</a>
                            <a href="javascript:void(0)" type="button" class="btn btn-sm btn-danger rounded-pill px-3 delete" data-id="{{ $Material->id }}">Delete</a>
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
            {!! $Materials->links() !!}

        </div>
    </div>
</div>

<!-- ajax amd Js code -->

<script type="text/javascript">
      
 $(document).ready(function($){
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#addNewBook').click(function () {
       $('#addEditBookForm').trigger("reset");
       $('#ajaxBookModel').html("Add material");
       $('#ajax-book-model').modal('show');
    });
 
    $('body').on('click', '.edit', function () {
        var id = $(this).data('id');
         
        // ajax
        $.ajax({
            type:"POST",
            url: "{{ url('admin/edit-material') }}",
            data: { id: id },
            dataType: 'json',
            success: function(res){
              $('#ajaxBookModel').html("Edit material");
              $('#ajax-book-model').modal('show');
              $('#id').val(res.id);
              $('#name').val(res.name);
              $('#costPerUnit').val(res.costPerUnit);
              
            //   $('#image').val(res.image);
              console.log(res.name);

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
                        url: "{{ url('admin/delete-material') }}",
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
            var url = "{{ url('admin/add-update-material') }}";
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