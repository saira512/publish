@extends('layouts.app1') 


 @if (session('Status'))
<p><center>{{ session('Status') }}<center></p>

@endif

@section('content')


@endsection
