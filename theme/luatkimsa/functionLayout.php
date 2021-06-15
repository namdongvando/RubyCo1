<?php

namespace theme\luatkimsa;

class functionLayout {

    public $Menu;
    public $NameTheme;
    public $TopMainMenu;
    public $FooterMenu;
    public $FooterMenuDichVu;
    public $FooterMenuHoTro;
    public $FooterMenuCongTy;
    public $FileConfig;

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

    function gethtml() {
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $hotlint_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . "/";
        ?>
        <title><?php echo \Model_Seo::$Title; ?></title>
        <meta charset="utf-8">
        <!--<meta http-equiv="cache-control" content="no-cache" />-->
        <link rel="canonical" href="<?php echo $actual_link; ?>">
        <link rel="alternate" hreflang="vi" href="<?php echo $actual_link; ?>">
        <!--<meta http-equiv="x-dns-prefetch-control" content="on" />-->
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
        <link href="/public/lawkimsa/luatkimsa/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="/public/lawkimsa/luatkimsa/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="/public/lawkimsa/luatkimsa/assets/pages/css/animate.css" rel="stylesheet">
        <link href="/public/lawkimsa/luatkimsa/assets/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
        <link href="/public/lawkimsa/luatkimsa/assets/plugins/owl.carousel/assets/owl.carousel.css" rel="stylesheet">
        <link href="/public/lawkimsa/luatkimsa/assets/pages/css/components.css" rel="stylesheet">
        <link href="/public/lawkimsa/luatkimsa/assets/pages/css/slider.css" rel="stylesheet">
        <link href="/public/lawkimsa/luatkimsa/assets/corporate/css/style.css" rel="stylesheet">
        <link href="/public/lawkimsa/luatkimsa/assets/corporate/css/style-responsive.css" rel="stylesheet">
        <link href="/public/lawkimsa/luatkimsa/assets/corporate/css/themes/gray.css" rel="stylesheet" id="style-color">
        <link href="/public/lawkimsa/luatkimsa/assets/corporate/css/custom.css" rel="stylesheet">
        <link href="/public/lawkimsa/Css/Style.css?v=<?php echo fileatime("public/lawkimsa/Css/Style.css"); ?>" rel="stylesheet" type="text/css"/>

        <script src="/public/partials/loaderpartials/home/homeconfig.js?v=<?php echo fileatime("public/partials/loaderpartials/home/homeconfig.js"); ?>"></script>
        <?php
    }

