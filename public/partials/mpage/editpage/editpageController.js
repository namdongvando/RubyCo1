app.controller("editpageController", editpageController);
function editpageController($scope, $rootScope, $http, $routeParams) {
    $http.get("/mpage/getPagesOptions/0").then(function(res) {
        $scope._Pages = res.data;
    });
    $scope.editpageInit = function(page) {
        $scope.itemPage = page;
        $scope.itemPage.Note = JSON.parse(page["Note"]);

    }

}