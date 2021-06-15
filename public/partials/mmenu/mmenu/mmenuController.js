app.controller("mmenuController", mmenuController);
function mmenuController($scope, $rootScope, $http, $routeParams) {

    $http.get("/mmenu/getMenus").then(function (res) {
        $scope._listMenu = res.data;
    });

    $scope.clickChonMenu = function (groups) {
        $http.get("/mmenu/getMenuByGroup/" + groups).then(function (res) {
            $scope._listMenuByGroups = res.data;
            console.log($scope._listMenuByGroups);
        });
    }
}