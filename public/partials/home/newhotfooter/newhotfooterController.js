app.controller("newhotfooterController", newhotfooterController);
function newhotfooterController($scope, $rootScope, $http, $routeParams) {
    var listnewshot = window.localStorage.getItem("listnewshot");
    if (listnewshot) {
        $scope._listnewshot = JSON.parse(listnewshot);
    } else {
        $http.get("/api/gettintuchot/").then(function(res) {
            $scope._listnewshot = res.data;
            window.localStorage.setItem("listnewshot", JSON.stringify(res.data));
        });
    }

}
app.directive('myMainDirective', function() {
    return function(scope, element, attrs) {

    };
});
app.directive('myRepeatDirective', function() {
    return function(scope, element, attrs) {
        if (scope.$last) {
            $(".owl-carousel").each(function(index, el) {
                var config = $(this).data();
                config.navText = ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'];
                config.smartSpeed = "300";
                if ($(this).hasClass('owl-style2')) {
                    config.animateOut = "fadeOut";
                    config.animateIn = "fadeIn";
                }
                $(this).owlCarousel(config);
            });
        }
    };
});