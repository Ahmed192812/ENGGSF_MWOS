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
            
        </div>
        <div class="col-2 text-end">
        </div>
    </div>

    <br>
    <div class="row mb-2 text-center">
        <div class="col">
        <table class="table table-striped m-0 align-bottom border">
                <thead>
                    <tr class="text-center">
                        <th scope="col">name</th>
                        <th scope="col-4">quintets</th>
                        <th scope="col">price</th>
                        <th scope="col">status</th>
                        <th scope="col">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                @if($orders->isNotEmpty() && $repairs->isNotEmpty() && $customs->isNotEmpty())
                @foreach ($orders as $order)
                    <tr>
                        <td class="col text-center align-middle">{{ $order->name}}</td>
                        <td class="col text-center align-middle">{{ $order->quantity}}</th>                      
                        <td class="col text-center align-middle">{{ $order->price}}</td>
                        <td class="col text-center align-middle">
                        @if($order->status == "Pending")
                        <span class="badge bg-info text-dark">{{ $order->status}}</span>
                        @else
                        <span class="badge bg-warning text-dark">{{ $order->status}}</span>
                        @endif
                        </td>

                        <td class="col text-center align-middle">
                        <a href="javascript:void(0)" type="button" class="btn btn-sm btn-secondary rounded-pill px-3 viewOrders" data-id="{{ $order->orderId }}">Edit</a>
                            <a href="javascript:void(0)" type="button" class="btn btn-sm btn-danger rounded-pill px-3 delete" data-id="{{ $order->orderId }}">Delete</a>
                        </td>
                    </tr>
                            @endforeach
                            @foreach ($customs as $custom)
                    <tr>
                        <td class="col text-center align-middle">A Custom {{ $custom->prodCategory}}</td>
                        <td class="col text-center align-middle">{{ $custom->quantity}}</th>                      
                        <td class="col text-center align-middle">@if($custom->price == null) price not yet here  @else{{ $custom->price }} @endif</td>
                        <td class="col text-center align-middle">
                        @if($custom->status == "Pending")
                        <span class="badge bg-info text-dark">{{ $custom->status}}</span>
                        @else
                        <span class="badge bg-warning text-dark">{{ $custom->status}}</span>
                        @endif
                        </td>

                        <td class="col text-center align-middle">
                        <a href="javascript:void(0)" type="button" class="btn btn-sm btn-secondary rounded-pill px-3 viewCustom" data-id="{{ $custom->CustomId }}">Edit</a>
                            <a href="javascript:void(0)" type="button" class="btn btn-sm btn-danger rounded-pill px-3 delete" data-id="{{ $custom->CustomId }}">Delete</a>
                        </td>
                    </tr>
                            @endforeach
                            @foreach ($repairs as $repair)
                    <tr>
                        <td class="col text-center align-middle">repair a {{ $repair->prodCategory}}</td>
                        <td class="col text-center align-middle">{{ $repair->quantity}}</th>                      
                        <td class="col text-center align-middle">
                        @if($repair->estimatedPrice == null && $repair->actualPrice == null) 
                            price not yet here 
                        @elseif($repair->estimatedPrice !== null && $repair->actualPrice == null )
                            estimated price({{ $repair->estimatedPrice }}) 
                        @elseif($repair->estimatedPrice !== null && $repair->actualPrice !== null )
                            {{ $repair->actualPrice }}
                         @else {{ $repair->actualPrice }} @endif
                    </td>
                        <td class="col text-center align-middle">
                        @if($repair->status == "Pending")
                        <span class="badge bg-info text-dark">{{ $repair->status}}</span>
                        @else
                        <span class="badge bg-warning text-dark">{{ $repair->status}}</span>
                        @endif
                        </td>

                        <td class="col text-center align-middle">
                        <a href="javascript:void(0)" type="button" class="btn btn-sm btn-secondary rounded-pill px-3 viewRepair" data-id="{{ $repair->repairsId }}">Edit</a>
                            <a href="javascript:void(0)" type="button" class="btn btn-sm btn-danger rounded-pill px-3 delete" data-id="{{ $repair->repairsId }}">Delete</a>
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
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#viewOrderModal">
    Open modal
  </button>

