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

    <!-- MetisMenu CSS -->
    <link href="{{ asset('unit/bower_components/metisMenu/dist/metisMenu.min.css') }}" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="{{ asset('unit/dist/css/timeline.css') }}" rel="stylesheet">

    <!-- SB Admin Custom CSS -->
    <link href="{{ asset('unit/dist/css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Slaycaster Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom-all.css') }}">

    <!-- Yujin Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/chief.css') }}">

     <!-- datetimepicker-->
    <link href="{{ asset('bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css">
    
     <!-- Morris Charts CSS -->
    <link href="{{ asset('unit/bower_components/morrisjs/morris.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/dark-hive/jquery-ui.css">

    <!-- Custom Fonts -->
    <link href="{{ asset('unit/bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <!-- <link href='https://fonts.googleapis.com/css?family=Orbitron:700' rel='stylesheet' type='text/css'> -->
    
    <link href="{{ asset('css/jquery-duration-picker.css') }}" rel="stylesheet" type="text/css">


    <!-- jQuery -->
    <script src="{{ asset('unit/bower_components/jquery/dist/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('unit/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ asset('unit/bower_components/metisMenu/dist/metisMenu.min.js') }}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('unit/dist/js/sb-admin-2.js') }}"></script>

    <!-- Datetimepicker-->
    <script src="{{ asset('bower_components/moment/min/moment.min.js') }}"></script>
     <script src="{{ asset('bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>

     <script src="{{ asset('js/servertime.js') }}"></script>

     <script src="{{ asset('js/jquery-ui.min.js') }}"></script>

      <script src="{{ asset('js/jquery-duration-picker.js') }}"></script>

</head>

<body class="layout_chief-body">
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="layout-title-navbar navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand layout-custom-pnpname" href="{{ url('/admin') }}">
                    Web-Payphone
                </a>
                <a class="navbar-brand layout-custom-pnpabb" href="{{ url('/admin') }}">
                    Web-Payphone
                </a>

                
            </div>
            
            <div class="layout-custom-username">
                    Welcome 
                    {{ Session::get('name') }} 
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right layout-custom-navbrand">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle layout-custom-navbaruser" data-toggle="dropdown">
                       
                            Welcome 
                             {{ Session::get('name') }} 

                        <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ url('admin/users') }}"><i class="fa fa-user fa-fw"></i> 
                                Users
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('admin/usergroups') }}"><i class="fa fa-group fa-fw"></i> 
                                Groups
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('admin/permissions') }}"><i class="fa fa-key fa-fw"></i> 
                                Permissions
                            </a>
                        </li>
                        <hr/>
                        <li>
                            <a href="{{ url('admin/auditlogs') }}"><i class="fa fa-key fa-fw"></i> 
                                Audit Logs
                            </a>
                        </li>
                        <hr/>
                        <li>
                            <a href="{{ url('creds/logout') }}"><i class="fa fa-sign-out fa-fw"></i> 
                                Logout
                            </a>
                        </li>
                        
                    </ul>
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
        </nav>
            
        <nav class="layout-title-navbar navbar navbar-default side-nav" role="navigation">
            <div class="navbar-default sidebar" role="navigation" id="sidebarinfo" style="display:none;">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            
                            <a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard fa-fw"></i>    Dashboard
                            </a>
                        </li>

                        <li>

                            <a href="{{ url('admin/subscribers') }}"><i class="fa fa-group fa-fw"></i> 
                                Subscribers
                            </a>

                        </li>

                        <li>

                            <a href="{{ url('admin/plans') }}"><i class="fa fa-table fa-fw"></i> 
                                Plans
                            </a>

                        </li>
                    
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <div class="the-blur"></div>

        <div id="page-wrapper" class="chief-page-wrapper">
            @yield('content')
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <script src="{{ asset('js/sidebardata.js') }}"></script>

</body>

</html>
