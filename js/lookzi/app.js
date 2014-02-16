var app = angular.module('Lookzi', [])
    .config(function ($httpProvider, $routeProvider) {
        delete $httpProvider.defaults.headers.common['X-Requested-With'];
    $routeProvider
        .when('/', {controller: 'mainController',
        resolve: {
            'MyServiceData': function (APIInfoService) {
                return MyService.promise;
            }
        }});
    });