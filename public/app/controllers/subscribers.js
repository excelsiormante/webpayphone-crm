app.controller('SubscribersController', function ($scope, $http, $interval) {

    $scope.subscribers = [];
    $scope.loading = true;
    $scope.info = false;

    $scope.init = function () {
        $scope.loading = false;
        $scope.info = true;
        $http.get(public + 'api/subscribers').
                success(function (data, status, headers, config) {
                    $scope.subscribers = data;
                    $scope.loading = false;
                });
    };

    $scope.sort = function (keyname)
    {
        $scope.sortKey = keyname;   //set the sortKey to the param passed
        $scope.reverse = !$scope.reverse; //if true make it false and vice versa
    };

    $scope.save = function (modalstate, id)
    {
        $scope.loading = true;
        var url = public + 'api/subscribers';

        //append Unit Objective ID to the URL if the form is in edit mode
        if (modalstate === 'edit')
        {
            url += "/" + id;

            $http.put(url, {
                name: $scope.subscriber.name,
                email: $scope.subscriber.email,
                password: $scope.subscriber.password,
            }).success(function (data, status, headers, config, response) {
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
                email: $scope.subscriber.email,
                password: $scope.subscriber.password,
            }).success(function (data, status, headers, config, response) {
                $('#myModal').modal('hide');
                $scope.subscribers = '';
                $scope.init();
                $scope.loading = false;
            });
        }
        //
    };

    $scope.toggle = function (id)
    {
        $scope.form_title = "SUBSCRIBER DETAILS";
        $scope.id = id;
        $http.get(public + 'api/subscribers/' + id)
                .success(function (response) {
                    if ( response.result === 1 ) {
                        $scope.subscriber = response.data;
                        $scope.statuses   = response.statuses;
                    }
                });
        $('#myModal').modal('show');
    };

    $scope.init();


    //$interval( function(){ $scope.init(); }, 1000);
});

