app.controller("addressController", addressController);
function addressController($scope, $rootScope, $http, $routeParams) {
    $scope.Tinh = '32';
    $scope.Huyen = '33';
    $http.get("https://sangquan.net/api/getLocation/").then(function(res) {
        $scope._Locations = res.data;
//        console.log($scope._Locations);
        $scope.getLocationsByParent = function(id) {
//            console.log(id);
            if ($scope._Locations) {
                return $scope._Locations.filter(function(item) {
                    if (item.MaDiaChiCha == id)
                        return item;
                });
            }
            return [];
        }
        $scope.getLocationsById = function(id) {
            if ($scope._Locations) {
                return $scope._Locations.filter(function(item) {
                    if (item.MaDiaChi == id)
                        return item;
                })[0];
            }
            return [];
        }
        $scope.setHuyen = function(tinh) {
            $scope.Huyen = $scope.getLocationsByParent(tinh)[0].MaDiaChi;
        }

    });
}