@extends('layouts.app')

@if (session('Status'))
    <div class="alert alert-success" role= "alert">
      <p><center>{{ session('Status') }}<center></p>
    </div>
    @endif

@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Admin's Dashboard</div>

                <div class="panel-body">
                 <li><a href="{{ route('add_role') }}"> Add new role</a></li>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
