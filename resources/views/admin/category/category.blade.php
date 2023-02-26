@extends('layouts.dashboard')

@section('contentgola')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Category</li>
    </ol>
</nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 col-md-8">
@can('show_category')
            <div class="card">
                <div class="card-header">
                    <h3>Category List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($categorygola as $sl=>$categorydata)
                        <tr>
                            <td>{{ $sl+1; }}</td>
                            <td>{{ $categorydata->category_name; }}</td>
                            <td>
                                <img src="{{ asset('/uploads/category') }}/{{ $categorydata->category_image; }}" alt="">
                            </td>
                            <td>
                                <div class="dropdown mb-2">
                                    <button class="btn p-0" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal icon-lg text-muted pb-3px"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
@can('category_update')
                                        <a href="{{ route('category.edit', $categorydata->id) }}" class="dropdown-item d-flex align-items-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 icon-sm mr-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg> <span class="">
                                            Edit
                                        </span></a>
@endcan
                                        <a href="javascript:" datar-linkta="{{ route('category.delete', $categorydata->id) }}" class="dropdown-item d-flex align-items-center delete-alert">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash icon-sm mr-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg> <span class="">
                                            Delete
                                        </span></a>

                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
@endcan
        </div>
        <div class="col-lg-4 col-md-4">
@can('add_category')
            <div class="card">
                <div class="card-header">
                    <h3>Add Category</h3>
                </div>
                @if(session('success'))
                    <strong class="text-danger">
                        {{ session('success') }}
                    </strong>
                @endif
                <div class="card-body">
                    <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data" class="forms-sample">
                        @csrf
                        <div class="form-group">
                            <label for="cat_name">Category name</label>
                            <input type="text" name="category_name" class="form-control" id="cat_name" value="{{ old('category_name') }}" >
                            @error('category_name')
                                <strong class="text-danger">
                                    {{ $message }}
                                </strong>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="cat_img">Category Image</label>
                            <input type="file" name="category_image" class="form-control" id="cat_img">
                            @error('category_image')
                                <strong class="text-danger">
                                    {{ $message }}
                                </strong>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Add Category</button>
                    </form>
                </div>
            </div>
@endcan
        </div>
    </div>
</div>
@endsection

@section('footer_script')
    <script>
        $('.delete-alert').click(function(){

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
                var linktapai = $(this).attr('datar-linkta');
                window.location.href = linktapai;
            }
            });

        });
    </script>

        @if(session('successdelete'))
            <script>
                Swal.fire({
                    title: '{{ session('successdelete') }}',
                })
            </script>
        @endif
@endsection
