var Module = angular.module('app', ['ngRoute']);

Module.config(function ($stateProvider) {

    $stateProvider

        .state('login', {
            url: '/login',
            templateUrl: 'app/modules/admin/views/login.html',
            params: {type: 'users'},
            data: {pageTitle: 'LOGIN'},
            controller: 'loginController',
            resolve: {
                deps: ['$ocLazyLoad', function ($ocLazyLoad) {
                    return $ocLazyLoad.load({
                        name: 'loginController',
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            'assets/global/plugins/angularjs/plugins/ui-select/select.min.css',
                            'assets/global/plugins/angularjs/plugins/ui-select/select.min.js',
                            'app/modules/admin/services/services.js',
                            'app.js'
                        ]
                    });
                }]
            }
        })
        .state('sponsor', {
            url: 'sponsor',
            templateUrl: 'app/modules/admin/views/sponsor.html',
            data: {pageTitle: 'USERS'},
            params: {type: 'users', id: null},
            controller: 'SponsorController',
            resolve: {
                deps: ['$ocLazyLoad', function ($ocLazyLoad) {
                    return $ocLazyLoad.load({
                        name: 'SponsorController',
                        files: [
                            'assets/global/plugins/angularjs/plugins/ui-select/select.min.css',
                            'assets/global/plugins/angularjs/plugins/ui-select/select.min.js',
                            'app/modules/admin/services/services.js',
                            'app.js'
                        ]
                    });
                }]
            }
        })
        .state('home', {
            url: '/home',
            templateUrl: 'pm/app/modules/admin/home.html',
            data: {pageTitle: 'HOME'},
            params: {type: 'users', id: null},
            controller: 'homeController',
            resolve: {
                deps: ['$ocLazyLoad', function ($ocLazyLoad) {
                    return $ocLazyLoad.load({
                        name: 'SponsorController',
                        files: [
                            'assets/global/plugins/angularjs/plugins/ui-select/select.min.css',
                            'assets/global/plugins/angularjs/plugins/ui-select/select.min.js',
                            'app/modules/admin/controllers/home.js',
                            'app.js'
                        ]
                    });
                }]
            }
        })

});


Module.controller('personal_filter', function ($scope, $http) {

});


Module.controller('homeController', function ($scope, $http) {

});



