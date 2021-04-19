@extends('Layout.master')

@section('content')

<nav class="navbar navbar-dark bg-dark justify-content-between">
  <a class="navbar-brand mx-3">Admin</a>
  <form class="form-inline">
 <a href="{{ route('admin.logout') }}" class="btn btn-primary btn-sm  mx-5"  role="button">Logout</a>
  </form>
</nav>


<div class="container text-center bg-warning my-5">
                    <h1>All Users</h1>
</div>

<div class="container my-5 d-flex justify-content-around">
    <a href="#" class="btn btn-primary btn-sm my-auto active mx-2" role="button">Import data</a>
    <a href="#" class="btn btn-primary btn-sm my-auto active mx-2" role="button">Export data</a>
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
            <th scope="col">Name</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Password</th>
             <th scope="col">Perform</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user as $data)
            <tr>
            <th scope="row">{{ $no++ }}</th>
            <td>{{ $data->name  }}</td>
            <td>{{ $data->uname  }}</td>
            <td>{{ $data->email  }}</td>
            <td>{{ $data->password  }}</td>
            <td>
                @php
                    $status = $data->status;
                @endphp
                <div class="d-sm-inline-flex">
                    @if ($status == "active")
                      <a href="" style="color: red;" class=" btn btn-light btn-sm my-auto active user-status" role="button" data-id="{{ $data->id  }}" data-status="{{ $data->status  }}">Block</a>
                    @else
                        <a href="" style="color: red;" class=" btn btn-light btn-sm my-auto active user-status" role="button" data-id="{{ $data->id  }}" data-status="{{ $data->status  }}">Unblock</a>
                    @endif

                <a href="delete/{{ $data->id  }}" class="mx-2 btn btn-danger btn-sm my-auto active" role="button">Delete</a></td>
                </div>
            </tr>
            @endforeach
        </tbody>
</table>
<div class="my-3 d-flex justify-content-center">
    {!! $user->links() !!}
</div>
</div>
<script src="js/main.js">
		$(document).ready(function() {
			// change user status
			$('.user-status').click(function(e) {
				e.preventDefault();
				var id = $(this).attr('data-id');
				var status = $(this).attr('data-status');
				$.ajax({

					url: '{{ route('admin.changeStatus') }}',
                    method: 'GET',
					data: {
                        'status': status, 'id': id
					},
					success: function(data) {
						location.reload();
					}
				});
			});

		});
</script>

@endsection
