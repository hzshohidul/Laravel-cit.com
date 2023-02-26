@extends('frontend.master')
@section('contentgola')
    <!--Signup-->
    <section class="login">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-8 m-auto">
                    <div class="login-content">
                        <h4>Sign up</h4>
                        @if (session('reqsend'))
                            <div class="alert alert-success">
                                {{ session('reqsend') }}
                            </div>
                        @endif
                        <!--form-->
                        <form action="{{ route('guest.register.store') }}" class="sign-form widget-form" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Your Full name*" name="name" value="">
                            </div>

                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Email Address*" name="email" value="">
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Password*" name="password" value="">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn-custom">Sign Up</button>
                            </div>
                            <p class="form-group text-center">Already have an account? <a href="{{ route('guest.login') }}" class="btn-link">Login</a> </p>



                            <div class="">
                                <a  class="btn btn-light w-100 my-3" href="{{ route('github.redirect') }}">
                                Login with <img width="30"  src="https://i.postimg.cc/qMVKBXG4/001-github.png" alt="">
                                </a></li>

                                <a  class="btn btn-light w-100 mb-3" href="{{ route('google.redirect') }}">
                                Login with <img width="30"  src="https://i.postimg.cc/02YwzMtm/003-google.png" alt="">
                                </a></li>
                            </div>
                        </form>
                           <!--/-->
                    </div>
                </div>
             </div>
        </div>
    </section>
@endsection
