app.service('APIInfoService', function ($http) {
    var myData = null;
    var promise = $http.get('api_info.json').success(function (data) {
        myData = data;
    });

    return {
        promise: promise,
        setData: function (data) {
            myData = data;
        },
        getData: function () {
            return myData;
        }
    };
});