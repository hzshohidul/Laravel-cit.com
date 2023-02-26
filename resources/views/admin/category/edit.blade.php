@extends('layouts.dashboard')
@section('contentgola')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-md-8 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h3>Update Category?</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('category.update') }}" method="POST" enctype="multipart/form-data" class="forms-sample">
                            @csrf
                            <input type="hidden" name="cat_hidden_idta" value="{{ $cat_data_gola->id }}" >
                            <div class="form-group">
                                <label for="cat_name">Category name</label>
                                <input type="text" name="category_name" class="form-control" id="cat_name" value="{{ $cat_data_gola->category_name }}" >
                                @error('category_name')
                                    <strong class="text-danger">
                                        {{ $message }}
                                    </strong>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="cat_img">Category Image</label>
                                <input type="file" name="category_image" class="form-control" id="cat_img">
                                <img width="200" src="{{ asset('uploads/category/') }}/{{ $cat_data_gola->category_image }}" alt="">
                                @error('category_image')
                                    <strong class="text-danger">
                                        {{ $message }}
                                    </strong>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">Edit Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_script')
    @if(session('success'))
        <script>
            Swal.fire({
                title: '{{ session('success') }}',
            })
        </script>
    @endif
@endsection
