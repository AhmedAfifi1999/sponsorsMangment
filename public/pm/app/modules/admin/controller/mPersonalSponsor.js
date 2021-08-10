var PersonalSponsor = angular.module('managePersonalSponsor', ['ngRoute']);


PersonalSponsor.config(function ($routeProvider) {
    $routeProvider.when('/view1/:param1/:param2', {
        templateUrl: 'Project/EditProject.html',
        controller: 'myCtrl'
    })
})

PersonalSponsor.controller('allInfoCtrl', function ($scope, $http) {

    var glopalUrl = window.location.href;
    console.log('glopalUrl : ' + glopalUrl);
    var id = glopalUrl.substring(glopalUrl.lastIndexOf('=') + 1);
    console.log('id = ' + id);

    $scope.raw= {};
    getPersonalSponsor = function () {
        $http({
            method: 'GET',
            url: 'http://sponsorsmanagement.ps/api/personalSponsor/' + id,
            data: 'parameters'
        }).then(function success(response) {
            console.log(response);
            console.log(response['data']['data'].identification_number_type);
            if (response['data']['data'].identification_number_type === 'identity') {
                document.getElementById("identity").checked = true;
                document.getElementById("passport").checked = false;
            } else if (response['data']['data'].identification_number_type === 'passport') {
                document.getElementById("passport").checked = true;
                document.getElementById("identity").checked = false;
            }
            $scope.raw=response['data']['data'];
            console.log($scope.raw);

        }, function error(response) {

        });


    };
    getPersonalSponsor();


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

PersonalSponsor.controller('updateCtrl', function ($scope, $http) {


    $scope.updatePersonalSponsor = function () {

         console.log('here data :'+$scope.MpersonalSponsor);
        var glopalUrl = window.location.href;
        console.log('glopalUrl : ' + glopalUrl);
        var id = glopalUrl.substring(glopalUrl.lastIndexOf('=') + 1);

        var url = 'http://sponsorsmanagement.ps/api/Guaranteed/' + id,
            data = $scope.MpersonalSponsor,
            config = 'contenttype';

        $http.put(url, data, config).then(function (response) {

            console.log(response);

        }, function (response) {

            // this function handles error

        });


    };


});
