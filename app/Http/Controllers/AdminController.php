<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function profile()
    {
        return view('admin.dashboard.profile');
    }

    public function updateProfile(Request $request)
    {
        $id = Auth::guard('admin')->user()->id;
        $file = $request->file('image');
        $data = array();

        $data['name']= $request->name;
        $data['email']= $request->email;
        $data['phone']= $request->phone;
        $data['job']= $request->job;

        if($file){
            $image_name = $file->getClientOriginalName();
            $file->move('assets/images', Carbon::now()->timestamp.$image_name);
            $image = Carbon::now()->timestamp.$image_name;
            $data['image'] = $image;
        }

        if($request->password){
            $data['password'] = Hash::make($request->password);
        }


        Admin::where('id',$id)->update($data);

        return redirect()->route('admin_profile')->with('success', 'profile updated successfully');

    }



}
