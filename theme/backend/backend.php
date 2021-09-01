<?php

namespace theme\backend;

class backend extends \Model\Database {

    function head() {
        ?>
        <link rel="shortcut icon" href="/public/no-image.jpg" />
        <link rel="stylesheet" href="/public/admin/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="/public/admin/dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="/public/admin/dist/css/skins/_all-skins.min.css">
        <link rel="stylesheet" href="/public/admin/plugins/iCheck/flat/blue.css">
        <link rel="stylesheet" href="/public/admin/plugins/morris/morris.css">
        <link rel="stylesheet" href="/public/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
        <link rel="stylesheet" href="/public/admin/plugins/datepicker/datepicker3.css">
        <link rel="stylesheet" href="/public/admin/plugins/datatables/dataTables.bootstrap.css">
        <link rel="stylesheet" href="/public/admin/plugins/daterangepicker/daterangepicker-bs3.css">
        <link rel="stylesheet" href="/public/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
        <link href="/public/admin/plugins/select2/select2.min.css" rel="stylesheet" type="text/css"/>
        <link href="/public/admin/dist/css/Style.css?v=<?php echo filemtime('public/admin/dist/css/Style.css'); ?>" rel="stylesheet" type="text/css"/>
        <link href="/public/admin/Customer.css?v=<?php echo filemtime("public/admin/Customer.css"); ?>" rel="stylesheet" type="text/css"/>
        <script src="/public/ckfinder/ckfinder.js" type="text/javascript"></script>
        <script src="/public/admin/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <?php
    }

