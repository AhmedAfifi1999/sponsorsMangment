var App = angular.module('myApp', ['ngRoute']);
App.controller('loginController', function ($scope, $http) {


    $scope.login = function () {

        var url = 'http://sponsorsmanagement.ps/api/login',
            data = $scope.user,
            config = 'contenttype';

        $http.post(url, data, config).then(function (response) {
            console.log(response['data'].access_token);
            $window.localStorage.setItem('token', response['data'].access_token);


        }, function (response) {
            console.log(response)
            // this function handles error
        });
    }


});
