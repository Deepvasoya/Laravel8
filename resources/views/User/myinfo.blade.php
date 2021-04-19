@extends('Layout.master')

@section('content')
<div class="container my-5">
<a href="{{ route('user.dashboard') }}" class="btn btn-primary btn-sm my-auto active mx-2" role="button">Back</a>
</div>

<div class="container text-center bg-warning my-5">
                    <h1>My Profile</h1>
</div>
<div class="container">
  <div class="row">
    <div class="col-5">
      <h3 class="text-center">My Profile</h3>
        <form action="{{ route('user.newinfo') }}" method="POST">
        @if(session()->has('newsuccess'))
        <div class="alert alert-success">
            {{ session()->get('newsuccess') }}
        </div>
        @endif
        @csrf
      <div class="form-group my-3">
        <label for="exampleInputName">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{  $Userinfo->name }}">
        <span class="text-danger">@error('name'){{ $message }} @enderror</span>
      </div>

      <div class="form-group my-3">
        <label for="exampleInputName">Username</label>
        <input type="text" class="form-control" id="uname" name="uname" placeholder="Enter Username" maxlength="10" value="{{  $Userinfo->uname }}">
        <span class="text-danger">@error('uname'){{ $message }} @enderror</span>
      </div>
      <div class="form-group">
        <label for="exampleInputEmail">Email address</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="{{  $Userinfo->email }}">
        <span class="text-danger">@error('email'){{ $message }} @enderror</span>
      </div>
      <button type="submit" class="btn btn-primary my-3">Chang Profile</button>
   </form>
    </div>
    <div class="col-5 mx-5">
      <h3 class="text-center">Change Password</h3>
      <form action="{{ route('user.newpass') }}" method="POST">
        @if(session()->has('success'))
        <div class="container alert alert-success">
            {{ session()->get('success') }}
        </div>
         @endif
         @if(session()->has('fail'))
        <div class="alert alert-danger">
        {{ session()->get('fail') }}
        </div>
        @endif
      @csrf
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
      <button type="submit" class="btn btn-primary my-3">Chang Password</button>
    </form>
    </div>
  </div>
</div>

@endsection
