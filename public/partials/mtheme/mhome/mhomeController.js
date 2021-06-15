app.controller("mhomeController", mhomeController);
function mhomeController($scope, $rootScope, $http, $routeParams) {
    $scope.Theme = "home1";
    $scope.TypePageId = "Pages";
    $scope.TypeCatId = "Cat";
    $scope.Home = {};
    $http.get("/mpage/getPages/").then(function(res) {
        $scope.ListPages = res.data;
    });


    $http.get("/mcategory/getCategorys/").then(function(res) {
        $scope._Categorys = res.data;
    });

    $scope.addHomeCategory = function(item, type) {

        if (type == $scope.TypeCatId) {
            var itemdata = {
                "Id": item.catID,
                "Name": item.catName,
                "Type": $scope.TypeCatId
            };
        } else {
            var itemdata = {
                "Id": item.idPa,
                "Name": item.Name,
                "Type": $scope.TypePageId
            };
        }
        $scope.Home.HomeCategory.push(itemdata);
    }

    $scope.removeHomeCategory = function(index) {
        $scope.Home.HomeCategory.splice(index, 1);

    }

//    $scope.mhomeInit = function() {
    $http.get("/api/homeconfig/").then(function(res) {
        console.log(res.data);
        if (res.data != "") {
            $scope.Home = res.data;
        } else {
            $scope.Home = {};
        }

    });
//}

    $scope.clickAdddisplayPosition = function() {
        $scope.Home.displayPosition.push(
                {
                    DanhMuc: "29",
                    Mau: "mau3"
                }
        );
    }




}