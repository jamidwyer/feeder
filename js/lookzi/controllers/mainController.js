app.controller("mainController", ['$scope', 'GeolocationService', '$http', 'APIInfoService', function ($scope, geolocation, $http, api_info) {
    //everything assigned to $scope is available within the div controlled by mainController (in this case, main-frame)
    $scope.items = [];
    $scope.position = null;
    $scope.message = "Determining geolocation...";
    $scope.init = function () {
        geolocation().then(function (position) {
            $scope.data = api_info.getData();
            $scope.position = position;
            var requestURL = "";
            var latitude = "";
            var longitude = "";
            var apiName = "";
            var apiCount = $scope.data.length;
            var i = 0;
            for (i = 0; i < apiCount; i++) {
                requestURL = $scope.data[i].url;
                latitude = $scope.data[i].latitude;
                longitude = $scope.data[i].longitude;
                apiName = $scope.data[i].service;
                $http({method: 'GET', url: 'php/' + apiName + ".php?latitude=" + position.coords.latitude + "&longitude=" + position.coords.longitude})
                    .success(function (data) {
                        $scope.items = data;
                    })
                    .error(function (error) {
                    });
                
            }
        });
    };
}]);