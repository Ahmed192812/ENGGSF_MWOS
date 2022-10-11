@extends('layouts.app')
@section('content')
<br>
<div class="container">
    <div class="row">
        <div class="col-3">
        </div>
        <div class="col-3">
        </div>
        <div class="col-3">
        </div>
        <div class="col-3 text-end">
            <button type="button" class="btn btn-sm btn-primary">+ Add Product Type</button>
        </div>
    </div>

    <br>

    <div class="row mb-2 text-center">
        <div class="col">
            <table class="table table-striped m-0 align-bottom border">
                <thead>
                    <tr>
                        <th scope="col">PRODUCT ID</th>
                        <th scope="col">PRODUCT NAME</th>
                        <th scope="col">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="col-2">1</th>
                        <td class="col-6">Flush Doors</td>
                        <td class="col-4">
                            <button type="button" class="btn btn-sm btn-secondary rounded-pill px-3">Edit</button>
                            <button type="button" class="btn btn-sm btn-danger rounded-pill px-3">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-2">2</th>
                        <td class="col-6">Door Jamb</td>
                        <td class="col-4">
                            <button type="button" class="btn btn-sm btn-secondary rounded-pill px-3">Edit</button>
                            <button type="button" class="btn btn-sm btn-danger rounded-pill px-3">Delete</button>
                        </td>
                    </tr>
                    <td class="col-2">3</th>
                    <td class="col-6">Kitchen Drawer</td>
                    <td class="col-4">
                        <button type="button" class="btn btn-sm btn-secondary rounded-pill px-3">Edit</button>
                        <button type="button" class="btn btn-sm btn-danger rounded-pill px-3">Delete</button>
                    </td>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection