@extends('layouts.dashboard')
@section('contentgola')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">My Post</li>
    </ol>
</nav>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3>Edit Post</h3>
        </div>
        @if (session('post_update'))
            <strong class="text-danger">
                {{ session('post_update') }}
            </strong>
        @endif
        <div class="card-body">
           <form action="{{ route('post.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="post_hidden_id" value="{{ $postta->id }}">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mb-3">
                        <select name="category_id" class="form-control">
                            <option value="">-- Select Category --</option>
                            @foreach ($category_gola as $category_data)
                            <option {{ ($postta->category_id == $category_data->id?'selected':'') }} value="{{ $category_data->id }}">
                                {{ $category_data->category_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Post Title</label>
                        <input type="text" name="title" value="{{ $postta->title }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Post Short Desp</label>
                        <input type="text" name="short_desh" value="{{ $postta->short_desp }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Post Description</label>
                        <textarea name="desp" class="form-control" cols="30" id="summernote" rows="20">
                            {!! $postta->desp !!}
                        </textarea>
                    </div>
                    <div class="mb-3">
                        <h4>Select Tags</h4>
                        <div class="form-group d-flex flex-wrap">
                            @php
                                $after_explode_tag = explode(',', $postta->tag_id);
                            @endphp
                            @foreach ($tag_gola as $tag_data)
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input type="checkbox"
                                        @foreach ($after_explode_tag as $tag_id)
                                            {{ $tag_id == $tag_data->id?'checked':''}}
                                        @endforeach
                                    class="form-check-input" name="tag_idta[]" value="{{ $tag_data->id }}">
                                    {{ $tag_data->tag_name }}
                                <i class="input-frame"></i></label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="">Featured Image</label>
                        <input type="file" name="feat_image" class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        <div class="my-2">
                            <img id="blah" width="50%" src="{{ asset('uploads/post') }}/{{ $postta->feat_image }}" alt="post-image">
                        </div>
                    </div>

                </div>
                <div class="col-lg-4 m-auto">
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary form-control">Update Post</button>
                    </div>
                </div>
            </div>
           </form>
        </div>
    </div>
</div>
@endsection
@section('footer_script')
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 300,
        });
    });
</script>
@endsection
