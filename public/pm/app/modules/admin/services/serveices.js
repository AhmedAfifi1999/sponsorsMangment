var AdminServices = angular.module('AdminServices', []).constant('API_URL', '/api/');

AdminServices.factory('Users', function ($resource) {
    return $resource('../api/Admin/users/:operation/:id', {id: '@id',page: '@page'}, {
        query  : { method:'GET' ,params:{}, isArray:false },
        filter:{method:'POST' ,params:{operation:'filter'}, isArray:false },
        updateStatus:{method:'PUT'  , params: {operation:'updateStatus'}, isArray: false},
        resetPassword:{method:'PUT'  , params: {operation:'resetPassword'}, isArray: false},
        update: {method: 'PUT'},
        destroy: {method: 'DELETE'}
    });
});

