<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<meta name="csrf-token" content="{{ csrf_token() }}">

@extends('user.userLayout')

@section('content')
@if (session('Success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <span>{{ session('Success') }}</span>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="container">
  <form action="{{ route('user.orders') }}" method="get">
    @csrf
    <button type="submit" name="input" class="btn btn-sm rounded-pill px-3 me-2 @if($input == 'Orders' || empty($input)) btn-secondary @else btn-outline-secondary @endif" value="Orders">Orders</button>
    <button type="submit" name="input" class="btn btn-sm rounded-pill px-3 me-2 @if($input == 'Repairs')btn-secondary @else btn-outline-secondary @endif" value="Repairs">Repairs</button>
    <button type="submit" name="input" class="btn btn-sm rounded-pill px-3 @if($input == 'Customs') btn-secondary @else btn-outline-secondary @endif" value="Customs">Customs</button>
  </form>

  <div class="card shadow mb-2">
    <div class="card-body text-center">
      <div class="d-flex justify-content-center">
        <div class="col-3 fw-bold">Date</div>
        <div class="col-3 fw-bold">Product</div>
        <div class="col-3 fw-bold">Status</div>
        <div class="col-3 fw-bold">Actions</div>
      </div>
    </div>
  </div>

  <div class="card shadow">
    <div class="card-body">
      <div class="table-responsive-sm">
        <table class="table table-hover text-center m-0">
          <tbody>
            @if(empty($input) || $input == "Orders")
            @foreach ($orders as $order)
            <tr class="align-middle">
              <td class="col-3">{!! date('j F Y', strtotime($order->date)) !!}</td>
              <td class="col-3">{{ $order->name }}</td>
              <td class="col-3">
                @if($order->status == "Pending")
                <span class="badge bg-info text-dark">{{ $order->status}} Payment/Material</span>
                @elseif($order->status == "TBR")
                <span class="badge bg-warning text-dark">To Be Reviewed</span>
                @elseif($order->status == "Accepted")
                <span class="badge bg-light text-dark">{{ $order->status}}</span>
                @elseif($order->status == "Cancelled")
                <span class="badge bg-danger text-dark">{{ $order->status}}</span>
                @elseif($order->status == "processing")
                <span class="badge bg-dark text-light">{{ $order->status}}</span>
                @elseif($order->status == "FDP")
                <span class="badge bg-light text-dark">for Delivery /pek up</span>
                @elseif($order->status == "done")
                <span class="badge bg-success text-light">Completed</span>
                @endif
              </td>
              <td class="col-3">
                <a href="javascript:void(0)" type="button" class="btn btn-outline-info btn-sm px-3 rounded-pill viewOrders" data-id="{{ $order->orderId }}">View</a>
                @if($order->status == "TBR")
                <form class="g-0 m-0" action="{{ route('user.cancel') }}" method="get">
                  @csrf
                  <input type="hidden" name="order" value="{{ $order->orderId }}">
                  <button class="btn btn-outline-danger btn-sm px-3 rounded-pill">Delete</button>
                </form>
                @endif
              </td>
            </tr>
            @endforeach

            @elseif($input == "Repairs")
            @foreach ($repairs as $repair)
            <tr class="align-middle">
              <td class="col-3">{!! date('j F Y', strtotime($repair->date)) !!}</td>
              <td class="col-3">{{ $repair->prodCategory }}</td>
              <td class="col-3">
                @if($repair->status == "Pending")
                <span class="badge bg-info text-dark">{{ $repair->status}} Payment/Material</span>
                @elseif($repair->status == "TBR")
                <span class="badge bg-warning text-dark">To Be Reviewed</span>
                @elseif($repair->status == "Accepted")
                <span class="badge bg-light text-dark">{{ $repair->status}}</span>
                @elseif($repair->status == "Cancelled")
                <span class="badge bg-danger text-dark">{{ $repair->status}}</span>
                @elseif($repair->status == "processing")
                <span class="badge bg-dark text-light">{{ $repair->status}}</span>
                @elseif($repair->status == "done")
                <span class="badge bg-success text-light">Completed</span>
                @elseif($repair->status == "FDP")
                <span class="badge bg-light text-dark">for Delivery /pek up</span>
                @endif
              </td>
              <td class="col-3">
                <a href="javascript:void(0)" type="button" class="btn btn-outline-info btn-sm px-3 rounded-pill viewRepair" data-id="{{ $repair->repairsId }}">View</a>
                @if($repair->status == "TBR")
                <form class="g-0 m-0" action="{{ route('user.cancel') }}" method="get">
                  @csrf
                  <input type="hidden" name="repair" value="{{ $repair->repairsId }}">
                  <button class="btn btn-outline-danger btn-sm px-3 rounded-pill">Delete</button>
                </form>
                @endif
              </td>
            </tr>
            @endforeach

            @elseif($input == "Customs")
            @foreach ($customs as $custom)
            <tr class="align-middle">
              <td class="col-3">{!! date('j F Y', strtotime($custom->date)) !!}</td>
              <td class="col-3">{{ $custom->prodCategory }}</td>
              <td class="col-3">
                @if($custom->status == "Pending")
                <span class="badge bg-info text-dark">{{ $custom->status}} Payment/Material</span>
                @elseif($custom->status == "TBR")
                <span class="badge bg-warning text-dark">To Be Reviewed</span>
                @elseif($custom->status == "Accepted")
                <span class="badge bg-light text-dark">{{ $custom->status}}</span>
                @elseif($custom->status == "Declined")
                <span class="badge bg-danger text-dark">{{ $custom->status}}</span>
                @elseif($custom->status == "processing")
                <span class="badge bg-dark text-light">{{ $custom->status}}</span>
                @elseif($custom->status == "done")
                <span class="badge bg-success text-light">Completed</span>
                @elseif($custom->status == "FDP")
                <span class="badge bg-light text-dark">for Delivery /pek up</span>
                @endif
              </td>
              <td class="col-3">
                <a href="javascript:void(0)" type="button" class="btn btn-outline-info btn-sm px-3 rounded-pill viewCustom" data-id="{{ $custom->CustomId }}">View</a>
                @if($custom->status == "TBR")
                <form class="g-0 m-0" action="{{ route('user.cancel') }}" method="get">
                  @csrf
                  <input type="hidden" name="custom" value="{{ $custom->CustomId }}">
                  <button class="btn btn-outline-danger btn-sm px-3 rounded-pill">Delete</button>
                </form>
                @endif
              </td>
            </tr>
            @endforeach
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<!-- Button trigger modal 
<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#viewOrderModal">
  Launch demo modal
</button>-->

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
                <img id="image" src="" class="card-img-top" alt="Apple Computer" />
                <div class="card-body">
                  <div class="text-center">
                    <h5 class="card-title">you Order details</h5>
                    <p id="productname" class="text-muted mb-4"></p>
                  </div>
                  <div>
                    <div class="d-flex justify-content-between">
                      <span id="1stSpan"></span><span id="1stSpanValue">$5,999</span>
                    </div>
                    <div class="d-flex justify-content-between">
                      <span id="2ndSpan"></span><span id="2edSpanValue">$999</span>
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
                    <span>Status</span><span>pending</span>
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
  $(document).ready(function($) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });


    $('body').on('click', '.viewRepair', function() {
      var id = $(this).data('id');

      // ajax
      $.ajax({
        type: "POST",
        url: "{{ url('user/edit-repairOrder') }}",
        data: {
          id: id
        },
        dataType: 'json',
        success: function(res) {
          $('#viewOrderModal').modal('show');
          //change the span text of the modal
          $('#1stSpan').text('Estimated Price');
          $('#2ndSpan').text('Actual Price');
          $('#3edSpan').text('Product Category');
          $('#4thSpan').text('furniture State');
          // change the span value from the data base 
          $('#productname').text('repair a ' + res.prodCategory);
          if (res.estimatedPrice == null) {
            $('#1stSpanValue').text('Not determined Yet');
          } else {
            $('#1stSpanValue').text(res.estimatedPrice);
          }
          if (res.actualPrice == null) {
            $('#2edSpanValue').text('Not determined Yet');
          } else {
            $('#2edSpanValue').text(res.actualPrice);
          }
          $('#3edSpanValue').text(res.prodCategory);
          $('#4thSpanValue').text(res.furnitureState);

          var ImagURL = '{{ URL::asset(' / imgs / products / ') }}' + '/' + res.image;
          console.log(ImagURL);
          $('#image').attr('src', ImagURL);
          //testing
          //   console.log(res.furnitureState);
          //   $('#image').val(res.image);
          //   console.log(image);

        }

      });

    });
    $('body').on('click', '.viewCustom', function() {
      var id = $(this).data('id');
      console.log(id);
      // ajax
      $.ajax({
        type: "POST",
        url: "{{ url('user/edit-customOrder') }}",
        data: {
          id: id
        },
        dataType: 'json',
        success: function(res) {
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
          $('#productname').text('custom ' + res.prodCategory);
          $('#1stSpanValue').text(res.description);
          $('#2edSpanValue').text(res.quantity);
          if (res.price == null) {
            $('#3edSpanValue').text('Not Determined Yet');
          } else {
            $('#3edSpanValue').text(res.price);
          }

          $('#4thSpanValue').text(res.prodCategory);
          $('#5thSpanValue').text(res.name);
          $('#6thSpanValue').text(res.desiredMaterial);
          var ImagURL = '{{ URL::asset(' / imgs / products / ') }}' + '/' + res.customImage;
          console.log(ImagURL);
          $('#image').attr('src', ImagURL);
          //   console.log(res.furnitureState);


        }

      });

    });

    $('body').on('click', '.viewOrders', function() {
      var id = $(this).data('id');
      // console.log(id);
      // ajax
      $.ajax({
        type: "POST",
        url: "{{ url('user/edit-Orders') }}",
        data: {
          id: id
        },
        dataType: 'json',
        success: function(res) {
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
          $('#productname').text(res.name + ' from E-Catalog');
          $('#1stSpanValue').text(res.description);
          $('#2edSpanValue').text(res.quantity);
          $('#3edSpanValue').text(res.price);
          $('#4thSpanValue').text(res.prodCategory);
          $('#5thSpanValue').text(res.payment_type);
          $('#6thSpanValue').text(res.tall + "*" + res.height + "*" + res.width);

          //   var src = ($(this).attr('src') === );
          var ImagURL = '{{ URL::asset(' / imgs / products / ') }}' + '/' + res.image;
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