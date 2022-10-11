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
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">+ Add Product Type</button>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
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
                            <button type="button" class="btn btn-sm btn-secondary rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                            <button type="button" class="btn btn-sm btn-danger rounded-pill px-3">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Product</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection