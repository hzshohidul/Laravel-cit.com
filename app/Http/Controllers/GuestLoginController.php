<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class GuestLoginController extends Controller
{
    //Guest Login Request
    function guest_login_request(Request $request){
        if(Auth::guard('guestlogin')->attempt(['email'=>$request->email, 'password'=>$request->password])){
            if (Auth::guard('guestlogin')->user()->email_verified_at == null) {
                Auth::guard('guestlogin')->logout();
                return redirect()->route('mail.verify.req')->with([
                    'verify_req'=>'Plesse Verify Your Mail First! Check Your email',
                    'mail'=>$request->email,
                ]);
            } else {
                return redirect()->route('index')->withGuest_login('You have successfully login');
            }
        }
        else{
            return redirect()->route('guest.login');
        }
    }


    function guest_logout(){
        Auth::guard('guestlogin')->logout();
        return redirect()->route('index');
    }
}
