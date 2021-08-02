
var AuthModule = angular.module("AuthModule", ['ngResource','satellizer','ngCookies','pascalprecht.translate'])

AuthModule.config(['$authProvider', function ($authProvider) {
    $authProvider.loginUrl = 'http://sponsorsmanagement.ps/api/login';
}]);

