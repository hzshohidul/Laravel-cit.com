@extends('layouts.dashboard')
@section('contentgola')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">My Post</li>
    </ol>
</nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Post List</h3>
                </div>
                <div class="card-body">
                    @if (session('post_delectttt'))
                        <strong class="text-danger">
                            {{ session('post_delectttt') }}
                        </strong>
                        @elseif (session('post_delect'))
                        <strong class="text-danger">
                            {{ session('post_delect') }}
                        </strong>
                    @endif
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Category</th>
                            <th>Title</th>
                            <th>Tags</th>
                            <th>Feat Image</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($my_post_gola as $sl=>$my_post_data)
                        <tr>
                            <td>{{ $sl+1; }}</td>
                            <td>{{ $my_post_data->rel_to_category->category_name }}</td>
                            <td>{{ $my_post_data->title }}</td>
                            <td>
                                @php
                                    $after_explode_tag = explode(',', $my_post_data->tag_id);
                                @endphp
                                @foreach ($after_explode_tag as $tag_id_part)
                                    @php
                                        $tag_gola = App\Models\Tag::where('id', $tag_id_part)->get();
                                    @endphp
                                    @foreach ($tag_gola as $tagta)
                                        <span class="badge badge-warning">
                                            {{ $tagta->tag_name }}
                                        </span>
                                    @endforeach
                                @endforeach
                            </td>
                            <td>
                                <img src="{{ asset('uploads/post') }}/{{ $my_post_data->feat_image }}" alt="post-image">
                            </td>
                            <td>
                                <a href="{{ route('post.view', $my_post_data->id) }}" class="btn btn-success">View</a>
                                <a href="{{ route('post.edit', $my_post_data->id) }}" class="btn btn-info">Edit</a>
                                <a href="{{ route('post.delete', $my_post_data->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
