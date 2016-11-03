@extends('admin.layout-admin')

@section('content')

<!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
<script src="{{ asset('bower_components/angular/angular.min.js')}}"></script>

<!-- Angular Utils Pagination -->
<script src="{{ asset('bower_components/angularUtils-pagination/dirPagination.js')}}"></script>

<!-- AngularJS Application Script -->
<script src="{{ asset('app/app.js')}}"></script>

<!-- AngularJS Chief Objective Controller Script -->
<script src="{{ asset('app/controllers/subscribers.js')}}"></script>

<script src="{{ asset('js/showtabledata.js')}}"></script>

<br>
<div ng-app="unitScorecardApp" ng-controller="SubscribersController">
    <div class="wrap">
        <div class="row">			
            <div class="col-lg-12">
                <div class="panel panel-warning objectives-custom-panel">
                    <div class="panel-heading objectives-custom-heading">
                        <i class="fa fa-group fa-5x"></i> 
                        <h2>
                            <b>Subscribers</b>
                        </h2>
                        <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
                    </div>
                    <div class="panel-body">
                        <div class="row">
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
                                <i class="fa fa-info-circle fa-fw"></i>Subscribers
                            </div>
                            <div ng-show="info" class="alert alert-info objective-info-abb">
                                <i class="fa fa-info-circle fa-fw"></i>All Subscribers 
                            </div>
                        </div>
                        <!--./div class row-->
                        <div class="table-responsive" ng-show="info" id="tabledata">
                            <table class="table table-bordered">
                                <thead>
                                <td class="subscriber-name">
                                    Username
                                </td>

                                <td class="subscriber-email">
                                    User Type
                                </td>

                                <td class="subscriber-join">
                                    Created Date
                                </td>

                                <td class="subscriber-status">
                                    Status
                                </td>

                                <td class="subscriber-edit">
                                    View
                                </td>
                                </thead>

                                <tr dir-paginate='subscriber in subscribers|
                                    orderBy: "updated_at":true:sortKey:reverse|
                                    filter:search|
                                    itemsPerPage:5'>

                                    <td>
                                        <% subscriber.username %>
                                    </td>
                                    <td>
                                        <% subscriber.user_type %>
                                    </td>

                                    <td>
                                        <% subscriber.date_created %>
                                    </td>

                                    <td>
                                        <% subscriber.status %>
                                    </td>

                                    <td>
                                        <button class="btn btn-warning btn-xs btn-detail" 
                                                ng-click="toggle(subscriber.id)">
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
                    <form name="frmEditSubscriber" class="form-horizontal" novalidate="">
                        <table class="table table-responsive">

                            <tr>
                                <td class="col-md-4 mod">
                                    <label for="username" class="control">Username:</label>
                                </td>
                                <td class="col-md-8">
                                    <input type='text' disabled value="<% subscriber.username %>" ng-model="subscriber.username" autocomplete="off" class="form-control" required ng-touched />
                                </td>
                            </tr>

                            <tr>
                                <td class="col-md-4 mod">
                                    <label for="user_type" class="control">User Type:</label>
                                </td>
                                <td class="col-md-8">
                                    <input type='text' disabled value="<% subscriber.user_type %>" ng-model="subscriber.user_type" autocomplete="off" class="form-control" required ng-touched />
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="col-md-4 mod">
                                    <label for="ewallet" class="control">E-Wallet:</label>
                                </td>
                                <td class="col-md-8">
                                    <input type='text' disabled value="<% subscriber.ewallet %>" ng-model="subscriber.ewallet" autocomplete="off" class="form-control" required ng-touched />
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="col-md-4 mod">
                                    <label for="firstname" class="control">First Name:</label>
                                </td>
                                <td class="col-md-8">
                                    <input type='text' name="firstname" disabled value="<% subscriber.firstname %>" ng-model="subscriber.firstname" autocomplete="off" class="form-control" required ng-touched />
                                </td>
                            </tr>

                            <tr>
                                <td class="col-md-4 mod">
                                    <label for="middlename" class="control">Middle Name:</label>
                                </td>
                                <td class="col-md-8">
                                    <input type='text' name="middlename" disabled value="<% subscriber.middlename %>" ng-model="subscriber.middlename" autocomplete="off" class="form-control" required ng-touched />
                                </td>
                            </tr>

                            <tr>
                                <td class="col-md-4 mod">
                                    <label for="lastname" class="control">Last Name:</label>
                                </td>
                                <td class="col-md-8">
                                    <input type='text' name="lastname" disabled value="<% subscriber.lastname %>" ng-model="subscriber.lastname" autocomplete="off" class="form-control" required ng-touched />
                                </td>
                            </tr>

                            <tr>
                                <td class="col-md-4 mod">
                                    <label for="address" class="control">Address:</label>
                                </td>
                                <td class="col-md-8">
                                    <input type='text' name="address" disabled value="<% subscriber.address %>" ng-model="subscriber.address" autocomplete="off" class="form-control" required ng-touched />
                                </td>
                            </tr>

                            <tr>
                                <td class="col-md-4 mod">
                                    <label for="bdate" class="control">Birth Date:</label>
                                </td>
                                <td class="col-md-8">
                                    <input type='text' name="bdate" disabled value="<% subscriber.bdate %>" ng-model="subscriber.bdate" autocomplete="off" class="form-control" required ng-touched />
                                </td>
                            </tr>

                            <tr>
                                <td class="col-md-4 mod">
                                    <label for="email_address" class="control">Email Address:</label>
                                </td>
                                <td class="col-md-8">
                                    <input type='text' name="email_address" disabled value="<% subscriber.email_address %>" ng-model="subscriber.email_address" autocomplete="off" class="form-control" required ng-touched />
                                </td>
                            </tr>

                            <tr>
                                <td class="col-md-4 mod">
                                    <label for="status" class="control">Status:</label>
                                </td>
                                <td class="col-md-8">
                                    <select disabled ng-model="subscriber.status" ng-options="status as status.label for status in statuses track by status.value"></select>
                                </td>
                            </tr>

                        </table>
                    </form>
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