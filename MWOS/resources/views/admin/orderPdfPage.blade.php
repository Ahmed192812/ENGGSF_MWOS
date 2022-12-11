@extends('layouts.app')
@section('content')
<form action="{{ route('admin.ordersPdfPage-Allorders')}}" method="post">
    @csrf
<div class="form-group mt-5">
    <div class="row">
        <div class="col-3">
            <label for="startDate">From</label>
            <input type="date" name="startDate" id="startDate" class="form-control" placeholder="From"> 
        </div>
        <div class="col-3">
        <label for="startDate">To</label>

        <input type="date" name="endDate" id="endDate" class="form-control" placeholder="To"> 
        </div>
        
        <div class="col-3">
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
        <div class="col-3">
            <button type="submit" class="btn btn-success">Filter PDF</button>
        </div>
    </div>
</div>
</form>
<!-- <a href="{{ route('admin.ordersPdfPage-Allorders')}}">all orders pdf</a> -->
<br>
<br>
<a href="#">all fished orders pdf</a>
<br>
<br>
<a href="#">all Archives orders pdf</a>



@endsection