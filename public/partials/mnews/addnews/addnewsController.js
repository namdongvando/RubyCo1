app.controller("addnewsController", addnewsController);
function addnewsController($scope, $rootScope, $http, $routeParams) {

    $http.get("/mnews/getPages").then(function(res) {
        $scope.PagesByType = res.data;
    });
    $scope.addnewsInit = function(idPa) {
        $scope._New = {PageID: idPa, AnHien: "1", TinNoiBat: "0"};
    }
}