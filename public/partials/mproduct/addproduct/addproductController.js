app.controller("addproductController", addproductController);
function addproductController($scope, $rootScope, $http, $routeParams) {
    var $headers = {
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        }
    };
    $http.get("/backend/getCategorys").then(function(res) {
        $scope._ListCategory = res.data;
    });
    $scope.getLinkByCode = function(code) {
        var data =
                {
                    "Code": code
                };
        $http.post("/laytin/getLinkByCode/", $.param(data), $headers).then(function(res) {
            console.log(res.data);
            $scope.getContentBylink(res.data);
            $scope.linkproduct = res.data;
        });

    }
    $scope.getContentBylink = function(link) {
        var data =
                {
                    "Link": link
                };

        $http.post("/laytin/getByLink/", $.param(data), $headers).then(function(res) {
            $scope._Content = res.data;
            $("#Content").val($scope._Content);
            CKEDITOR.replace($(this).attr("Content"));
        });
        $http.post("/laytin/getByLinkName/", $.param(data), $headers).then(function(res) {
            $scope._Name = res.data;
        });
    }
}