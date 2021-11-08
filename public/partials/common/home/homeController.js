
app.controller("homeController", homeController);

function homeController($scope, $http, $location, $anchorScroll) {
    $location.hash('');
    $location.replace();
    $scope.productCatHome = [];
    var Version = window.localStorage.getItem("Version");
    $http.get("/api/version/").then(function(res) {
        window.localStorage.setItem("Version", JSON.stringify(res.data));
        if (Version) {
            Version = JSON.parse(Version);
            if (Version.Version != res.data.Version) {
                window.localStorage.clear();
            }
        }
    });

    $scope.TaiSaoChonChungToi = function() {
        console.log($scope._TaiSaoChonChungToi);
        if ($scope._TaiSaoChonChungToi == null)
            $http.get("/api/TaiSaoChonChungToi/").then(function(res) {
                $scope._TaiSaoChonChungToi = res.data;
            });
    }
    $http.get("/api/getMenuTopMainMenu/").then(function(res) {
        $scope._MenuTopMainMenu = res.data;
    });
    $http.get("/api/danhmucsanpham/").then(function(res) {
        $scope._DanhMucSanPham = res.data;
    });
    $http.get("/api/AdvByProduct/").then(function(res) {
        $scope._AdvProducts = res.data;
        console.log($scope._AdvProducts);
    });
    $http.get("/api/baivietnoibat/").then(function(res) {

        $scope._BaiVietNoiBat = res.data;

    });
    $scope.listNewsProducts = function() {
        $http.get("/api/listNewsProducts/").then(function(res) {
            $scope._listNewsProducts = res.data;
            window.localStorage.setItem("listNewsProducts", JSON.stringify(res.data));
        });
    }
    $scope.listProductSale = function() {
        $http.get("/api/listProductsSale/").then(function(res) {
            $scope._listProductSale = res.data;
            window.localStorage.setItem("listProductSale", JSON.stringify(res.data));
        });
    }
    $scope.listProductByCatIdHome = function(catId) {
        console.log($scope.productCatHome);
        if ($scope.productCatHome[catId])
            return  $scope.productCatHome[catId];
        $http.get("/api/productCatHome/" + catId + "/").then(function(res) {
            $scope.productCatHome[catId] = res.data;
            return  $scope.productCatHome[catId];
        });
    }
    $scope.HomeConfig = function() {
        $http.get("/api/homeconfig/").then(function(res) {
            $scope._HomeConfig = res.data;
            window.localStorage.setItem("HomeConfig", JSON.stringify(res.data));
        });
    }

    var listNewsProducts = window.localStorage.getItem("HomeConfig");
    if (listNewsProducts) {
        $scope._HomeConfig = JSON.parse(listNewsProducts);
    } else {
        $scope.HomeConfig();
    }

    $scope.updateHomeSlide = function() {
        $http.get("/api/updateHomeSlide/").then(function(res) {
            $scope._advHomeSlide = res.data;
            window.localStorage.setItem("advHomeSlide", JSON.stringify(res.data));
        });
    }

    var Product = window.localStorage.getItem("HotProduct");
    if (Product) {
        $scope._Products = JSON.parse(Product);
    } else {
        $http.get("/api/getProductsHot/").then(function(res) {
            $scope._Products = res.data;
            window.localStorage.setItem("HotProduct", JSON.stringify(res.data));
        });
    }



    var listNewsProducts = window.localStorage.getItem("listNewsProducts");
    if (listNewsProducts) {
        $scope._listNewsProducts = JSON.parse(listNewsProducts);
    } else {
        $scope.listNewsProducts();
    }
    /**
     * Comment
     * @param {type} parameter
     */

    var listProductSale = window.localStorage.getItem("listProductSale");
    if (listProductSale) {
        $scope._listProductSale = JSON.parse(listProductSale);
    } else {
        $scope.listProductSale();
    }

    /**
     * HOme slide
     * @param {type} parameter
     */

    var advHomeSlide = window.localStorage.getItem("advHomeSlide");
    if (advHomeSlide) {
        $scope._advHomeSlide = JSON.parse(advHomeSlide);
    } else {
        $http.get("/api/homeslide/").then(function(res) {
            $scope._advHomeSlide = res.data;
            window.localStorage.setItem("advHomeSlide", JSON.stringify(res.data));
        });
    }
    /**
     * menus
     * @param {type} parameter
     */

    $scope.getMenus = function() {
        $http.get("/api/getMenus/").then(function(res) {
            $scope._allMenus = res.data;
            window.localStorage.setItem("allMenus", JSON.stringify(res.data));
        });
    }

    $scope.linkLienKetMenu = function() {
        $http.get("/api/linkLienKet/").then(function(res) {
            $scope._linkLienKetMenu = res.data;
            window.localStorage.setItem("linkLienKetMenu", JSON.stringify(res.data));
        });
    }

    $http.get("/api/baivietmoinhat/").then(function(res) {
        $scope._baivietmoinhat = res.data;

    });
    $http.get("/api/VanBanPhapLuat/").then(function(res) {
        $scope._vanbanphapluat = res.data;

    });
    var linkLienKetMenu = window.localStorage.getItem("linkLienKetMenu");
    if (linkLienKetMenu) {
        $scope._linkLienKetMenu = JSON.parse(linkLienKetMenu);
    } else {
        $scope.linkLienKetMenu();
    }



    var allMenus = window.localStorage.getItem("allMenus");
    if (allMenus) {
        $scope._allMenus = JSON.parse(allMenus);
    } else {
        $scope.getMenus();
    }

    var advDanhMucNoiBat = window.localStorage.getItem("advDanhMucNoiBat");
    if (advDanhMucNoiBat) {
        $scope._advDanhMucNoiBat = JSON.parse(advDanhMucNoiBat);
    } else {
        $http.get("/api/danhmucnoibat/").then(function(res) {
            $scope._advDanhMucNoiBat = res.data;
            window.localStorage.setItem("advDanhMucNoiBat", JSON.stringify(res.data));
        });
    }
    var ProductView = window.localStorage.getItem("HotProductView");
    if (ProductView) {
        $scope._ProductsView = JSON.parse(ProductView);
    } else {
        $http.get("/api/getProductsHotView/").then(function(res) {
            $scope._ProductsView = res.data;
            window.localStorage.setItem("HotProductView", JSON.stringify(res.data));
        });
    }

    $scope.updateHomeSlide();
    setTimeout(function() {
        if (false) {
            $scope.updateHomeSlide();
            $scope.linkLienKetMenu();
            $scope.listProductSale();
            $scope.HomeConfig();
            $scope.getMenus();
        }
    }, 15000);
    $scope.onCarouselClickItem = function(index) {
        $("#homeSlide .carousel-items-title .itemC").removeClass("active");
        $("#homeSlide .carousel-items-title .itemC[data-index='" + index + "']").addClass("active");
    }

    $(function() {
        $('#homeSlide').carousel({
            interval: 4000
        }).on('slid.bs.carousel', function() {
            var index = $("#homeSlide .carousel-inner .item.active").data("index");
            $scope.onCarouselClickItem(index);
        }).on('slide.bs.carousel', function(e) {
        });
    });
}
