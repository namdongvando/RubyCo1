app.controller("languageController", languageController);
function languageController($scope, $rootScope, $http, $routeParams) {
    $scope.languageInit = function (lang) {
        $scope._Langs = lang;
    }

    $scope.AddItemLanguage = function () {
        var defaut = {
            key: "",
            value: "",
        }
        $scope._Langs.push(defaut);
    }

}