app.controller("mnewsController", mnewsController);
function mnewsController($scope, $rootScope, $http, $routeParams) {

    $scope._pagesID = "";
    $scope.mnewsInit = function() {

    }

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



    $http.get("/mnews/getPages").then(function(res) {

        $scope.PagesByType = res.data;
    })

    $scope.clikGetNewsByPage = function(idPa) {
        $http.get("/mnews/getNewsByPages/" + idPa).then(function(res) {
            $scope.newsByPage = res.data;
            $scope._pagesID = idPa;
        })
    }

}