@extends('admin.layout-admin')

@section('content')

<!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
<script src="{{ asset('bower_components/angular/angular.min.js')}}"></script>

<!-- Angular Utils Pagination -->
<script src="{{ asset('bower_components/angularUtils-pagination/dirPagination.js')}}"></script>

<!-- AngularJS Application Script -->
<script src="{{ asset('app/app.js')}}"></script>

<!-- AngularJS Chief Objective Controller Script -->
<script src="{{ asset('app/controllers/permissions.js')}}"></script>

<script src="{{ asset('js/showtabledata.js')}}"></script>

<br>
<div ng-app="unitScorecardApp" ng-controller="PermissionsController">

    <div class="wrap">


        <div class="panel panel-warning objectives-custom-panel">
            <div class="panel-heading objectives-custom-heading">
                <i class="fa fa-key fa-5x"></i> 
                <h2>
                    <b>Assign Permissions </b>
                </h2>
                <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
            </div>
            <div class="panel-body">
                <div><label>Groups</label></div>
                <div style='color:black'>
                    <select ng-options="group as group.groupname for group in usergroups track by group.id" ng-model="selected_group"></select>
                </div><br><br>
                <div ng-repeat="(key,permission) in permissions">
                    <h3><% key %></h3>
                    <div class="row">
                        <label ng-repeat="value in permission">
                            <input type="checkbox" name="<% value.html_name %>" ng-model="value.is_valid" id="<% value.html_name %>" /><% value.permission %>&nbsp;&nbsp;
                        </label>
                    </div>
                </div>
                <button type="button" 
                        class="btn btn-success btn-sm btn-block" 
                        id="btn-save" 
                        ng-click="save()">
                    Save Changes
                </button>
            </div>
        </div>
    </div>	
</div>
@endsection