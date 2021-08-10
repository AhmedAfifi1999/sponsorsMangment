var App = angular.module('login', ['ngRoute']);
App.controller('loginController', function ($scope, $http) {

    $scope.login = function () {
        console.log($scope.user.account_type);
        console.log($scope.user.email);

        if ($scope.user.account_type === "1") {
            console.log('--Start--')
            console.log($scope.user.account_type);
            console.log($scope.user.email);
            console.log('--end--')
            var url = 'http://sponsorsmanagement.ps/api/login',
                data = $scope.user,
                config = 'content_type';


            $http.post(url, data, config).then(function (response) {

                if (response['status'] === 200) {
                    window.location.href = "/home";
                    console.log(response['data'].access_token);
                    window.localStorage.setItem('token', response['data'].access_token);

                }
            }, function (response) {

                console.log(response)
            });
        }
    }


});
