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
	<div ng-app="unitScorecardApp" ng-controller="APIPlansController">
	    <div class="wrap">
		    <div class="row">			
				<div class="col-lg-12">
					<div class="panel panel-warning objectives-custom-panel">
						<div class="panel-heading objectives-custom-heading">
							<i class="fa fa-calendar fa-5x"></i> 
                            <h2>
                                <b>Plans</b>
                            </h2>
                            <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-lg-2">
									<button id="btn-add" 
                                            class="btn btn-primary btn-block btn-md" 
                                            ng-click="toggle('add', 0)">
                                            Add New Plan
                                    </button>
								</div>
								<div class="col-lg-5 pull-right">
									<form>
								        <div class="form-group">
								        	<div class="input-group">
									            <span class="input-group-addon">
							                    	<i class="fa fa-search fa-fw"></i>
							                    </span>
									            <input type="text" 
                                                        ng-model="search" 
                                                        class="form-control" 
                                                        placeholder="Search here..." />
								        	</div>
								        </div>
								    </form>
								</div>
							</div>
							<!--/.div class row-->
							<div class="row" id="tableinfo">
								<div ng-show="info" class="alert alert-info objective-info-name">
                                    <i class="fa fa-info-circle fa-fw"></i>Plans
                                </div>
                                <div ng-show="info" class="alert alert-info objective-info-abb">
                                    <i class="fa fa-info-circle fa-fw"></i>All Plans 
                                </div>
							</div>
							<!--./div class row-->
                            <div class="table-responsive" ng-show="info" id="tabledata">
    							<table class="table table-bordered">
    								<thead>
                                        <td class="plan-name">
                                            Plan Code
                                        </td>

                                        <td class="plan-description">
                                            Description
                                        </td>

                                        <td class="plan-type">
                                            Type
                                        </td>

                                        <td class="plan-airtime">
                                            Airtime Duration
                                        </td>

                                        <td class="plan-duration">
                                            Plan Duration
                                        </td>

                                        <td class="plan-nominations">
                                            Nominations
                                        </td>

                                        <td class="plan-price">
                                            Price
                                        </td>
                                        
    									<td class="plan-edit"></td>
    								</thead>
    								
                                    <tr dir-paginate='plan in plans|
                                        orderBy: "updated_at":true:sortKey:reverse|
                                        filter:search|
                                        itemsPerPage:5'>

    									<td>
                                            <% plan.code %>
                                        </td>
    									<td>
                                            <% plan.description %>
                                        </td>

                                        <td>
                                            <% plan.type %>
                                        </td>

                                        <td>
                                             <% plan.airtime_days %> Days, <% plan.airtime_hours %> Hours, <% plan.airtime_minutes %> Minutes
                                        </td>

                                        <td>
                                              <% plan.plan_days %> Days, <% plan.plan_hours %> Hours, <% plan.plan_minutes %> Minutes
                                        </td>

                                        <td>
                                            <% plan.nominations %>
                                        </td>

                                        <td>
                                            <% plan.price %>
                                        </td>

    									<td>
    										<button class="btn btn-warning btn-xs btn-detail" 
                                                    ng-click="toggle('edit', plan.plan_id)">
                                                    <span class="fa fa-edit fa-fw"></span>
                                            </button>
    									</td>
    								</tr>
    							</table>
                            </div>
                            <!--./table table striped-->
							<center>
								<dir-pagination-controls
							         max-size="7"
							         direction-links="true"
							         boundary-links="true" 
                                     id="pagina">
							    </dir-pagination-controls>
							    <!--./dir-pagination-controls-->
							</center>
						</div>
					</div>
				</div>
			</div>
	    </div>

		<!-- Modal (Pop up when detail button clicked) -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" 
                                class="close" 
                                data-dismiss="modal" 
                                aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <i class="fa fa-circle-o-notch fa-4x"></i>
                        <h4 class="modal-title" id="myModalLabel"><b><% form_title %></b></h4>
                    </div>


                     <div class="modal-body">
                        <form name="frmEditPlan" class="form-horizontal" novalidate="">
                            <table class="table table-responsive">
                                <tr>
                                    <td class="col-md-4 mod">
                                        <label for="code" 
                                                class="control-label">Plan Code:
                                        </label>
                                    </td>
                                    <td class="col-md-8">
                                        <input type='text' 
                                                id="id_code" 
                                                name="code" 
                                                value="<% plan.code %>" 
                                                ng-model="plan.code" 
                                                autocomplete="off" 
                                                class="form-control" 
                                                required ng-touched />
                                        <span class="help-inline" 
                                                ng-show="userForm.code.$invalid && !userForm.code.$pristine">
                                            code is required.
                                        </span>
                                    </td>
                                </tr>

                                 <tr>
                                    <td class="col-md-4 mod">
                                        <label for="description" 
                                                class="control-label">Description:
                                        </label>
                                    </td>
                                    <td class="col-md-8">
                                        <input type='text' 
                                                id="id_description" 
                                                name="description" 
                                                value="<% plan.description %>" 
                                                ng-model="plan.description" 
                                                autocomplete="off" 
                                                class="form-control" 
                                                required ng-touched />
                                        <span class="help-inline" 
                                                ng-show="userForm.description.$invalid && !userForm.description.$pristine">
                                            description is required.
                                        </span>
                                    </td>
                                </tr>

                                 <tr>
                                    <td class="col-md-4 mod">
                                        <label for="type" class="control">Plan Type:</label>
                                    </td>
                                    <td class="col-md-8">
                                        <select id="id_type" name="type" data-ng-model="plan.type" class="form-control" required ng-touched>
                                                     <option value="">
                                                        Select Plan Type
                                                    </option>
                                                    <option value="Telebabad Plans">
                                                        Telebabad Plans
                                                    </option>
                                                    <option value="Pay-per call Plans">
                                                        Pay-per call Plans
                                                    </option>
                                                    <option value="Row Per-minute calling plan">
                                                        Row Per-minute calling plan
                                                    </option>
                                                    <option value="Sponsored calling plans">
                                                        Sponsored calling plans
                                                    </option>
                                        </select>
                                    </td>
                                </tr>


                                 <tr>
                                    <td class="col-md-4 mod">
                                        <label for="airtime_duration" class="control">Airtime duration:</label>
                                    </td>
                                    <td class="col-md-8">
                                        <input type='text' id="id_airtime_duration" name="airtime_duration" ng-model="plan.airtime_duration" autocomplete="off" class="form-control duration-picker" required ng-touched />
                                    <span class="help-inline" ng-show="userForm.airtime_duration.$invalid">airtime duration is required.</span>
                                    </td>
                                </tr>

                                 <tr>
                                    <td class="col-md-4 mod">
                                        <label for="airtime_duration" class="control">Plan duration:</label>
                                    </td>
                                    <td class="col-md-8">
                                        <input type='text' id="id_plan_duration" name="plan_duration" ng-model="plan.plan_duration" autocomplete="off" class="form-control duration-picker" required ng-touched />
                                    <span class="help-inline" ng-show="userForm.plan_duration.$invalid">plan duration is required.</span>
                                    </td>
                                </tr>

                                 <tr>
                                    <td class="col-md-4 mod">
                                        <label for="nominations" class="control">Nominations:</label>
                                    </td>
                                    <td class="col-md-8">
                                        <input type='text' id="id_nominations" name="nominations" value="<% plan.nominations %>" ng-model="plan.nominations" autocomplete="off" class="form-control" required ng-touched />
                                    <span class="help-inline" ng-show="userForm.nominations.$invalid">nominations are required.</span>
                                    </td>
                                </tr>


                                <tr>
                                    <td class="col-md-4 mod">
                                        <label for="nominations" class="control">Price:</label>
                                    </td>
                                    <td class="col-md-8">
                                        <input type='text' id="id_price" name="price" value="<% plan.price %>" ng-model="plan.price" autocomplete="off" class="form-control" required ng-touched />
                                    <span class="help-inline" ng-show="userForm.price.$invalid">price is required.</span>
                                    </td>
                                </tr>
                               

                            </table>
                        </form>
                    </div>

                    
                    <div class="modal-footer">
                        <button type="button" 
                                class="btn btn-success btn-sm btn-block" 
                                id="btn-save" 
                                ng-click="save(modalstate, id)" 
                                ng-disabled="frmEditPlan.$invalid">
                            Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
	</div>

    <script type="text/javascript">
        function showTableData() {
          // var reportbutton = document.getElementById("reportbutton").style.display = "block";
          var tableinfo = document.getElementById("tableinfo").style.display = "block";
          var tabledata = document.getElementById("tabledata").style.display = "block";
          var pagina = document.getElementById("pagina").style.display = "block";
        }
        setTimeout("showTableData()", 700);

        $('.duration-picker').durationPicker({
          lang: 'en',
           formatter: function (s) {
            return s;
          },
          showSeconds: false
        });

       /* $('.duration-picker').change(function() {
          alert($('#id_airtime_duration').val());
        }); */

    </script>


  
@endsection