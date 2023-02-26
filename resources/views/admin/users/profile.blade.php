@extends('layouts.dashboard')

@section('contentgola')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile Edit</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg-6 col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @if (session('success'))
                        <strong class="text-danger">
                            {{ session('success') }}
                        </strong>
                    @endif
                    <h4 class="card-title">Do you went to update your profile ?</h4>
                    <form class="cmxform" id="signupForm" method="POST" action="{{ route('update.profile') }}">
                        @csrf
                        <fieldset>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" name="fullname" value="{{ Auth::user()->name }}" class="form-control" type="text">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" name="email" value="{{ Auth::user()->email }}" class="form-control" type="email">
                            </div>
                            <div class="form-group">
                                <label for="password">Old Password</label>
                                <input id="password" class="form-control" name="old_password" type="password">
                                @if(session('error'))
                                    <strong class="text-danger">
                                        {{ session('error') }}
                                    </strong>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="new_password">New password</label>
                                <input id="new_password" class="form-control" name="new_password" type="password">
                            </div>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @if (session('successimg'))
                        <strong class="text-danger">
                            {{ session('successimg') }}
                        </strong>
                    @endif
                    <h4 class="card-title">Do you went to update your Image ?</h4>
                    <form class="cmxform" id="signupForm" method="POST" action="{{ route('photo.update') }}" enctype="multipart/form-data">
                        @csrf
                        <fieldset>
                            <div class="form-group">
                                <label for="photo">Photo</label>
                                <input type="file" name="photo" id="photo" class="form-control">
                                @if(session('error'))
                                    <strong class="text-danger">
                                        {{ session('error') }}
                                    </strong>
                                @endif
                            </div>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
