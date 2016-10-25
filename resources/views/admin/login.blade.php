<!DOCTYPE html>
<html lang="en-PH">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#363636 ">
    <meta name="msapplication-navbutton-color" content="#363636 ">
    <meta name="apple-mobile-web-app-status-bar-style" content="#363636">
    <meta name="description" content="Philippine National Police Unit Scorecard">
    <meta name="keywords" content="PNP, unit scorecard, usc, pnp usc">
    <meta name="author" content="Fare Matrix">

    <title>Web-Payphone|Admin</title>

    <!-- Favicon.ico -->
    <link rel="shortcut icon" href="{{{ asset('favicon.ico') }}}">

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('unit/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Slaycaster Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom-all.css') }}">

    <!-- Yujin Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/chief.css') }}">

 

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/dark-hive/jquery-ui.css">

    <!-- Custom Fonts -->
    <link href="{{ asset('unit/bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <!-- <link href='https://fonts.googleapis.com/css?family=Orbitron:700' rel='stylesheet' type='text/css'> -->


    <!-- jQuery -->
    <script src="{{ asset('unit/bower_components/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('unit/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>


</head>



<body>




    <div class="container custom_picture-space">
        <div class="row">
            
        <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
        <div class="panel-heading">Web Payphone Admin</div>
        <div class="panel-body">
                         
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="form-horizontal" role="form" method="POST" action="{{url('creds/login')}}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="form-group animated fadeInLeft delayp1">
        <label class="col-md-4 control-label">Username</label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="username" value="{{ old('email') }}">
        </div>
    </div>

        <div class="form-group">
            <label class="col-md-4 control-label">Password</label>
            <div class="col-md-6">
                <input type="password" class="form-control" name="password">
            </div>
        </div>

        <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary" style="margin-right: 15px;">
                    Login
                </button>
            </div>
        </div>
    </form>
    </div>
    </div>
    </div>

    </div>
    </div>


   

    <script src="{{ asset('js/sidebardata.js') }}"></script>

</body>

</html>
