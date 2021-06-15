app.controller("madvController", madvController);
function madvController($scope, $rootScope, $http, $routeParams) {
    $scope._Attribute = [];
    $scope._Advs = null;
    $scope.Video = {
        "Link": ""
        , "IsShow": true
    };
    $scope._DetailAdvs = null;
    $scope.madvInit = function() {

    }

    $scope.getVideo = function() {
        $http.get("/madv/getVideo/").then(function(res) {
            $scope.Video = res.data;
            console.log(res.data);
        });
    }


    $scope.saveVideo = function() {
        $scope.Video.Link = $("#UrlHinh").val();
        var dataPost = $scope.Video;
        $http({
            method: 'POST',
            url: "/madv/saveVideo/",
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            transformRequest: function(obj) {
                var str = [];
                for (var p in obj)
                    str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                return str.join("&");
            },
            data: dataPost
        }).then(function(res) {
            console.log(res.data);
        });
    }


    $http.get("/madv/getAdvs").then(function(res) {
        $scope._Advs = res.data;
    });
    $http.get("/madv/getGroupAdvs").then(function(res) {
        $scope._GroupsAdv = res.data;
    });
    $scope.getAdvsByGroups = function(groups) {
        $http.get("/madv/getAdvsByGroups/" + groups + "/").then(function(res) {
            $scope._Advs = res.data;
        });
    }
    $scope.clickRemoveAtt = function(index) {
        $scope._Attribute.splice(index, 1);
    }
    $scope.clickAddAtt = function() {
        $scope._Attribute.push({key: "", value: ""});
    }

    $scope.clickSuaQuangCao = function(ID) {
        $scope._DetailAdvs = null;
        $http.get("/madv/getAdvsByID/" + ID).then(function(res) {
            $scope._editDetailAdvs = res.data;
            $scope._Attribute = JSON.parse($scope._editDetailAdvs.DataAttribute);
        });
    }
    $scope.clickCopyQuangCao = function(ID) {
//       tạo
        $scope._editDetailAdvs = null;
        $http.get("/madv/getAdvsByID/" + ID).then(function(res) {
            $scope._DetailAdvs = res.data;
            $scope._Attribute = JSON.parse($scope._DetailAdvs.DataAttribute);
        });
    }

}