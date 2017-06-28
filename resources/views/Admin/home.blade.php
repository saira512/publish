<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            /*html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }*/

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            /*.content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }*/

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
     @if (session('Status'))
        <div class="alert alert-success" role= "alert">
            <p><center>{{ session('Status') }}<center></p>
        </div>
     @endif
     <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                 @if (Auth::check())
                    <a href="{{ url('Myaccount') }}">My Account</a>
                 @else
                    <a href="{{ url('login') }}">Login</a>
                    <a href="{{ url('register_form') }}">Register</a>
                 @endif
                </div>
             @endif
             @foreach ($notices as $notice)
                 <div class="container">
                    <div class="row">
                         <div class="col-md-6 col-md-offset-2">
                            <div class="panel panel-success">
                                <div class="panel-heading"> <font size="6"><center>{{ $notice->title }}</center></font></div>
                                <div class="panel-body">
                                    <font size="5"><center>{{  $notice->content }}</center></font>

                                </div>
                                 <div class="panel-footer">
                                     <font size=""> Published On:{{ $notice->published_on }}</font>
                                     <br> Posted By:{{ $notice->name }}
                                 </div>
                        
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            @endforeach
        </div>
    </body>
</html>
