<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class ProfileController extends Controller
{
    public function index(){
        return view('admin.profile.index');
    }


    public function update(Request $request){

        $request->validate([
            'name' => ['required','min:3', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email,'.Auth::user()->id],
            'image' => ['image', 'max:2048']
        ]);

        $user = Auth::user();

        if($request->hasFile('image')){
            if( File::exists(public_path($user->image))){
                File::delete(public_path($user->image));
            }

            $image = $request->image;
            $imageName = uniqid().'_'.$image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);

            $path = "/uploads/".$imageName;
            $user->image = $path;
        }


        $user->name = $request->name;
        $user->email = $request->email;

    /** @var \App\Models\User $user **/
       $user->save();


        return redirect()->back();

    }

    // Update password
    public function updatePassword(Request $request){
        $request->validate([
            'current_password' => ['required','current_password'],
            'password' => ['required', 'confirmed', 'min:8']

        ]);

        $request->user()->update([
            'password' => bcrypt($request->password)
        ]);

        return redirect()->back();
    }
}
