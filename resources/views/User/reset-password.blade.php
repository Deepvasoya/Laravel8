@extends('Layout.master')

@section('content')
<div class="container col-4 my-5 justify-content-center">
<form method="POST" action="{{ route('user.resetnewpassword') }}">
    <div class="mb-3 text-center">
            <h1>Reset Password</h1>
    </div>
     @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
    @if(session()->has('fail'))
    <div class="alert alert-danger">
        {{ session()->get('fail') }}
    </div>
    @endif
    @csrf
   <input type="hidden" name="token" value="{{ $token }}">
  <div class="form-group my-3">
        <label for="exampleInputPassword">New Password</label>
        <input type="password" class="form-control" id="npassword" name="npassword" placeholder="Enter New Password">
        <span class="text-danger">@error('npassword'){{ $message }} @enderror</span>
   </div>
   <div class="form-group my-3">
        <label for="exampleInputPassword">Conform Password</label>
        <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Repeat Password">
        <span class="text-danger">@error('cpassword'){{ $message }} @enderror</span>
    </div>
  <button type="submit" class="btn btn-primary my-3">Submit</button>
  <p style="text-decoration: none;font-size:15px;" class="text-center">Already a member?
 <a href="{{ route('userlogin') }}" style="text-decoration: none; color:blue;font-size:15px;margin-top: 25px;">Sign in</a>
 </p>
</form>
</div>
@endsection
