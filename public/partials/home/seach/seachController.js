app.controller("seachController", function($scope, $rootScope, $http, $routeParams) {

    $http.get("/api/danhmucsanpham/").then(function(res) {
        $scope._DanhMuc = res.data;
    });
    $scope.setDanhMuc = function($keyword, $danhmuc) {
        $scope.keyword = $keyword;
        $scope.danhmuc = $danhmuc;
    };

});