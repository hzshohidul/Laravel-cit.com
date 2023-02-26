@extends('layouts.dashboard')

@section('contentgola')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="mx-auto" style="width: 50%;">
                <h3>Welcome to : {{ Auth::user()->name; }}</h3>
                <img width="300" mx-auto d-block src="https://i.postimg.cc/R0p75wTn/5fb7ea92e953c6dea3c31c66f852569d.gif" alt="">
                </div>
            </div>
        </div>
    </div>
@endsection
