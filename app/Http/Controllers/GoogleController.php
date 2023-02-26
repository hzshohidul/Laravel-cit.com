<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\GuestLogin;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;

class GoogleController extends Controller
{
    // redirect_provider
    function redirect_provider(){
        return Socialite::driver('google')->redirect();
    }
    // provider_to_application
    function provider_to_application(){
        $user = Socialite::driver('google')->user();

        if(GuestLogin::where('email', $user->getEmail())->exists()){
            if(Auth::guard('guestlogin')->attempt(['email'=>$user->getEmail(), 'password'=>'abc@123'])){
                return redirect()->route('index')->with('guest_login', 'You have Successfully login');
            }
        }
        else{
            GuestLogin::insert([
                'name'=>$user->getName(),
                'email'=>$user->getEmail(),
                'password'=>bcrypt('abc@123'),
                'created_at'=>Carbon::now(),
            ]);

            if(Auth::guard('guestlogin')->attempt(['email'=>$user->getEmail(), 'password'=>'abc@123'])){
                return redirect()->route('index')->with('guest_login', 'You have Successfully login');
            }
        }
    }
}
