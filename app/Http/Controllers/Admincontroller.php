<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\User;

class Admincontroller extends Controller
{
    public function check(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:12',
        ]);

        $adminemail = Admin::where('email', '=', $request->email)->first();

        if (!$adminemail) {
            return back()->with('fail', 'Enter Valid Email id');
        } else {
            if (Hash::check($request->password, $adminemail->password)) {
                $request->session()->put('Adminid', $adminemail->id);
                return redirect('Admin/Dashboard');
            } else {
                return back()->with('fail', 'Incorrect Password');
            }
        }
    }

    public function dashboard(Request $request)
    {
        $user = User::orderBy('id', 'desc')->paginate(10);
        return view('Admin.Dashboard', compact('user'))->with('no', 1);
    }

    public function changeStatus(Request $request)
    {
        $ustatus = $request->status;
        $userstatus = User::find($request->id);

        if ($ustatus == "active") {
            $userstatus->status = "inactive";
            $userstatus->save();
        } else {
            $userstatus->status = "inactive";
            $userstatus->save();
        }
    }

    public function delete($id)
    {
        User::where('id', $id)->delete();
        return redirect('Admin/Dashboard')->with('success', 'Delete successful!');
    }


    public function logoutadmin(Request $request)
    {
        if (session()->has('Adminid')) {
            session()->flush('Adminid');
            return redirect('Admin/login');
        }
    }
}
