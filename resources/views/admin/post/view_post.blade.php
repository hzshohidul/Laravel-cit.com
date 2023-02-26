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
                    <h4 class="text-info">View Post</h4>
                </div>
                <div class="card-body">
                    <h3>{{ $post_ta->title }}</h3>
                    <div class="my-5">
                        <img width="100%" src="{{ asset('uploads/post') }}/{{ $post_ta->feat_image }}" alt="post-image">
                    </div>
                    <p>{!! $post_ta->desp !!}</p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