    function Menu($_Controller = "mproduct") {
        ?>
        <header class="main-header "  ng-controller="bklayoutController" ng-init='bklayoutInit(<?php echo $this->_encode($_SESSION[QuanTri]); ?>)'>
            <!-- Logo -->
            <a href="/backend/" class="logo">
                <span class="logo-mini"><b>A</b>LT</span>
                <span class="logo-lg"><b>Quản Trị</b></span>
            </a>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li><a href="/" target="_blank"  >Xem Website</a></li>

                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="/public/admin/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                                <span class="hidden-xs">{{DangNhap.Name}}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="/public/admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                    <p>
                                        {{DangNhap.Name}}
                                        <small>{{DangNhap.Username}}</small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="/duser/aprofile/index" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="/backend/logout" class="btn btn-default btn-flat">Đăng Xuất</a>
                                    </div>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </nav>
        </header>

        <aside class="main-sidebar" ng-controller="bklayoutController" ng-init='bklayoutInit(<?php echo $this->_encode($_SESSION[QuanTri]); ?>)'  >
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar ">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="/public/admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p>{{DangNhap.Name}}</p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <!-- search form -->
                <form action="/<?php echo $_Controller ?>/seach/" method="POST" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" name="keyword" class="form-control" placeholder="Tìm Kiếm...">
                        <span class="input-group-btn">
                            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
                <!-- /.search form -->
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu ">
                    <li class="header text-center text-uppercase " style="color: #ddd;" ><b>Chức Năng Chính</b></li>

                    <li class="treeview ">
                        <a href="/mthuvien/index">
                            <i class="fa fa-image"></i> <span>Thư Viện Hình Ảnh</span>
                        </a>
                    </li>
                    <li class="treeview <?php echo \Model\Breadcrumb::CheckMenuAcrive("QuanLyBaiViet") ? 'active' : '' ?> ">
                        <a href="/mpage/index">
                            <i class="fa fa-list-alt"></i> <span>Quản Lý Bài Viết</span>
                            <i class="fa fa-angle-right pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="/mpage/index"><i class="fa fa-circle-o"></i> Danh mục bài biết</a></li>
                            <li><a href="/mnews/index"><i class="fa fa-circle-o"></i> Bài viết</a></li>
                            <li><a href="/mnews/addnews"><i class="fa fa-circle-o"></i> Thêm Bài viết</a></li>
                            <li><a href="/tags/"><i class="fa fa-circle-o"></i> Tags</a></li>
                        </ul>
                    </li>
                    <li class="treeview hidden ">
                        <a href="/mpage/index">
                            <i class="fa fa-list-alt"></i> <span>Quản Lý Bài Viết</span>
                            <i class="fa fa-angle-right pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="/mpage/index"><i class="fa fa-circle-o"></i> Danh mục bài biết</a></li>
                            <li><a href="/mnews/index"><i class="fa fa-circle-o"></i> Bài viết</a></li>
                            <li><a href="/mnews/addnews"><i class="fa fa-circle-o"></i> Thêm Bài viết</a></li>
                        </ul>
                    </li>
                    <?php
                    if (\Module\duser\Model\Duser::CheckQuyen([\Module\duser\Model\Duser::CodeSuperAdmin, \Module\duser\Model\Duser::$CodeAdmin])) {
                        ?>
                        <li class="treeview  <?php echo \Model\Breadcrumb::CheckMenuAcrive("Controller_madv") ? 'active' : '' ?>">
                            <a href="/madv/index"><i class="fa fa-home"></i>
                                <span>Trang Chủ</span>
                                <i class="fa fa-angle-right pull-right"></i>
                            </a>
                            <ul class="treeview-menu  ">
                                <li class="active" ><a  href="/madv/homeslide/"><i class="fa fa-circle-o"></i>Quản Lý Banner Động</a></li>
                                <li class="active" ><a  href="/madv/doitac"><i class="fa fa-circle-o"></i>Đối Tác</a></li>
                                <li class="active" ><a  href="/madv/khachhang/"><i class="fa fa-circle-o"></i>Ý Kiến Khách Hàng </a></li>
                                <li class="active" ><a  href="/mtheme/mhome/home"><i class="fa fa-circle-o"></i>Giao Diện</a></li>
                            </ul>
                        </li>
                        <?php
                    }
                    if (\Module\duser\Model\Duser::CheckQuyen([\Module\duser\Model\Duser::CodeSuperAdmin, \Module\duser\Model\Duser::$CodeAdmin])) {
                        ?>
                        <li class="treeview">
                            <a href="/mtheme/thememenu/home/TopMainMenu">
                                <i class="fa fa-list-alt"></i> <span>Quản Lý Menu</span>
                                <i class="fa fa-angle-right pull-right"></i>
                            </a>

                        </li>
                        <?php
                    }
                    if (\Module\duser\Model\Duser::CheckQuyen([\Module\duser\Model\Duser::CodeSuperAdmin, \Module\duser\Model\Duser::$CodeAdmin])) {
                        ?>
                        <li class="treeview ">
                            <a href="/minfor/index/thongtincongty">
                                <i class="fa fa-list-alt"></i> <span>Thông tin công ty</span>
                                <i class="fa fa-angle-right pull-right"></i>
                            </a>
                        </li>
                        <?php
                    }
                    if (\Module\duser\Model\Duser::CheckQuyen([\Module\duser\Model\Duser::CodeSuperAdmin, \Module\duser\Model\Duser::$CodeAdmin])) {
                        ?>
                        <li class="  treeview  ">
                            <a href="/duser/index/index">
                                <i class="fa fa-users"></i> <span>Quản Lý User</span>
                                <i class="fa fa-angle-right pull-right"></i>
                            </a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>
        <?php
    }

    function js() {
        ?>

        <!-- jQuery UI 1.11.4 -->
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <script>
                            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.5 -->
        <script src="/public/admin/bootstrap/js/bootstrap.min.js"></script>
        <!-- Morris.js charts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="/public/admin/plugins/morris/morris.min.js"></script>
        <script src="/public/admin/plugins/select2/select2.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="/public/admin/plugins/sparkline/jquery.sparkline.min.js"></script>
        <!-- jvectormap -->
        <script src="/public/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="/public/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="/public/admin/plugins/knob/jquery.knob.js"></script>
        <!-- daterangepicker -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
        <script src="/public/admin/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- datepicker -->
        <script src="/public/admin/plugins/datepicker/bootstrap-datepicker.js"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="/public/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
        <!-- DataTables -->
        <script src="/public/admin/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="/public/admin/plugins/datatables/dataTables.bootstrap.min.js"></script>
        <!-- Slimscroll -->
        <script src="/public/admin/plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="/public/admin/plugins/fastclick/fastclick.min.js"></script>
        <!-- AdminLTE App -->
        <script src="/public/admin/dist/js/pages/dashboard.js"></script>
        <script src="/public/admin/dist/js/app.min.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="/public/admin/dist/js/demo.js"></script>
        <script src="/public/admin/Javascript.js?<?php echo filemtime('public/admin/Javascript.js'); ?>" type="text/javascript"></script>
        <script>

                            $(function() {
                                $(".xoa").click(function() {

                                });
                                $(".dataTable").each(function() {
                                    var id = "#" + $(this).attr("id");
                                    $(id).dataTable();
                                });
                                setTimeout(function() {
                                    $(".alert").toggle();
                                }, 3000);

                                function password_generator(len) {
                                    var length = (len) ? (len) : (10);
                                    var string = "abcdefghijklmnopqrstuvwxyz"; //to upper
                                    var numeric = '0123456789';
                                    var punctuation = '!@#$%^&*()_+~`|}{[]\:;?><,./-=';
                                    var password = "";
                                    var character = "";
                                    var crunch = true;
                                    while (password.length < length) {
                                        entity1 = Math.ceil(string.length * Math.random() * Math.random());
                                        entity2 = Math.ceil(numeric.length * Math.random() * Math.random());
                                        entity3 = Math.ceil(punctuation.length * Math.random() * Math.random());
                                        hold = string.charAt(entity1);
                                        hold = (password.length % 2 == 0) ? (hold.toUpperCase()) : (hold);
                                        character += hold;
                                        character += numeric.charAt(entity2);
                                        character += punctuation.charAt(entity3);
                                        password = character;
                                    }
                                    password = password.split('').sort(function() {
                                        return 0.5 - Math.random()
                                    }).join('');
                                    return password.substr(0, len);
                                }
                                $("#TaoMatKhau").click(function() {
                                    var self = $(this);
                                    var target = self.data("target");
                                    $(target).val(password_generator());
                                });
                                $(".XemMatKhau").click(function() {
                                    var self = $(this);
                                    var target = self.data("target");
                                    if ($(target).attr("type") == "text") {
                                        $(target).attr("type", "password");
                                    } else {
                                        $(target).attr("type", "text");
                                    }

                                }); 
                            });

                            function BrowseServerShowImg(startupPath, functionData, idimg) {
                                var finder = new CKFinder();
                                finder.BasePath = '<?php echo BASE_URL ?>public/';
                                finder.startupPath = startupPath;
                                finder.selectActionFunction = function(fileUrl, data) {
                                    document.getElementById(data["selectActionData"]).value = fileUrl;
                                    var ID = data["selectActionData"];
                                    console.log(fileUrl);
                                    $('#' + idimg).attr('src', fileUrl);
                                };
                                finder.selectActionData = functionData;
                                finder.selectThumbnailActionFunction = function(fileUrl, data) {
                                    console.log(fileUrl);
                                    $('#' + idimg).attr('src', fileUrl);
                                };
                                finder.popup();
                            }
                            function BrowseServer(startupPath, functionData) {
                                var finder = new CKFinder();
                                finder.BasePath = '<?php echo BASE_URL ?>public/';
                                finder.startupPath = startupPath;
                                finder.selectActionFunction = SetFileField;
                                finder.selectActionData = functionData;
                                finder.selectThumbnailActionFunction = ShowThumbnails;
                                finder.popup();
                            }
                            function SetFileField(fileUrl, data) {
                                document.getElementById(data["selectActionData"]).value = fileUrl;
                                var ID = data["selectActionData"];
                                hienthumb(fileUrl, ID);
                            }
                            function ShowThumbnails(fileUrl, data) {
                                var sFileName = this.getSelectedFile().name;

                                document.getElementById('thumbnails').innerHTML +=
                                        '<div class="thumb">' +
                                        '<img src="' + fileUrl + '" />' +
                                        '<div class="caption">' +
                                        '<a href="' + data["fileUrl"] + '" target="_blank">' + sFileName + '</a> (' + data["fileSize"] + 'KB)' +
                                        '</div>' +
                                        '</div>';
                                document.getElementById('preview').style.display = "";
                                return false;

                            }
                            function hienthumb(fileUrl, ID) {
                                if (fileUrl != "") {
                                    $('#HinhQuanCao').attr('src', fileUrl);
                                    var bien = "<img src='" + fileUrl + "'  height='100'>";
                                    $('#' + ID).parent().children('label').children('.HinhChon').html(bien);
                                }
                                ;
                            }


        </script>
        <script src="https://www.google.com/recaptcha/api.js?render=<?php echo reCAPTCHA; ?>"></script>
        <?php
    }

    function Breadcrumb() {
        $brea = new \Model\Breadcrumb();
        $brea->backend();
    }

    public
            function Footer() {
        ?>
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.3.0
            </div>
            <strong>Copyright &copy; <?php echo date("Y", time()); ?> <a href="https://nguyenvando.net">nguyenvando.net</a>.</strong>
        </footer>
        <div class="control-sidebar-bg"></div>

        <?php
    }

}
