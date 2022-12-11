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
                        <span class="badge bg-success text-light">for Delivery /pek up</span>
                        @endif
                        </td>

                        <td class="col text-center align-middle">
                        <a href="javascript:void(0)" type="button" class="btn btn-sm btn-secondary rounded-pill px-3 viewOrders" data-id="{{ $order->orderId }}">View</a>
                            <a href="javascript:void(0)" type="button" class="btn btn-sm btn-danger rounded-pill px-3 deleteOrders" data-id="{{ $order->orderId }}">Delete</a>
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
                        <span class="badge bg-success text-light">for Delivery /pek up</span>
                        @endif
                        </td>

                        <td class="col text-center align-middle">
                        <a href="javascript:void(0)" type="button" class="btn btn-sm btn-secondary rounded-pill px-3 viewCustom" data-id="{{ $custom->CustomId }}">View</a>
                            <a href="javascript:void(0)" type="button" class="btn btn-sm btn-danger rounded-pill px-3 deleteCustom" data-id="{{ $custom->CustomId }}">Delete</a>
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
                        <span class="badge bg-success text-light">for Delivery /pek up</span>
                        @endif
                        </td>

                        <td class="col text-center align-middle">
                            <a href="javascript:void(0)" type="button" class="btn btn-sm btn-secondary rounded-pill px-3 viewRepair" data-id="{{ $repair->repairsId }}">View</a>
                            <a href="javascript:void(0)" type="button" class="btn btn-sm btn-danger rounded-pill px-3 deleteRepair" data-id="{{ $repair->repairsId }}">Delete</a>
                            <form action="admin.restore-Orders" method="post">
                                <input type="hidden" value="$repair->repairsId">
                                <button type="submit" class="btn btn-sm btn-success rounded-pill px-3">Restore</a>
                            </form>
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







@endsection