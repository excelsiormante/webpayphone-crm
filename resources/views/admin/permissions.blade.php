@extends('admin.layout-admin')

@section('content')

    <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>

    <!-- Angular Utils Pagination -->
    <script src="{{ asset('bower_components/angularUtils-pagination/dirPagination.js') }}"></script>

    <!-- AngularJS Application Script -->
    <script src="{{ asset('app/app.js') }}"></script>

    <!-- AngularJS Chief Objective Controller Script -->
    <script src="{{ asset('app/controllers/plans.js') }}"></script>

    <script src="{{ asset('js/showtabledata.js') }}"></script>

    <br>
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
                        <div style='color:black'><select></select></div><br><br>

		            <h3>Users</h3>

			        <div class="row">

			        	&nbsp;&nbsp;

				    	<label><input type="checkbox" class="users-add"   name="users-add" value="users-add" id="users-add" />  Add</label>&nbsp;&nbsp;
				    	<label><input type="checkbox" class="users-edit" name="users-edit" value="users-edit" id="users-edit"/>  Edit</label>&nbsp;&nbsp;
				    	<label><input type="checkbox" class="users-delete" name="users-delete" value="users-delete" id="users-delete"/>  Delete</label>&nbsp;&nbsp;
				    	<label><input type="checkbox" class="users-export" name="users-export" value="users-export" id="users-export"/>  Export</label>&nbsp;&nbsp;<br><br>

			    	</div>



			    	<h3>Groups</h3>

			    	<div class="row">

			    		&nbsp;&nbsp;

				    	<label><input type="checkbox" class="groups-add"   name="groups-add" value="groups-add" id="groups-add" />  Add</label>&nbsp;&nbsp;
				    	<label><input type="checkbox" class="groups-edit" name="groups-edit" value="groups-edit" id="groups-edit"/>  Edit</label>&nbsp;&nbsp;
				    	<label><input type="checkbox" class="groups-delete" name="groups-delete" value="groups-delete" id="groups-delete"/>  Delete</label>&nbsp;&nbsp;
				    	<label><input type="checkbox" class="groups-export" name="groups-export" value="groups-export" id="groups-export"/>  Export</label>&nbsp;&nbsp;<br><br>

			    	</div>

			    	<h3>Plans</h3>

			    	<div class="row">

			    		&nbsp;&nbsp;

				    	<label><input type="checkbox" class="Plans-add"   name="Plans-add" value="Plans-add" id="Plans-add" />  Add</label>&nbsp;&nbsp;
				    	<label><input type="checkbox" class="Plans-edit" name="Plans-edit" value="Plans-edit" id="Plans-edit"/>  Edit</label>&nbsp;&nbsp;
				    	<label><input type="checkbox" class="Plans-delete" name="Plans-delete" value="Plans-delete" id="Plans-delete"/>  Delete</label>&nbsp;&nbsp;
				    	<label><input type="checkbox" class="Plans-export" name="Plans-export" value="Plans-export" id="Plans-export"/>  Export</label>&nbsp;&nbsp;<br><br>

					</div>


				</div>
			</div>

			
	</div>

@endsection