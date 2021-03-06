<?php

namespace theme\bdsltp;

class functionLayout {

    public $Menu;
    public $NameTheme;
    public $TopMainMenu;
    public $FooterMenu;
    public $FooterMenuDichVu;
    public $FooterMenuHoTro;
    public $FooterMenuCongTy;
    public $FileConfig;

    const MauBietThuDep = "MauBietThuDep";
    const FormLienHe = "FormLienHe";
    const NguoiSangTao = "NguoiSangTao";
    const TaiSaoChonChungToi = "TaiSaoChonChungToi";
    const KhachHangNoiVeChungToi = "KhachHangNoiVeChungToi";
    const TuVanHotLine = "TuVanHotLine";
    const XayDungTronGoi = "XayDungTronGoi";
    const ThongTinCanBiet = "ThongTinCanBiet";
    const HomeSlide = "HomeSlide";
    const GioiThieuNgan = "GioiThieuNgan";

    private static $ConfigTheme;
    private static $NguoiSangTao;
    private static $MauBietThuDep;
    private static $KhachHangNoiVeChungToi;
    private static $TuVanHotLine;
    private static $XayDungTronGoi;
    private static $ThongTinCanBiet;
    private static $HomeSlide;
    private static $GioiThieuNgan;

    static function DeCodeHTML() {
        $str = ob_get_clean();
        $str = str_replace("[" . self::NguoiSangTao . "]", self::NguoiSangTao(), $str);
        $str = str_replace("[" . self::MauBietThuDep . "]", self::MauBietThuDep(), $str);
        $str = str_replace("[" . self::TaiSaoChonChungToi . "]", self::TaiSaoChonChungToi(), $str);
        $str = str_replace("[" . self::FormLienHe . "]", self::FormLienHe(), $str);
        $str = str_replace("[" . self::HomeSlide . "]", self::HomeSlide(), $str);
        $str = str_replace("[" . self::TuVanHotLine . "]", self::TuVanHotLine(), $str);
        $str = str_replace("[" . self::XayDungTronGoi . "]", self::XayDungTronGoi(), $str);
        $str = str_replace("[" . self::ThongTinCanBiet . "]", self::ThongTinCanBiet(), $str);
        $str = str_replace("[" . self::KhachHangNoiVeChungToi . "]", self::KhachHangNoiVeChungToi(), $str);
        $str = str_replace("[" . self::GioiThieuNgan . "]", self::GioiThieuNgan(), $str);
        $Content = new \Model\Content();
        $DSOption = $Content->Contents();
        if ($DSOption)
            foreach ($DSOption as $k => $value) {
                $str = str_replace("__" . $k . "___", $value, $str);
            }

        $str = \Model_SaveCache::minify_output($str);
        echo $str;
    }

    public static function getThemeConfig($Ma = null) {
        $a = file_get_contents(ROOT_DIR . "/theme/config/homeconfig.json");
        if (self::$ConfigTheme == null)
            self::$ConfigTheme = json_decode($a, JSON_OBJECT_AS_ARRAY);
        if ($Ma)
            return self::$ConfigTheme[$Ma];
        return self::$ConfigTheme;
    }

    function __construct() {
        ob_start();
        $this->NameTheme = 'home';
        $this->TopMainMenu = [];
        $this->FooterMenu = [];
        $this->FooterMenuHoTro = [];
        $this->FooterMenuDichVu = [];
        $this->FooterMenuCongTy = [];
        $this->Menu = new \Model\Menu();
        $this->FileConfig = ROOT_DIR . "/theme/{$this->NameTheme}/_lib/homeconfig";
        $this->loadmenu();
    }

    function LoadConfig() {
        $lib = new \lib\io();
        $ad = new \Model_Adapter();
        return $ad->_decode($lib->readFile($this->FileConfig));
    }

