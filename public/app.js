var Module = angular.module('MyApp', ['ngRoute']);

Module.controller('allInfoCtrl', function ($scope, $http) {
    $scope.cities;
    $scope.countries;
    $scope.governorates;
    $scope.nationalities;
    $scope.neighborhoods;

    locationInfo = function () {

        $http({
            method: 'GET',
            url: 'http://sponsorsmanagement.ps/api/location'
        }).then(function success(response) {
            console.log(response['data'].cities);
            console.log('------------------');
            $scope.cities = response['data'].cities;
            $scope.countries = response['data'].countries;
            $scope.governorates = response['data'].governorates;
            $scope.nationalities = response['data'].nationalities;
            $scope.neighborhoods = response['data'].neighborhoods;


        }, function error(response) {
        });


    }
    locationInfo();


});


// allInfoCtrl
Module.controller('PersonalCtrl', function ($scope, $http) {


    $scope.CreateNewPersonalSponsor = function () {
        $scope.personal.password = "123";
        $scope.personal.password_confirmation = "123";
        console.log($scope.personal);
        var url = 'http://sponsorsmanagement.ps/api/personalSponsor/register',
            data = $scope.personal,
            config = 'content_type';


        $http.post(url, data, config).then(function (response) {
            console.log("insert Is Successfully")
        }, function (response) {

            console.log(response)
        });

    };


});


Module.controller('EnterpriseCtrl', function ($scope, $http) {
//organize
    $scope.myOrgFunc = function () {
        $scope.organize.password = "123";
        $scope.organize.password_confirmation = "123";

        console.log($scope.organize);
        var url = 'http://sponsorsmanagement.ps/api/enterprise/register',
            data = $scope.organize,
            config = 'content_type';


        $http.post(url, data, config).then(function (response) {
            console.log("insert Is Successfully")
        }, function (response) {

            console.log(response)
        });


    };

});



