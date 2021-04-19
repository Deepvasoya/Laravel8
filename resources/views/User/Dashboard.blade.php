@extends('Layout.master')

@section('content')

<nav class="navbar navbar-dark bg-dark justify-content-between">
  <a class="navbar-brand mx-3">{{ $Userinfo->name }}</a>
  <form class="form-inline">
<a href="{{ route('user.myinfo') }}" class="btn btn-primary btn-sm"  role="button">My Profile</a>
 <a href="{{ route('user.logoutuser') }}" class="btn btn-primary btn-sm  mx-5"  role="button">Logout</a>
  </form>
</nav>


<div class="container text-center bg-warning my-5">
                    <h1>My Cars</h1>
</div>

<div class="container my-5">
<a href="{{ route('user.add')  }}" class="btn btn-primary btn-sm my-auto active mx-2" role="button">Add New Car</a>
</div>
 @if(session()->has('success'))
    <div class="container alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif
<div class="container my-5">
<table class="table">
        <thead>
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Company</th>
            <th scope="col">Model</th>
            <th scope="col">Model_year</th>
            <th scope="col">Engine</th>
            <th scope="col">Description</th>
            <th scope="col">Perform</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carinfo as $car)
            <tr>
            <th scope="row">{{ $no++ }}</th>
            <td>{{ $car->company  }}</td>
            <td>{{ $car->model  }}</td>
            <td>{{ $car->model_year  }}</td>
            <td>{{ $car->engine  }}</td>
            <td>{{ $car->description  }}</td>
            <td><a href="edit/{{ $car->id  }}" class="btn btn-primary btn-sm my-auto active mx-2" role="button">Edit</a><a href="delete/{{ $car->id  }}" class="btn btn-danger btn-sm my-auto active" role="button">Delete</a></td>
            </tr>
            @endforeach
        </tbody>
</table>
<div class="my-3 d-flex justify-content-center">
    {!! $carinfo->links() !!}
</div>
</div>
@endsection
