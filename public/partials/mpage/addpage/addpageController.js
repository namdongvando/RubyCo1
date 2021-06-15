app.controller("addpageController", addpageController);
function addpageController($scope, $rootScope, $http, $routeParams) {

    $scope.editpageInit = function (page) {
        $scope.itemPage = page;
        $scope.itemPage.Note = {};

    }

}