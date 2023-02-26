<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Image;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //View User Page
    function users(){
        $usersall = User::where('id', '!=', Auth::id())->orderBy('created_at', 'DESC')->paginate(10);
        $total_users = User::count();
        return view('admin.users.users', compact('usersall', 'total_users'));
    }
    //Delete Single User
    function user_delete($user_idta){
        // $user_image = User::where('id', $user_idta)->first()->image;
        // $image_location = public_path('uploads/user/'.$user_image);
        // unlink($image_location);

        //*** Image Folder theke Delece Hobe na karon Hard Delete jokhon korbo tokhon image folder theke delete hobe. ok ***

        User::find($user_idta)->delete();
        return back()->withUserdelete('User Deleted Successfully.');
    }
    //View User Profile Page
    function profile_edit(){
        return view('admin.users.profile');
    }
    //Update User Profile
    function update_profile(Request $request){
        if($request->new_password == ''){
           User::find(Auth::id())->update([
                'name' => $request->fullname,
                'email' => $request->email,
           ]);
           return back()->withSuccess('Information is Updated!');
        }else{
            if(Hash::check($request->old_password, Auth::user()->password)){
                User::find(Auth::id())->update([
                    'name' => $request->fullname,
                    'email' => $request->email,
                    'password' => bcrypt($request->new_password),
               ]);
               return back()->withSuccess('Information & Password Updated!');
            }else{
                return back()->with('error', 'Old Password Incurrect!');
            }
        }
    }
    //User Photo Update
    function photo_update(Request $request){
        $uploaded_file = $request->photo;
        $extension = $uploaded_file->getClientOriginalExtension();
        $file_name = Auth::id().'.'.$extension;
        Image::make($uploaded_file)->save(public_path('uploads/user/'.$file_name));
        User::find(Auth::id())->update([
            'image' => $file_name,
        ]);
        return back()->withSuccessimg('Image Uploaded Sussessfully!');
    }
    //Check Mulipart User Soft Deleted
    function delete_check(Request $request){
        if ($request->check == '') {
            return back()->with('check_nai', 'No User Selected!');
        } else {
            foreach($request->check as $check_user_data){
                $userdatata = User::find($check_user_data)->delete();
            }
            return back()->with('check_user_delete', 'Selected User Deleted.');
        }
    }
    //Trash User Page View
    function trash(){
        $usersall = User::onlyTrashed()->where('id', '!=', Auth::id())->orderBy('name', 'ASC')->get();
        $total_users = User::withTrashed()->count('deleted_at');
        return view('admin.users.trash', [
            'usersall' => $usersall,
            'total_users' => $total_users,
        ]);
    }
    //User Restore
    function user_restore($user_idta){
        $usersall = User::onlyTrashed()->where('id', '=', $user_idta)->get();
        //$user_name = User::onlyTrashed()->find($user_idta);
        //$user_name->name; (Ai babew hoito)
        foreach($usersall as $userdata){
            //print_r($userdata->email);
        }
        User::withTrashed()->find($user_idta)->restore();
        return back()->with('user_restore', $userdata->email.'-Restore Successfully.');
    }
    //User Hard Delete
    function user_hard_delete($userhard_idta){
        $image_name = User::onlyTrashed()->find($userhard_idta);
        if($image_name->image == null){
            User::onlyTrashed($userhard_idta)->find($userhard_idta)->forceDelete();
            return back()->with('user_permanent_delete', 'User Permanent Deleted.');
        }
        else{
            $image_location = public_path('uploads/user/'.$image_name->image);
            unlink($image_location);

            User::onlyTrashed($userhard_idta)->find($userhard_idta)->forceDelete();
            return back()->with('user_permanent_delete', 'User Permanent Deleted.');
        }
    }
    function delete_parmanent_check(Request $request){
        if($request->click == 2){
            if ($request->check == '') {
                return back()->with('restore_check_nai', 'No User Selected! Select then Restore');
            }else{
                echo 'User Select ase. Select Data gola dore restore kore nen.';
            }
        }elseif($request->click == 1){
            if ($request->check == '') {
                return back()->with('check_nai', 'No User Selected!');
            } else {
                foreach($request->check as $check_user_data){
                    $image_name = User::onlyTrashed()->find($check_user_data);

                    if($image_name->image == null){
                        User::onlyTrashed($check_user_data)->find($check_user_data)->forceDelete();
                    }
                    else{
                        $image_location = public_path('uploads/user/'.$image_name->image);
                        unlink($image_location);

                        User::onlyTrashed($check_user_data)->find($check_user_data)->forceDelete();
                    }
                }
                return back()->with('check_user_parmanent_delete', 'Selected User Parmanent Deleted.');
            }
        }
    }

}
