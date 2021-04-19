@extends('Layout.master')

@section('content')
<div class="container my-5">
<a href="{{ route('user.dashboard') }}" class="btn btn-primary btn-sm my-auto active mx-2" role="button">Back</a>
</div>

<div class="container text-center bg-warning my-5">
                    <h1>Add New Car</h1>
</div>

<form class="container my-5" method="POST" action="{{ route('user.addnewcar')  }}">
        @csrf
    <div class="form-group my-3">
        <label>Company</label>
        <input type="text" class="form-control" name="company" placeholder="Enter Company">
        @error('company')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group my-3">
        <label>Model</label>
        <input type="text" class="form-control" name="model" placeholder="Enter Model">
        @error('model')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group my-3">
        <label>Model_year</label>
        <input type="text" class="form-control" name="model_year" placeholder="Enter Model_year">
        @error('model_year')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group my-3">
        <label>Engine</label>
        <input type="text" class="form-control" name="engine" placeholder="Enter Engine">
        @error('engine')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
     <div class="form-group my-3">
        <label>Description</label>
         <textarea type="text" class="form-control" name="description" rows="3" placeholder="Enter description"></textarea>
         @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
         @enderror
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection
