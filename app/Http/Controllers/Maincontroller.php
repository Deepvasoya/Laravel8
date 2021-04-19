<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Car;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mail;

class Maincontroller extends Controller
{
    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'uname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:12',

        ]);
        $token = Str::random(60);
        $user = new User;
        $user->name = $request->name;
        $user->uname = $request->uname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->token = $token;
        $user->status = "active";
        $save = $user->save();

        if ($save) {
            return back()->with('success', 'New account is successfully created');
        } else {
            return back()->with('fail', 'Somthing went Wrong, try again later');
        }
    }

    public function check(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:12',
        ]);

        $usersemail = User::where('email', '=', $request->email)->where('status', 'active')->first();

        if (!$usersemail) {
            return back()->with('fail', 'We do not find your email or Your Account is Block');
        } else {
            if (Hash::check($request->password, $usersemail->password)) {
                $request->session()->put('Loginuser', $usersemail->id);
                return redirect('User/Dashboard');
            } else {
                return back()->with('fail', 'Incorrect Password');
            }
        }
    }

    public function dashboard(Request $request)
    {
        $Userinfo =  User::where('id', '=', session('Loginuser'))->first();
        $carinfo =  Car::where('user_id', '=', session('Loginuser'))->orderBy('id', 'desc')->paginate(10);
        return view('User.Dashboard', compact('carinfo', 'Userinfo'))->with('no', 1);
    }

    public function add()
    {
        return view('User.Addcar');
    }

    public function addnewcar(Request $request)
    {
        $validated = $request->validate([
            'company' => 'required',
            'model' => 'required',
            'model_year' => 'required|max:4',
            'engine' => 'required',
            'description' => 'required|max:255',
        ]);

        $user = User::find(session('Loginuser'));
        $car = new Car();
        $car->company = $request->input('company');
        $car->model = $request->input('model');
        $car->model_year = $request->input('model_year');
        $car->engine = $request->input('engine');
        $car->description = $request->input('description');
        $user->car()->save($car);

        return redirect('User/Dashboard')->with('success', 'You are successfully add new car!');
    }

    public function edit($id)
    {
        $singlecar = Car::find($id);
        return view('User/Edit', compact('singlecar'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'company' => 'required',
            'model' => 'required',
            'model_year' => 'required|max:4',
            'engine' => 'required',
            'description' => 'required|max:255',
        ]);

        $singlecar = Car::find($id);
        $singlecar->company = $request->input('company');
        $singlecar->model = $request->input('model');
        $singlecar->model_year = $request->input('model_year');
        $singlecar->engine = $request->input('engine');
        $singlecar->description = $request->input('description');
        $singlecar->update();
        return redirect('User/Dashboard')->with('success', 'Update successful!');
    }


    public function delete($id)
    {
        Car::where('id', $id)->delete();
        return redirect('User/Dashboard')->with('success', 'Delete successful!');
    }

     public function myinfo()
    {
        $Userinfo =  User::where('id', '=', session('Loginuser'))->first();
        return view('User.myinfo',compact('Userinfo'));
    }

    public function newinfo(Request $request)
    {
         $request->validate([
            'name' => 'required',
            'uname' => 'required',
            'email' => 'required|email',
        ]);

          $userinfo = User::find(session('Loginuser'));
          $userinfo->name = $request->name;
          $userinfo->uname = $request->uname;
          $userinfo->email = $request->email;
          $userinfo->update();  
          return back()->with('newsuccess', 'Edit Profile successfully.');
    }

    public function newpass(Request $request)
    {
         $request->validate([
            'npassword' => 'required|min:5|max:12',
            'cpassword' => 'required|min:5|max:12',
        ]);

         $npassword = $request->npassword;
         $cpassword = $request->cpassword;

         if($npassword == $cpassword){
            $userspass = User::find(session('Loginuser'));
            $userspass->password = Hash::make($npassword);
            $userspass->update();  
            return back()->with('success', 'Password Change successfully.');
         }
         else{
            return back()->with('fail', 'Enter same password in conform password field.');
         }
       
    }


    public function password(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $usere = User::where('email', '=', $request->input('email'))->first();
        if (!$usere) {
            return back()->with('fail', 'We do not find your email');
        } else {
           
            Mail::send('User/sendmail',['token' => $usere->token],function($messages) use($request){
                 $messages->to($request->input('email'));
                 $messages->subject('Reset Password Notification');
            });
            return back()->with('success', 'Reset password link send to your email');
        }
    }

    public function resetpassword($token) 
    { 
     return view('User.reset-password', ['token' => $token]);
    }

    public function resetnewpassword(Request $request) 
    { 
     $request->validate([
      'npassword' => 'required|min:5|max:12',
      'cpassword' => 'required|min:5|max:12',
  ]);
         $npassword = $request->npassword;
         $cpassword = $request->cpassword;
         $token = $request->token;

         if($npassword == $cpassword){
            $userspass = User::where('token', '=', $token)->first();
            $userspass->password = Hash::make($npassword);
            $userspass->update();  
            return back()->with('success', 'Password Change successfully.');
         }
         else{
            return back()->with('fail', 'Enter same password in conform password field.');
         }
    }

    public function logoutuser(Request $request)
    {
        if (session()->has('Loginuser')) {
            session()->flush('Loginuser');
            return redirect('User/login');
        }
    }
}
