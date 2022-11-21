<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<meta name="csrf-token" content="{{ csrf_token() }}">

@extends('user.userLayout')

@section('content')

<div class="container my-4">
<div class="row rounded-4 p-3 border shadow-lg text-center g-0 m-0 mb-2">
        <div class="col text-bottom">
            <b>Product name</b>
        </div>
        <div class="col">
            <b>price</b>
        </div>
        <div class="col">
            <b>quantity</b>
        </div>
        <div class="col">
           <b>Status</b>
        </div>
        <div class="col">
         <b>Action</b>
        </div>
    </div>
    @foreach($orders as $order)
    <div class="row rounded-4 p-3 border shadow-lg mb-1 text-center g-0 m-0">
        <div class="col text-bottom">
            <p>{{ $order->name }}</p>
        </div>
        <div class="col">
            <p>{{ $order->price }}</p>
        </div>
        <div class="col">
            <p>{{ $order->quantity }}</p>
        </div>
        <div class="col">
            @if($order->status == "Pending")
            <button class="btn btn-success btn-sm px-3 rounded-pill">{{ $order->status }}</button>
            @endif
        </div>
        <div class="col">
        <a href="javascript:void(0)" type="button" class="btn btn-outline-info btn-sm px-3 rounded-pill viewOrders" data-id="{{ $order->orderId }}">View</a>
            <button class="btn btn-outline-danger btn-sm px-3 rounded-pill">Cancel</button>
        </div>
    </div>
    @endforeach
    @foreach($customs as $custom)
    <div class="row rounded-4 p-3 border shadow-lg mb-1 text-center g-0 m-0">
        <div class="col text-bottom">
            <p> Custom {{ $custom->prodCategory }}</p>
        </div>
        <div class="col">
            <p>@if($custom->price == null) price not yet here  @else{{ $custom->price }} @endif</p>
        </div>
        <div class="col">
            <p>{{ $custom->	description }}</p>
        </div>
        <div class="col">
          
            <button class="btn btn-info btn-sm px-3 rounded-pill">processing</button>

        </div>
        <div class="col">
            <a href="javascript:void(0)" type="button" class="btn btn-outline-info btn-sm px-3 rounded-pill viewCustom" data-id="{{ $custom->CustomId }}">View</a>
            <button class="btn btn-outline-danger btn-sm px-3 rounded-pill">Cancel</button>
        </div>
    </div>
    @endforeach
    @foreach($repairs as $repair)
    <div class="row rounded-4 p-3 border shadow-lg mb-1 text-center g-0 m-0">
        <div class="col text-bottom">
            <p> Repair {{ $repair->prodCategory }} </p>
        </div>
        <div class="col">
            <p>@if($repair->estimatedPrice == null) price not yet here  @else{{ $repair->estimatedPrice }} @endif</p>
        </div>
        <div class="col">
            <p>{{ $repair->	furnitureState }}</p>
        </div>
        <div class="col">
          
            <button class="btn btn-info btn-sm px-3 rounded-pill">processing</button>

        </div>
        <div class="col">
            <a href="javascript:void(0)" type="button" class="btn btn-outline-info btn-sm px-3 rounded-pill viewRepair" data-id="{{ $repair->repairsId }}">View</a>
            <button class="btn btn-outline-danger btn-sm px-3 rounded-pill">Cancel</button>
        </div>
    </div>
    @endforeach
</div>


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#viewOrderModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="viewOrderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-body">
      <section style="background-color: #eee;">
  <div class="container ">
    <div class="row justify-content-center">
        <div class="card text-black">
          <i class="fab fa-apple fa-lg pt-3 pb-1 px-3"></i>
          <img id="image" src=""
            class="card-img-top" alt="Apple Computer" />
          <div class="card-body">
            <div class="text-center">
              <h5  class="card-title">you Order details</h5>
              <p id="productname" class="text-muted mb-4"></p>
            </div>
            <div>
              <div class="d-flex justify-content-between">
                <span id="1stSpan"></span><span id="1stSpanValue">$5,999</span>
              </div>
              <div class="d-flex justify-content-between">
                <span id="2ndSpan" ></span><span id="2edSpanValue">$999</span>
              </div>
              <div class="d-flex justify-content-between">
                <span id="3edSpan"></span><span id="3edSpanValue">$199</span>
              </div>
              <div class="d-flex justify-content-between">
                <span id="4thSpan"></span><span id="4thSpanValue">$199</span>
              </div>
              <div class="d-flex justify-content-between">
                <span id="5thSpan"></span><span id="5thSpanValue"></span>
              </div>
              <div class="d-flex justify-content-between">
                <span id="6thSpan"></span><span id="6thSpanValue"></span>
              </div>
              
            </div>
            <div class="d-flex justify-content-between total font-weight-bold mt-4">
              <span >Status</span><span>pending</span>
            </div>
          </div>
        </div>
    </div>
  </div>
</section>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
        
        // ajax
        $.ajax({
            type:"POST",
            url: "{{ url('user/edit-repairOrder') }}",
            data: { id: id },
            dataType: 'json',
            success: function(res){
              $('#viewOrderModal').modal('show');
              //change the span text of the modal
              $('#1stSpan').text('Estimated Price');
              $('#2ndSpan').text('Actual Price');
              $('#3edSpan').text('Product Category');
              $('#4thSpan').text('furniture State');
              // change the span value from the data base 
              $('#productname').text('repair a '+ res.prodCategory);
              $('#1stSpanValue').text(res.estimatedPrice);
              $('#2edSpanValue').text(res.actualPrice);            
              $('#3edSpanValue').text(res.prodCategory);
              $('#4thSpanValue').text(res.furnitureState);

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
            url: "{{ url('user/edit-customOrder') }}",
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
              $('#3edSpanValue').text(res.price);
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
        // console.log(id);
        // ajax
        $.ajax({
            type:"POST",
            url: "{{ url('user/edit-Orders') }}",
            data: { id: id },
            dataType: 'json',
            success: function(res){
              $('#viewOrderModal').modal('show');
              //product name is type of service + product category
             //change the span text of the modal
             $('#1stSpan').text('description');
              $('#2ndSpan').text('quantity');
              $('#3edSpan').text('price');
              $('#4thSpan').text('Product Category');
              $('#5thSpan').text('payment type');
              $('#6thSpan').text('Siz(L*H*W)');

              
             // change the span value from the data base
             $('#productname').text(res.name +' from E-Catalog'); 
              $('#1stSpanValue').text(res.description);
              $('#2edSpanValue').text(res.quantity);
              $('#3edSpanValue').text(res.price);
              $('#4thSpanValue').text(res.prodCategory);
              $('#5thSpanValue').text(res.payment_type);
              $('#6thSpanValue').text(res.tall+"*"+res.height+"*"+res.width);
              
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