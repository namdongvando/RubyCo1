app.controller("editproductController", editproductController);
function editproductController($scope, $rootScope, $http, $routeParams) {

    $scope.editproductInit = function (Pro) {
        $http.get("/api/getProductByID/" + Pro).then(function (res) {
            $scope._Product = res.data;
            $http.get("/backend/getCategorys").then(function (res) {
                $scope._ListCategory = res.data;
            });
        });

    }

    $scope.XoaHinhSanPham = function (urlhinh, id) {
        $http.post('/mproduct/xoahinhsanpham', {'path': urlhinh}, {'Content-Type': 'application/x-www-form-urlencoded'}).then(function (res) {});
        $("#" + id).hide();
    }

}