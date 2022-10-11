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
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">+ Add Product</button>
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

    <div class="row mb-3">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4 text-center align-middle">
                            <img src="{{asset('imgs/products/sofa_bed.png')}}" style="width: 250px;">
                        </div>
                        <div class="col-8">
                            <div class="row">
                                <div class="col">
                                    <h2>SHANE</h2>
                                </div>
                                <div class="col text-end">
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                                    <button type="button" class="btn btn-sm btn-danger">Delete</button>
                                </div>
                            </div>
                            <p class="text-muted fst-italic">Wooden Sofa Bed | Chair</p>
                            <p>Height: | Width: | </p>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent cursus ipsum vitae quam feugiat, vel dapibus ex lobortis. Maecenas ornare risus sit amet neque egestas, quis auctor mi blandit. Ut volutpat nibh id aliquet cursus. Aliquam mattis dapibus magna eget sollicitudin. Nulla id quam eget odio fringilla pretium. Duis volutpat ullamcorper mauris a semper. Aenean malesuada felis ligula, eget condimentum lacus iaculis non.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
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

<!-- <table class="table table-striped m-0 align-middle border">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">IMAGE</th>
                        <th scope="col">NAME</th>
                        <th scope="col">CATEGORY</th>
                        <th scope="col">PRICE</th>
                        <th scope="col">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="col">1</th>
                        <td class="col">
                            <img src="{{asset('imgs/products/p_stand.png')}}" style="width: 100px;">
                        </td>
                        <td class="col">Plywood TV Stand</th>
                        <td class="col">Table</td>
                        <td class="col">P7,000</th>
                        <td class="col">
                            <button type="button" class="btn btn-sm btn-info rounded-pill px-3">View</button>
                            <button type="button" class="btn btn-sm btn-warning rounded-pill px-3">Edit</button>
                            <button type="button" class="btn btn-sm btn-danger rounded-pill px-3">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="col">2</th>
                        <td class="col">
                            <img src="{{asset('imgs/products/sofa_bed.png')}}" style="width: 100px;">
                        </td>
                        <td class="col">Wooden Sofa Bed</th>
                        <td class="col">Chair</td>
                        <td class="col">P10,000</th>
                        <td class="col">
                            <button type="button" class="btn btn-sm btn-info rounded-pill px-3">View</button>
                            <button type="button" class="btn btn-sm btn-warning rounded-pill px-3">Edit</button>
                            <button type="button" class="btn btn-sm btn-danger rounded-pill px-3">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="col">3</th>
                        <td class="col">
                            <img src="{{asset('imgs/products/wooden_bed.png')}}" style="width: 100px;">
                        </td>
                        <td class="col">Wooden Bed (with Headboard)</th>
                        <td class="col">Bed</td>
                        <td class="col">P15,000</th>
                        <td class="col">
                            <button type="button" class="btn btn-sm btn-info rounded-pill px-3">View</button>
                            <button type="button" class="btn btn-sm btn-warning rounded-pill px-3">Edit</button>
                            <button type="button" class="btn btn-sm btn-danger rounded-pill px-3">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="col">4</th>
                        <td class="col">
                            <img src="{{asset('imgs/products/sala_set.png')}}" style="width: 100px;">
                        </td>
                        <td class="col">Wooden Sala Set</th>
                        <td class="col">Chair</td>
                        <td class="col">P25,000</th>
                        <td class="col">
                            <button type="button" class="btn btn-sm btn-info rounded-pill px-3">View</button>
                            <button type="button" class="btn btn-sm btn-warning rounded-pill px-3">Edit</button>
                            <button type="button" class="btn btn-sm btn-danger rounded-pill px-3">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="col">5</th>
                        <td class="col">
                            <img src="{{asset('imgs/products/dining_chairs.png')}}" style="width: 100px;">
                        </td>
                        <td class="col">Dining Chairs</th>
                        <td class="col">Chair</td>
                        <td class="col">P10,000</th>
                        <td class="col">
                            <button type="button" class="btn btn-sm btn-info rounded-pill px-3">View</button>
                            <button type="button" class="btn btn-sm btn-warning rounded-pill px-3">Edit</button>
                            <button type="button" class="btn btn-sm btn-danger rounded-pill px-3">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="col">6</th>
                        <td class="col">
                            <img src="{{asset('imgs/products/shelf.png')}}" style="width: 100px;">
                        </td>
                        <td class="col">Bookshelf</th>
                        <td class="col">Shelf</td>
                        <td class="col">P8,000</th>
                        <td class="col">
                            <button type="button" class="btn btn-sm btn-info rounded-pill px-3">View</button>
                            <button type="button" class="btn btn-sm btn-warning rounded-pill px-3">Edit</button>
                            <button type="button" class="btn btn-sm btn-danger rounded-pill px-3">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td class="col">7</th>
                        <td class="col">
                            <img src="{{asset('imgs/products/bench.png')}}" style="width: 100px;">
                        </td>
                        <td class="col">Bench</th>
                        <td class="col">Chair</td>
                        <td class="col">P4,000</th>
                        <td class="col">
                            <button type="button" class="btn btn-sm btn-info rounded-pill px-3">View</button>
                            <button type="button" class="btn btn-sm btn-warning rounded-pill px-3">Edit</button>
                            <button type="button" class="btn btn-sm btn-danger rounded-pill px-3">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table> -->
</div>
</div>
</div>
@endsection