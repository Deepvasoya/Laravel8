@extends('Layout.master')

@section('content')
<div class="container">
     <div class="row justify-content-center">
         <div class="col-md-8">
             <div class="card">
                 <div class="card-header">Verify Your Email Address</div>
                   <div class="card-body">
                    <a href="http://127.0.0.1:8000/User/reset-password/{{$token}}">Click Here</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection