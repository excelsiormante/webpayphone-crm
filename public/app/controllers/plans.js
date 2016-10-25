app.controller('PlansController', function($scope, $http, $interval) {

	$scope.plans = [];
	$scope.loading = true;
    $scope.info = false;
 
    $scope.init = function() {
        $scope.loading = false;
        $scope.info = true;
		$http.get(public + 'api/plans').
		success(function(data, status, headers, config) {
			$scope.plans = data;
				$scope.loading = false;
		});	
	};

	$scope.sort = function(keyname)
    {
        $scope.sortKey = keyname;   //set the sortKey to the param passed
        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
    };

    $scope.save = function(modalstate, id) 
    {
        $scope.loading = true;
        var url = public + 'api/plans';

        //append Unit Objective ID to the URL if the form is in edit mode
        if (modalstate === 'edit')
        {
            url += "/" + id;

            $http.put(url, {
                code: $scope.plan.code,
                description: $scope.plan.description,
                type: $scope.plan.type,
                airtime_duration: $scope.plan.airtime_duration,
                plan_duration:  $scope.plan.plan_duration,
                nominations:  $scope.plan.nominations,
                price:  $scope.plan.price,

            }).success(function(data, status, headers, config, response) {
                console.log(response);
                $('#myModal').modal('hide');
                $scope.plans = '';
                $scope.init();
                $scope.loading = false;
            });
        }
        else if (modalstate === 'add')
        {
            $http.post(url, {
                code: $scope.plan.code,
                description: $scope.plan.description,
                type: $scope.plan.type,
                airtime_duration: $scope.plan.airtime_duration,
                plan_duration:  $scope.plan.plan_duration,
                nominations:  $scope.plan.nominations,
                price:  $scope.plan.price,

            }).success(function(data, status, headers, config, response) {
                console.log(response);
                $('#myModal').modal('hide');
                $scope.plans = '';
                $scope.init();
                $scope.loading = false;
            });
        }
        // 
    };

    $scope.toggle = function(modalstate, id) 
    {
        $scope.modalstate = modalstate;

        switch (modalstate) {
            case 'add':
                $scope.form_title = "ADD PLAN";
                document.getElementById('id_code').value = "";
                document.getElementById('id_description').value = "";
                document.getElementById('id_type').value = "";
                document.getElementById('id_airtime_duration').value = "0";
                document.getElementById('id_plan_duration').value = "0";
                document.getElementById('id_nominations').value = "";
                document.getElementById('id_price').value = "";
              
                break;
            case 'edit':
                $scope.form_title = "EDIT PLAN";
                $scope.id = id;
                $http.get(public + 'api/plans/' + id)
                        .success(function(response) {
                            console.log(response);
                            $scope.plan = response;
                        });
                break;
            default:
                break;
        }
        console.log(id);
        $('#myModal').modal('show');
    };

    $scope.init();

    
	//$interval( function(){ $scope.init(); }, 1000);
});

