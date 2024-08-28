<?php

namespace theme\rubyv3;

use Model\Category;
use Model\Menu;
use Model\Products;

class functionLayout
{

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

    static function DeCodeHTML()
    {
        $str = ob_get_clean();
        // $str = str_replace("[" . self::NguoiSangTao . "]", self::NguoiSangTao(), $str);
        // $str = str_replace("[" . self::MauBietThuDep . "]", self::MauBietThuDep(), $str);
        // $str = str_replace("[" . self::TaiSaoChonChungToi . "]", self::TaiSaoChonChungToi(), $str);
        // $str = str_replace("[" . self::FormLienHe . "]", self::FormLienHe(), $str);
        // $str = str_replace("[" . self::HomeSlide . "]", self::HomeSlide(), $str);
        // $str = str_replace("[" . self::TuVanHotLine . "]", self::TuVanHotLine(), $str);
        // $str = str_replace("[" . self::XayDungTronGoi . "]", self::XayDungTronGoi(), $str);
        // $str = str_replace("[" . self::ThongTinCanBiet . "]", self::ThongTinCanBiet(), $str);
        // $str = str_replace("[" . self::KhachHangNoiVeChungToi . "]", self::KhachHangNoiVeChungToi(), $str);
        // $str = str_replace("[" . self::GioiThieuNgan . "]", self::GioiThieuNgan(), $str);
        $Content = new \Model\Content();
        $DSOption = $Content->Contents();
        if ($DSOption)
            foreach ($DSOption as $k => $value) {
                $str = str_replace("__" . $k . "___", $value, $str);
            }

        // $str = \Model_SaveCache::minify_output($str);
        echo $str;
    }

    public static function getThemeConfig($Ma = null)
    {
        $a = file_get_contents(ROOT_DIR . "/theme/config/homeconfig.json");
        if (self::$ConfigTheme == null)
            self::$ConfigTheme = json_decode($a, JSON_OBJECT_AS_ARRAY);
        if ($Ma)
            return self::$ConfigTheme[$Ma];
        return self::$ConfigTheme;
    }

