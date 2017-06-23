@extends('layouts.app1') 


 @if (session('Status'))
<p><center>{{ session('Status') }}<center></p>

@endif

@section('content')

@foreach ($notice as $notice)

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-2">
                <div class="panel panel-success">
                   <div class="panel-heading"> <font size="6"><center>{{ $notice->title }}</center></font></div>
                    <div class="panel-body">
                        <font size="5"><center>{{  $notice->content }}</center></font>

                    <div>
                    <div class="panel-footer">
                          <font size=""> Published On:</font>
                          <br> Posted By:{{ $name }}
                     </div>
                    <div class=" col-md-6">
                         <button type="submit" class="btn btn-primary" float:left>
                                    EDIT 
                         </button>
                     </div>
                     <div class=" col-md-offset-10">
                         <button type="submit" class="btn btn-primary" float:left>
                                    DELETE 
                         </button>
                         
                     </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endsection
