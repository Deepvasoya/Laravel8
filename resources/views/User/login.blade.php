@extends('Layout.master')

@section('content')
<div class="container col-4 my-5 justify-content-center">
<form action="{{ route('user.check') }}" method="POST">
    <div class="mb-3 text-center">
            <h1>User Login</h1>
    </div>
    @if(session()->has('fail'))
    <div class="alert alert-danger">
        {{ session()->get('fail') }}
    </div>
    @endif
    @csrf
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
  <div class="d-flex">
                        <p style="text-decoration: none;font-size:15px;">Forgot Your Password?
                            <a href="{{ route('userforgotpass') }}" style="text-decoration: none;font-size:15px;margin-top: 25px;">Click Here</a>
                        </p>
    </div>
  <button type="submit" class="btn btn-primary my-3">Submit</button>
 <p style="text-decoration: none;font-size:15px;" class="text-center">Not Have an account?
 <a href="{{ route('usersignup') }}" style="text-decoration: none; color:blue;font-size:15px;margin-top: 25px;">SignUp Here</a>
 </p>

</form>
</div>
@endsection
