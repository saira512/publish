@extends('layouts.app1') 


 @if (session('Status'))
<p><center>{{ session('Status') }}<center></p>

@endif

@section('content')
@foreach ($notices as $notice)

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><center>EDIT YOUR NOTICE</center></div>
                <div class="panel-body">
                  @if ($created_user == $logged_in_user)
                    <form class="form-horizontal" role="form" id="form" method="POST" action="{{ route('update_my_notice') }}">
                  @else
                   <form class="form-horizontal" role="form" id="form" method="POST" action="{{ route('update_single_notice') }}">     
                  @endif     
                        {{ csrf_field() }}


                        <input type="hidden" name="id" value="{{ old('id',$notice->id)}}" >

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">TITLE</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title' ,$notice->title) }}" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       <div class="form-group{{ $errors->has('content1') ? ' has-error' : '' }}">
                            <label for="content1" class="col-md-4 control-label">CONTENT</label>

                
                            <div class="col-md-6">
                                <textarea id="content1" rows="10" cols="50" class="form-control" name="content1" value="{{ old('content' ,$notice->content) }}" required autofocus>{{ $notice->content }}</textarea>

                                @if ($errors->has('content1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('expire_at') ? ' has-error' : '' }}">
                            <label for="expity_date" class="col-md-4 control-label">EXPIRY DATE AND TIME</label>

                            <div class="col-md-6">
                                <input id="expire_at"   class="form-control"  name="expire_at" value="{{ old('expire_at' , $notice->expire_at) }}" required autofocus >
                               
                               
                                @if ($errors->has('expire_at'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('expire_at') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    SUBMIT 
                                </button>
                            </div>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