    static function ThongTinCanBiet() {

        $DanhMuc = new \Model\pages(self::getThemeConfig(self::ThongTinCanBiet));
        $news = $DanhMuc->getNewsMoiTop(12);
        if ($news == null) {
            return;
        }
        ob_start();
        ?>
        <!-- BEGIN RECENT WORKS -->
        <div class="recent-work margin-bottom-40">
            <div class="col-md-12">
                <hr>
                <h1 class="text-center title-pannel" ><span><?php echo $DanhMuc->Name; ?></span></h1>
                <div class="owl-carousel owl-carousel4">
                    <?php
                    foreach ($news as $k => $new) {
                        $_v = new \Model\news($new);
                        ?>
                        <div class="recent-work-item">
                            <div class="item-content" >
                                <em>
                                    <img src="<?php echo $_v->UrlHinh() ?>" alt="<?php echo $_v->Name; ?>" class="img-responsive">
                                    <a href="<?php echo $_v->linkNewsCurent(); ?>"><i class="fa fa-link"></i></a>
                                    <a href="<?php echo $_v->UrlHinh() ?>" class="fancybox-button" title="<?php echo $_v->Name ?>" data-rel="fancybox-button"><i class="fa fa-search"></i></a>
                                </em>
                                <a class="recent-work-description" href="javascript:;">
                                    <h3><?php echo $_v->Name ?></h3>
                                </a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>

                </div>
            </div>
        </div>
        <!-- END RECENT WORKS -->
        <?php
        $str = ob_get_clean();
        return $str;
    }

    static function XayDungTronGoi() {
        ob_start();
        ?>
        <!-- BEGIN RECENT WORKS -->
        <div class="recent-work margin-bottom-40">
            <div class="col-md-12">
                <hr>
                <h1 class="text-center title-pannel" ><span>X??y D???ng Tr???n G??i</span></h1>
                <div class="owl-carousel owl-carousel4">
                    <div class="recent-work-item">
                        <div class="item-content" >
                            <em>
                                <img src="/public/bdsltp/public/images/banner/nha1.jpg" alt="Amazing Project" class="img-responsive">
                                <a href="portfolio-item.html"><i class="fa fa-link"></i></a>
                                <a href="/public/images/banner/nha1.jpg" class="fancybox-button" title="Project Name #1" data-rel="fancybox-button"><i class="fa fa-search"></i></a>
                            </em>
                            <a class="recent-work-description" href="javascript:;">
                                <strong>Amazing Project</strong>
                                <b>Agenda corp.</b>
                            </a>
                        </div>
                    </div>
                    <div class="recent-work-item">
                        <div class="item-content" >
                            <em>
                                <img src="/public/bdsltp/public/images/banner/nha1.jpg" alt="Amazing Project" class="img-responsive">
                                <a href="portfolio-item.html"><i class="fa fa-link"></i></a>
                                <a href="/public/images/banner/nha1.jpg" class="fancybox-button" title="Project Name #1" data-rel="fancybox-button"><i class="fa fa-search"></i></a>
                            </em>
                            <a class="recent-work-description" href="javascript:;">
                                <strong>Amazing Project</strong>
                                <b>Agenda corp.</b>
                            </a>
                        </div>
                    </div>
                    <div class="recent-work-item">
                        <div class="item-content" >
                            <em>
                                <img src="/public/bdsltp/public/images/banner/nha1.jpg" alt="Amazing Project" class="img-responsive">
                                <a href="portfolio-item.html"><i class="fa fa-link"></i></a>
                                <a href="/public/images/banner/nha1.jpg" class="fancybox-button" title="Project Name #1" data-rel="fancybox-button"><i class="fa fa-search"></i></a>
                            </em>
                            <a class="recent-work-description" href="javascript:;">
                                <strong>Amazing Project</strong>
                                <b>Agenda corp.</b>
                            </a>
                        </div>
                    </div>
                    <div class="recent-work-item">
                        <div class="item-content" >
                            <em>
                                <img src="/public/bdsltp/public/images/banner/nha1.jpg" alt="Amazing Project" class="img-responsive">
                                <a href="portfolio-item.html"><i class="fa fa-link"></i></a>
                                <a href="/public/images/banner/nha1.jpg" class="fancybox-button" title="Project Name #1" data-rel="fancybox-button"><i class="fa fa-search"></i></a>
                            </em>
                            <a class="recent-work-description" href="javascript:;">
                                <strong>Amazing Project</strong>
                                <b>Agenda corp.</b>
                            </a>
                        </div>
                    </div>
                    <div class="recent-work-item">
                        <div class="item-content" >
                            <em>
                                <img src="/public/bdsltp/public/images/banner/nha1.jpg" alt="Amazing Project" class="img-responsive">
                                <a href="portfolio-item.html"><i class="fa fa-link"></i></a>
                                <a href="/public/images/banner/nha1.jpg" class="fancybox-button" title="Project Name #1" data-rel="fancybox-button"><i class="fa fa-search"></i></a>
                            </em>
                            <a class="recent-work-description" href="javascript:;">
                                <strong>Amazing Project</strong>
                                <b>Agenda corp.</b>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END RECENT WORKS -->
        <?php
        $str = ob_get_clean();
        return $str;
    }

    static function MauBietThuDep() {
        $DanhMuc = new \Model\pages(self::getThemeConfig(self::MauBietThuDep));
        $news = $DanhMuc->getNewsMoiTop(12);
        if ($news == null) {
            return;
        }
        ob_start();
        ?>
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="margin-bottom-40">
            <!-- BEGIN CONTENT -->
            <div class="col-md-12 col-sm-12">
                <h1 class="text-center title-pannel" ><span><?php echo $DanhMuc->Name; ?></span></h1>
                <div class="content-page">
                    <div class="filter-v1">
                        <div class="thongtincanbiet row mix-grid thumbnails">
                            <?php
                            if ($news) {
                                foreach ($news as $k => $value) {
                                    $_v = new \Model\news($value);
                                    ?>
                                    <div class="col-md-3 col-sm-4 mix category_1 mix_all" style="display: block; opacity: 1; ">
                                        <div class="mix-inner ">
                                            <img alt="<?php echo $_v->Name ?>" data-src="<?php echo $_v->UrlHinh() ?>" src="/public/loading.svg" class="lazy hinhVuong hinhcol4  img-responsive">
                                            <div class="mix-details">
                                                <h4><?php echo $_v->Name ?></h4>
                                                <a class="mix-link"><i class="fa fa-link"></i></a>
                                                <a data-rel="fancybox-button" title="<?php echo $_v->Name; ?>" href="<?php echo $_v->UrlHinh(); ?>" class="mix-preview fancybox-button"><i class="fa fa-search"></i></a>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- BEGIN SIDEBAR & CONTENT -->
        <?php
        $str = ob_get_clean();
        return $str;
    }

    static function KhachHangNoiVeChungToi() {
        $DanhMuc = new \Model\pages(self::getThemeConfig(self::KhachHangNoiVeChungToi));
        $news = $DanhMuc->getNewsMoiTop(12);
        if ($news == null) {
            return;
        }
        ob_start();
        ?>
        <div class="margin-bottom-40">
            <div class="col-md-12">
                <hr>
                <h1 class="text-center title-pannel" ><span><?php echo $DanhMuc->Name; ?></span></h1>
                <div id="myCarousel1" class="padding-top-40">
                    <!-- Carousel items -->
                    <div class="carousel-inner khachangnoigi owl-carousel3">
                        <?php
                        foreach ($news as $k => $value) {
                            $_v = new \Model\news($value);
                            ?>
                            <div class="item">
                                <div class="khachangnoigi-content" >
                                    <div class="col-md-4">
                                        <img class="img img-responsive img-circle" style="border-radius: 100px;" src="<?php echo $_v->UrlHinh(); ?>" alt="">
                                        <div class="">
                                            <span class="testimonials-name"><?php echo $_v->Name; ?></span>
                                            <span class="testimonials-post"><?php echo strip_tags($_v->Summary); ?></span>
                                        </div>
                                    </div>
                                    <blockquote class="col-md-8" ><p><?php echo strip_tags($_v->Content); ?></p></blockquote>
                                    <div class="clearfix" ></div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                    <!-- Carousel nav -->
                    <a class="left-btn" href="#myCarousel1" data-slide="prev"></a>
                    <a class="right-btn" href="#myCarousel1" data-slide="next"></a>
                </div>
            </div>
        </div>
        <?php
        $str = ob_get_clean();
        return $str;
    }

    function loadmenu() {

        $a = $this->Menu->MenuByTheme($this->NameTheme);
        foreach ($a as $k => $Menu) {
            $body = $this->Menu->MenuByGroupThemeParent($this->NameTheme, $Menu["Groups"], "0", FALSE);
            foreach ($body as $k1 => $menuCap2) {
                $sub = $this->Menu->MenuByGroupThemeParent($this->NameTheme, $menuCap2["Groups"], $menuCap2["IDMenu"], FALSE);
                if ($sub) {
                    $body[$k1]['submenu'] = $sub;
                }
            }
            $a[$k]["body"] = $body;
        }
        foreach ($a as $k => $Menu) {
            if ($Menu["Groups"] == 'TopMainMenu') {
                $this->TopMainMenu = $a[$k];
            }
            if ($Menu["Groups"] == 'FooterMenu') {
                $this->FooterMenu = $a[$k];
            }
            if ($Menu["Groups"] == 'FooterMenuCongTy') {
                $this->FooterMenuCongTy = $a[$k];
            }
            if ($Menu["Groups"] == 'FooterMenuHoTro') {
                $this->FooterMenuHoTro = $a[$k];
            }
            if ($Menu["Groups"] == 'FooterMenuDichVu') {
                $this->FooterMenuDichVu = $a[$k];
            }
        }

        $this->TopMainMenu = $this->Menu->_encode($this->TopMainMenu["body"]);
        $this->FooterMenu = $this->Menu->_encode($this->FooterMenu["body"]);
        $this->FooterMenuCongTy = $this->Menu->_encode($this->FooterMenuCongTy["body"]);
        $this->FooterMenuHoTro = $this->Menu->_encode($this->FooterMenuHoTro["body"]);
        $this->FooterMenuDichVu = $this->Menu->_encode($this->FooterMenuDichVu["body"]);


//        var_dump($this->TopMainMenu);
    }

    static function gethtml() {
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $hotlint_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . "/";
        ?>
        <title><?php echo \Model_Seo::$Title; ?></title>
        <meta charset="utf-8">
        <link rel="canonical" href="<?php echo $actual_link; ?>">
        <link rel="alternate" hreflang="vi" href="<?php echo $actual_link; ?>">
        <meta name="Resource-type" content="Document" />
        <meta name="theme-color" content="#007a8c" />
        <link rel="dns-prefetch" href="//cdnjs.cloudflare.com" />
        <link rel="dns-prefetch" href="//ajax.googleapis.com" />
        <link rel="dns-prefetch" href="//www.facebook.com" />
        <link rel="dns-prefetch" href="//fonts.googleapis.com" />
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
        <meta name="keywords" content="<?php echo strip_tags(\Model_Seo::$key); ?>" />
        <meta name="description" content="<?php echo strip_tags(\Model_Seo::$des); ?>">
        <meta name="author" content="https://nguyenvando.net">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta property="og:image" content="__icon___">
        <meta property="og:locale" content="vi_VN" />
        <meta property="og:url" content="<?php echo $actual_link; ?>">
        <meta property="og:type" content="website">
        <meta property="og:title" content="<?php echo strip_tags(\Model_Seo::$key); ?>">
        <meta property="og:description" content="<?php echo strip_tags(\Model_Seo::$des); ?>">
        <meta charset="utf-8">
        <title><?php echo \Model_Seo::$Title; ?></title>
        <link rel="shortcut icon" href="__icon___">
        <link rel="apple-touch-icon" href="__icon___">
        <link rel="apple-touch-icon" sizes="72x72" href="__icon___">
        <link rel="apple-touch-icon" sizes="114x114" href="__icon___">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|PT+Sans+Narrow|Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css">

        <?php
    }

    static function head() {
        self::gethtml();
        ?>
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|PT+Sans+Narrow|Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css">
        <link href="/public/bdsltp/public/theme/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="/public/bdsltp/public/theme/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="/public/bdsltp/public/theme/assets/pages/css/animate.css" rel="stylesheet">
        <link href="/public/bdsltp/public/theme/assets/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
        <link href="/public/bdsltp/public/theme/assets/plugins/owl.carousel/assets/owl.carousel.css" rel="stylesheet">
        <link href="/public/bdsltp/public/theme/assets/pages/css/components.css" rel="stylesheet">
        <link href="/public/bdsltp/public/theme/assets/pages/css/slider.css" rel="stylesheet">
        <link href="/public/bdsltp/public/theme/assets/corporate/css/style.css" rel="stylesheet">
        <link href="/public/bdsltp/public/theme/assets/pages/css/portfolio.css" rel="stylesheet">
        <link href="/public/bdsltp/public/theme/assets/corporate/css/style-responsive.css" rel="stylesheet">
        <link href="/public/bdsltp/public/theme/assets/corporate/css/themes/blue.css" rel="stylesheet" id="style-color">

        <link href="/public/bdsltp/public/theme/assets/corporate/css/custom.css?v=<?php echo filemtime("public/bdsltp/public/theme/assets/corporate/css/custom.css") ?>" rel="stylesheet">
        <script src="/public/partials/loaderpartials/home/homeconfig.js?v=<?php echo fileatime("public/partials/loaderpartials/home/homeconfig.js"); ?>"></script>
        <style type="text/css" >
            .float-contact {
                position: fixed;
                bottom: 20px;
                left: 20px;
                z-index: 99999;
            }
            .chat-zalo {
                background: #0084c7;
                border-radius: 20px;
                padding: 8px 15px;
                color: white;
                font-weight: bold;
                margin-bottom: 12px;
            }
            .chat-face {
                background: #125c9e;
                border-radius: 20px;
                padding: 8px 15px;
                color: white;
                display: block;
                margin-bottom: 6px;
            }
            .float-contact .hotline {
                background: #103852 !important;
                font-weight: bold;
                border-radius: 20px !important;
                padding: 8px 15px;
                color: white;
                display: block;
                margin-bottom: 6px;
            }

        </style>
        <?php
    }

    function is_mobile() {
        if (empty($_SERVER['HTTP_USER_AGENT'])) {
            return false;
        } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false // many mobile devices (all iPhone, iPad, etc.)
                || strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mobi') !== false) {
            return true;
        }
        return false;
    }

    static function header() {
        ?>
        <div class="header">
            <div class="container">
                <a class="site-logo" href="/">
                    <img src="__Logo___" alt="__WebName___">
                </a>
                <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>
                <!-- BEGIN NAVIGATION -->
                <div class="header-navigation pull-right font-transform-inherit">
                    <ul>
                        <li ng-repeat="item in _MenuTopMainMenu"  ng-class="item.submenu ? 'dropdown' : ''" class="" >
                            <a ng-href="{{item.Link}}" data-toggle="{{item.submenu?'dropdown':''}}"  >{{item.Name}}
                                <i ng-show="item.submenu" class="fa fa-angle-down" ></i>
                            </a>
                            <ul ng-show="item.submenu" class="dropdown-menu">
                                <li ng-repeat="item1 in item.submenu" >
                                    <a  href="{{item1.Link}}">{{item1.Name}}</a>

                                    <ul ng-show="item1.submenu" class="dropdown-menu">
                                        <li ng-repeat="item2 in item1.submenu" >
                                            <a  href="{{item2.Link}}">{{item2.Name}}</a>
                                        </li>
                                    </ul>

                                </li>
                            </ul>
                        </li>
                        <li class="menu-search">
                            <span class="sep"></span>
                            <i class="fa fa-search search-btn"></i>
                            <div class="search-box">
                                <form action="#">
                                    <div class="input-group">
                                        <input type="text" placeholder="Search" class="form-control">
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary" type="submit">T??m Ki???m</button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <?php
    }

    function leftmenu() {
        $Cat = new \Model\Category();
        $Cats = $Cat->Categorys();
        ?>
        <ul class="tree-menu">

            <?php
            $dem = 0;
            if ($Cats)
                foreach ($Cats as $_Category) {
                    ?>
                    <li class="" >
                        <span></span> <a href="<?php echo $_Category->linkCurentCategory() ?>"> <?php echo $_Category->catName ?> </a>
                        <!--ds danh muc con-->
                        <?php
//                                                            C???p 2
                        $lCat = $_Category->Categorys4IDParent($_Category->catID);
                        if ($lCat) {
                            foreach ($lCat as $_Category1) {
                                ?>
                                <ul>
                                    <li><span></span>
                                        <a href="<?php echo $_Category1->linkCurentCategory(); ?>" >
                                            <?php echo $_Category1->catName ?>
                                        </a>
                                        <ul>
                                            <?php
                                            $lCat1 = $_Category1->Categorys4IDParent($_Category1->catID);
                                            if ($lCat1) {
                                                foreach ($lCat1 as $_Category2) {
                                                    ?>
                                                    <li><span></span> <a href="<?php echo $_Category2->linkCurentCategory(); ?>"><?php echo $_Category2->catName ?></a></li>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </li>
                                </ul>
                                <?php
                            }
                            ?>

                            <?php
                        }
                        ?>
                    </li>
                    <?php
                    $dem++;
                }
            ?>
        </ul>

        <?php
    }

    function homeslider() {
        $str = ob_start();
        ?>
        <!-- BEGIN SLIDER -->
        <div class="page-slider margin-bottom-40">
            <div id="carousel-example-generic" class="carousel slide carousel-slider">
                <!-- Indicators -->
                <ol class="carousel-indicators carousel-indicators-frontend">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <!-- First slide -->
                    <div style="background-color: #103852;background: url('/public/bdsltp/public/images/banner/banner2.jpg')" class="item active">
                        <div class="container">
                            <div class="carousel-position-six text-uppercase text-center">
                                <h2 class="margin-bottom-20 animate-delay carousel-title-v5" data-animation="animated fadeInLeft">
                                    Thi???t K??? V?? Thi C??ng <br/>
                                    <span class="carousel-title-normal">Hotline: 0123456789</span>
                                </h2>
                                <p class="carousel-subtitle-v5 border-top-bottom margin-bottom-30" data-animation="animated fadeInDown">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                </p>

                                <a class="carousel-btn-green" href="#" data-animation="animated fadeInRight">Xem ngay</a>
                            </div>

                        </div>
                    </div>
                    <div style="background-color: #103852;background: url('/public/bdsltp/public/images/banner/banner2.jpg')" class="item ">
                        <div class="container">
                            <div class="carousel-position-six text-uppercase text-center">
                                <h2 class="margin-bottom-20 animate-delay carousel-title-v5" data-animation="animated fadeInDown">
                                    Thi???t K??? V?? Thi C??ng <br/>
                                    <span class="carousel-title-normal">Hotline: 0123456789</span>
                                </h2>
                                <p class="carousel-subtitle-v5 border-top-bottom margin-bottom-30" data-animation="animated fadeInDown">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                </p>

                                <a class="carousel-btn-green" href="#" data-animation="animated fadeInUp">Xem ngay</a>
                            </div>

                        </div>
                    </div>
                    <div style="background-color: #103852; background: url('/public/bdsltp/public/images/banner/banner2.jpg')" class="item ">
                        <div class="container">
                            <div class="carousel-position-six text-uppercase text-center">
                                <h2 class="margin-bottom-20 animate-delay carousel-title-v5" data-animation="animated fadeInDown">
                                    Thi???t K??? V?? Thi C??ng <br/>
                                    <span class="carousel-title-normal">Hotline: 0123456789</span>
                                </h2>
                                <p class="carousel-subtitle-v5 border-top-bottom margin-bottom-30" data-animation="animated fadeInDown">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                </p>

                                <a class="carousel-btn-green" href="#" data-animation="animated fadeInUp">Xem ngay</a>
                            </div>

                        </div>
                    </div>

                </div>

                <!-- Controls -->
                <a class="left carousel-control carousel-control-shop carousel-control-frontend" href="#carousel-example-generic" role="button" data-slide="prev">
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                </a>
                <a class="right carousel-control carousel-control-shop carousel-control-frontend" href="#carousel-example-generic" role="button" data-slide="next">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        <!-- END SLIDER -->

        <?php
        $str = ob_get_clean();
    }

    function pagetop() {
        $a = new \Model\adv();
        $DS = $a->AdvsByGroup("danh-muc-noi-bat");
        ?>
        <!-- END Home slideder-->
        <div class="page-top">
            <div class="container">
                <!-- Baner bottom -->
                <div class="row banner-bottom">

                    <div class="col-sm-3" ng-repeat="item in _advDanhMucNoiBat" >
                        <div class="banner-boder-zoom2">
                            <a href="{{item.Link}}">
                                <img  class="lazyload QuanCao-img img-responsive"  alt="{{item.Name}}"  data-srcset="{{item.Image}}" src="/public/no-image.jpg" title="{{item.Name}}" />
                            </a>
                        </div>
                        <h3 class="text-center TenQuanCao" >{{item.Name}}</h3>
                    </div>

                </div>
                <!-- end banner bottom -->
            </div>
        </div>
        <!---->
        <?php
    }

    function servicestopfooter() {
        //
        $a = new \Model\adv();
        $DS = $a->AdvsByGroup("chinh-sach-cuoi-tran");
        ?>
        <div class="services2">
            <ul>
                <?php
                foreach ($DS as $value) {
                    ?>
                    <li class="col-xs-12 col-sm-6 col-md-4 services2-item">
                        <div class="service-wapper">
                            <div class="row">
                                <div class="col-sm-6 image">
                                    <div class="icon">
                                        <img src="<?php echo $value->Urlimages ?>" alt="<?php echo $value->Name ?>">
                                    </div>
                                    <h3 class="title"><a href="<?php echo $value->Link ?>"><?php echo $value->Name ?></a></h3>
                                </div>
                                <div class="col-sm-6 text">
                                    <?php echo $value->Content ?>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
        <?php
    }

    function services() {
        ?>
        <div ng-show="<?php echo $this->LoadConfig()->DichVu ?> == '1'" >
            <div class="container">
                <div class="service ">
                    <div class="col-xs-6 col-sm-3 service-item">
                        <div class="icon">
                            <img alt="services" src="/public/home/assets/data/s1.png" />
                        </div>
                        <div class="info">
                            <a href="#"><h3>Free Shipping</h3></a>
                            <span>On order over $200</span>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-3 service-item">
                        <div class="icon">
                            <img alt="services" src="/public/home/assets/data/s2.png" />
                        </div>
                        <div class="info">
                            <a href="#"><h3>30-day return</h3></a>
                            <span>Moneyback guarantee</span>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-3 service-item">
                        <div class="icon">
                            <img alt="services" src="/public/home/assets/data/s3.png" />
                        </div>

                        <div class="info" >
                            <a href="#"><h3>24/7 support</h3></a>
                            <span>Online consultations</span>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-3 service-item">
                        <div class="icon">
                            <img alt="services" src="/public/home/assets/data/s4.png" />
                        </div>
                        <div class="info">
                            <a href="#"><h3>SAFE SHOPPING</h3></a>
                            <span>Safe Shopping Guarantee</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    static function footer() {
        $adv = new \Model\adv();
        $carousel = $adv->AdvsByGroup("partner", false);
        $carousel1 = $adv->AdvsByGroup("customers", false);
        ob_start();
        ?>
        <!-- BEGIN PRE-FOOTER -->
        <div class="pre-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-6 pre-footer-col">
                        <div class="text-center">
                            <img class="img img-responsive" style="margin: auto;" src="__Logo___" alt="__webName___">
                        </div>
                        <p class="text-justify" >
                            __GioiThieuFooter___
                        </p>
                    </div>

                    <div class="col-md-4 col-sm-6 pre-footer-col">
                        <h2>Li??n H???</h2>
                        <address class="margin-bottom-40">
                            <p>?????a Ch???:  __DiaChi___</p>
                            <p>Phone: __SDT___</p>
                            <p>Fax: __Fax___</p>
                            <p>Email: <a href="mailto:__Email___">__Email___</a></p>
                            <p>Skype: <a href="skype:__Skyper___">__Skyper___</a></p>
                        </address>
                    </div>
                    <div class="col-md-4 col-sm-6 pre-footer-col">
                        <h2>Nh???n Tin</h2>
                        <p>????ng k?? nh???n b???n tin c???a ch??ng t??i v?? c???p nh???t nh???ng tin t???c v?? ??u ????i m???i nh???t!</p>
                        <div class="pre-footer-subscribe-box pre-footer-subscribe-box-vertical">
                            <form action="#">
                                <div class="input-group">
                                    <input type="text" placeholder="email@mail.com" class="form-control">
                                    <span class="input-group-btn">
                                        <button class="btn btn-danger" type="submit">G???i</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- END TWITTER BLOCK -->
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="container">
                <div class="row">
                    <!-- BEGIN COPYRIGHT -->
                    <div class="col-md-4 col-sm-4 padding-top-10">
                        2015 ?? . ALL Rights Reserved.
                    </div>
                    <!-- END COPYRIGHT -->
                    <!-- BEGIN PAYMENTS -->
                    <div class="col-md-4 col-sm-4">
                        <ul class="social-footer list-unstyled list-inline pull-right">
                            <li><a href="javascript:;"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="javascript:;"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="javascript:;"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="javascript:;"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="javascript:;"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="javascript:;"><i class="fa fa-skype"></i></a></li>
                            <li><a href="javascript:;"><i class="fa fa-github"></i></a></li>
                            <li><a href="javascript:;"><i class="fa fa-youtube"></i></a></li>
                            <li><a href="javascript:;"><i class="fa fa-dropbox"></i></a></li>
                        </ul>
                    </div>
                    <!-- END PAYMENTS -->
                    <!-- BEGIN POWERED -->
                    <div class="col-md-4 col-sm-4 text-right">
                        <p class="powered">titkul</p>
                    </div>
                    <!-- END POWERED -->
                </div>
            </div>
        </div>
        <?php
        $str = ob_get_clean();
        return $str;
    }

    static function js() {
        ?>

        <div class="float-contact">
            <!--            <a class="chat-zalo btn" href="http://zalo.me/__Hotline___">Chat Zalo</a>-->
            <a style="border-radius: 100px;" class="hotline btn" href="tel:__SDT___">G???i Ngay : __Hotline___</a>
        </div>
        <script src="/public/bdsltp/public/theme/assets/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="/public/bdsltp/public/theme/assets/plugins/jquery-migrate.min.js" type="text/javascript"></script>
        <script src="/public/bdsltp/public/theme/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="/public/bdsltp/public/theme/assets/corporate/scripts/back-to-top.js" type="text/javascript"></script>
        <script src="/public/bdsltp/public/theme/assets/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->
        <script src="/public/bdsltp/public/theme/assets/plugins/owl.carousel/owl.carousel.min.js" type="text/javascript"></script><!-- slider for products -->
        <script src="/public/bdsltp/public/theme/assets/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->
        <script src="/public/bdsltp/public/theme/assets/plugins/jquery-mixitup/jquery.mixitup.min.js" type="text/javascript"></script>
        <script src="/public/bdsltp/public/theme/assets/pages/scripts/bs-carousel.js" type="text/javascript"></script>
        <script src="/public/bdsltp/public/theme/assets/pages/scripts/portfolio.js" type="text/javascript"></script>
        <script src="http://maps.google.com/maps/api/js?sensor=true" type="text/javascript"></script>
        <script src="/public/bdsltp/public/theme/assets/plugins/gmaps/gmaps.js" type="text/javascript"></script>
        <script src="/public/bdsltp/public/theme/assets/pages/scripts/contact-us.js" type="text/javascript"></script>
        <script src="/public/bdsltp/public/theme/assets/corporate/scripts/layout.js?v=<?php echo time(); ?>" type="text/javascript"></script>
        <script src="/public/lazyloadimg/lazyloading.js" type="text/javascript"></script>
        <script type="text/javascript">
                            jQuery(document).ready(function() {
                            Layout.init();
                            Layout.initOWL();
                            Layout.initTwitter();
                            Layout.initFixHeaderWithPreHeader(); /* Switch On Header Fixing (only if you have pre-header) */
                            Layout.initNavScrolling();
                            Portfolio.init();
                            ContactUs.init();
                            });</script>
        <?php
    }

    function categorySlider($isMultyCategory = -1) {
        $adv = new \Model\adv();
        if ($isMultyCategory == -1) {
            $lisAdv = $adv->AdvsByGroup("cat0");
        } else {
            $gp = "cat" . $isMultyCategory;
            $lisAdv = $adv->AdvsByGroup($gp);
        }

        if ($lisAdv) {
            if (count($lisAdv) == 1) {
                $lisAdv[1] = $lisAdv[0];
            }
            ?>
            <!-- category-slider -->
            <div class="category-slider"  >
                <ul class="owl-carousel owl-style2" data-dots="false" data-loop="true" data-nav = "true" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-items="1">
                    <?php
                    foreach ($lisAdv as $_adv) {
                        ?>
                        <li>
                            <img src="<?php echo $_adv->Urlimages ?>" alt="<?php echo $_adv->Name ?>">
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <!-- ./category-slider -->
            <?php
        }
    }

    function product($produc) {
        $produc = new \Model\Products($produc);
        $p = new \Model\Products();
        $images = $p->getAllImges($produc->ID);
        ?>
        <div class="product-container">
            <div class="left-block">
                <a class="linkproductcat" href="<?php echo $produc->linkProduct(); ?>">
                    <img  on-error-src="/public/images_load.gif" class=" img-responsive" alt="<?php echo $produc->nameProduct ?>"
                          src="<?php echo $produc->UrlHinh(); ?>" />
                </a>
                <?php
                if ($produc->Price > 0) {
                    ?>
                    <div class="add-to-cart">
                        <a title="Gi??? H??ng" href="/cart/index/addproduct/<?php echo $produc->ID ?>">Th??m Gi??? H??ng</a>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="right-block">
                <h3 class="product-name" style="height: 60px" >
                    <a style="font-size: 16px;text-shadow: 0 0 1px #aaa;" href="<?php echo $produc->linkProduct(); ?>">
                        <?php echo $produc->nameProduct; ?>
                    </a>
                </h3>
                <div class="info-orther">
                    <div class="product-desc">
                        <?php
                        echo strip_tags($produc->Summary);
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    function HienThiMau($Pages, $function = "mau1") {
        $Model_Pages = new \Model\pages();
        $Note = $Model_Pages->_decode($Pages["Note"]);
        $this->$function($Pages);
    }

    function functionName($param) {
        ?>
        <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li class="dropdown">
                <a href="category.html" class="dropdown-toggle" data-toggle="dropdown">Fashion</a>
                <ul class="dropdown-menu mega_dropdown" role="menu" style="width: 830px;">
                    <li class="block-container col-sm-3">
                        <ul class="block">
                            <li class="img_container">
                                <a href="#">
                                    <img class="img-responsive" src="/public/home/assets/data/men.png" alt="sport">
                                </a>
                            </li>
                            <li class="link_container group_header">
                                <a href="#">MEN'S</a>
                            </li>
                            <li class="link_container"><a href="#">Skirts</a></li>
                            <li class="link_container"><a href="#">Jackets</a></li>
                            <li class="link_container"><a href="#">Tops</a></li>
                            <li class="link_container"><a href="#">Scarves</a></li>
                            <li class="link_container"><a href="#">Pants</a></li>
                        </ul>
                    </li>
                    <li class="block-container col-sm-3">
                        <ul class="block">
                            <li class="img_container">
                                <a href="#">
                                    <img class="img-responsive" src="/public/home/assets/data/women.png" alt="sport">
                                </a>
                            </li>
                            <li class="link_container group_header">
                                <a href="#">WOMEN'S</a>
                            </li>
                            <li class="link_container"><a href="#">Skirts</a></li>
                            <li class="link_container"><a href="#">Jackets</a></li>
                            <li class="link_container"><a href="#">Tops</a></li>
                            <li class="link_container"><a href="#">Scarves</a></li>
                            <li class="link_container"><a href="#">Pants</a></li>
                        </ul>
                    </li>
                    <li class="block-container col-sm-3">
                        <ul class="block">
                            <li class="img_container">
                                <a href="#">
                                    <img class="img-responsive" src="/public/home/assets/data/kid.png" alt="sport">
                                </a>
                            </li>
                            <li class="link_container group_head                                                                                                                                                                                                        er">
                                <a href                                                                                                                                                                                                        ="#">Kids</a>
                            </li>
                            <li class="link_container"><a href="#">Shoes</a></li>
                            <li class="link_container"><a href="#">Clothing</a></li>
                            <li class="link_container"><a href="#">Tops</a></li>
                            <li class="link_container"><a href="#">Scarves</a></li>
                            <li class="link_container"><a href="#">Accessories</a></li>
                        </ul>
                    </li>
                    <li class="block-container col-sm-3">
                        <ul class="block">
                            <li class="img_container">
                                <a href="#">
                                    <img class="img-responsive" src="/public/home/assets/data/trending.png" alt="sport">
                                </a>
                            </li>
                            <li class="li                                                                                                                                                                                                        nk_container group_header"                                                                                                                                                                                                        >
                                <a href="#">TRENDING</a>
                            </li>
                            <li class="link_container"><a href                                                                                                                                                                                                        ="#">Men's Clothing</a></li>
                            <li class="lin                                                                                                                                                                                                        k_container"><a href="#">Kid's Clothing</a></li>
                            <li class="link_contain                                                                                                                                                                                                        er"><a href="#">Women's Clothing</                                                                                                                                                                                                        a></li>
                            <li class="link_container"><a href="#">Accessories</a><                                                                                                                                                                                                        /li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a href="category.html" class="dr                                                                                                                                                                                                        opdown-toggle" data-toggle="dropdo                                                                                                                                                                                                        wn">Sports</a></li>
            <li class="dropdown">
                <a href="category.ht                                                                                                                                                                                                        ml" class="dropdown-toggle" data-toggle="dropdown">Foods                                                                                                                                                                                                        </a>
                <ul class="mega_dropdown                                                                                                                                                                                                         dropdown-menu" style="width: 8                                                                                                                                                                                                        30px;">
                    <li class="block-container col-sm-3">
                        <ul class="block">
                            <li class="link_contai                                                                                                                                                                                                        ner group_header">
                                <a href="#">Asian</a>
                            </li>
                            <li class="link_container">
                                <a href                                                                                                                                                                                                        ="#">Vietnamese Pho</a>
                            </li>
                            <li class="link_container">
                                <a href="#">Noodles</a>
                            </li>
                            <li class="link_container">
                                <a href="#">Seafood</a>
                            </li>
                            <li class="link_container group_header">
                                <a href="#">Sausages</a>
                            </li>
                            <li class="link_container">
                                <a href="#">Meat Dishes</a>
                            </li>
                            <li class="link_container">
                                <a href="#">Desserts</a>
                            </li>
                            <li class="link_container">
                                <a href="#">Tops</a>
                            </li>
                            <li class="link_container">
                                <a href="#">Tops</a>
                            </li>
                        </ul>
                    </li>
                    <li class="block-container col-sm-3">
                        <ul class="block">
                            <li class="link_container group_header">
                                <a href="#">European</a>
                            </li>
                            <li class="link_container">
                                <a href="#">Greek Potatoes</a>
                            </li>
                            <li class="link_container">
                                <a href="#">Famous Spaghetti</a>
                            </li>
                            <li class="link_container">
                                <a href="#">Famous Spaghetti</a>
                            </li>
                            <li class="link_container group_header">
                                <a href="#">Chicken</a>
                            </li>
                            <li class="link_container">
                                <a href="#">Italian Pizza</a>
                            </li>
                            <li class="link_container">
                                <a href="#">French Cakes</a>
                            </li>
                            <li class="link_container">
                                <a href="#">Tops</a>
                            </li>
                            <li class="link_container">
                                <a href="#">Tops</a>
                            </li>
                        </ul>
                    </li>
                    <li class="block-container col-sm-3">
                        <ul class="block">
                            <li class="link_container group_header">
                                <a href="#">FAST</a>
                            </li>
                            <li class="link_container">
                                <a href="#">Hamberger</a>
                            </li>
                            <li class="link_container">
                                <a href="#">Pizza</a>
                            </li>
                            <li class="link_container">
                                <a href="#">Noodles</a>
                            </li>
                            <li class="link_container group_header">
                                <a href="#">Sandwich</a>
                            </li>
                            <li class="link_container">
                                <a href="#">Salad</a>
                            </li>
                            <li class="link_container">
                                <a href="#">Paste</a>
                            </li>
                            <li class="link_container">
                                <a href="#">Tops</a>
                            </li>
                            <li class="link_container">
                                <a href="#">Tops</a>
                            </li>
                        </ul>
                    </li>
                    <li class="block-container col-sm-3">
                        <ul class="block">
                            <li class="img_container">
                                <img src="/public/home/assets/data/banner-topmenu.jpg" alt="Banner">
                            </li>
                        </ul>
                    </li>

                </ul>
            </li>
            <li class="dropdown">

                <a href="category.html" class="dropdown-toggle" data-toggle="dropdown">Digital<span class="notify notify-right">new</span></a>
                <ul class="dropdown-menu container-fluid">
                    <li class="block-container">
                        <ul class="block">
                            <li class="link_container"><a href="#">Mobile</a></li>
                            <li class="link_container"><a href="#">Tablets</a></li>
                            <li class="link_container"><a href="#">Laptop</a></li>
                            <li class="link_container"><a href="#">Memory Cards</a></li>
                            <li class="link_container"><a href="#">Accessories</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a href="category.html">Furniture</a></li>
            <li><a href="category.html">Jewelry</a></li>
            <li><a href="category.html">Blog</a></li>
        </ul>
        <?php
    }

    function TinTucFooter() {
        ?>
        <div id="content-wrap1" ng-controller="newhotfooterController" >
            <div class="container"  >
                <!-- Baner bottom -->
                <div class="hidden row banner-bottom">
                    <div class="col-sm-6 item-left">
                        <div class="banner-boder-zoom">
                            <a href="#"><img alt="ads" class="img-responsive" src="/public/home/assets/data/banner-botom1.jpg" /></a>
                        </div>
                    </div>
                    <div class="col-sm-6 item-right">
                        <div class="banner-boder-zoom">
                            <a href="#"><img alt="ads" class="img-responsive" src="/public/home/assets/data/banner-bottom2.jpg" /></a>
                        </div>
                    </div>
                </div>
                <!-- end banner bottom -->

                <!-- blog list -->
                <div class="blog-list"  style="background-color: #fff;" >
                    <h2 class="page-heading">
                        <span class="page-heading-title">Tin T???c M???i</span>
                    </h2>
                    <div class="blog-list-wapper" style="padding: 10px;margin: 0px;" >
                        <ul class="" >
                            <li class="col-md-3 newsitem" ng-repeat="item in _listnewshot" >
                                <div class="post-thumb image-hover2">
                                    <a href="{{item.link}}">
                                        <img class="img img-responsive"  style="padding-top: 10px;" src="{{item.UrlHinh}}" alt="{{item.Name}}">
                                    </a>
                                </div>
                                <div class="post-desc">
                                    <h5 style="height: 2em;" class="post-title">
                                        <a href="{{item.Link}}">{{item.Name}}</a>
                                    </h5>
                                    <div class="post-meta">
                                        <span class="date">{{item.NgayDang}}</span>

                                    </div>
                                    <div class="readmore">
                                        <a href="{{item.Link}}">Chi ti???t</a>
                                    </div>
                                </div>
                            </li>
                            <div class="clearfix" ></div>
                        </ul>
                    </div>
                </div>

                <div class="clearfix" ></div>

                <!-- ./blog list -->
                <!-- service 2 -->
                <div class="services2 " style="background-color: #fff;" >
                    <ul>
                        <li class="col-xs-12 col-sm-6 col-md-4 services2-item">
                            <div class="service-wapper">
                                <div class="row">
                                    <div class="col-sm-6 image">
                                        <div class="icon">
                                            <img src="/public/home/assets/data/icon-s1.png" alt="service">
                                        </div>
                                        <h3 class="title"><a href="#">Gi?? Tr???</a></h3>
                                    </div>
                                    <div class="col-sm-6 text">
                                        Ch??ng t??i cung c???p gi?? c??? c???nh tranh tr??n th??? tr?????ng.
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="col-xs-12 col-sm-6 col-md-4 services2-item">
                            <div class="service-wapper">
                                <div class="row">
                                    <div class="col-sm-6 image">
                                        <div class="icon">
                                            <img src="/public/home/assets/data/icon-s2.png" alt="service">
                                        </div>
                                        <h3 class="title"><a href="#">V???n Truy???n To??n Qu???c</a></h3>
                                    </div>
                                    <div class="col-sm-6 text">
                                        V???i h??? th???ng v???n chuy???n to??n qu???c.
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="col-xs-12 col-sm-6 col-md-4 services2-item">
                            <div class="service-wapper">
                                <div class="row">
                                    <div class="col-sm-6 image">
                                        <div class="icon">
                                            <img src="/public/home/assets/data/icon-s3.png" alt="service">
                                        </div>
                                        <h3 class="title"><a href="#">THANH TO??N AN TO??N</a></h3>
                                    </div>
                                    <div class="col-sm-6 text">
                                        Thanh To??n Khi Nh???n H??ng.
                                        Thanh to??n thu???n ti???n.
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="col-xs-12 col-sm-6 col-md-4 services2-item">
                            <div class="service-wapper">
                                <div class="row">
                                    <div class="col-sm-6 image">
                                        <div class="icon">
                                            <img src="/public/home/assets/data/icon-s4.png" alt="service">
                                        </div>
                                        <h3 class="title"><a href="#">Y??n T??m Mua S???m</a></h3>
                                    </div>
                                    <div class="col-sm-6 text">
                                        B???o v??? ng?????i mua c???a ch??ng t??i bao g???m vi???c mua h??ng c???a b???n t??? nh???p chu???t ?????n giao h??ng.
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="col-xs-12 col-sm-6 col-md-4 services2-item">
                            <div class="service-wapper">
                                <div class="row">
                                    <div class="col-sm-6 image">
                                        <div class="icon">
                                            <img src="/public/home/assets/data/icon-s5.png" alt="service">
                                        </div>
                                        <h3 class="title"><a href="#">H??? tr??? 24/7</a></h3>
                                    </div>
                                    <div class="col-sm-6 text">
                                        H??? tr??? su???t ng??y ????m cho tr???i nghi???m mua s???m su??n s???.
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="col-xs-12 col-sm-6 col-md-4 services2-item">
                            <div class="service-wapper">
                                <div class="row">
                                    <div class="col-sm-6 image">
                                        <div class="icon">
                                            <img src="/public/home/assets/data/icon-s6.png" alt="service">
                                        </div>
                                        <h3 class="title"><a href="#">Mua S???m Tr???c Tuy???n</a></h3>
                                    </div>
                                    <div class="col-sm-6 text">
                                        ???ng d???ng mua s???m tr???c truy???n cho c??c b???n nh???ng s???a l???a ch???n t???t nh???t.
                                    </div>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>

            </div> <!-- /.container -->
        </div>

        <?php
    }

    static function DanhMucSanPham() {
        ?>

        <div class="block left-module panel">
            <p class="title_block">T??m Ki???m</p>
            <div class="panel-body" >
                <?php
                self::Seach();
                ?>
            </div>
        </div>
        <div class="block left-module">
            <p class="title_block">Danh M???c S???n Ph???m</p>
            <div class="block_content">
                <ul class="tree-menu">
                    <li  ng-repeat="mainmenu in _allMenus.LeftMenu| orderBy:Serial"  >
                        <span ng-show="mainmenu.DSDanhMucCon" class="pull-right" >
                            <i class="fa fa-arrow-circle-right" ></i>
                        </span>
                        <a href="#" class="open submenu" ng-show="mainmenu.DSDanhMucCon" > {{mainmenu.catName}}</a>
                        <a href="{{mainmenu.Link}}" ng-show="!mainmenu.DSDanhMucCon" > {{mainmenu.catName}}</a>
                        <ul >
                            <li ng-repeat="submainmenu in mainmenu.DSDanhMucCon" >
                                <span  class="pull-right fa fa-arrow-circle-right" ng-show="submainmenu.DSDanhMucCon" ></span>
                                <a  href="{{submainmenu.Link}}" >
                                    {{submainmenu.catName}}
                                </a>
                                <ul ng-show="submainmenu.DSDanhMucCon" >
                                    <li ng-repeat="submainmenu1 in submainmenu.DSDanhMucCon" ><span></span>
                                        <a href="{{submainmenu1.Link}}">
                                            {{submainmenu1.catName}}
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>

        <div class="block left-module hidden-xs">
            <p class="title_block">Trang X?? H???i</p>
            <div class="block_content social-content" >
                <div class="social-link text-center">
                    <a class="facebook" href="__linkFacebook___"><i class="fa fa-facebook"></i></a>
                    <a class="pinterest" href="__linkPinterest___"><i class="fa fa-pinterest-p"></i></a>
                    <a class="twitter" href="__linkTwitter___"><i class="fa fa-twitter"></i></a>
                    <a class="google-plus" href="__linkGoogle___"><i class="fa fa-google-plus"></i></a>
                </div>

            </div>
        </div>
        <div class="block left-module">
            <p class="title_block">S???n Ph???m M???i</p>
            <div class="block_content  listproducts" >
                <div ng-repeat="item in  _listNewsProducts" class="media product">
                    <a class="pull-left"  href="{{item.Link}}">
                        <img class="media-object lazyload" style="width: 60px;" data-srcset="{{item.UrlHinh}}" src="/public/no-image.jpg" alt="Image">
                    </a>
                    <div class="media-body">
                        <h5 class="media-heading"><a href="{{item.Link}}"   >{{item.nameProduct}}</a></h5>
                        <p class="product-price" >{{item.PriceVnd}}</p>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    public static function HomeRight() {
        ?>
        <!-- block category -->
        <div class="block left-module panel">
            <p class="title_block">T??m Ki???m</p>
            <div class="panel-body" >
                <?php
                self::Seach();
                ?>
            </div>
        </div>
        <div class="block left-module">
            <p class="title_block">Danh M???c S???n Ph???m</p>
            <div class="block_content">
                <ul class="tree-menu">
                    <li  ng-repeat="mainmenu in _allMenus.LeftMenu| orderBy:Serial" >
                        <span ng-show="mainmenu.DSDanhMucCon" class="pull-right" >
                            <i class="fa fa-arrow-circle-right" ></i>
                        </span>
                        <a href="#" class="submenu" ng-show="mainmenu.DSDanhMucCon" > {{mainmenu.catName}}</a>
                        <a href="{{mainmenu.Link}}" ng-show="!mainmenu.DSDanhMucCon" > {{mainmenu.catName}}</a>
                        <ul >
                            <li ng-repeat="submainmenu in mainmenu.DSDanhMucCon" >
                                <span  class="pull-right fa fa-arrow-circle-right" ng-show="submainmenu.DSDanhMucCon" ></span>
                                <a  href="{{submainmenu.Link}}" >
                                    {{submainmenu.catName}}
                                </a>
                                <ul ng-show="submainmenu.DSDanhMucCon" >
                                    <li ng-repeat="submainmenu1 in submainmenu.DSDanhMucCon" ><span></span>
                                        <a href="{{submainmenu1.Link}}">
                                            {{submainmenu1.catName}}
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>
        <div class="block left-module hidden-xs">
            <p class="title_block">Trang X?? H???i</p>
            <div class="block_content social-content" >
                <div class="social-link text-center">
                    <a class="facebook" href="__linkFacebook___"><i class="fa fa-facebook"></i></a>
                    <a class="pinterest" href="__linkPinterest___"><i class="fa fa-pinterest-p"></i></a>
                    <a class="twitter" href="__linkTwitter___"><i class="fa fa-twitter"></i></a>
                    <a class="google-plus" href="__linkGoogle___"><i class="fa fa-google-plus"></i></a>
                </div>

            </div>
        </div>
        <div class="block left-module">
            <p class="title_block">S???n Ph???m M???i</p>
            <div class="block_content  listproducts" >
                <div ng-repeat="item in  _listNewsProducts" class="media product">
                    <a class="pull-left"  href="{{item.Link}}">
                        <img class="media-object lazyload" style="width: 60px;" data-srcset="{{item.UrlHinh}}" src="/public/no-image.jpg" alt="Image">
                    </a>
                    <div class="media-body">
                        <h5 class="media-heading"><a href="{{item.Link}}"   >{{item.nameProduct}}</a></h5>
                        <p class="product-price" >{{item.PriceVnd}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="block left-module">
            <p class="title_block">S???n Ph???m Khuy???n M??i</p>
            <div class="block_content  listproducts" >
                <div ng-repeat="item in _listProductSale" class="media product">
                    <a class="pull-left"  href="{{item.Link}}">
                        <img class="media-object lazyload" style="width: 60px;" data-srcset="{{item.UrlHinh}}" src="/public/no-image.jpg" alt="Image">
                    </a>
                    <div class="media-body">
                        <h5 class="media-heading"><a href="{{item.Link}}"  >{{item.nameProduct}}</a></h5>
                        <p class="product-price" >{{item.PriceVnd}}</p>
                        <p class="product-price-old" ng-show="item.Price > 0" >{{item.PriceVnd}}</p>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    public static function Seach() {
        ?>
        <div ng-controller="seachController" ng-init="setDanhMuc('', '0')" >
            <form action="/index/seach/" method="post" enctype="multipart/form-data" >
                <div class="form-group">
                    <label for="">T??? Kh??a</label>
                    <input ng-model="keyword" type="text" class="form-control" name="seach[keyword]" placeholder="T??? kh??a">
                </div>
                <div class="form-group">
                    <label for="">Danh M???c S???n Ph???m</label>
                    <select ng-model="danhmuc" type="text" class="form-control" name="seach[danhmuc]"  >
                        <option value="0" >T???t C???</option>
                        <option ng-repeat="item  in _DanhMuc" value="{{item.Id}}" >{{item.Name}}</option>
                    </select>
                </div>
                <div class="form-group text-center">
                    <input type="submit" class="btn btn-primary" value="T??m Ki???m" name="timkiem" >
                </div>

            </form>
        </div>


        <?php
    }

    public function Menu() {
        ?>
        <div class="header">
            <div class="container">
                <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>
                <div class="header-navigation font-transform-inherit">
                    <ul class="">
                        <li ng-repeat="item in _MenuTopMainMenu"  ng-class="item.submenu ? 'dropdown' : ''" class="" >
                            <a ng-href="{{item.submenu?'#':item.Link}}" data-toggle="{{item.submenu?'dropdown':''}}"  >{{item.Name}}
                                <i ng-show="item.submenu" class="fa fa-angle-down" ></i>
                            </a>
                            <ul ng-show="item.submenu" class="dropdown-menu sub-menu">
                                <li ng-repeat="item1 in item.submenu" >
                                    <a  href="{{item1.Link}}">{{item1.Name}}</a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-search " style="top: 0px;display: none;">
                            <a href="#"  >
                                <span class="sep"></span>
                                <i class="fa fa-search search-btn"></i>
                            </a>
                            <div class="search-box">
                                <form action="#">
                                    <div class="input-group">
                                        <input type="text" placeholder="Search" class="form-control">
                                        <span class="input-group-btn">
                                            <button class="btn btn-primary" type="submit">Search</button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </li>


                    </ul>
                </div>
            </div>
        </div>
        <?php
    }

    public function right() {
        ?>
        <div class="">
            <div class="panel-body row">
                <form action="/timkiem/index/" method="GET" >
                    <div class="form-group">
                        <label for="">T??m Ki???m</label>
                        <input type="text" class="form-control" value="<?php echo isset($_GET["keyword"]) ? $_GET["keyword"] : ""; ?>" name="keyword" placeholder="T??? Kh??a T??m Ki???m">
                        <p>__TimKiemVD___</p>

                    </div>
                    <div class="form-group text-center">
                        <input type="submit" class="btn btn-theme" value="T??m Ki???m"  >
                    </div>
                </form>
            </div>
        </div>
        <div class="panel panel-theme">
            <div class="panel-heading">
                <h3 class="panel-title">B??i Vi???t M???i Nh???t</h3>
            </div>
            <div class="panel-body">
                <div class="recent-news margin-bottom-10 " >
                    <div ng-repeat="news in _baivietmoinhat" class="row margin-bottom-10">
                        <div class="col-md-3">
                            <a href="{{news.Link}}" class=" " style="display: block;" >
                                <img onerror="this.src='/public/lawkimsa/Images/h1.jpg'" class="img-responsive" alt="{{news.Name}}" src="{{news.UrlHinh}}">
                            </a>
                        </div>
                        <div class="col-md-9 recent-news-inner">
                            <h3  ><a style="color: #000;font-weight: bold;font-size: 1em;" href="{{news.Link}}">{{news.Name}}</a></h3>
                            <p style="color: #aaa;line-height: 1em;height: 2.09em;overflow: hidden;" >{{news.Summary}}</p>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    static function TuVanHotLine() {
        ob_start();
        ?>
        <div class="clearfix" ></div>
        <div class="tuvan-container margin-10" >
            <p class="text-center" >H??Y G???I NGAY CH??NG T??I</p>
            <h3 class="text-center" >????? ???????C T?? V???N MI???N PH??</h3>
            <div class="btn-tuvan text-center" >
                <a href="tel:__Hotline___" class="btn-lg btn-bds btn btn-primary btn-radius" >Hotline: __Hotline___</a>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }

    public static function HomeSlide() {
        $adv = new \Model\advSlider();
        $advs = $adv->GetSlides();
        ob_start();
        ?>
        <div class="page-slider margin-bottom-40">
            <div id="carousel-example-generic" class="carousel slide carousel-slider">
                <!-- Indicators -->

                <ol class="carousel-indicators carousel-indicators-frontend">
                    <?php
                    for ($i = 0; $i < count($advs); $i++) {
                        ?>
                        <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; ?>" class="<?php echo $i == 0 ? 'active' : ''; ?>"></li>
                        <?php
                    }
                    ?>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <!-- First slide -->
                    <?php
                    foreach ($advs as $k => $value) {
                        $slide = new \Model\advSlider($value);
                        ?>
                        <div class="item <?php echo $k == 0 ? 'active' : ''; ?>" style="background-color: #103852;background: url('<?php echo $slide->Urlimages; ?>')" >
                            <div class="container">
                                <div style="color: #aaa !important;" class="carousel-position-six text-uppercase text-center">
                                    <?php echo $slide->Content; ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <a class="left carousel-control carousel-control-shop carousel-control-frontend" href="#carousel-example-generic" role="button" data-slide="prev">
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                </a>
                <a class="right carousel-control carousel-control-shop carousel-control-frontend" href="#carousel-example-generic" role="button" data-slide="next">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        <?php
        $str = ob_get_clean();
        return $str;
    }

    public static function GioiThieuNgan() {
        $Pages = new \Model\pages(self::getThemeConfig(self::GioiThieuNgan));
        ob_start();
        ?>
        <div class="main">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="">
                            <div class="row margin-bottom-30">
                                <?php echo $Pages->Content; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $str = ob_get_clean();
        return $str;
    }

    public static function FormLienHe() {
        ob_start();
        ?>
        <form action="" role="form">
            <div class="form-group">
                <label for="contacts-name">H??? & T??n</label>
                <input type="text" class="form-control" id="contacts-name">
            </div>
            <div class="form-group">
                <label for="contacts-email">Email</label>
                <input type="email" class="form-control" id="contacts-email">
            </div>
            <div class="form-group">
                <label for="contacts-message">N???i Dung</label>
                <textarea class="form-control" rows="5" id="contacts-message"></textarea>
            </div>
            <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> G???i </button>
            <button type="reset" class="btn btn-default"> L??m L???i</button>
        </form>
        <?php
        $str = ob_get_clean();
        return $str;
    }

    public static function TaiSaoChonChungToi() {
        return self::owlcarousel5(self::getThemeConfig(self::TaiSaoChonChungToi));
    }

    static function owlcarousel6($param) {
        $DanhMuc = new \Model\pages($param);
        $news = $DanhMuc->getNewsMoiTop(12);
        if ($news == null) {
            return;
        }
        ob_start();
        ?>
        <!-- BEGIN RECENT WORKS -->
        <div class="recent-work margin-bottom-40">
            <div class="col-md-12">
                <div class="row">
                    <h1 class="text-center title-pannel" ><span><?php echo $DanhMuc->Name; ?></span></h1>
                    <div class="owl-carousel owl-carousel6-brands">
                        <?php
                        foreach ($news as $k => $new) {
                            $_v = new \Model\news($new);
                            ?>
                            <div class="recent-work-item">
                                <div class="item-content" >
                                    <em>
                                        <img src="<?php echo $_v->UrlHinh() ?>" alt="<?php echo $_v->Name; ?>" class="img-responsive">
                                        <a href="<?php echo $_v->linkNewsCurent(); ?>"><i class="fa fa-link"></i></a>
                                        <a href="<?php echo $_v->UrlHinh() ?>" class="fancybox-button" title="<?php echo $_v->Name ?>" data-rel="fancybox-button"><i class="fa fa-search"></i></a>
                                    </em>
                                    <a class="recent-work-description" href="javascript:;">
                                        <h3><?php echo $_v->Name ?></h3>
                                    </a>
                                </div>
                            </div>
                            <?php
                        }
                        ?>


                    </div>

                </div>
            </div>
        </div>
        <!-- END RECENT WORKS -->
        <?php
        $str = ob_get_clean();
        return $str;
    }

    static function owlcarousel5($param) {
        $DanhMuc = new \Model\pages($param);
        $news = $DanhMuc->getNewsMoiTop(12);
        if ($news == null) {
            return;
        }
        ob_start();
        ?>
        <!-- BEGIN RECENT WORKS -->
        <div class="recent-work margin-bottom-40 container">
            <div class="col-md-12">
                <hr>
                <h1 class="text-center title-pannel" ><span><?php echo $DanhMuc->Name; ?></span></h1>
                <div class="owl-carousel owl-carousel5">
                    <?php
                    foreach ($news as $k => $new) {
                        $_v = new \Model\news($new);
                        ?>
                        <div class="recent-work-item">
                            <div class="item-content" >
                                <em>
                                    <img data-src="<?php echo $_v->UrlHinh() ?>" src="/public/loading.svg" alt="<?php echo $_v->Name; ?>" class="lazy hinhVuong img-responsive">
                                    <a href="<?php echo $_v->linkNewsCurent(); ?>"><i class="fa fa-link"></i></a>
                                    <a href="<?php echo $_v->UrlHinh() ?>" class="fancybox-button" title="<?php echo $_v->Name ?>" data-rel="fancybox-button"><i class="fa fa-search"></i></a>
                                </em>
                                <a class="recent-work-description" href="javascript:;">
                                    <h3><?php echo $_v->Name ?></h3>
                                </a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>


                </div>
            </div>
        </div>
        <!-- END RECENT WORKS -->
        <?php
        $str = ob_get_clean();
        return $str;
    }

    static function owlcarousel1($param) {
        $DanhMuc = new \Model\pages($param);
        $news = $DanhMuc->getNewsMoiTop(12);
        if ($news == null) {
            return;
        }
        ob_start();
        ?>
        <div class="owl-carousel owl-carousel1">
            <?php
            foreach ($news as $k => $new) {
                $_v = new \Model\news($new);
                ?>
                <div class="item-content NguoiSangLap" >
                    <em>
                        <img src="<?php echo $_v->UrlHinh() ?>" alt="<?php echo $_v->Name; ?>" class="img-responsive mb-3">
                        <p class="text-center mt-5" ><?php echo $_v->Name; ?>-<?php echo strip_tags($_v->Summary); ?></p>
                        <p class="text-center" ><?php echo strip_tags($_v->Content); ?></p>
                    </em>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
        $str = ob_get_clean();
        return $str;
    }

    public static function NguoiSangTao() {
        $DanhMuc = new \Model\pages(self::getThemeConfig()[self::NguoiSangTao]);
        $news = $DanhMuc->getNewsMoiTop(12);
        if ($news == null) {
            return;
        }
        ob_start();
        ?>
        <div class="recent-work margin-bottom-40">
            <div class="col-md-12">
                <hr>
                <h1 class="text-center title-pannel" ><span><?php echo $DanhMuc->Name; ?></span></h1>
            </div>
            <div class="">
                <div class="col-md-4 col-lg-4 front-carousel">
                    <div class="owl-carousel owl-carousel1">
                        <?php
                        foreach ($news as $k => $new) {
                            $_v = new \Model\news($new);
                            ?>
                            <div class="item-content NguoiSangLap" >
                                <em>
                                    <img src="<?php echo $_v->UrlHinh() ?>" alt="<?php echo $_v->Name; ?>" class="img-responsive mb-3">
                                    <p class="text-center mt-5" ><?php echo $_v->Name; ?>-<?php echo strip_tags($_v->Summary); ?></p>
                                    <p class="text-center" ><?php echo strip_tags($_v->Content); ?></p>
                                </em>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="col-md-8 col-lg-8">
                    <iframe style="width: 100%;height: 500px" src="https://www.youtube.com/embed/__VideoId___" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
        <?php
        $str = ob_get_clean();
        return $str;
    }

}