    function __construct()
    {
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

    function LoadConfig()
    {
        $lib = new \lib\io();
        $ad = new \Model_Adapter();
        return $ad->_decode($lib->readFile($this->FileConfig));
    }

    static function ThongTinCanBiet()
    {

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
                                                                                                                                                                        <h1 class="text-center title-pannel"><span><?php echo $DanhMuc->Name; ?></span></h1>
                                                                                                                                                                        <div class="owl-carousel owl-carousel4">
                                                                                                                                                                            <?php
                                                                                                                                                                            foreach ($news as $k => $new) {
                                                                                                                                                                                $_v = new \Model\news($new);
                                                                                                                                                                                ?>
                                                                                                                                                                                                                                                            <div class="recent-work-item">
                                                                                                                                                                                                                                                                <div class="item-content">
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

    static function XayDungTronGoi()
    {
        ob_start();
        ?>
                                                                                                                                                                <!-- BEGIN RECENT WORKS -->
                                                                                                                                                                <div class="recent-work margin-bottom-40">
                                                                                                                                                                    <div class="col-md-12">
                                                                                                                                                                        <hr>
                                                                                                                                                                        <h1 class="text-center title-pannel"><span>Xây Dựng Trọn Gói</span></h1>
                                                                                                                                                                        <div class="owl-carousel owl-carousel4">
                                                                                                                                                                            <div class="recent-work-item">
                                                                                                                                                                                <div class="item-content">
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
                                                                                                                                                                                <div class="item-content">
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
                                                                                                                                                                                <div class="item-content">
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
                                                                                                                                                                                <div class="item-content">
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
                                                                                                                                                                                <div class="item-content">
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

    static function MauBietThuDep()
    {
        $DanhMuc = new \Model\pages(self::getThemeConfig(self::MauBietThuDep));
        $news = $DanhMuc->getNewsMoiTop(12);
        if ($news == null) {
            return;
        }
        ob_start();
        ?>
                                                                                                                                                                <div class="margin-bottom-40">
                                                                                                                                                                    <div class="container">
                                                                                                                                                                        <div class="row">
                                                                                                                                                                            <!-- BEGIN SIDEBAR & CONTENT -->
                                                                                                                                                                            <!-- BEGIN CONTENT -->
                                                                                                                                                                            <div class=" col-md-12 col-sm-12">
                                                                                                                                                                                <h1 class="text-center title-pannel"><span><?php echo $DanhMuc->Name; ?></span></h1>
                                                                                                                                                                                <div class="content-page">
                                                                                                                                                                                    <div class="filter-v1">
                                                                                                                                                                                        <div class="thongtincanbiet row mix-grid thumbnails">
                                                                                                                                                                                            <?php
                                                                                                                                                                                            if ($news) {
                                                                                                                                                                                                foreach ($news as $k => $value) {
                                                                                                                                                                                                    $_v = new \Model\news($value);
                                                                                                                                                                                                    ?>
                                                                                                                                                                                                                                                                                                                                                            <div class="col-md-3 col-xs-6 col-sm-4 mix category_1 mix_all" style="opacity: 1; ">
                                                                                                                                                                                                                                                                                                                                                                <div class="mix-inner ">
                                                                                                                                                                                                                                                                                                                                                                    <a href="<?php echo $_v->linkNewsCurent(); ?>">
                                                                                                                                                                                                                                                                                                                                                                        <img style="width: 100%;" alt="<?php echo $_v->Name ?>" data-src="<?php echo $_v->UrlHinh() ?>" src="/public/loading.svg" class="lazy HinhChuNhat img-responsive">
                                                                                                                                                                                                                                                                                                                                                                    </a>
                                                                                                                                                                                                                                                                                                                                                                    <div class="mix-details">
                                                                                                                                                                                                                                                                                                                                                                        <a href="<?php echo $_v->linkNewsCurent(); ?>">
                                                                                                                                                                                                                                                                                                                                                                            <h4><?php echo $_v->Name ?></h4>
                                                                                                                                                                                                                                                                                                                                                                        </a>
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
                                                                                                                                                                    </div>

                                                                                                                                                                </div>

                                                                                                                                                            <?php
                                                                                                                                                            $str = ob_get_clean();
                                                                                                                                                            return $str;
    }

    static function KhachHangNoiVeChungToi()
    {
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
                                                                                                                                                                        <h1 class="text-center title-pannel"><span><?php echo $DanhMuc->Name; ?></span></h1>
                                                                                                                                                                        <div id="myCarousel1" class="padding-top-40">
                                                                                                                                                                            <!-- Carousel items -->
                                                                                                                                                                            <div class="carousel-inner khachangnoigi owl-carousel3">
                                                                                                                                                                                <?php
                                                                                                                                                                                foreach ($news as $k => $value) {
                                                                                                                                                                                    $_v = new \Model\news($value);
                                                                                                                                                                                    ?>
                                                                                                                                                                                                                                                                <div class="item">
                                                                                                                                                                                                                                                                    <div class="khachangnoigi-content">
                                                                                                                                                                                                                                                                        <div class="col-md-4">
                                                                                                                                                                                                                                                                            <img class="img img-responsive img-circle" style="border-radius: 100px;" src="<?php echo $_v->UrlHinh(); ?>" alt="">
                                                                                                                                                                                                                                                                            <div class="">
                                                                                                                                                                                                                                                                                <span class="testimonials-name"><?php echo $_v->Name; ?></span>
                                                                                                                                                                                                                                                                                <span class="testimonials-post"><?php echo strip_tags($_v->Summary); ?></span>
                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                        <blockquote class="col-md-8">
                                                                                                                                                                                                                                                                            <p><?php echo strip_tags($_v->Content); ?></p>
                                                                                                                                                                                                                                                                        </blockquote>
                                                                                                                                                                                                                                                                        <div class="clearfix"></div>
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

    function loadmenu()
    {

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

    static function gethtml()
    {
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $hotlint_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]" . "/";
        ?>

                                                                                                                                                                <title><?php echo \Model_Seo::$Title; ?></title>
                                                                                                                                                                <meta charset="utf-8">
                                                                                                                                                                <link rel="canonical" href="<?php echo $actual_link; ?>">
                                                                                                                                                                <link rel="alternate" hreflang="vi" href="<?php echo $actual_link; ?>">
                                                                                                                                                                <meta name="Resource-type" content="Document" />
                                                                                                                                                                <meta name="theme-color" content="#62060a" />
                                                                                                                                                                <link rel="dns-prefetch" href="//cdnjs.cloudflare.com" />
                                                                                                                                                                <link rel="dns-prefetch" href="//ajax.googleapis.com" />
                                                                                                                                                                <link rel="dns-prefetch" href="//www.facebook.com" />
                                                                                                                                                                <link rel="dns-prefetch" href="//fonts.googleapis.com" />
                                                                                                                                                                <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
                                                                                                                                                                <meta name="keywords" content="<?php echo strip_tags(\Model_Seo::$key); ?>" />
                                                                                                                                                                <meta name="description" content="<?php echo strip_tags(\Model_Seo::$des); ?>">
                                                                                                                                                                <meta name="author" content="https://nguyenvando.net">
                                                                                                                                                                <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
                                                                                                                                                                <meta property="og:image" content="<?php echo \Model_Seo::$Images; ?>">
                                                                                                                                                                <meta property="og:locale" content="vi_VN" />
                                                                                                                                                                <meta property="og:url" content="<?php echo $actual_link; ?>">
                                                                                                                                                                <meta property="og:type" content="website">
                                                                                                                                                                <meta property="og:title" content="<?php echo strip_tags(\Model_Seo::$Title); ?>">
                                                                                                                                                                <meta property="og:description" content="<?php echo strip_tags(\Model_Seo::$des); ?>">
                                                                                                                                                                <meta charset="utf-8">
                                                                                                                                                                <meta name="google-site-verification" content="agE2_gUWWzEd2vxHZsVrGQDvEDMbspGj1F7Mr3Ay5Ko">

                                                                                                                                                                <title><?php echo \Model_Seo::$Title; ?></title>
                                                                                                                                                                <link rel="shortcut icon" href="__icon___">
                                                                                                                                                                <link rel="apple-touch-icon" href="__icon___">
                                                                                                                                                                <link rel="apple-touch-icon" sizes="72x72" href="__icon___">
                                                                                                                                                                <link rel="apple-touch-icon" sizes="114x114" href="__icon___">
                                                                                                                                                                <link rel="manifest" href="/public/manifest.json?v=<?php echo filemtime('public/manifest.json'); ?>">
                                                                                                                                                                <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|PT+Sans+Narrow|Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css">

                                                                                                                                                            <?php
    }

    static function head()
    {
        self::gethtml();
        ?>
                                                                                                                                                                <link rel="stylesheet" type="text/css" href="/public/home/assets/lib/bootstrap/css/bootstrap.min.css" />
                                                                                                                                                                <link rel="stylesheet" type="text/css" href="/public/home/assets/lib/font-awesome/css/font-awesome.min.css" />
                                                                                                                                                                <link rel="stylesheet" type="text/css" href="/public/home/assets/lib/select2/css/select2.min.css" />
                                                                                                                                                                <link rel="stylesheet" type="text/css" href="/public/home/assets/lib/jquery.bxslider/jquery.bxslider.css" />
                                                                                                                                                                <link rel="stylesheet" type="text/css" href="/public/home/assets/lib/owl.carousel/owl.carousel.css" />
                                                                                                                                                                <link rel="stylesheet" type="text/css" href="/public/home/assets/lib/jquery-ui/jquery-ui.css" />
                                                                                                                                                                <link rel="stylesheet" type="text/css" href="/public/home/assets/css/animate.css" />
                                                                                                                                                                <link rel="stylesheet" type="text/css" href="/public/home/assets/css/reset.css" />
                                                                                                                                                                <link rel="stylesheet" type="text/css" href="/public/home/assets/css/style.css" />
                                                                                                                                                                <link rel="stylesheet" type="text/css" href="/public/home/assets/css/responsive.css" />
                                                                                                                                                                <link rel="stylesheet" type="text/css" href="/public/rubyv3/style.css?v=<?php echo filemtime("public/rubyv3/style.css") ?>" />
                                                                                                                                                                <link href="/public/Phonering/phonering.css?v=<?php echo filemtime('public/Phonering/phonering.css'); ?>" rel="stylesheet" type="text/css" />
                                                                                                                                                                <script src="/public/partials/loaderpartials/home/homeconfig.js?v=<?php echo fileatime("public/partials/loaderpartials/home/homeconfig.js"); ?>"></script>
                                                                                                                                                                <link href="/public/wowjs/animate.min.css<?php echo filemtime("public/wowjs/animate.min.css"); ?>" rel="stylesheet" type="text/css" />
                                                                                                                                                                <script type="text/javascript">
                                                                                                                                                                    app.controller("nhanvienController",
                                                                                                                                                                        function($scope, $rootScope, $http, $routeParams) {
                                                                                                                                                                            $scope.IsShowInFor = true;
                                                                                                                                                                            $scope.onToggle = function() {
                                                                                                                                                                                $scope.IsShowInFor = !$scope.IsShowInFor;
                                                                                                                                                                            };
                                                                                                                                                                            $scope.CSKHInit = function() {
                                                                                                                                                                                $http.get("/api/getNhanVien/").then((res) => {
                                                                                                                                                                                    $scope.NhanVien = res.data.NhanVien;
                                                                                                                                                                                    console.log($scope.NhanVien);
                                                                                                                                                                                });
                                                                                                                                                                            };
                                                                                                                                                                        });
                                                                                                                                                                </script>
                                                                                                                                                            <?php
    }

    function is_mobile()
    {
        if (empty($_SERVER['HTTP_USER_AGENT'])) {
            return false;
        } elseif (
            strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false // many mobile devices (all iPhone, iPad, etc.)
            || strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mobi') !== false
        ) {
            return true;
        }
        return false;
    }

    static function header()
    {
        ?>
                            <div id="header" class="header">
                                <div class="top-header hidden hidden-sm hidden-xs">
                                    <div class="container ">
                                        <div class="support-link">
                                            <a href="#">Tạo kế hoạch in</a>
                                            <a href="#">Kiểm tra đơn hàng</a>
                                            <a href="#">Thông tin và Hỏi đáp</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="main-header">
                                    <div class="container ">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-2 col-md-2 logo">
                                                <a href="/">
                                                    <img class="Main_logo" alt="__Title___" src="__Logo___" />
                                                </a>
                                            </div>
                                            <div class="col-xs-4 col-md-4 col-sm-4 header-search-box">
                                                <form action="/index/seach/" class="form-inline">
                                                    <div class="form-search">
                                                        <div class="form-group input-serach">
                                                            <input value="<?php echo $_REQUEST["seach"] ?? ""; ?>" name="seach" type="text" placeholder="Tìm kiếm sản phẩm" />
                                                            <button type="submit" class="btn pull-right mybtn-search">
                                                                <span><i class="fa fa-search"></i></span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-xs-12 col-md-6 Supper-Title text-center">
                                                <?php
                                                $Mn = new Menu();
                                                $itenm = $Mn->MenusByGroup("R3_HeaderMenu", false);
                                                foreach ($itenm as $key => $value) {
                                                    $_item = new Menu($value);
                                                    $_itemLink = $_item->Link;
                                                    $_name = $_item->Name;
                                                    echo <<<HTML
<a href="{$_itemLink}">
<img  onerror="this.src='/public/no-image.jpg'" src="{$_item->Note}" alt="{$_name}">
<span>{$_name}</span>
</a>    
HTML;
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="nav-top-menu" class="nav-top-menu">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-sm-3 hidden-sm hidden-xs" id="box-vertical-megamenus">
                                                <div class="box-vertical-megamenus">
                                                    <h4 class="title">
                                                        <span class="title-menu">Danh Mục Ấn Phẩm</span>
                                                        <span class="btn-open-mobile pull-right home-page"><i class="fa fa-bars"></i></span>
                                                    </h4> 
                                                    <div class="vertical-menu-content">
                                                        <ul class="vertical-menu-list">
                                                        <?php
                                                        $Mn = new Menu();
                                                        $itenm = $Mn->MenusByGroup("VerticalMenu", false);
                                                        foreach ($itenm as $key => $value) {
                                                            $_item = new Menu($value);
                                                            $_itemLink = $_item->Link;
                                                            $_name = $_item->Name;
                                                            echo <<<HTML
<li>
<a href="{$_item->Link}">
<img class="icon-menu" style="height: 15px" src="{$_item->Note}" alt="{$_item->Name}" />
{$_item->Name}
</a>
</li>
HTML;
                                                        }
                                                        ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="main-menu" class="col-md-9 main-menu">
                                                <nav class="navbar navbar-default">
                                                    <div class="container-fluid">
                                                        <div class="navbar-header">
                                                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                                                data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                                                <i class="fa fa-bars"></i>
                                                            </button>
                                                            <a class="navbar-brand" href="#">MENU</a>
                                                        </div>
                                                        <div id="navbar" class="navbar-collapse collapse">
                                                            <ul class="nav navbar-nav">
                                                            <?php
                                                            $Mn = new Menu();
                                                            $itenm = $Mn->MenusByGroup("TopMainMenu", false);
                                                            foreach ($itenm as $key => $value) {
                                                                $_item = new Menu($value);
                                                                $_itemLink = $_item->Link;
                                                                $_name = $_item->Name;
                                                                echo <<<HTML
<li>
<a href="{$_itemLink}">
{$_name} 
</a>    
</li>
HTML;
                                                            }
                                                            ?>
                                                                </ul>
                                                        </div>
                                                    </div>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <?php
    }









    static function footer()
    {
        $adv = new \Model\adv();
        ob_start();
        ?>
                                                                                                                                                                  <footer id="footer">
                                                                                                                                                                <div class="container">
                                                                                                                                                                    <!-- introduce-box -->
                                                                                                                                                                    <div id="introduce-box" class="row">
                                                                                                                                                                        <div class="col-xs-12 col-sm-6 col-md-3">
                                                                                                                                                                            <div>
                                                                                                                                                                                __footer1___
                                                                                                                                                                            </div>
                                                                                                                                                                        </div>
                                                                                                                                                                        <div class="col-xs-6 col-sm-6 col-md-3">
                                                                                                                                                                            <div>
                                                                                                                                                                                __footer2___
                                                                                                                                                                            </div>
                                                                                                                                                                        </div>
                                                                                                                                                                        <div class="col-xs-6 col-sm-6 col-md-3">
                                                                                                                                                                            <div>
                                                                                                                                                                                __footer3___
                                                                                                                                                                            </div>
                                                                                                                                                                        </div>
                                                                                                                                                                        <div class="col-xs-12 col-sm-6 col-md-3">
                                                                                                                                                                            <div>
                                                                                                                                                                                __footer4___
                                                                                                                                                                            </div>
                                                                                                                                                                        </div>
                                                                                                                                                                    </div> 
                                                                                                                                                                </div>
                                                                                                                                                            </footer> 
                                                                                                                                                                <div class="footer" style="background-color: #777;">
                                                                                                                                                                    <div class="container">
                                                                                                                                                                        <div class="row">
                                                                                                                                                                            <div class="col-md-4 col-sm-4 padding-top-10">
                                                                                                                                                                            Copyrights &#169; 2015 rubyco.com.vn
                                                                                                                                                                            </div>
                                                                                                                                                                            <div class="col-md-4 col-sm-4">
                                                                                                                                                                            </div>
                                                                                                                                                                            <div class="col-md-4 col-sm-4 text-right">
                                                                                                                                                                                <p class="powered"><a href="https://nguyenvando.net">nguyenvando.net</a></p>
                                                                                                                                                                            </div>
                                                                                                                                                                        </div>
                                                                                                                                                                    </div>
                                                                                                                                                                </div>
                                                                                                                                                                <div style="position: fixed;right: 150px;bottom: 330px;z-index: 99999" class="hidden-xs phonering-alo-phone phonering-alo-green phonering-alo-show" id="phonering-alo-phoneIcon">
                                                                                                                                                                    <div class="phonering-alo-ph-circle"></div>
                                                                                                                                                                    <div class="phonering-alo-ph-circle-fill"></div>
                                                                                                                                                                    <a href="https://www.facebook.com/inbangronlambanghieu/" class="pps-btn-img" title="Liên hệ">
                                                                                                                                                                        <div class="phonering-alo-ph-img-circle">
                                                                                                                                                                            <i style="margin-top: 7px;color: #fff;background-color: #fff0;" class="fa fa-facebook fa-3x"></i>
                                                                                                                                                                        </div>
                                                                                                                                                                    </a>
                                                                                                                                                                </div>
                                                                                                                                                                <div style="position: fixed;right: 150px;bottom: 230px;z-index: 99999" class="hidden-xs phonering-alo-phone phonering-alo-green phonering-alo-show" id="phonering-alo-phoneIcon">
                                                                                                                                                                    <div class="phonering-alo-ph-circle"></div>
                                                                                                                                                                    <div class="phonering-alo-ph-circle-fill"></div>
                                                                                                                                                                    <a href="https://m.me/__messengerID___" class="pps-btn-img" title="Liên hệ">
                                                                                                                                                                        <div class="phonering-alo-ph-img-circle">
                                                                                                                                                                            <img style="width: 40px;margin-top: 5px;" src="/public/Icon/messenger.png">
                                                                                                                                                                            <!-- <i style="color: #fff;background-color: #fff0;" class="fa fa-facebook fa-3x"></i> -->
                                                                                                                                                                        </div>
                                                                                                                                                                    </a>
                                                                                                                                                                </div>
                                                                                                                                                                <div style="position: fixed;right: 150px;bottom: 430px;z-index: 99999" class="hidden-xs phonering-alo-phone phonering-alo-green phonering-alo-show" id="phonering-zalo-phoneIcon1">
                                                                                                                                                                    <div class="phonering-alo-ph-circle"></div>
                                                                                                                                                                    <div class="phonering-alo-ph-circle-fill"></div>
                                                                                                                                                                    <a href="https://zalo.me/__ContactZalo___" class="pps-btn-img" title="Zalo">
                                                                                                                                                                        <div class="icon-zalo phonering-alo-ph-img-circle">
                                                                                                                                                                        </div>
                                                                                                                                                                    </a>
                                                                                                                                                                </div>

                                                                                                                                                            <?php
                                                                                                                                                            $str = ob_get_clean();
                                                                                                                                                            return $str;
    }

    static function js()
    {
        ?>

                                                                                                                                                                <div class="hidden float-contact">
                                                                                                                                                                    <a style="border-radius: 100px;" class="hotline btn" href="tel:__SDT___">Gọi Ngay : __Hotline___</a>
                                                                                                                                                                </div>
                                                                                                                                                                <script type="text/javascript" src="/public/home/assets/lib/jquery/jquery-1.11.2.min.js"></script>
                                                                                                                                                                <script type="text/javascript" src="/public/home/assets/lib/bootstrap/js/bootstrap.min.js"></script>
                                                                                                                                                                <script type="text/javascript" src="/public/home/assets/lib/select2/js/select2.min.js"></script>
                                                                                                                                                                <script type="text/javascript" src="/public/home/assets/lib/jquery.bxslider/jquery.bxslider.min.js"></script>
                                                                                                                                                                <script type="text/javascript" src="/public/home/assets/lib/owl.carousel/owl.carousel.min.js"></script>
                                                                                                                                                                <script type="text/javascript" src="/public/home/assets/lib/jquery.countdown/jquery.countdown.min.js"></script>
                                                                                                                                                                <script type="text/javascript" src="/public/home/assets/js/jquery.actual.min.js"></script>
                                                                                                                                                                <script type="text/javascript" src="/public/home/assets/js/theme-script.js"></script>

                                                                                                                                                                <script src="/public/wowjs/wow.js" type="text/javascript"></script>
                                                                                                                                                                <script type="text/javascript">
                                                                                                                                                                    jQuery(document).ready(function() {
                                                                                                                                                                        try {
                                                                                                                                                                            // Layout.init();
                                                                                                                                                                            // Layout.initOWL();
                                                                                                                                                                            // Layout.initTwitter();
                                                                                                                                                                            // Layout.initFixHeaderWithPreHeader();
                                                                                                                                                                            // Layout.initNavScrolling();
                                                                                                                                                                            // Portfolio.init();
                                                                                                                                                                            // ContactUs.init();
                                                                                                                                                                            new WOW().init();
                                                                                                                                                                        } catch (e) {
                                                                                                                                                                            console.log(e);
                                                                                                                                                                        }

                                                                                                                                                                    });
                                                                                                                                                                </script>
                                                                                                                                                               <?php
                                                                                                                                                               if (FALSE) {
                                                                                                                                                                   ?>
                                                                                                                                                                                                                                                <script src="https://www.google.com/recaptcha/api.js?render=<?php echo reCAPTCHA; ?>"></script>
                                                                                                                                                                                                                                            <?php
                                                                                                                                                               }
                                                                                                                                                               ?>
                                                                                                                                                                <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=611f2ae4f4d23f00121c6e0b&product=sop' async='async'></script>
                                                                                                                                                                <?php
    }

    public function Menu()
    {
        ?>
                                                                                                                                                                                                                                                                                <div class="header">
                                                                                                                                                                                                                                                                                    <div class="container">
                                                                                                                                                                                                                                                                                        <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>
                                                                                                                                                                                                                                                                                        <div class="header-navigation font-transform-inherit">
                                                                                                                                                                                                                                                                                            <ul class="">
                                                                                                                                                                                                                                                                                                <li ng-repeat="item in _MenuTopMainMenu" ng-class="item.submenu ? 'dropdown' : ''" class="">
                                                                                                                                                                                                                                                                                                    <a ng-href="{{item.submenu?'#':item.Link}}" data-toggle="{{item.submenu?'dropdown':''}}">{{item.Name}}
                                                                                                                                                                                                                                                                                                        <i ng-show="item.submenu" class="fa fa-angle-down"></i>
                                                                                                                                                                                                                                                                                                    </a>
                                                                                                                                                                                                                                                                                                    <ul ng-show="item.submenu" class="dropdown-menu sub-menu">
                                                                                                                                                                                                                                                                                                        <li ng-repeat="item1 in item.submenu">
                                                                                                                                                                                                                                                                                                            <a href="{{item1.Link}}">{{item1.Name}}</a>
                                                                                                                                                                                                                                                                                                        </li>
                                                                                                                                                                                                                                                                                                    </ul>
                                                                                                                                                                                                                                                                                                </li>
                                                                                                                                                                                                                                                                                                <li class="menu-search " style="top: 0px;display: none;">
                                                                                                                                                                                                                                                                                                    <a href="#">
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

    public function right()
    {
        ?>
                                                                                                                                                                                                                                                                                <div class="">
                                                                                                                                                                                                                                                                                    <div class="panel-body row">
                                                                                                                                                                                                                                                                                        <form action="/timkiem/index/" method="GET">
                                                                                                                                                                                                                                                                                            <div class="form-group">
                                                                                                                                                                                                                                                                                                <label for="">Tìm Kiếm</label>
                                                                                                                                                                                                                                                                                                <input type="text" class="form-control" value="<?php echo isset($_GET["keyword"]) ? $_GET["keyword"] : ""; ?>" name="keyword" placeholder="Từ Khóa Tìm Kiếm">
                                                                                                                                                                                                                                                                                                <p>__TimKiemVD___</p>

                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                            <div class="form-group text-center">
                                                                                                                                                                                                                                                                                                <input type="submit" class="btn btn-theme" value="Tìm Kiếm">
                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                        </form>
                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                <div class="panel panel-theme">
                                                                                                                                                                                                                                                                                    <div class="panel-heading">
                                                                                                                                                                                                                                                                                        <h3 class="panel-title">Bài Viết Mới Nhất</h3>
                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                    <div class="panel-body">
                                                                                                                                                                                                                                                                                        <div class="recent-news margin-bottom-10 ">
                                                                                                                                                                                                                                                                                            <div ng-repeat="news in _baivietmoinhat" class="row margin-bottom-10">
                                                                                                                                                                                                                                                                                                <div class="col-md-3">
                                                                                                                                                                                                                                                                                                    <a href="{{news.Link}}" class=" " style="display: block;">
                                                                                                                                                                                                                                                                                                        <img onerror="this.src='/public/lawkimsa/Images/h1.jpg'" class="img-responsive" alt="{{news.Name}}" src="{{news.UrlHinh}}">
                                                                                                                                                                                                                                                                                                    </a>
                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                <div class="col-md-9 recent-news-inner">
                                                                                                                                                                                                                                                                                                    <h3><a style="color: #000;font-weight: bold;font-size: 1em;" href="{{news.Link}}">{{news.Name}}</a></h3>
                                                                                                                                                                                                                                                                                                    <p style="color: #aaa;line-height: 1em;height: 2.09em;overflow: hidden;">{{news.Summary}}</p>
                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                <hr>
                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                            <?php
    }


    function product($_Product)
    {
        $_Product = new Products($_Product);
        ?>
                                                        <div class="col-xs-6 col-md-4">
                                                                            <div class="row">

                                                                                <div class="col-md-12 text-center">
                                                                                    <a href="<?php echo $_Product->linkProduct(); ?>">
                                                                                        <img style="height: 200px;width: 100%;" onerror="this.src='/public/lawkimsa/Images/h1.jpg'"
                                                                                            class="img img-responsive" src="<?php echo $_Product->UrlHinh(); ?>"
                                                                                            alt="<?php echo $_Product->Name ?>" />
                                                                                    </a>
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <a href="<?php echo $_Product->linkProduct(); ?>" class="">
                                                                                        <h3 style="margin-top: 10px;overflow: hidden;height: 40px;line-height: 20px;font-size: 18px;"
                                                                                            class="newstitle text-justify">
                                                                                            <?php echo $_Product->Name; ?>
                                                                                        </h3>
                                                                                    </a>
                                                                                    <p><strong><span style="color: red;">
                                                                                                <?php echo $_Product->PriceShow(); ?>
                                                                                            </span> </strong> </p>
                                                                                    <p class="text-justify" style="overflow: hidden;height: 70px;">
                                                                                        <?php echo $_Product->Summary(); ?>
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="clearfix"></div>
                                                                            <hr>
                                                                        </div>
                                                             <?php
    }

}