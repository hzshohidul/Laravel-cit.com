<?php

namespace App\Http\Controllers;

use App\Models\GuestMailVerify;
use Illuminate\Support\Facades\Notification;
use App\Notifications\GuestMailVerifyNotification;
use Auth;
use Carbon\Carbon;
use App\Models\GuestLogin;
use Illuminate\Http\Request;

class GuestRegisterController extends Controller
{
    // Guest Register page view
    function guest_register(){
        return view('frontend.guest_register');
    }
    // Guest Login page view
    function guest_login(){
        return view('frontend.guest_login');
    }
    // Guest Register Request with Store
    function guest_register_store(Request $request)  {
        $guest_info = GuestLogin::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'created_at'=>Carbon::now(),
        ]);

        // Registration korar por verify
        $guest_info_inserted = GuestMailVerify::create([
            'guest_id'=>$guest_info->id,
            'token'=>uniqid(),
            'created_at'=>Carbon::now(),
        ]);

        // Notification send
        Notification::send($guest_info, new GuestMailVerifyNotification($guest_info_inserted));
        return back()->with('reqsend', 'We have sent you a Email Verify link! please check your email');

        // // Notification send
        // Notification::send($guest_info, new GuestMailVerifyNotification($guest_info));
        // return back()->with('reqsend', 'We have sent you a Email Verify link! please check your email');
        //---------------------------------


        //Registration korar shathe shathe login
        if(Auth::guard('guestlogin')->attempt(['email'=>$request->email, 'password'=>$request->password])){
            // return redirect('/guest/login');
            //return redirect()->route('guest.login');
            return redirect()->route('index')->with('guest_login', 'You have Successfully login');
        }
        //------------------------------
    }

    //verify_mail
    function verify_mail($token){
         $guest = GuestMailVerify::where('token', $token)->firstOrFail();
         GuestLogin::findOrFail($guest->guest_id)->update([
             'email_verified_at'=>Carbon::now()->format('Y-m-d'),
         ]);
         // mail theke verify korar por delete hobe verify database theke
         $guest->delete();
         return redirect()->route('guest.login')->withVerify('Your Email Verified Successfully! Now You Can Login');
    }

    // Verify korte vole gese
    function mail_verify_req(){
        if(Auth::guard('guestlogin')->user()){
            if(Auth::guard('guestlogin')->user()->email_verified_at == null){
                return view('frontend.mail_verify_req');
            }
            else{
                return 'ok hoye gese';
            }
        }
        else{
            return view('frontend.mail_verify_req');
        }
    }

    // mail_verify_again
    function mail_verify_again(Request $request){
        $guest_info = GuestLogin::where('email', $request->email)->firstOrFail();
        GuestMailVerify::where('guest_id', $guest_info->id)->delete();

        $guest_info_inserted = GuestMailVerify::create([
            'guest_id'=>$guest_info->id,
            'token'=>uniqid(),
            'created_at'=>Carbon::now(),
        ]);
        Notification::send($guest_info, new GuestMailVerifyNotification($guest_info_inserted));
        return back()->withReqsend('We have sent you a Email Verify link! please check your email');
    }

}
