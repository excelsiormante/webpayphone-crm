app.controller('SubscribersController', function($scope, $http, $interval) {

	$scope.subscribers = [];
	$scope.loading = true;
    $scope.info = false;
 
    $scope.init = function() {
        $scope.loading = false;
        $scope.info = true;
		$http.get(public + 'api/subscribers').
		success(function(data, status, headers, config) {
			$scope.subscribers = data;
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
        var url = public + 'api/subscribers';

        //append Unit Objective ID to the URL if the form is in edit mode
        if (modalstate === 'edit')
        {
            url += "/" + id;

            $http.put(url, {
                name: $scope.subscriber.name,
                email:  $scope.subscriber.email,
                password:  $scope.subscriber.password,

            }).success(function(data, status, headers, config, response) {
                console.log(response);
                $('#myModal').modal('hide');
                $scope.subscribers = '';
                $scope.init();
                $scope.loading = false;
            });
        }
        else if (modalstate === 'add')
        {
            $http.post(url, {
                name: $scope.subscriber.name,
                email:  $scope.subscriber.email,
                password:  $scope.subscriber.password,

            }).success(function(data, status, headers, config, response) {
                console.log(response);
                $('#myModal').modal('hide');
                $scope.subscribers = '';
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
                $scope.form_title = "ADD SUBSCRIBER";
                document.getElementById('id_name').value = "";
                document.getElementById('id_email').value = "";
                document.getElementById('id_password').value = "";
              
                break;
            case 'edit':
                $scope.form_title = "EDIT SUBSCRIBER";
                $scope.id = id;
                $http.get(public + 'api/subscribers/' + id)
                        .success(function(response) {
                            console.log(response);
                            $scope.subscriber = response;
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

