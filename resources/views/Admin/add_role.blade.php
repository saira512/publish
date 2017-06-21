@extends('layouts.app1') 


 @if (session('Status'))
<p><center>{{ session('Status') }}<center></p>

@endif
<html>
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">You have already added the following roles</div>

                <div class="panel-body">
                @foreach ($roles as $roles)
                 <li>{{ $roles->title }}</li>
                 @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><center>Add New Role</center></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('create_role') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">New Role</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('permission') ? ' has-error' : '' }}">
                             <label for="permission" class="col-md-4 control-label">Add Permissions</label>

  

                            <div class="col-md-6">
                               <select name="permission[]" required class="select2 m-b-10 select2-multiple" multiple="multiple">
                               @foreach ($permissions as $permission)
                               <option value="{{ $permission->id}}">{{ $permission->display_name}}</option>
                               @endforeach
                               </select>
                               @if ($errors->has('permission'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('permission') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Add Role
                                </button>
                            </div>
                        </div>


                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script type="text/javascript">
   $(".select2").select2();
  </script>
</html>