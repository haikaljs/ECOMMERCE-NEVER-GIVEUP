<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class UserProfileController extends Controller
{
    public function index(){
        return view('frontend.dashboard.profile');
    }
    public function update(Request $request){
        $request->validate([
            'name' => ['required','min:3', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email,'.Auth::user()->id],
            'image' => ['image', 'max:2048']
        ]);

        $user = Auth::user();

        if($request->hasFile('image')){
            if(File::exists(public_path($user->image))){
                File::delete(public_path($user->image));
            }

            $image = $request->image;
            $imageName = uniqid().'_'.$image->getClientOriginalName();
            $image->move(public_path('uploads'),$imageName);

            $path = 'uploads/'.$imageName;

            $user->image = $path;
        }

        $user->name = $request->name;
        $user->email = $request->email;

         /** @var \App\Models\User $user **/
        $user->save();

        toastr()->success('Password Updated Successfully!');
        return redirect()->back();
    }

     // Update password
     public function updatePassword(Request $request){
        $request->validate([
            'current_password' => ['required','current_password'],
            'password' => ['required', 'confirmed', 'min:8'],

        ]);

        $request->user()->update([
            'password' => bcrypt($request->password)
        ]);

        toastr()->success('Password Updated Successfully!');
        return redirect()->back();
    }
}