<div class="modal" id="viewOrderModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <i class="fab fa-apple fa-lg pt-3 pb-1 px-3"></i>
          <img id="image" src=""
            class="card-img-top" alt="Apple Computer" style="width: 50%; height: 40%; margin-left: 20%; margin-bottom: 5%;"/>
            <h3 class="text-center mb-5">order details</h3>
            <form action="javascript:void(0)" id="addEditBookForm" name="addEditBookForm" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id" >

                      <div class="row">
                        <div class="col-6">
                        <div class="mb-3">
                            <label id="label1" class="form-label">product Name</label>
                            <input name="name" id="name" type="text" class="form-control  orderInputDes repairInputDes" value="">
                            <span class="text-danger error-text name_error errorSpan"></span>
                        </div>

                        </div>
                        <div class="col-6">
                        <div class="mb-3">
                            <label id="label2" class="form-label">Product Category</label>
                            <select name="prodCategory_id" id="prodCategory_id" class="form-control orderInputDes repairInputDes">
                                <option selected>select product category</option>
                                @foreach ($productCategory as $Product)
                                <option value="{{$Product->productCategoryId}}">{{$Product->prodCategory}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-text prodCategory_id_error errorSpan"></span>
                        </div>
                        
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-6">

                        <div class="mb-3">
                            <label id="label3" class="form-label">Size(L*W*H)</label>
                                <div class="col-12">
                                    <input type="text" name="size" id="size" class="form-control orderInputDes" placeholder="Length" value="">
                                    <span class="text-danger error-text tall_error errorSpan"></span>
                                </div>
                               
                          </div>
                        </div>
                        <div class="col-6">
                        <div class="mb-3">
                            <label id="label4" class="form-label">Price</label>
                            <input name="price" id="price" type="text" class="form-control orderInputDes" value="">
                            <span class="text-danger error-text price_error errorSpan"></span>
                        </div>
                        
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-6">
                        <div class="mb-3" id="materialHid">
                            <label id="label5" class="form-label">Material</label>
                            <select name="material_id" id="material_id" class="form-control orderInputDes">
                                <option selected>select Material</option>
                                @foreach ($Materials as $Material)
                                <option value="{{$Material->MaterialsId}}">{{$Material->name}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-text material_id_error errorSpan"></span>
                        </div>

                        </div>
                        <div class="col-6">
                        <div class="mb-3">
                            <label id="label6" class="form-label">payment_type</label>
                            <input name="payment_type" id="payment_type" type="text" class="form-control orderInputDes repairInputDes" value="">
                            <span class="text-danger error-text name_error errorSpan"></span>
                        </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-6">
                        <div class="mb-3">
                            <label id="label7" class="form-label">quantity</label>
                                <div class="col-12">
                                    <input type="text" name="quantity" id="quantity" class="form-control repairInputDes" placeholder="Length" value="">
                                    <span class="text-danger error-text quantity_error errorSpan"></span>
                                </div>
                               
                          </div>

                        </div>
                        <div class="col-6">
                        <div class="mb-3">
                            <label id="label8" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option selected value="">Status</option>
                                <option value="TBR">To Be Reviewed</option>
                                <option value="Accepted">Accepted</option>
                                <option value="Declined">Declined</option>
                                <option value="Pending">Pending payment/materials</option>
                                <option value="processing">processing</option>
                                <option value="done">for delivery/pek up</option>

                            </select>

                        </div>
                        
                        </div>
                      </div>       
                      <div class="mb-3">
                            <label id="label9" class="form-label">Description</label><br>
                            <textarea cols="30" rows="5" name="description" id="description" class="form-control orderInputDes repairInputDes" value=""></textarea>
                            <span class="text-danger error-text description_error errorSpan"></span>
                        </div>
                       
                      
                    </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      <div class="text-end">
                            <button type="submit" class="btn btn-primary" id="btn-save" value="addNewBook">Save changes</button>
                        </div>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
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

 
    $('body').on('click', '.viewRepair', function () {
        var id = $(this).data('id');
        document.getElementById("materialHid").style.display = "none";
        var cells = document.getElementsByClassName("orderInputDes"); 
        for (var i = 0; i < cells.length; i++) { 
            cells[i].disabled = false;
        }
        var cells = document.getElementsByClassName("repairInputDes"); 
        for (var i = 0; i < cells.length; i++) { 
            cells[i].disabled = true;
        }
        // ajax
        $.ajax({
            type:"POST",
            url: "{{ url('admin/edit-repairOrder') }}",
            data: { id: id },
            dataType: 'json',
            success: function(res){
              $('#viewOrderModal').modal('show');
              //change the span text of the modal
              $('#label1').text('order Name');
              $('#label2').text('Product Category');
              $('#label3').text('Estimated Price');
              $('#label4').text('actualPrice');
              $('#label6').text('payment type');
              $('#label7').text('quantity');
              // $('#label8').text('status');
              $('#label9').text('furniture State');


              // change the span value from the data base 
              $('#name').val('repair a '+ res.prodCategory);
              if (res.estimatedPrice == null) {
                $('#size').val('Not determined Yet');
              }
              else{
                $('#size').val(res.estimatedPrice);
              }
              if (res.actualPrice == null) {
                $('#price').val('Not determined Yet');            
              }
              else{
                $('price').val(res.actualPrice);            
              }
              $('#prodCategory_id').val(res.	productCategory_id);
              $('#description').val(res.furnitureState);
              $('#status').val(res.status);
              $('#quantity').val('not available');
              $('#payment_type').val(res.payment_type);


              var ImagURL = '{{ URL::asset('/imgs/products/') }}'+'/'+res.image;
            console.log(ImagURL);
              $('#image').attr('src', ImagURL);
              //testing
            //   console.log(res.furnitureState);
            //   $('#image').val(res.image);
            //   console.log(image);

           }
              
        });
          
    });
    $('body').on('click', '.viewCustom', function () {
        var id = $(this).data('id');
        console.log(id);
        // ajax
        $.ajax({
            type:"POST",
            url: "{{ url('admin/edit-customOrder') }}",
            data: { id: id },
            dataType: 'json',
            success: function(res){
              $('#viewOrderModal').modal('show');
              //product name = type of service + product category
             //change the span text of the modal
             $('#1stSpan').text('description');
              $('#2ndSpan').text('quantity');
              $('#3edSpan').text('price');
              $('#4thSpan').text('product Category');
              $('#5thSpan').text('Material');
              $('#6thSpan').text('Desired Material');

             
             // change the span value from the data base 
             $('#productname').text('custom '+ res.prodCategory);
              $('#1stSpanValue').text(res.description);
              $('#2edSpanValue').text(res.quantity);
              if (res.price == null) {
                $('#3edSpanValue').text('Not Determined Yet');
              }else{$('#3edSpanValue').text(res.price);}
              
              $('#4thSpanValue').text(res.prodCategory);
              $('#5thSpanValue').text(res.name);
              $('#6thSpanValue').text(res.desiredMaterial);
              var ImagURL = '{{ URL::asset('/imgs/products/') }}'+'/'+res.customImage;
            console.log(ImagURL);
              $('#image').attr('src', ImagURL);
            //   console.log(res.furnitureState);
           

           }
              
        });
          
    });

    $('body').on('click', '.viewOrders', function () {
        var id = $(this).data('id');
        console.log(id);
        document.getElementById("materialHid").style.display = "block";
        var cells = document.getElementsByClassName("repairInputDes"); 
        for (var i = 0; i < cells.length; i++) { 
            cells[i].disabled = false;
        }
        var cells = document.getElementsByClassName("orderInputDes"); 
        for (var i = 0; i < cells.length; i++) { 
            cells[i].disabled = true;
        }
        // ajax
        $.ajax({
            type:"POST",
            url: "{{ url('admin/edit-Orders') }}",
            data: { id: id },
            dataType: 'json',
            success: function(res){
              $('#viewOrderModal').modal('show');
              //product name is type of service + product category
              //change the span text of the modal
              $('#label1').text('Product Name');
              $('#label2').text('Product Category');
              $('#label3').text('Size');
              $('#label4').text('Price');
              $('#label5').text('Material');
              $('#label6').text('Payment Type');
              $('#label7').text('quantity');
              $('#label8').text('status');
              $('#label9').text('Description');

              
             // change the span value from the database
             $('#id').val(res.id);
              $('#name').val(res.name);
              $('#prodCategory_id').val(res.prodCategory_id);
              $('#size').val(res.tall+"*"+res.height+"*"+res.width);
              $('#material_id').val(res.material_id );
              $('#description').val(res.description);
              $('#status').val(res.status);
              $('#price').val(res.price);
              $('#quantity').val(res.quantity);
              $('#payment_type').val(res.payment_type);




              
            //   var src = ($(this).attr('src') === );
            var ImagURL = '{{ URL::asset('/imgs/products/') }}'+'/'+res.image;
            console.log(ImagURL);
              $('#image').attr('src', ImagURL);

            //   console.log(res.furnitureState);
           

           }
              
        });
          
    });
    
    // $('body').on('click', '.delete', function () {


    //                 Swal.fire({
    //         title: 'Are you sure?',
    //         text: "You won't be able to revert this!",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Yes, delete it!'
    //         }).then((result) => {
    //         if (result.isConfirmed) {
    //             var id = $(this).data('id');
    //                 // ajax
    //                 $.ajax({
    //                     type:"POST",
    //                     url: "{{ url('admin/delete-material') }}",
    //                     data: { id: id },
    //                     dataType: 'json',
    //                     success: function(res){
    //                     window.location.reload();
    //                     }
    //                 });
    //             Swal.fire(
    //             'Deleted!',
    //             'YRecord has been deleted.',
    //             'success'
    //             )
    //         }
    //         })

    // });

    
   
});




</script>
@endsection