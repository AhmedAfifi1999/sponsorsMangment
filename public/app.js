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
        })
        .state('search', {
            url: '/search',
            params: {type: 'users', id: null},
            templateUrl: 'http://sponsorsmanagement.ps/pm/app/modules/admin/views/search.html',
            // data: {pageTitle: 'HOME'},
            controller: 'allInfoCtrl',
        })

        .state('managementEnterpriseSponsor', {
            url: '/managementEnterpriseSponsor/:id',
            params: {type: 'users', id: null},
            templateUrl: 'http://sponsorsmanagement.ps/pm/app/modules/admin/views/managementEnterpriseSponsor.html',
            // data: {pageTitle: 'HOME'},
            controller: 'updateEnterPriseSponsorCtrl',
        })
        .state('managementPersonalSponsor', {
            url: '/managementPersonalSponsor.html/:id',
            params: {type: 'users', id: null},
            templateUrl: 'http://sponsorsmanagement.ps/pm/app/modules/admin/views/managementPersonalSponsor.html',
            // data: {pageTitle: 'HOME'},
            controller: 'allInfoCtrl',
        })

    ;
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


});

//---- Manage Personal Sponsor "section"

Module.controller('ManagePersonalCtrl', function ($scope, $http) {
});

Module.controller('updatePersonalSponsorCtrl', function ($scope, $http, $stateParams) {
    $scope.id = $stateParams.id;
    console.log('id = ' + $scope.id);
    $scope.guaranteeds = {};
    $scope.raw = {};
    getPersonalSponsor = function () {
        $http({
            method: 'GET',
            url: 'http://sponsorsmanagement.ps/api/personalSponsor/' + $scope.id,
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
            $scope.raw = response['data']['data'];
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
    $scope.updatePersonalSponsor = function () {
        console.log($scope.raw);
        var url = 'http://sponsorsmanagement.ps/api/updatePersonalSponsorsInfo/' + $scope.id,
            data = $scope.raw,
            config = 'contenttype';
        $http.put(url, data, config).then(function (response) {
            console.log('Updated Successfully');
        }, function (response) {
            //
        });
    };
    getGuaranteeds = function () {
        $http({
            method: 'GET',
            url: 'http://sponsorsmanagement.ps/api/show/personal/guaranteed/' + $scope.id,
        }).then(function success(response) {
            $scope.guaranteeds = response['data']['data'];
            console.log($scope.guaranteed);
        }, function error(response) {

        });
    }
    $scope.PFilterGuaranteed = {};
    $scope.getPFilterdGuaranteed = function () {
        console.log($scope.PFilterData)
        var url = 'http://sponsorsmanagement.ps/api/search/personal/' + $scope.id + '/guaranteed',
            data = $scope.PFilterData,
            config = 'contenttype';
        $http.put(url, data, config).then(function (response) {
            $scope.PFilterGuaranteed = response['data']['data'];
            console.log($scope.PFilterGuaranteed);
        }, function (response) {
            //
        });

    };
    $scope.getPFilterdGuaranteed();
    getGuaranteeds();
    $scope.sms = function () {
        var url = 'http://sponsorsmanagement.ps/api/updatePersonalSponsorsInfo/' + $scope.id,
            data = $scope.id,
            config = 'contenttype';
        $http.post(url, data, config).then(function (response) {
            console.log('Send Message Successfully');
        }, function (response) {
            //
        });
    }

    $scope.currencies = {};
    getCurrency = function () {
        $http({
            method: 'GET',
            url: 'http://sponsorsmanagement.ps/api/currency',
        }).then(function success(response) {
            $scope.currencies = response['data']['data'];
        }, function error(response) {

        });
    }
    getCurrency();
    // $scope.createGuaranteed;
    $scope.AddGuaranteed = function () {
        console.log($scope.PFilterData)
        var url = 'http://sponsorsmanagement.ps/api/store/personal/guaranteed/' + $scope.id,
            data = $scope.createGuaranteed,
            config = 'contenttype';
        $http.AddGuaranteed()(url, data, config).then(function (response) {
            $scope.PFilterGuaranteed = response['data']['data'];
            console.log(response['data']['data']);
        }, function (response) {
            //
        });
    }

    $scope.deleteGuaranteed = function (id) {
        var url = 'http://sponsorsmanagement.ps/api/Guaranteed/' + id,
            data = '',
            config = 'contenttype';
        $http.delete(url, data, config).then(function (response) {


        }, function (response) {


        });


    }

    $scope.updateGuaranteed = function (id) {
        var url = 'http://sponsorsmanagement.ps/api/Guaranteed/' +id,
            data = $scope.Guaranteed,
            config = 'contenttype';
        $http.put(url, data, config).then(function (response) {
            console.log('Updated Successfully');
        }, function (response) {
            //
        });    }
    $scope.showGuaranteed = function (id) {
        $http({
            method: 'GET',
            url: 'http://sponsorsmanagement.ps/api/Guaranteed/' + id,
        }).then(function success(response) {
            $scope.Guaranteed = response['data']['data'];
            console.log($scope.Guaranteed);
        }, function error(response) {

        });
    }

});

Module.controller('updateEnterPriseSponsorCtrl', function ($scope, $http, $stateParams) {
    $scope.id = $stateParams.id;
    $scope.raw = {};
    $scope.countries;
    getEnterPriseSponsor = function () {
        $http({
            method: 'GET',
            url: 'http://sponsorsmanagement.ps/api/enterprise/' + $scope.id,
            data: 'parameters'
        }).then(function success(response) {
            console.log(response['data']['data']);
            $scope.raw = response['data']['data'];

        }, function error(response) {

        });
    };
    getEnterPriseSponsor();
    locationInfo = function () {

        $http({
            method: 'GET',
            url: 'http://sponsorsmanagement.ps/api/location'
        }).then(function success(response) {
            console.log(response['data'].cities);
            $scope.countries = response['data'].countries;
        }, function error(response) {
        });
    }
    locationInfo();

    $scope.updateEnterpriseSPonsor = function () {

        console.log($scope.raw);
        var url = 'http://sponsorsmanagement.ps/api/enterprise/' + $scope.id,
            data = $scope.raw,
            config = 'contenttype';
        $http.put(url, data, config).then(function (response) {
            console.log('Updated Successfully');
        }, function (response) {
            //
        });

    };

});
