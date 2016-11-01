app.controller('UsersController', function($scope, $http, $interval) {

	$scope.users = [];
	$scope.loading = true;
    $scope.info = false;
 
    $scope.init = function() {
        $scope.loading = false;
        $scope.info = true;
		$http.get(public + 'api/users').
		success(function(data, status, headers, config) {
            $http.get(public + 'api/usergroups').
            success(function(data2, status, headers, config){
                 angular.forEach(data,function(datum){
                      angular.forEach(data2,function(datum2){
                            if(datum.id == datum2.id )
                            {
                                datum.groupname = datum2.groupname; 
                            }
                       });
                 });
            }); 

            $scope.users = data;
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
        var url = public + 'api/users';

        //append Unit Objective ID to the URL if the form is in edit mode
        if (modalstate === 'edit')
        {
            url += "/" + id;

            $http.put(url, {
                fullname: $scope.user.fullname,
                email:  $scope.user.email,
                username: $scope.user.username,
                usergroup: $scope.user.usergroup,
                password:  $scope.user.password,

            }).success(function(data, status, headers, config, response) {
                console.log(response);
                $('#myModal').modal('hide');
                $scope.users = '';
                $scope.init();
                $scope.loading = false;
            });
        }
        else if (modalstate === 'add')
        {
            $http.post(url, {
                fullname: $scope.user.fullname,
                email:  $scope.user.email,
                password:  $scope.user.password,
                username: $scope.user.username,
                usergroup: $scope.user.usergroup,


            }).success(function(data, status, headers, config, response) {
                console.log(response);
                $('#myModal').modal('hide');
                $scope.users = '';
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
                $scope.form_title = "ADD USER";
                document.getElementById('id_fullname').value = "";
                document.getElementById('id_email').value = "";
                document.getElementById('id_password').value = "";
                document.getElementById('id_username').value = "";
                document.getElementById('id_usergroup').value = "";
              
                break;
            case 'edit':
                $scope.form_title = "EDIT USER";
                $scope.id = id;
                $http.get(public + 'api/users/' + id)
                        .success(function(response) {
                            console.log(response);
                            $scope.user = response;
                        });
                break;
            default:
                break;
        }
        $('#myModal').modal('show');
    };

    $scope.init();

    
	//$interval( function(){ $scope.init(); }, 1000);
});

