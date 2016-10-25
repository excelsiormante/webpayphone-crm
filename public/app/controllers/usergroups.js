app.controller('APIUsergroupsController', function($scope, $http, $interval) {

	$scope.usergroups = [];
	$scope.loading = true;
    $scope.info = false;
 
    $scope.init = function() {
        $scope.loading = false;
        $scope.info = true;
		$http.get(public + 'api/usergroups').
		success(function(data, status, headers, config) {
			$scope.usergroups = data;
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
        var url = public + 'api/usergroups';

        //append Unit Objective ID to the URL if the form is in edit mode
        if (modalstate === 'edit')
        {
            url += "/" + id;

            $http.put(url, {
                groupname: $scope.usergroup.groupname,
                status:  $scope.usergroup.status,

            }).success(function(data, status, headers, config, response) {
                console.log(response);
                $('#myModal').modal('hide');
                $scope.usergroups = '';
                $scope.init();
                $scope.loading = false;
            });
        }
        else if (modalstate === 'add')
        {
            $http.post(url, {
                groupname: $scope.usergroup.groupname,
                status:  $scope.usergroup.status,

            }).success(function(data, status, headers, config, response) {
                console.log(response);
                $('#myModal').modal('hide');
                $scope.usergroups = '';
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
                $scope.form_title = "ADD USER GROUP";
                document.getElementById('id_groupname').value = "";
                document.getElementById('id_status').value = "";
              
                break;
            case 'edit':
                $scope.form_title = "EDIT USER GROUP";
                $scope.id = id;
                $http.get(public + 'api/usergroups/' + id)
                        .success(function(response) {
                            console.log(response);
                            $scope.usergroup = response;
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

