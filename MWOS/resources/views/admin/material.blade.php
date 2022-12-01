@extends('layouts.app')
@section('content')

@if(isset($NoFound))
<div class="alert alert-danger alert-dismissible fade show">
    {{ $NoFound }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>


@elseif(isset($found))
<div class="alert alert-success alert-dismissible fade show">
    {{$found}}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="row">
    <div class="col d-flex justify-content-end">
        <form class="d-flex justify-content-end" action="{{ route('admin.materialSearch') }}" method="GET">
            <input type="search" name="search" class="form-control me-2" placeholder="Search" style="width: 250px">
            <button class="btn btn-info me-2" type="submit"><i class="bi bi-search"></i></button>
        </form>
        <button id="addNewBook" type="button" class="btn btn-info Adding" data-bs-toggle="modal" data-bs-target="#ajax-book-model"><i class="bi bi-file-earmark-plus"></i></button>
    </div>
</div>

<br>

<div class="row">
    <div class="col">
        <table class="table table-striped m-0 text-center align-middle border">
            <thead>
                <tr>
                    <th scope="col-3">IMAGE</th>
                    <th scope="col-3">MATERIAL NAME</th>
                    <th scope="col-3">COST PER UNIT</th>
                    <th scope="col-3">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @if($Materials->isNotEmpty())
                @foreach ($Materials as $Material)
                <tr>
                    <td class="col-3">
                        <img src="{{asset('imgs/materials/' . $Material->image)}}" style="width: 100px;">
                    </td>
                    <td class="col-3">{{ $Material->name}}</td>
                    <td class="col-3">{{ $Material->costPerUnit}}</td>
                    <td class="col-3">
                        <a href="javascript:void(0)" type="button" class="btn btn-sm btn-secondary rounded-pill px-3 edit" data-id="{{ $Material->id }}">Edit</a>
                        <a href="javascript:void(0)" type="button" class="btn btn-sm btn-danger rounded-pill px-3 delete" data-id="{{ $Material->id }}">Delete</a>
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
        {!! $Materials->links() !!}
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="ajax-book-model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ajaxBookModel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" id="addEditBookForm" name="addEditBookForm" method="POST" enctype="multipart/form-data">
                    <span class="invalid-feedback errorSpan" role="alert" red></span>
                    <input type="hidden" name="id" id="id">
                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input id="image" name="image" type="file" class="form-control" value="">
                        <span class="text-danger error-text image_error errorSpan"></span>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input id="name" name="name" type="text" class="form-control" value="" required>
                        <span class="text-danger error-text name_error errorSpan"></span>

                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cost Per Unit</label>
                        <input id="costPerUnit" name="costPerUnit" type="number" class="form-control" value="" required>
                        <span class="text-danger error-text costPerUnit_error errorSpan"></span>
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btn-save" value="addNewBook">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ajax amd Js code -->
<script type="text/javascript">
    $(document).ready(function($) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#addNewBook').click(function() {
            $('#addEditBookForm').trigger("reset");
            $('#ajaxBookModel').html("Add material");
            $('#ajax-book-model').modal('show');
        });

        $('body').on('click', '.edit', function() {
            var id = $(this).data('id');

            // ajax
            $.ajax({
                type: "POST",
                url: "{{ url('admin/edit-material') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    $('#ajaxBookModel').html("Edit material");
                    $('#ajax-book-model').modal('show');
                    $('#id').val(res.id);
                    $('#name').val(res.name);
                    $('#costPerUnit').val(res.costPerUnit);

                    //   $('#image').val(res.image);
                    console.log(res.name);

                }

            });

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
                        url: "{{ url('admin/delete-material') }}",
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

        $('body').on('click', '#btn-save', function(e) {
            e.preventDefault()
            var url = "{{ url('admin/add-update-material') }}";
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
                beforeSend: function() {
                    $(document).find('span.error-text').text('');
                },
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


                },


            });

        });


    });
</script>

@endsection