    function head() {
        $this->gethtml();
        ?>


        <link rel="shortcut icon" href="__icon___" />
        <link media rel="stylesheet" type="text/css" href="/public/home/assets/lib/owl.carousel/owl.carousel.css" />
        <script type="text/javascript" >
            document.write('<link media rel="stylesheet" type="text/css" href="/public/home/assets/lib/bootstrap/css/bootstrap.min.css" />');
            document.write('<link media rel="stylesheet" type="text/css" href="/public/home/assets/lib/font-awesome/css/font-awesome.min.css" />');
            document.write('<link media rel="stylesheet" type="text/css" href="/public/home/assets/lib/select2/css/select2.min.css" />');
            document.write('<link media rel="stylesheet" type="text/css" href="/public/home/assets/lib/jquery-ui/jquery-ui.css" />');
            document.write('<link media rel="stylesheet" type="text/css" href="/public/home/assets/css/animate.css" />');</script>
        <link media rel="stylesheet" type="text/css" href="/public/home/assets/css/reset.css" />
        <script type="text/javascript" >

            document.write('<link media rel="stylesheet" type="text/css" href="/public/home/assets/css/style.css" />');
            document.write('<link media rel="stylesheet" type="text/css" href="/public/home/assets/css/responsive.css" />');
            document.write('<link media rel="stylesheet" type="text/css" href="/public/Phonering/phonering.css" />');
            document.write('<link media rel="stylesheet" type="text/css" href="/public/home/assets/css/option6_1.css" />');</script>

        <script type="text/javascript" >
            window.addEventListener("load", function() {
            try {
            const loader = document.querySelector(".loading");
            loader.className += " hidden";
            } catch (e) {
            console.log(e.message);
            }
            });</script>



        <script type="text/javascript" >
            var script = document.createElement('script');
            script.src = '/public/partials/loaderpartials/home/homeconfig.js';
            document.write(script.outerHTML);</script>
        <style type="text/css" >
            body{
                background-color: #CCCCCC;
            }
            #product-detail img{
                max-width: 100%;
                height: auto !important;
            }
            #fb-page{
                position: fixed;
                left: 50px;
                bottom: 200px;
                /*background-color: #4faa34;*/
                height: 400px;
                width: 300px;
                display: none;
                z-index: 10000;
            }
            .image-hover2 a {

                display: block;
            }
            .option6 #main-menu .navbar{
                background:  none;
            }
            .option6 #main-menu .navbar-default .navbar-nav>li>a{

                font-weight: bold;
            }
            .option6 #main-menu .navbar-default .navbar-nav>li {
                display: flex;
                flex-wrap: nowrap;
            }
            .option6 #main-menu .navbar .navbar-nav>li:hover, .option6 #main-menu .navbar .navbar-nav>li.active{
                background-color: rgba(255, 255, 255, 0.08);
            }
        </style>
        <link href="/theme/noithathoaphatgiagoc/public/public.css?v=<?php echo filemtime('theme/noithathoaphatgiagoc/public/public.css') ?>" rel="stylesheet" type="text/css"/>


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

    function header() {
        ?>
        <div class="pre-header hidden">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-xs-6 additional-shop-info">
                        <strong class="color-while text-uppercase"  >Văn Phòng Luật Sư Mai Thị Kim Sa</strong>
                    </div>
                    <div class="col-md-6 col-xs-6 additional-nav">
                        <ul class="list-unstyled list-inline pull-right">
                            <li class="color-while" ><i class="fa fa-phone"></i><span>+1 456 6717</span></li>
                            <li class="color-while" ><i class="fa fa-envelope-o"></i><span>info@keenthemes.com</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="body-header"  >
            <div class="container">
                <div class="row" >
                    <div class="col-md-12" >
                        <a href="/"  >
                            <img src="/public/lawkimsa/Images/BannerDemo3.jpg" class="img img-responsive" alt="aa"/>
                        </a>
                    </div>
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
//                                                            Cấp 2
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
        $io = new \lib\io();
        $video = $io->readFile("data/video.js");
        $video = json_decode($video, JSON_OBJECT_AS_ARRAY);
//        var_dump($video);
//        die();
        $a = new \Model\adv();
        $DS = $a->GetFileContentGroup("homeslide");
        $lib = new \lib\imageComp();
        ?>
        <div id="home-slider"   style="background-color: #2C2C2C;" >
            <div class="container">
                <div class="row">
                    <div class="col-sm-8" style="padding-right: 0px;">
                        <div class="homeslider">
                            <ul id="contenhomeslider-customPage">
                                <?php
                                if ($DS) {
                                    foreach ($DS as $value) {
                                        $img = $value["Image"];
                                        ?>
                                        <li >
                                            <img  data-srcset="<?php echo $img; ?>" src="/public/images_load.gif" style="width: 100%;" class="lazyload homeslider-img img img-responsive center-block"  alt="<?php echo $value["Name"] ?>"   title="<?php echo $value["Name"] ?>" />
                                        </li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                            <div class="bx-control">
                                <div class="slide-prev">
                                    <span id="bx-prev"></span>
                                </div>
                                <div id="bx-pager" class="slide-pager">
                                    <?php
                                    $dem = 0;
                                    foreach ($DS as $value) {
                                        $Attribute = $a->_decode($value->Attribute);
                                        ?>
                                        <a data-slide-index="<?php echo $dem; ?>" href="#"><?php echo $dem + 1; ?></a>
                                        <?php
                                        $dem++;
                                    }
                                    ?>
                                </div>
                                <div class="slide-next">
                                    <span id="bx-next"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2 group-banner-slider" style="overflow: hidden;max-height: 480px;padding-left: 2px;">
                        <?php
                        $a = new \Model\adv();
                        $DS = $a->AdvsByGroup("quan-cao-slide-ben-p");
                        foreach ($DS as $value) {
                            $img = $lib->layHinh($value->Urlimages, 183, 120, false);
                            ?>
                            <div class="item banner-opacity">
                                <a href="<?php echo $value->Link ?>">
                                    <img class="lazyload"  src="/public/images_load.gif" data-src="<?php echo $img ?>" alt="<?php echo $value->Name ?>">
                                </a>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="col-sm-2 group-banner-slider" style="overflow: hidden;max-height: 480px; padding-left: 2px; margin-left:-15px; padding-right: 0;">
                        <div class=" item policy">
                            <h5 class="title">Chính Sách</h5>
                            <ul>

                                <li><a href="#">
                                        <img class="icon1" src="/public/home/assets/data/option6/safe1.png" alt="Icon">
                                        <img class="icon2" src="/public/home/assets/data/option6/safe2.png" alt="Icon">
                                        Thanh toán an toàn
                                    </a></li>
                                <li><a href="#">
                                        <img class="icon1" src="/public/home/assets/data/option6/icon2.png" alt="Icon">
                                        <img class="icon2" src="/public/home/assets/data/option6/icon2-1.png" alt="Icon">
                                        Giao hàng tận nơi</a></li>
                                <li><a href="#">
                                        <img class="icon1" src="/public/home/assets/data/option6/icon3.png" alt="Icon">
                                        <img class="icon2" src="/public/home/assets/data/option6/icon3-1.png" alt="Icon">
                                        Đổi Trả</a></li>
                                <li><a href="#">
                                        <img class="icon1" src="/public/home/assets/data/option6/icon4.png" alt="Icon">
                                        <img class="icon2" src="/public/home/assets/data/option6/icon4-1.png" alt="Icon">
                                        Dịch vụ khách hàng</a></li>
                                <li><a href="#">
                                        <img class="icon1" src="/public/home/assets/data/option6/icon5.png" alt="Icon">
                                        <img class="icon2" src="/public/home/assets/data/option6/icon5-1.png" alt="Icon">
                                        Bán hàng uy tín</a></li>
                            </ul>
                        </div>
                        <?php
                        $a = new \Model\adv();
                        $DS = $a->AdvsByGroup("quan-cao-duoi-chinh-");
                        foreach ($DS as $value) {
                            $img = $lib->layHinh($value->Urlimages, 198, 130, false);
                            ?>
                            <div class="item banner-opacity">
                                <a href="<?php echo $value->Link ?>">
                                    <img class="lazyload img img-responsive" src="/public/images_load.gif" data-src="<?php echo $img ?>" alt="<?php echo $value->Name ?>">
                                </a>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="col-sm-12 header-top-right">
                        <div class="group-banner-slide">
                            <div class="col-left">
                            </div>
                            <div class="col-right">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
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

    function footer() {
        $adv = new \Model\adv();
        $carousel = $adv->AdvsByGroup("partner", false);
        $carousel1 = $adv->AdvsByGroup("customers", false);
        ?>
        <div class="pre-footer">
            <div class="container">
                <div class="row">
                    <!-- BEGIN BOTTOM ABOUT BLOCK -->
                    <div class="col-md-4 col-sm-6 pre-footer-col">
                        __positionMap___
                    </div>

                    <div class="col-md-4 col-sm-6 pre-footer-col">
                        <h2>Liên Hệ</h2>
                        <address class="margin-bottom-40">
                            __DiaChi___
                            <br>

                            Email: <a href="mailto:__Email___">__Email___</a><br>
                            Skype: <a href="skype:__Skye___">__Skye___</a>
                        </address>
                    </div>
                    <div class="col-md-4 col-sm-6 pre-footer-col">
                        <div class="pre-footer-subscribe-box pre-footer-subscribe-box-vertical">
                            <h2>Nhận Tin Mới Nhất</h2>
                            <p>Đăng ký bản tin của chúng tôi và cập nhật những tin tức và giao dịch mới nhất!</p>
                            <form action="#">
                                <div class="input-group">
                                    <input type="text" placeholder="abc@mail.com" class="form-control">
                                    <span class="input-group-btn">
                                        <button class="btn btn-theme" type="submit">Đăng Ký</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-4 padding-top-10">
                        <a href="javascript:;">Privacy Policy</a>
                        | <a href="javascript:;">Terms of Service</a>
                    </div>
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
                    <div class="col-md-4 col-sm-4 text-right" >
                        <p class="powered" style="font-size: 8px;" >Powered by: <a href="https://nguyenvando.net/">nguyenvando.net</a></p>
                    </div>

                </div>
            </div>
        </div>


        <div class="modal fade" id="modal-id">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="btn btn-danger close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <div class="row" >
                            <div class="col-md-3 "  style="padding-top: 20px;" >
                                <div  class="" >
                                    <img style="margin: auto;"  class="img img-responsive"  src="/public/lawkimsa/Images/Logo1.png" />
                                </div>
                            </div>
                            <div class="col-md-9" >
                                <h2 style="font-weight: bold;" class="text-uppercase text-center" >văn phòng Luật <br> Mai Thị Kim Sa</h2>
                                <p class="text-center" >
                                    <strong>Chuyên Nghiệp</strong>
                                    - <strong>Chính Xác</strong>
                                    - <strong>Hiệu Quả</strong>
                                </p>
                            </div>
                            <h3 class="text-center color-red" ><b class="text-uppercase"   >HOTLINE : </b> 0123 455 789</h3>
                        </div>
                        <div class="clearfix" ></div>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }

    function js() {
        ?>
        <a class="btn btn-primary hidden" data-toggle="modal" href='#modal-id'>Trigger modal</a>
        <script src="/public/lawkimsa/luatkimsa/assets/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="/public/lawkimsa/luatkimsa/assets/plugins/jquery-migrate.min.js" type="text/javascript"></script>
        <script src="/public/lawkimsa/luatkimsa/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="/public/lawkimsa/luatkimsa/assets/corporate/scripts/back-to-top.js" type="text/javascript"></script>
        <script src="/public/lawkimsa/luatkimsa/assets/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>
        <script src="/public/lawkimsa/luatkimsa/assets/plugins/owl.carousel/owl.carousel.min.js" type="text/javascript"></script>
        <script src="/public/lawkimsa/luatkimsa/assets/corporate/scripts/layout.js" type="text/javascript"></script>
        <script src="/public/lawkimsa/luatkimsa/assets/pages/scripts/bs-carousel.js" type="text/javascript"></script>
        <script type="text/javascript">

                            jQuery(document).ready(function() {
                            Layout.init();
                            Layout.initOWL();
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
                        <a title="Giỏ Hàng" href="/cart/index/addproduct/<?php echo $produc->ID ?>">Thêm Giỏ Hàng</a>
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
                        <span class="page-heading-title">Tin Tức Mới</span>
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
                                        <a href="{{item.Link}}">Chi tiết</a>
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
                                        <h3 class="title"><a href="#">Giá Trị</a></h3>
                                    </div>
                                    <div class="col-sm-6 text">
                                        Chúng tôi cung cấp giá cả cạnh tranh trên thị trường.
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
                                        <h3 class="title"><a href="#">Vận Truyển Toàn Quốc</a></h3>
                                    </div>
                                    <div class="col-sm-6 text">
                                        Với hệ thống vận chuyển toàn quốc.
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
                                        <h3 class="title"><a href="#">THANH TOÁN AN TOÀN</a></h3>
                                    </div>
                                    <div class="col-sm-6 text">
                                        Thanh Toán Khi Nhận Hàng.
                                        Thanh toán thuận tiện.
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
                                        <h3 class="title"><a href="#">Yên Tâm Mua Sắm</a></h3>
                                    </div>
                                    <div class="col-sm-6 text">
                                        Bảo vệ người mua của chúng tôi bao gồm việc mua hàng của bạn từ nhấp chuột đến giao hàng.
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
                                        <h3 class="title"><a href="#">Hỗ trợ 24/7</a></h3>
                                    </div>
                                    <div class="col-sm-6 text">
                                        Hỗ trợ suốt ngày đêm cho trải nghiệm mua sắm suôn sẻ.
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
                                        <h3 class="title"><a href="#">Mua Sắm Trực Tuyến</a></h3>
                                    </div>
                                    <div class="col-sm-6 text">
                                        Ứng dụng mua sắm trực truyến cho các bạn những sựa lựa chọn tốt nhất.
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

    function DeCodeHTML() {

        $str = ob_get_clean();
        $Content = new \Model\Content();
        $DSOption = $Content->Contents();


        if ($DSOption)
            foreach ($DSOption as $k => $value) {
                $str = str_replace("__" . $k . "___", $value, $str);
            }

        $str = \Model_SaveCache::minify_output($str);
        echo $str;
    }

    static function DanhMucSanPham() {
        ?>

        <div class="block left-module panel">
            <p class="title_block">Tìm Kiếm</p>
            <div class="panel-body" >
                <?php
                self::Seach();
                ?>
            </div>
        </div>
        <div class="block left-module">
            <p class="title_block">Danh Mục Sản Phẩm</p>
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
            <p class="title_block">Trang Xã Hội</p>
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
            <p class="title_block">Sản Phẩm Mới</p>
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
            <p class="title_block">Tìm Kiếm</p>
            <div class="panel-body" >
                <?php
                self::Seach();
                ?>
            </div>
        </div>
        <div class="block left-module">
            <p class="title_block">Danh Mục Sản Phẩm</p>
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
            <p class="title_block">Trang Xã Hội</p>
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
            <p class="title_block">Sản Phẩm Mới</p>
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
            <p class="title_block">Sản Phẩm Khuyến Mãi</p>
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
                    <label for="">Từ Khóa</label>
                    <input ng-model="keyword" type="text" class="form-control" name="seach[keyword]" placeholder="Từ khóa">
                </div>
                <div class="form-group">
                    <label for="">Danh Mục Sản Phẩm</label>
                    <select ng-model="danhmuc" type="text" class="form-control" name="seach[danhmuc]"  >
                        <option value="0" >Tất Cả</option>
                        <option ng-repeat="item  in _DanhMuc" value="{{item.Id}}" >{{item.Name}}</option>
                    </select>
                </div>
                <div class="form-group text-center">
                    <input type="submit" class="btn btn-primary" value="Tìm Kiếm" name="timkiem" >
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
                        <label for="">Tìm Kiếm</label>
                        <input type="text" class="form-control" value="<?php echo isset($_GET["keyword"]) ? $_GET["keyword"] : ""; ?>" name="keyword" placeholder="Từ Khóa Tìm Kiếm">
                        <p>__TimKiemVD___</p>

                    </div>
                    <div class="form-group text-center">
                        <input type="submit" class="btn btn-theme" value="Tìm Kiếm"  >
                    </div>
                </form>
            </div>
        </div>
        <div class="panel panel-theme">
            <div class="panel-heading">
                <h3 class="panel-title">Bài Viết Mới Nhất</h3>
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

}
