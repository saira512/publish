@extends('layouts.app1')

@if (session('Status'))
    <p><center>{{ session('Status') }}<center></p>
@endif

@section('content')

    @foreach ($notices as $notice)

        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-2">
                    <div class="panel panel-success">
                      <div class="panel-heading"> <font size="6"><center>{{ $notice->title }}</center></font></div>
                         <div class="panel-body">
                            <font size="5"><center>{{  $notice->content }}</center></font>
                         <div>
                       <div class="panel-footer">
                            @if ($notice->published_on == "")
                            <font size=""> Published On:{{ "Not Yet Published" }}</font>
                            @else
                            <font size=""> Published On:{{ $notice->published_on }}</font>
                            @endif
                            <br> Posted By:{{ $name }}
                       </div>
                        @if (count ($notices) >1)
                          <div class=" col-md-6">
                            <a href="{{ route('edit_my_notice',['id' => $notice->id ]) }}" class="btn btn-info" role="button"> Edit</a>
                          </div>
                          <div class=" col-md-offset-10">
                            <a href="{{ route('delete_notice',['id' => $notice->id]) }}"  class="btn btn-info delete-notice"   role="button" > Delete</a>
                          </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
    @endforeach
    @include('Admin.modal') 
    <script type="text/javascript">
    $(".delete-notice").click(function(e){
       e.preventDefault();
        $('#confirm').modal({ backdrop: 'static', keyboard: false }).on('click', '#del-btn', function(){
            return true  
        });
    });


    </script>
@endsection
