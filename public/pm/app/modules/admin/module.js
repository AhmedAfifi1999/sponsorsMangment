var UsersModule = angular.module('UsersModule',['AdminServices']);

UsersModule.config(function ($stateProvider) {

    $stateProvider

        .state('login', {
            url: '/login',
            templateUrl: 'app/modules/admin/views/login.html',
            params:{type:'users'},
            data: {pageTitle: 'LOGIN'},
            controller: 'loginController',
            resolve: {
                deps: ['$ocLazyLoad', function($ocLazyLoad) {
                    return $ocLazyLoad.load({
                        name: 'loginController',
                        insertBefore: '#ng_load_plugins_before', // load the above css files before '#ng_load_plugins_before'
                        files: [
                            'assets/global/plugins/bootstrap-switch/css/bootstrap-switch-rtl.min.css',
                            'assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
                            'assets/global/plugins/angularjs/plugins/ui-select/select.min.css',
                            'assets/global/plugins/angularjs/plugins/ui-select/select.min.js' ,
                            'app/modules/admin/services/services.js',
                            'app/modules/admin/controllers/users.js'
                        ]
                    });
                }]
            }
        })
        .state('user-edit', {
            url: '/user/:id',
            templateUrl: 'app/modules/admin/views/users/form.html',
            data: {pageTitle: 'USERS'},
            params:{type:'users',id:null},
            controller: 'UserFormController',
            resolve: {
                deps: ['$ocLazyLoad', function ($ocLazyLoad) {
                    return $ocLazyLoad.load({
                        name: 'UserFormController',
                        files: [
                            'assets/global/plugins/angularjs/plugins/ui-select/select.min.css',
                            'assets/global/plugins/angularjs/plugins/ui-select/select.min.js' ,
                            'app/modules/admin/services/services.js',
                            'app/modules/admin/controllers/users.js'
                        ]
                    });
                }]
            }
        })

});
