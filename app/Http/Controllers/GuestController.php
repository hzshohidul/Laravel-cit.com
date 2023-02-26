<?php

namespace App\Http\Controllers;

use App\Notifications\GuestPassResetNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use App\Models\GuestPassReset;
use App\Models\GuestLogin;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    //Guest Pass Reset Req Page view
    function guest_pass_reset_req(){
        return view('frontend.guest_pass_reset_req');
    }
    // guest pass reset req send action data
    function guest_pass_reset_req_send(Request $request){
        $guest_info = GuestLogin::where('email', $request->email)->firstOrFail();
        GuestPassReset::where('guest_id', $guest_info->id)->delete();

        $guest_inserted = GuestPassReset::create([
            'guest_id'    => $guest_info->id,
            'token'       => uniqid(),
            'created_at'  => Carbon::now(),
        ]);
        Notification::send($guest_info, new GuestPassResetNotification($guest_inserted));

        return back()->with('reqsend', 'We have sent you a password reset link! please check your email');
    }
    //Guest Password Reset and new password Page view
    function guest_pass_reset_form($tokenta){
        if(GuestPassReset::where('token', $tokenta)->exists()){
            return view('passreset.pass_reset_form',[
                'tokenta' => $tokenta,
            ]);
        }
        else{
            abort('404');
        }
    }

    function guest_pass_reset(Request $request){
        $guest_info = GuestPassReset::where('token', $request->token)->firstOrFail();
        GuestLogin::findOrFail($guest_info->guest_id)->update([
            'password' => bcrypt($request->new_password),
        ]);
        $guest_info->delete();
        return redirect()->route('guest.login')->with('resetsucces','Password Reset Successfully');
    }
}
