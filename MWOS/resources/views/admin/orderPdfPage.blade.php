@extends('layouts.app')
@section('content')
<form action="admin.filterByDatePDF" method="post">
    @csrf
<div class="form-group">
    <div class="row">
        <div class="col-6">
            input
        </div>
    </div>
</div>
</form>
<a href="{{ route('admin.ordersPdfPage-Allorders')}}">all orders pdf</a>
<br>
<br>
<a href="#">all fished orders pdf</a>
<br>
<br>
<a href="#">all Archives orders pdf</a>



@endsection