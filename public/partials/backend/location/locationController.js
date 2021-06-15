app.controller("locationController", locationController);
function locationController($scope, $rootScope, $http, $routeParams) {
    $http.get("http://api.vkhealth.vn/api/Location/GetCities").then(function (res) {
        $scope.__City = res.data;
        for (var item in res.data) {
            $scope.__City[item].Parent = 0;
            $scope.GetDistricts($scope.__City[item].Value);
        }
    });

    $scope.GetCitys = function () {
        $http.get("http://api.vkhealth.vn/api/Location/GetCities").then(function (res) {
            $scope.__City = res.data;
            $scope.Tinh = $scope.__City[0].Value;
            $scope.GetDistricts($scope.Tinh);
        });
    }
    $scope.GetDistricts = function (id) {

        $http.get("http://api.vkhealth.vn/api/Location/GetDistricts?CityCode=" + id).then(function (res) {
            $scope.__Districts = res.data;
            for (var i in $scope.__Districts) {
                $scope.__Districts[i].Parent = id;
                $scope.__City.push($scope.__Districts[i]);
                $scope.GetWards($scope.__Districts[i].Value);

            }
        });

    }
    $scope.GetWards = function (id) {
        $http.get("http://api.vkhealth.vn/api/Location/GetWards?DistrictCode=" + id).then(function (res) {
            $scope.__Wards = res.data;
            for (var i in $scope.__Wards) {
                $scope.__Wards[i].Parent = id;
                $scope.__City.push($scope.__Wards[i]);
            }
        });

    }

    $scope.savelocation1 = function (idata) {
        $.ajax({url: "/tinhthanh/index/savelocation/",
            data: {data: JSON.stringify(idata)},
            type: 'POST',
            success: function (result) {
                console.log(result);
            }
        });
    }

    $scope.savelocation = function () {
        $.ajax({url: "/tinhthanh/index/savelocation/",
            data: {data: JSON.stringify($scope.__City)},
            type: 'POST',
            success: function (result) {
                console.log(result);
            }
        });

    }

}