app.controller('PermissionsController', function($scope, $http, $interval) {

    $scope.usergroups = [];
    $scope.permissions = [];
    $scope.loading = true;
    $scope.info = false;
 
    $scope.init = function() {
        $scope.loading = false;
        $scope.info = true;
		$http.get(public + 'api/permissions').
		success(function(data, status, headers, config) {
                    $scope.usergroups = angular.fromJson(data.usergroups);
                    $scope.selected_group = $scope.usergroups[0];
                    $scope.permissions = angular.fromJson(data.permissions);
                    $scope.loading = false;
		});
	};

	$scope.sort = function(keyname)
    {
        $scope.sortKey = keyname;   //set the sortKey to the param passed
        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
    };

    $scope.save = function() 
    {
        var id = $scope.selected_group.id
        $scope.loading = true;
        var url = public + 'api/permissions';
        url += "/" + id;
        
        $http.put(url, {
            permissions : $scope.permissions
        }).success(function(data, status, headers, config, response) {
            $('#myModal').modal('hide');
            $scope.init();
            $scope.loading = false;
        });
    };

    $scope.toggle = function(modalstate, id) 
    {
        $scope.modalstate = modalstate;

        switch (modalstate) {
            
        }
        $('#myModal').modal('show');
    };

    $scope.init();

    
	//$interval( function(){ $scope.init(); }, 1000);
});

