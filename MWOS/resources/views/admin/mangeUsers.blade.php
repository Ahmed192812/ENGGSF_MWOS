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

<section class="intro mt-3">

    <div class="mask d-flex align-items-center h-100" >
    @if (session('found'))
    <div class="alert alert-success">
        {{ session('found') }}
    </div>
@endif
@if (session('NoFound'))
    <div class="alert alert-danger">
        {{ session('NoFound') }}
    </div>
@endif
    
      <div class="container">
      <div class="row mb-3">
        <div class="col-4">
        <div class="search">
            <i class="fa fa-search"></i>
            <form action="{{ route('admin.usersSearch') }}" method="GET">
                <div class="row">
                    <div class="col-11">
                    <input type="search" name="search" class="form-control col-8" placeholder="you can search for any record">
                    </div>
                    <div class="col-1">
                    <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="col-4">
        </div>
        <div class="col-4 text-end">
       <div class="row">
        <div class="col-6">
        <div class="dropdown ">
                <button class="btn btn-sm btn-primary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Filter
                </button>
                <ul class="dropdown-menu">
                <!-- @php $admin = 1; $customer = 2;$carpenter = 3 @endphp -->
                    <li>
                      <form action="{{ route('admin.mangeUsersFilter') }}" method="GET">
                        <input type="hidden" name="filter" value="1">
                        <button class="dropdown-item" type="submit">filter By Admins</button></li>
                      </form>
                    <li>
                    <form action="{{ route('admin.mangeUsersFilter') }}" method="GET">
                        <input type="hidden" name="filter" value="2">
                        <button class="dropdown-item" type="submit">filter By Customers</button>
                      </form> 
                      </li> 
                    <li>
                    <form action="{{ route('admin.mangeUsersFilter') }}" method="GET">
                        <input type="hidden" name="filter" value="3">
                        <button class="dropdown-item" type="submit">filter By Carpenters</button>
                      </form>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('admin.mangeUsers') }}" >All Users</a>
                 
                    </li>


                </ul>
            </div>
        </div>
        <div class="col-6">
          
        <button class="btn btn-primary Adding" type="button" data-bs-toggle="modal" data-bs-target="#ajax-book-model">+ Add User</button>
        </div>
       </div>
       
                    
        </div>
       
    
        
    </div>
      <!-- <div class="px-1 mb-3">
          
        </div> -->
        <div class="row justify-content-center">
          <div class="col-12">
            <div class="card  shadow-2-strong">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped m-0 align-bottom borde">
                    <thead>
                      <tr>
                      <th scope="col">#</th>
                        <th scope="col">EMPLOYEES</th>
                        <th scope="col">POSITION</th>
                        <th scope="col">Email</th>
                        <th scope="col">PHONE NUMBER</th>
                        <th scope="col">Action</th>
                        
                      </tr>
                    </thead>
                    <tbody> 
              @if($Users->isNotEmpty())
                @foreach ($Users as $OneUser)

                <tr>
                    <td>{{ $OneUser->id }}</td>
                    <td>{{ $OneUser->Fname }} {{ $OneUser->Lname }}</td>
                    <td>@if($OneUser->role == 1) Admin  @elseif($OneUser->role == 3) carpenter @elseif($OneUser->role == 2)Customer @endif </td>
                    <td>{{ $OneUser->email }}</td>
                    <td>{{ $OneUser->phoneNumber }}</td>
                    <td>
                    <a href="javascript:void(0)" type="button" class="btn btn-sm btn-secondary rounded-pill px-3 edit" data-id="{{ $OneUser->id }}">Edit</a>
                    <a href="javascript:void(0)" type="button" class="btn btn-sm btn-danger rounded-pill px-3 delete" data-id="{{ $OneUser->id }}">Delete</a>
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
                     {!! $Users->links() !!}
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

 <!-- Add Admin Modal -->
 <div class="modal fade" id="ajax-book-model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ajaxBookModel">Add Employee</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                     <form action="javascript:void(0)" id="addEditBookForm" name="addEditBookForm" method="POST">
                      <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                            <label class="form-label">first name</label>
                            <input id="fname" name="fname" type="text" class="form-control inputDis" value="" >
                            <span class="text-danger error-text fname_error"></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Last Name</label>
                            <input id="lname" name="lname" type="text" class="form-control inputDis" value="" >
                            <span class="text-danger error-text lname_error"></span>

                        </div>
                        <div class="mb-3">
                            <label class="form-label">email</label>
                            <input id="email" name="email" type="email" class="form-control inputDis" value="" >
                            <span class="text-danger error-text email_error"></span>
                        </div>
                        <div class="mb-3">
                                <label class="form-label my-1" for="form2Example18">Phone Number</label>
                                <input id="phoneNumber" type="tel" class="form-control inputDis" placeholder="092345678" name="phoneNumber" value="" autocomplete="phoneNumber" autofocus />
                                <span class="text-danger error-text phoneNumber_error"></span>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">role</label>
                            <select name="role" id="role" class="form-control inputDis">
                                <option value="" disabled="true" selected>Select Employee Role</option>
                                <option value="1">Admin</option>
                                <option value="3">Carpenter</option>
                                <option value="2"  disabled="true">Customer</option>
                            </Select>
                            <span class="text-danger error-text role_error"></span>
                        </div>
                        
                        <div class="mb-3" id="addressDisable">
                            <label class="form-label">Address</label>
                            <input id="address" name="address" type="text" class="form-control inputDis" value="" >

                        </div>
                        <div class="mb-3" id="passwordDisable" >
                            <label class="form-label">password</label>
                            <input id="password" name="password" type="password" class="form-control inputDis" value="" required>
                            <span class="text-danger error-text password_error"></span>
                        </div>
                        <div class="mb-3" id="ConfirmPasswordDisable">
                            <label class="form-label">Confirm password</label>
                            <input id="ConfirmPassword" name="password_confirmation" type="password" class="form-control inputDis" value="" required>
                            <span class="text-danger error-text Confirm_Password_error"></span>
                        </div>
                       
                        <div class="mb-3" id="verifiedByDisable" >
                        <label class="form-label my-1" for="form2Example28">verify By</label>
                        <select name="verifiedBy" id="verifiedBy" class="form-control inputDis">
                                <option value="" disabled="true" selected>Select verify method </option>
                                <option value="1">email</option>
                                <option value="2">phone number</option>
                            </Select>
                            <span class="text-danger error-text verifiedBy_error"></span>

                            
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

    <script type="text/javascript">
         $('body').on('click', '.Adding', function () {
        var cells = document.getElementsByClassName("inputDis"); 
        for (var i = 0; i < cells.length; i++) { 
            cells[i].disabled = false;
        }
          document.getElementById("passwordDisable").style.display = "block";
          document.getElementById("ConfirmPasswordDisable").style.display = "block";
          document.getElementById("verifiedByDisable").style.display = "block";
          document.getElementById("btn-save").style.display = "block";
          document.getElementById("addressDisable").style.display = "none";
          document.getElementById("addEditBookForm").reset();

         });
 $(document).ready(function($){
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#addNewBook').click(function () {
       $('#addEditBookForm').trigger("reset");
       $('#ajaxBookModel').html("Add Employee");
       $('#ajax-book-model').modal('show');
    });
 
    $('body').on('click', '.edit', function () {
        var id = $(this).data('id');
        document.getElementById("passwordDisable").style.display = "none";
        document.getElementById("ConfirmPasswordDisable").style.display = "none";
        document.getElementById("verifiedByDisable").style.display = "none";
        document.getElementById("addressDisable").style.display = "block";
        document.getElementById("btn-save").style.display = "none";
        var cells = document.getElementsByClassName("inputDis"); 
        for (var i = 0; i < cells.length; i++) { 
            cells[i].disabled = true;
        }


 

        // ajax
        $.ajax({
            type:"POST",
            url: "{{ url('admin/edit-mangeUsers') }}",
            data: { id: id },
            dataType: 'json',
            success: function(res){
              $('#ajaxBookModel').html("View Employee");
              $('#ajax-book-model').modal('show');
              $('#fname').val(res.Fname);
              $('#lname').val(res.Lname);
              $('#email').val(res.email);
              $('#role').val(res.role);
              $('#address').val(res.Address);
              $('#phoneNumber').val(res.phoneNumber);
              $('#password').val(res.password);
              
             

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
                        url: "{{ url('admin/delete-mangeUsers') }}",
                        data: { id: id },
                        dataType: 'json',
                        success: function(res){
                        window.location.reload();
                        }
                    });
                Swal.fire(
                'Deleted!',
                'User has been deleted.',
                'success'
                )
            }
            })

    });

    $('body').on('click', '#btn-save', function (e) {

           e.preventDefault()
            var url = "{{ url('admin/add-update-mangeUsers') }}";
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
                        // if (val[5]) {
                        //   $('span.'+prefix+'_error').text(val[5]);
                        // }
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
  
            
           
           },
         
        
        });
      
    });
    
   
});



</script>


@endsection
