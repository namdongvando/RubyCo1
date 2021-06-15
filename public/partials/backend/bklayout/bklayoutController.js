app.controller("bklayoutController", bklayoutController);
function bklayoutController($scope, $rootScope, $http, $routeParams) {

    $scope.DangNhap = null;
    $scope.bklayoutInit = function (quantri) {
        $scope.DangNhap = quantri;
    }

    

}