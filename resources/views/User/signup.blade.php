@extends('Layout.master')

@section('content')
<div class="container col-4 my-5 justify-content-center">
<form method="POST" action="{{ route('user.save') }}">
    <div class="mb-3 text-center">
            <h1>Sign Up</h1>
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
  <div class="form-group my-3">
    <label for="exampleInputName">Name</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{ old('name') }}">
    <span class="text-danger">@error('name'){{ $message }} @enderror</span>
  </div>

  <div class="form-group my-3">
    <label for="exampleInputName">Username</label>
    <input type="text" class="form-control" id="uname" name="uname" placeholder="Enter Username" maxlength="10" value="{{ old('uname') }}">
    <span class="text-danger">@error('uname'){{ $message }} @enderror</span>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail">Email address</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="{{ old('email') }}">
    <span class="text-danger">@error('email'){{ $message }} @enderror</span>
  </div>
  <div class="form-group my-3">
    <label for="exampleInputPassword">Password</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
    <span class="text-danger">@error('password'){{ $message }} @enderror</span>
  </div>
  <button type="submit" class="btn btn-primary my-3">Submit</button>
  <p style="text-decoration: none;font-size:15px;" class="text-center">Already a member?
 <a href="{{ route('userlogin') }}" style="text-decoration: none; color:blue;font-size:15px;margin-top: 25px;">Sign in</a>
 </p>
</form>
</div>
@endsection
