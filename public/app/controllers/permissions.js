app.controller('PermissionsController', function($scope, $http, $interval) {

    $scope.usergroups = [];
    $scope.loading = true;
    $scope.info = false;
 
    $scope.init = function() {
        $scope.loading = false;
        $scope.info = true;
		$http.get(public + 'api/permissions').
		success(function(data, status, headers, config) {
                    angular.forEach(data,function(datum){
                        alert(datum);
                    });
                    
                    
                    
                    
                    $scope.usergroups = data.usergroups;
                    $scope.selected_group = $scope.usergroups[0];
                    $scope.loading = false;
                    $scope.items = [{
                        id: 1,
                        label: 'aLabel'
                      }, {
                        id: 2,
                        label: 'bLabel'
                      }];
                    $scope.selected = $scope.items[0];
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
        var url = public + 'api/permissions';

        //append Unit Objective ID to the URL if the form is in edit mode
        if (modalstate === 'edit')
        {
            url += "/" + id;

            $http.put(url, {
                
            }).success(function(data, status, headers, config, response) {
                $('#myModal').modal('hide');
                $scope.permissions = '';
                $scope.init();
                $scope.loading = false;
            });
        }
        else if (modalstate === 'add')
        {
            $http.post(url, {
                
            }).success(function(data, status, headers, config, response) {
                $('#myModal').modal('hide');
                $scope.permissions = '';
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
            
        }
        $('#myModal').modal('show');
    };

    $scope.init();

    
	//$interval( function(){ $scope.init(); }, 1000);
});

