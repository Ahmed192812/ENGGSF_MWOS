@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col d-flex justify-content-end">
        <form class="d-flex justify-content-end" action="{{ route('admin.productCategorySearch') }}" method="GET">
            <input type="search" name="search" class="form-control me-2" placeholder="Search" style="width: 250px">
            <button class="btn btn-info me-2" type="submit"><i class="bi bi-search"></i></button>
        </form>
        <div class="dropdown">
            <a class="btn btn-info me-2 px-3" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button"><i class="bi bi-file-earmark-plus"></i></a>
            <ul class="dropdown-menu mx-0 shadow" style="border-radius: 9px;">
                <form action="{{ route('admin.add-update-productCategory') }}" method="POST">
                    @csrf
                    <li>
                        <div class="dropdown-item mb-2">
                            <label class="fw-bold mb-1 ">Category Name</label>
                            <input class="form-control" type="text" name="prodCategory">
                        </div>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <div class="text-center mx-2">
                            <button class="btn btn-primary btn-sm w-100" type="submit">Submit</button>
                        </div>
                    </li>
                </form>
            </ul>
        </div>
    </div>
</div>

<br>

<div class="row">
    <div class="col">
        <div class="table-responsive">
            <table class="table table-striped m-0 align-bottom text-center border">
                <thead>
                    <tr>
                        <th scope="col-6">PRODUCT NAME</th>
                        <th scope="col-6">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @if($product_category->isNotEmpty())
                    @foreach ($product_category as $oneProductCategory)
                    <tr>
                        <td class="col-6">{{ $oneProductCategory->prodCategory }}</td>
                        <td class="col-6">
                            <div class="d-flex justify-content-center">
                                <div class="dropdown">
                                    <a class="btn btn-sm btn-secondary rounded-pill px-3 me-2" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button">Edit</a>
                                    <ul class="dropdown-menu mx-0 shadow" style="border-radius: 9px;">
                                        <form action="{{ route('admin.add-update-productCategory') }}" method="POST">
                                            @csrf
                                            <li>
                                                <div class="dropdown-item bg-transparent mb-2">
                                                    <label class="fw-bold mb-1 ">Category Name</label>
                                                    <input class="form-control" type="text" name="prodCategory" value="{{ $oneProductCategory->prodCategory}}">
                                                    <input type="hidden" name="id" value="{{$oneProductCategory->id}}">
                                                </div>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li>
                                                <div class="text-center mx-2">
                                                    <button class="btn btn-primary btn-sm w-100" type="submit">Submit</button>
                                                </div>
                                            </li>
                                        </form>
                                    </ul>
                                </div>
                                <a href="javascript:void(0)" type="button" class="btn btn-sm btn-danger rounded-pill px-3 delete" data-id="{{ $oneProductCategory->id }}">Delete</a>
                            </div>
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
        <div style="margin-left: 41%; padding-top: 12px;">
            {!! $product_category->links() !!}
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
        $('body').on('click', '.delete', function() {


            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
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
                        url: "{{ url('admin/delete-productCategory') }}",
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
                        'YRecord has been deleted.',
                        'success'
                    )
                }
            })

        });
    });
</script>

@endsection