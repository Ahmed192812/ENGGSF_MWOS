@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col">
        <form action="{{ route('admin.mangeOrders') }}" method="get">
            @csrf
            <button type="submit" name="input" class="btn btn-sm rounded-pill px-3 me-2 @if($input == 'Orders' || empty($input)) btn-secondary @else btn-outline-secondary @endif" value="Orders">Orders</button>
            <button type="submit" name="input" class="btn btn-sm rounded-pill px-3 me-2 @if($input == 'Repairs')btn-secondary @else btn-outline-secondary @endif" value="Repairs">Repairs</button>
            <button type="submit" name="input" class="btn btn-sm rounded-pill px-3 @if($input == 'Customs') btn-secondary @else btn-outline-secondary @endif" value="Customs">Customs</button>
        </form>
    </div>
    <div class="col text-end">
        <!-- <form class="d-flex justify-content-end" action="{{ route('admin.productCategorySearch') }}" method="GET">
            <input type="search" name="search" class="form-control me-2" placeholder="Search" style="width: 250px">
            <button class="btn btn-info me-2" type="submit"><i class="bi bi-search"></i></button>
        </form> -->
        @if(Auth::check() && Auth::user()->role == 1)
        <a href="{{ route('admin.ordersPdfPage-Allorders')}}" type="button" class="btn btn btn-sm btn-info"><i class="bi bi-filetype-pdf"></i></a>
        @endif
    </div>
</div>

<div class="row mt-3">
    <div class="col">
        <div class="table-responsive">
            <table class="table table-striped m-0 align-bottom text-center border">
                <thead>
                    <tr>
                        <th class="col-3">Date</th>
                        <th class="col-3">Product</th>
                        <th class="col-3">Status</th>
                        <th class="col-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if(empty($input) || $input == "Orders")
                    @foreach ($orders as $order)
                    <tr>
                        <td class="col-3">{!! date('j F Y', strtotime($order->date)) !!}</td>
                        <td class="col-3">{{ $order->name}}</td>
                        <td class="col-3">
                            @if($order->status == "Pending")
                            <span class="badge bg-info text-dark">{{ $order->status}} Payment/Material</span>
                            @elseif($order->status == "TBR")
                            <span class="badge bg-warning text-dark">To Be Reviewed</span>
                            @elseif($order->status == "Accepted")
                            <span class="badge bg-light text-dark">{{ $order->status}}</span>
                            @elseif($order->status == "Declined")
                            <span class="badge bg-danger text-dark">{{ $order->status}}</span>
                            @elseif($order->status == "processing")
                            <span class="badge bg-dark text-light">{{ $order->status}}</span>
                            @elseif($order->status == "done")
                            <span class="badge bg-success text-light">Completed</span>
                            @elseif($order->status == "FDP")
                            <span class="badge bg-light text-dark">for Delivery /pek up</span>
                            @endif
                        </td>
                        <td class="col-3">
                            <a href="javascript:void(0)" type="button" class="btn btn-sm btn-secondary rounded-pill px-3 viewOrders" data-id="{{ $order->orderId }}">View/Edit</a>
                            <a href="javascript:void(0)" type="button" class="btn btn-sm btn-danger rounded-pill px-3 deleteOrders" data-id="{{ $order->orderId }}">Delete</a>
                            @if($order->deleted_at !== null)
                            <form class="mt-2" action="{{ route('admin.restore-Orders')}}" method="post">
                                @csrf
                                <input type="hidden" name="id" value=" {{$order->orderId}} ">
                                <button type="submit" class="btn btn-sm btn-success rounded-pill px-3">Restore</a>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach

                    @elseif($input == "Repairs")
                    @foreach ($repairs as $repair)
                    <tr>
                        <td class="col-3">{!! date('j F Y', strtotime($repair->date)) !!}</td>
                        <td class="col-3">{{ $repair->prodCategory }}</td>
                        <td class="col-3">
                            @if($repair->status == "Pending")
                            <span class="badge bg-info text-dark">{{ $repair->status}} Payment/Material</span>
                            @elseif($repair->status == "TBR")
                            <span class="badge bg-warning text-dark">To Be Reviewed</span>
                            @elseif($repair->status == "Accepted")
                            <span class="badge bg-light text-dark">{{ $repair->status}}</span>
                            @elseif($repair->status == "Declined")
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
                            <a href="javascript:void(0)" type="button" class="btn btn-sm btn-secondary rounded-pill px-3 viewRepair" data-id="{{ $repair->repairsId }}">View/Edit</a>
                            <a href="javascript:void(0)" type="button" class="btn btn-sm btn-danger rounded-pill px-3 deleteRepair" data-id="{{ $repair->repairsId }}">Delete</a>
                            @if($repair->deleted_at !== null)
                            <form class="mt-2" action="{{ route('admin.restore-repairOrder')}}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{$repair->repairsId}}">
                                <button type="submit" class="btn btn-sm btn-success rounded-pill px-3">Restore</a>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach

                    @elseif($input == "Customs")
                    @foreach ($customs as $custom)
                    <tr>
                        <td class="col-3">{!! date('j F Y', strtotime($custom->date)) !!}</td>
                        <td class="col-3">A Custom {{ $custom->prodCategory}}</td>
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
                        <td class="col text-center align-middle">
                            <a href="javascript:void(0)" type="button" class="btn btn-sm btn-secondary rounded-pill px-3 viewCustom" data-id="{{ $custom->CustomId }}">View/Edit</a>
                            <a href="javascript:void(0)" type="button" class="btn btn-sm btn-danger rounded-pill px-3 deleteCustom" data-id="{{ $custom->CustomId }}">Delete</a>
                            @if($custom->deleted_at !== null)
                            <form class="mt-2" action="{{ route('admin.restore-customOrder')}}" method="post">
                                @csrf
                                <input type="hidden" name="id" value=" {{$custom->CustomId}} ">
                                <button type="submit" class="btn btn-sm btn-success rounded-pill px-3">Restore</a>
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


