@extends('frontend.master')
@section('contentgola')
    <!--Login-->
    <section class="login">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-8 m-auto">
                    <div class="login-content">
                        <h4>Login</h4>
                        <p></p>
                        <form  action="{{ route('guest.pass.reset') }}" class="sign-form widget-form " method="post">
                            @csrf
                            <input type="hidden" name="token" value="{{ $tokenta }}" >
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Enter Your New Password*" name="new_password" value="">
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Enter Your Confirme Password*" name="confirme_password" value="">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn-custom">Send Request</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

