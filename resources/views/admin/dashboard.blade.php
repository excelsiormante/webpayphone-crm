@extends('admin.layout-admin')

@section('content')

	<br><br><br>
	<div class="wrap">
 		<div class="col-lg-4 pull-right">
            
            <div class="panel panel-warning" ng-app="unitScorecardApp" ng-controller="APIAuditlogsController" >
                <div class="panel-heading">
                    <i class="fa fa-bell fa-4x pull-right"></i>
                    <h3><b>ACTIVITY LOG</b></h3>
                    <center><i ng-show="loading" class="fa fa-spinner fa-spin"></i></center>
                </div>

                <div class="list-group" dir-paginate='audit_trail_dash in chief_audit_trails_dash|orderBy:"updated_at":true:sortKey:reverse|itemsPerPage:5' ng-show="info">
                    <a href="{{ url('chief/audit_trails') }}" class="list-group-item" style="font-size:12px;">
                    <span class="pull-right"><img ng-src="../uploads/userpictures/unit/cropped/<%audit_trail_dash.user_chief.UserChiefPicturePath%>" height="30px;">
                    </span>  

                            <b>Admin Josh Mante</b> 
                            <br />
                            Edited Plan "Unli 50"
                        <br />
                        <span class="pull-right small">October 23, 2016</span>
                        <br />
                    </a>
                </div>

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <!-- /.list-group -->
                    <a href="{{ url('admin/auditlogs') }}" class="btn btn-default btn-block">View All Activity Logs</a>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->

        </div>
    </div>






@endsection