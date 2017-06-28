@extends('layouts.app1')

@if (session('Status'))
    <div class="alert alert-success" role= "alert">
      <p><center>{{ session('Status') }}<center></p>
    </div>
@endif

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-primary">
        <div class="panel-heading">
         Published Notices
        </div>
        <div class="panel-body">
          @if (count($notices) > 0)
            <table align="center">
              <tr>
                <th style="padding: 0 10px;">Title</th>
                <th style="padding: 0 10px;">Content</th>
                <th style="padding: 0 10px;">Expiry_date</th>
                <th style="padding: 0 10px;">View</th>
                <th style="padding: 0 10px;">Edit</th>
                <th style="padding: 0 10px;">Delete</th>
              </tr>
                @foreach ($notices as $notice)
                  <tr>
                    <td style="padding: 15px 15px;">{{ $notice->title }} </td>
                    <td style="padding: 0 10px;"> {{ $notice->content }}</td>
                    <td style="padding: 0 10px;">{{ $notice->expire_at}} </td>
                    <td style="padding: 0 10px;"><a  href="{{ route('show_single_notice' , ['id' => $notice->id]) }}"  class="btn btn-info" role="button"> view</a> </td>
                    <td style="padding: 0 10px;"><a href="{{ route('edit_single_notice' , ['id' => $notice->id]) }}"  class="btn btn-info" role="button"> Edit</a> </td>
                    <td style="padding: 0 10px;"> <a href="{{ route('delete_notice' , ['id' => $notice->id]) }}"  class="btn btn-info delete-notice" role="button"> Delete</a></td>
                  </tr>
                @endforeach
            </table>
          @else
           {{ "No new Notices"}}
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@include('Admin.modal') 
    <script type="text/javascript">
    $(".delete-notice").click(function(e){
       e.preventDefault();
        $('#confirm').modal({ backdrop: 'static', keyboard: false }).on('click', '#del-btn', function(){
                
        });
    });


@endsection
