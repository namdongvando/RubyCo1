app.controller("mproductController", mproductController);
function mproductController($scope, $rootScope, $http, $routeParams) {


    $scope._CurentCategory = null;
    $http.get("/mproduct/getListCategory/").then(function(res) {
        $scope._listCategory = res.data;
    })

    $scope.GetProductPT = (params, pageIndex, pageNumber) => {
        var data = {
            name: params.seach,
            pageNumber: pageNumber,
            pageIndex: pageIndex
        }
        var link = (data) => {
            return "/mproduct/GetProductPT/" + data.pageIndex + "/" + data.pageNumber + "/" + data.name + "/";
        }

        $http.get(link(data), null, {headers: {"Content-type": "application/x-www-form-urlencoded; charset=utf-8"}}).then(function(res) {
            $scope._listProductNoPrice = res.data;
            $scope._listProductNoPrice.pageTotal = Math.ceil($scope._listProductNoPrice.totalCount / $scope._listProductNoPrice.pageNumber);
            console.log($scope._listProductNoPrice);
        })

    }

    $scope.savePriceProduct = function(item) {
        var data = {
            ID: item.ID
            , Price: item.Price
        }
        $http.post("/mproduct/savePriceProduct/", $.param(data), {headers: {"Content-type": "application/x-www-form-urlencoded; charset=utf-8"}}).then(function(res) {
            $scope._listProductByCatID = res.data;
        })
    }
    $scope.mproductNoPrice = function() {
        $http.get("/mproduct/productnopriceAjax/").then(function(res) {
            $scope._listProductNoPrice = res.data;
        })
    }
    $scope.mproductInit = function() {
    }
    $scope.clickSelectCategory = function(catID) {
        $scope._CurentCategory = catID;
        $http.get("/mcategory/getCategoryByID/" + catID).then(function(res) {
            $scope._Category = res.data;
        })
        $http.get("/mproduct/getProductsBycatID/" + catID).then(function(res) {
            $scope._listProductByCatID = res.data;
        })
    }

    $scope.getProductByName = function($name) {
        var data = {
            "Name": $name
        };
        $http.post("/mproduct/seachajax/", $.param(data), {headers: {"Content-type": "application/x-www-form-urlencoded; charset=utf-8"}}).then(function(res) {
            $scope._listProductByName = res.data;
        })
    }

}