<div class="modal" id="viewOrderModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Order Details</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <i class="fab fa-apple fa-lg pt-3 pb-1 px-3"></i>
                <img id="image" src="" class="card-img-top" alt="Apple Computer" style="width: 50%; height: 40%; margin-left: 20%; margin-bottom: 5%;" />
                <form action="javascript:void(0)" id="addEditBookForm" name="addEditBookForm" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="repairsId" id="repairsId">
                    <input type="hidden" name="CustomId" id="CustomId">
                    <input type="hidden" name="orderId" id="orderId">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label id="label1" class="form-label">Product Name</label>
                                <input name="name" id="name" type="text" class="form-control  orderInputDes repairInputDes customInputDes AllDes" value="">
                                <span class="text-danger error-text name_error errorSpan"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label id="label2" class="form-label">Product Category</label>
                                <select name="prodCategory_id" id="prodCategory_id" class="form-control orderInputDes repairInputDes customInputDes AllDes">
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
                            <div class="mb-3" id="hideSize">
                                <label id="label3" class="form-label">Size(L*W*H)</label>
                                <div class="col-12">
                                    <input type="text" name="size" id="size" class="form-control orderInputDes AllDes" placeholder="estimated Price" value="">
                                    <span class="text-danger error-text tall_error errorSpan"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label id="label4" class="form-label">Price</label>
                                <input name="price" id="price" type="text" placeholder="Not determined Yet" class="form-control orderInputDes AllDes" value="">
                                <span class="text-danger error-text price_error errorSpan"></span>
                            </div>
                        </div>
                        @if(isset($message))
                        <span class="text-danger">{{$message}}</span>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3" id="materialHid">
                                <label id="label5" class="form-label">Material</label>
                                <select name="material_id" id="material_id" class="form-control orderInputDes customInputDes AllDes">
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
                                <label id="label6" class="form-label">Payment Type</label>
                                <input name="payment_type" id="payment_type" type="text" class="form-control orderInputDes repairInputDes customInputDes AllDes" value="">
                                <span class="text-danger error-text name_error errorSpan"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label id="label7" class="form-label">Quantity</label>
                                <div class="col-12">
                                    <input type="text" name="quantity" id="quantity" class="form-control repairInputDes AllDes" placeholder="quantity" value="">
                                    <span class="text-danger error-text quantity_error errorSpan"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label id="label8" class="form-label ">Status</label>
                                <select name="status" id="status" class="form-control AllDes">
                                    <option selected value="">Status</option>
                                    <option value="TBR">To Be Reviewed</option>
                                    <option value="Declined">Declined</option>
                                    <option value="Pending">Pending Payment/materials</option>
                                    <option value="processing">processing</option>
                                    <option value="FDP">for delivery/pek up</option>
                                    <option value="done">Completed</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label id="label9" class="form-label ">Description</label><br>
                        <textarea cols="30" rows="5" name="description" id="description" class="form-control orderInputDes repairInputDes customInputDes AllDes" value=""></textarea>
                        <span class="text-danger error-text description_error errorSpan"></span>
                    </div>
                    <div class="mb-3" id="customOnly">
                        <label id="label10" class="form-label ">Desired Material</label><br>
                        <textarea cols="30" rows="5" name="desiredMaterial" id="desiredMaterial" class="form-control orderInputDes repairInputDes customInputDes AllDes" value=""></textarea>
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
    $(document).ready(function($) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('body').on('click', '.viewRepair', function() {
            var id = $(this).data('id');
            document.getElementById("materialHid").style.display = "none";
            document.getElementById("hideSize").style.display = "block";
            document.getElementById("customOnly").style.display = "none";
            var cells = document.getElementsByClassName("customInputDes");
            for (var i = 0; i < cells.length; i++) {
                cells[i].disabled = false;
            }
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
                type: "POST",
                url: "{{ url('admin/edit-repairOrder') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    if (res.deleted_at !== null) {
                        var cells = document.getElementsByClassName("AllDes");
                        for (var i = 0; i < cells.length; i++) {
                            cells[i].disabled = true;
                        }
                    };
                    $('#viewOrderModal').modal('show');
                    //change the span text of the modal
                    $('#label1').text('Order Name');
                    $('#label2').text('Product Category');
                    $('#label3').text('Estimated Price');
                    $('#label4').text('Actual Price');
                    $('#label6').text('Payment Type');
                    $('#label7').text('Quantity');
                    // $('#label8').text('status');
                    $('#label9').text('furniture State');
                    // change the INPUT value from the data base 
                    $('#repairsId').val(res.repairsId);
                    $('#orderId').val(0);
                    $('#CustomId').val(0);
                    $('#name').val('repair a ' + res.prodCategory);
                    $('#size').val(res.estimatedPrice);
                    $('#price').val(res.actualPrice);
                    $('#prodCategory_id').val(res.productCategory_id);
                    $('#description').val(res.furnitureState);
                    $('#status').val(res.status);
                    $('#quantity').val('not available');
                    $('#payment_type').val(res.payment_type);
                    var ImagURL = '{{ URL::asset('/imgs/products/') }}' + '/' + res.image;
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
            var cells = document.getElementsByClassName("orderInputDes");
            for (var i = 0; i < cells.length; i++) {
                cells[i].disabled = false;
            }
            var cells = document.getElementsByClassName("repairInputDes");
            for (var i = 0; i < cells.length; i++) {
                cells[i].disabled = false;
            }
            var cells = document.getElementsByClassName("customInputDes");
            for (var i = 0; i < cells.length; i++) {
                cells[i].disabled = true;
            }
            document.getElementById("customOnly").style.display = "block";
            document.getElementById("hideSize").style.display = "none";
            document.getElementById("materialHid").style.display = "block";
            console.log(id);
            // ajax
            $.ajax({
                type: "POST",
                url: "{{ url('admin/edit-customOrder') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    if (res.deleted_at !== null) {
                        var cells = document.getElementsByClassName("AllDes");
                        for (var i = 0; i < cells.length; i++) {
                            cells[i].disabled = true;
                        }
                    };
                    $('#viewOrderModal').modal('show');
                    //change the span text of the modal
                    $('#label1').text('Product Name');
                    $('#label2').text('Product Category');
                    // $('#label3').text('Size');
                    $('#label4').text('Price');
                    $('#label5').text('Material');
                    $('#label6').text('Payment Type');
                    $('#label7').text('Quantity');
                    $('#label8').text('Status');
                    $('#label9').text('Description');
                    $('#label10').text('Desired Material');
                    // change the span value from the data base 
                    $('#repairsId').val(0);
                    $('#orderId').val(0);
                    $('#CustomId').val(res.CustomId);
                    $('#name').val('a custom' + res.prodCategory);
                    $('#price').val(res.price);
                    $('#prodCategory_id').val(res.productCategory_id);
                    $('#description').val(res.description);
                    if (res.desiredMaterial == null) {
                        document.getElementById("customOnly").style.display = "none";
                    } else {
                        $('#desiredMaterial').val(res.desiredMaterial);
                    }
                    $('#status').val(res.status);
                    $('#quantity').val(res.quantity);
                    $('#material_id').val(res.material_id);
                    $('#payment_type').val(res.payment_type);
                    var ImagURL = '{{ URL::asset('/imgs/products/') }}' + '/' + res.customImage;
                    console.log(ImagURL);
                    $('#image').attr('src', ImagURL);
                    //   console.log(res.furnitureState);
                }
            });
        });
        $('body').on('click', '.viewOrders', function() {
            var id = $(this).data('id');
            console.log(id);
            document.getElementById("hideSize").style.display = "block";
            document.getElementById("materialHid").style.display = "block";
            document.getElementById("customOnly").style.display = "none";
            var cells = document.getElementsByClassName("customInputDes");
            for (var i = 0; i < cells.length; i++) {
                cells[i].disabled = false;
            }
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
                type: "POST",
                url: "{{ url('admin/edit-Orders') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    if (res.deleted_at !== null) {
                        var cells = document.getElementsByClassName("AllDes");
                        for (var i = 0; i < cells.length; i++) {
                            cells[i].disabled = true;
                        }
                    };
                    $('#viewOrderModal').modal('show');
                    //product name is type of service + product category
                    //change the span text of the modal
                    $('#label1').text('Product Name');
                    $('#label2').text('Product Category');
                    $('#label3').text('Size');
                    $('#label4').text('Price');
                    $('#label5').text('Material');
                    $('#label6').text('Payment Type');
                    $('#label7').text('Quantity');
                    $('#label8').text('Status');
                    $('#label9').text('Description');
                    // change the span value from the database
                    $('#CustomId').val(0);
                    $('#repairsId').val(0);
                    $('#orderId').val(res.orderId);
                    $('#name').val(res.name);
                    $('#prodCategory_id').val(res.prodCategory_id);
                    $('#size').val(res.tall + "*" + res.height + "*" + res.width);
                    $('#material_id').val(res.material_id);
                    $('#description').val(res.description);
                    $('#status').val(res.status);
                    $('#price').val(res.price);
                    $('#quantity').val(res.quantity);
                    $('#payment_type').val(res.payment_type);
                    //   var src = ($(this).attr('src') === );
                    var ImagURL = '{{ URL::asset('/imgs/products/') }}' + '/' + res.image;
                    console.log(ImagURL);
                    $('#image').attr('src', ImagURL);
                    //   console.log(res.furnitureState);
                }
            });
        });
        $('body').on('click', '.deleteOrders', function() {
            Swal.fire({
                title: 'Are you want to move order to Archives?',
                text: "you sill can restore it again",
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
                        type: "POST",
                        url: "{{ url('admin/delete-Orders') }}",
                        data: {
                            id: id
                        },
                        dataType: 'json',
                        success: function(res) {
                            window.location.reload();
                        }
                    });
                    Swal.fire(
                        'Deleted!',
                        'order has been moved to Archives.',
                        'success'
                    )
                }
            })
        });
        $('body').on('click', '.deleteCustom', function() {
            Swal.fire({
                title: 'Are you want to move order to Archives?',
                text: "you sill can restore it again",
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
                        type: "POST",
                        url: "{{ url('admin/delete-customOrder') }}",
                        data: {
                            id: id
                        },
                        dataType: 'json',
                        success: function(res) {
                            window.location.reload();
                        }
                    });
                    Swal.fire(
                        'Deleted!',
                        'order has been moved to Archives.',
                        'success'
                    )
                }
            })
        });
        $('body').on('click', '.deleteRepair', function() {
            Swal.fire({
                title: 'Are you want to move order to Archives?',
                text: "you sill can restore it again",
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
                        type: "POST",
                        url: "{{ url('admin/delete-repairOrder') }}",
                        data: {
                            id: id
                        },
                        dataType: 'json',
                        success: function(res) {
                            window.location.reload();
                        }
                    });
                    Swal.fire(
                        'Deleted!',
                        'order has been moved to Archives.',
                        'success'
                    )
                }
            })
        });
        $('body').on('click', '#btn-save', function(e) {
            e.preventDefault()
            var url = "{{ url('admin/mangeOrders-updateOrder') }}";
            let myForm = document.getElementById('addEditBookForm');
            let dataForm = new FormData(myForm);
            // ajax
            $.ajax({
                type: "POST",
                url: url,
                data: dataForm,
                contentType: false,
                processData: false,
                cache: false,
                dataType: 'json',
                // beforeSend:function(){
                //     $(document).find('span.error-text').text('');
                // },
                success: function(data) {
                    if (data.status == 0) {
                        $.each(data.error, function(prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
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
                }
            });
        });
    });
</script>

@endsection