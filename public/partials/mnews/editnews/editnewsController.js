app.controller("editnewsController", editnewsController);
function editnewsController($scope, $rootScope, $http, $routeParams) {

    $http.get("/mnews/getPages").then(function (res) {
        $scope.PagesByType = res.data;
    });

    $scope.editnewsInit = function (news) {
        $http.get("/mnews/getnewById/" + news).then(function (res) {
            $scope._New = res.data;
            console.log($scope._New);
        });
    }

}