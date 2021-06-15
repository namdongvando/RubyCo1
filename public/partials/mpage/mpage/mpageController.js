app.controller("mpageController", mpageController);
function mpageController($scope, $rootScope, $http, $routeParams) {
    $http.get("/mpage/getPages/").then(function(res) {
        $scope._Pages = res.data;

        $scope.getPagesByGroup = function($idGroups) {
            if ($scope._Pages) {
                return  $scope._Pages.filter(function(itema) {
                    if (itema.idGroup == $idGroups) {
                        return itema;
                    }
                });
            }
            return [];
        }


    });
    $scope.mpageInit = function() {
    }
}