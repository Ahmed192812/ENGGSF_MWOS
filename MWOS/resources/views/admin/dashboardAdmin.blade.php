@extends('layouts.app')

@section('content')
  <!-- Content Row -->
  <br>
  <br>
  <div class="row">

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                       Customers</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$Users}}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                       Orders</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$AllOrders}}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Earnings (Monthly) Card Example -->

<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                       Products</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$Products}}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Pending Requests Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                    Materials</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$Materials}}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<br>
<br>
<br>
<div class="row">
    <div class="col-5">
    <div class="card border-left-primary shadow">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="container">
    <div class="row justify-content-center">
        <div class="">
        <h5 style="text-align: center;">New Orders</h5>

            <div class="card">
            <table class="table">
  <thead>
    <tr>
      
      <th scope="col">Date</th>
      <th scope="col">name</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
    @foreach($ordersTable as $orderTable)
    <tr>
     
      <td>{!! date('j F Y', strtotime($orderTable->date)) !!}</td>
      <td>{{ $orderTable->name}}</td>
      <td>To Be Reviewed</td>
    </tr>
    @endforeach
    @foreach($customsTable as $customTable)
    <tr>
     
      <td>{!! date('j F Y', strtotime($customTable->date)) !!}</td>
      <td>A Custom {{ $customTable->prodCategory}}</td>
      <td>To Be Reviewed</td>
    </tr>
    @endforeach
    @foreach($repairsTable as $repairTable)
    <tr>
     
      <td>{!! date('j F Y', strtotime($repairTable->date)) !!}</td>
      <td>A Repair {{ $repairTable->prodCategory}}</td>
      <td>To Be Reviewed</td>
    </tr>
    @endforeach
  </tbody>
</table>
            </div>
        </div>
    </div>
</div>
    </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
</div>
<div class="col-2"></div>
<div class="col-5">
    <div class="card border-left-primary shadow">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="container">
    <div class="row justify-content-center">
        <div class="">
          <h5 style="text-align: center;">Completed Orders</h5>
            <div class="card">
            <table class="table">
  <thead>
    <tr>
      
      <th scope="col">Date</th>
      <th scope="col">name</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
    @foreach($ordersTableCom as $orderTable)
    <tr>
     
      <td>{!! date('j F Y', strtotime($orderTable->date)) !!}</td>
      <td>{{ $orderTable->name}}</td>
      <td>Completed</td>
    </tr>
    @endforeach
    @foreach($customsTableCom as $customTable)
    <tr>
     
      <td>{!! date('j F Y', strtotime($customTable->date)) !!}</td>
      <td>A Custom {{ $customTable->prodCategory}}</td>
      <td>Completed</td>
    </tr>
    @endforeach
    @foreach($repairsTableCom as $repairTable)
    <tr>
     
      <td>{!! date('j F Y', strtotime($repairTable->date)) !!}</td>
      <td>A Repair {{ $repairTable->prodCategory}}</td>
      <td>Completed</td>
    </tr>
    @endforeach
  </tbody>
</table>
            </div>
        </div>
    </div>
</div>
    </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
</div>

    </div>
    
@endsection
