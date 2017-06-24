@extends('layouts.app1') 


 @if (session('Status'))
<p><center>{{ session('Status') }}<center></p>

@endif

@section('content')
@foreach ($notice as $notic)

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><center>EDIT YOUR NOTICE</center></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('update_notice') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">TITLE</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ $notic->content }}" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            <label for="content" class="col-md-4 control-label">CONTENT</label>

                            <div class="col-md-6">
                                <textarea id="content" rows="10" cols="50" class="form-control" name="content" value="{{ $notic->content }}" required autofocus></textarea>

                                @if ($errors->has('content'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('expiry_date') ? ' has-error' : '' }}">
                            <label for="expity_date" class="col-md-4 control-label">EXPIRY DATE AND TIME</label>

                            <div class="col-md-6">
                                <input id="expiry_date" type="datetime-local" class="form-control" min="" name="expiry_date" value="{{ $notic->expire_at }}" required autofocus>
                               
                               
                                @if ($errors->has('expiry_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('expiry_date') }}</strong>
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
