@extends('Layout.master')

@section('content')
<div class="container col-4 my-5 justify-content-center">
<form method="POST" action="{{ route('user.password') }}">
    <div class="mb-3 text-center">
            <h1>Forgot Password</h1>
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
  <div class="form-group">
    <label for="exampleInputEmail">Email address</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
    <span class="text-danger">@error('email'){{ $message }} @enderror</span>
  </div>
  <button type="submit" class="btn btn-primary my-3">Submit</button>
</form>
</div>
@endsection
