var home = angular.module('home', []);
home.controller('personal_filter', function($scope, $http) {
    $scope.personal_btn = function () {
        console.log( $scope.personal);
        $http({
            method: 'GET',
            url: '{{route('search')}}',
            params : $scope.personal
        }).then(function success(response) {
        }, function error(response) {
        });
    }
});
