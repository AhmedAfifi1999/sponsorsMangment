var Module = angular.module('MyApp', ['ui.router', 'ngResource']);


Module.config(['$stateProvider', '$urlRouterProvider', function ($stateProvider, $urlRouterProvider) {
    // Redirect any unmatched url
    $urlRouterProvider.otherwise("/home");

    $stateProvider

        .state('home', {
            url: '/home',
            params: {type: 'users', id: null},
            templateUrl: 'http://sponsorsmanagement.ps/pm/app/modules/admin/views/home.html',
            // data: {pageTitle: 'HOME'},
            controller: 'allInfoCtrl',
            // resolve: {
            //     deps: ['$ocLazyLoad', function ($ocLazyLoad) {
            //         return $ocLazyLoad.load({
            //             name: 'MyApp',
            //             files: [
            //                 'app/modules/admin/controllers/home.js',
            //                 'app.js'
            //             ]
            //         });
            //     }]
            // }
        })
        .state('search', {
            url: '/search',
            params: {type: 'users', id: null},
            templateUrl: 'http://sponsorsmanagement.ps/pm/app/modules/admin/views/search.html',
            // data: {pageTitle: 'HOME'},
            controller: 'allInfoCtrl',
        });

    $urlRouterProvider.otherwise('/home');

}]);
Module.controller('AppController', function ($scope, $http) {


});

Module.controller('FooterController', function ($scope, $http) {


});
Module.controller('MeanMenuController', function ($scope, $http) {


});
Module.controller('HeaderController', function ($scope, $http) {


});

Module.controller('allInfoCtrl', function ($scope, $http) {

    $scope.cities;
    $scope.countries;
    $scope.governorates;
    $scope.nationalities;
    $scope.neighborhoods;
    $scope.organize = {};
    $scope.personal = {};
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

    $scope.CreateNewPersonalSponsor = function () {
        $scope.personal.password = "123";
        $scope.personal.password_confirmation = "123";
        console.log('this is Personal Sponsor Data');
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


Module.controller('EnterpriseCtrl', function ($scope, $http) {
    //organize

});


// allInfoCtrl
Module.controller('PersonalCtrl', function ($scope, $http) {


});

//---- Search File  "section"

Module.controller('PersonalFilterCtrl', function ($scope, $http) {

    $scope.searchPersonalData;
    $scope.search_personal_btn = function () {
        console.log($scope.searchPersonal);

        var token = window.localStorage.getItem('token');

        $http.defaults.headers.common['Authorization'] = 'Bearer ' + token;

        var url = 'http://sponsorsmanagement.ps/api/searchPersonalSponsor',
            data = $scope.searchPersonal,
            config = 'content_type';

        console.log('data' + data);
        $http.post(url, data, config).then(function (response) {
            $scope.searchPersonalData = response['data']['data'];

            console.log($scope.searchPersonalData);
            console.log("insert Is Successfully")
        }, function (response) {
            if (response['status'] === 401) {
                window.location.href = "http://sponsorsmanagement.ps/login.html";

            }
            console.log(response)
        });


    };

    $scope.management_personal_sponsor = function (id) {
        window.location.href = "http://sponsorsmanagement.ps/pm/app/modules/admin/views/managementPersonalSponsor.html?id=" + id;
        console.log(id);

    };

});

Module.controller('OrganizeFilterCtrl', function ($scope, $http) {
    $scope.searchOrganizeData;
    $scope.search_enterprise_btn = function () {
        console.log($scope.searchOrganize);

        var token = window.localStorage.getItem('token');
        $http.defaults.headers.common['Authorization'] = 'Bearer ' + token;

        var url = 'http://sponsorsmanagement.ps/api/searchEnterpriseSponsor',
            data = $scope.searchOrganize,
            config = 'content_type';

        $http.post(url, data, config).then(function (response) {
            $scope.searchOrganizeData = response['data']['data'];

            console.log($scope.searchOrganizeData);
            console.log("insert Is Successfully")
        }, function (response) {
            console.log();

            if (response['status'] === 401) {
                window.location.href = "http://sponsorsmanagement.ps/login.html";

            }

        });


    };


    $scope.management_enterprise_sponsor = function (id) {
        window.location.href = "http://sponsorsmanagement.ps/pm/app/modules/admin/views/managementPersonalSponsor.html?id=" + id;
        console.log(id);
    };

});

//---- Manage Personal Sponsor "section"

Module.controller('ManagePersonalCtrl', function ($scope, $http) {


});

