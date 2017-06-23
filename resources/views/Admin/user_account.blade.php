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
        <div class="panel panel-danger">
            
                <div class="panel-heading">{{ Auth::user()->name }}'s Dashboard</div>

                <div class="panel-body">
                    <a href="{{ route('add_notice') }}" class="btn btn-info" role="button"> Create New Notice</a>
                    <a href="{{ route('view_my_notice') }}"  class="btn btn-info" role="button"> My Notices</a>
                </div>
            </div>
        
        </div>
    </div>
</div>
@endsection
