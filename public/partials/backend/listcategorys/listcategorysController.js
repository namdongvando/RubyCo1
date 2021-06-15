app.controller("listcategorysController", listcategorysController);
app.filter('startFrom', function() {
    return function(input, start) {
        if (input) {
            start = +start;
            return input.slice(start);
        }
        return [];
    };
});

function listcategorysController($scope, $rootScope, $http, $routeParams, filterFilter) {
    $http.get("/backend/getCategorys").then(function(res) {

        $scope.ListCategory = res.data;
//        console.log($scope.ListCategory);
        $scope.showNameCategory = function(id) {
            if (id == 0) {
                return "Là Cấp Cha";
            }
            for (var itemCat in $scope.ListCategory) {
                if ($scope.ListCategory[itemCat].catID == id) {
                    return $scope.ListCategory[itemCat].catName;
                }
            }
        }
    });

    $scope.getCategorysByParentID = function(catID) {
        $http.get("/backend/getCategorysByParentID/" + catID).then(function(res) {
            $scope.ListCategory = res.data;
            $scope.selectCategoryById = function(catID) {
                return $scope.ListCategory.filter(function(item) {
                    if (item.parentCatID == catID)
                        return  item;
                })
            }
        });
    }
    $scope.selectCategory = function(catID) {
        $scope.formcategoryInit(catID, true);
    }
    $scope.newCategory = function() {
        $scope._CategoryDetail = {
            catID: null,
            catName: null,
            catParentID: 0,

        };
    }

    $scope.ListCategory = [];
    $scope.currentPage = 1;
    $scope.totalItems = $scope.ListCategory.length;
    $scope.entryLimit = 20; // items per page
    $scope.noOfPages = Math.ceil($scope.totalItems / $scope.entryLimit);
    $scope.$watch('search', function(newVal, oldVal) {
        $scope.filtered = filterFilter($scope.ListCategory, newVal);
        $scope.totalItems = $scope.filtered.length;
        $scope.noOfPages = Math.ceil($scope.totalItems / $scope.entryLimit);
        $scope.currentPage = 1;
    }, true);
}
