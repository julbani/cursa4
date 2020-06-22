<?php

namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Auth;
  
class ImageUploadController extends Controller
{
    public function imageUploadPost(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
  
        $imageName = time().'.'.$request->image->extension();  
   
        $request->image->move(public_path('images'), $imageName);

        $user = \App\User::find(Auth::user()->id);
        $user->photo = $imageName;
        $user->save();

        return back()
            ->with('success','Зображення успішно завантажено.')
            ->with('image',$imageName);
   
    }
}