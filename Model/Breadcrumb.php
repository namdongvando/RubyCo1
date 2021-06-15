<?php

namespace Model;

class Breadcrumb {

    public static $List;
    public static $MenuActive;

    function setBreadcrumb($array) {
        self::$List = $array;
    }

    function showBreadcrumb() {
        $ds = self::$List;
        $a = [];
        ?>
        <div class="breadcrumb clearfix">
            <a class="home" href="/" title="Return to Home">Trang Chủ</a>
            <?php
            if ($ds) {
                $a = end($ds);
                unset($ds[count($ds) - 1]);
                if ($ds)
                    foreach ($ds as $v) {
                        ?>
                        <span class="navigation-pipe">&nbsp;</span>
                        <a href="<?php echo $v["link"] ?>"><?php echo $v["title"] ?></a>
                        <?php
                    }
            }
            if ($a) {
                ?>
                <span class="navigation-pipe">&nbsp;</span>
                <span class="navigation_page"><?php echo $a["title"] ?></span>
                <?php
            }
            ?>
        </div>

        <?php
    }

    function backendBreadcrumb() {
        $ds = self::$List;
        $a = [];
        ?>
        <div class="breadcrumb clearfix">
            <a class="home" href="/" title="Return to Home">Trang Chủ</a>
            <?php
            if ($ds) {
                $a = end($ds);
                unset($ds[count($ds) - 1]);
                if ($ds)
                    foreach ($ds as $v) {
                        ?>
                        <span class="navigation-pipe">&nbsp;</span>
                        <a href="<?php echo $v["link"] ?>"><?php echo $v["title"] ?></a>
                        <?php
                    }
            }
            if ($a) {
                ?>
                <span class="navigation-pipe">&nbsp;</span>
                <span class="navigation_page"><?php echo $a["title"] ?></span>
                <?php
            }
            ?>
        </div>

        <?php
    }

    function backend() {
        $ds = self::$List;
        $a = [];
        ?>
        <ol class="breadcrumb ">
            <?php
            if ($ds) {
                $a = end($ds);
                unset($ds[count($ds) - 1]);
                if ($ds)
                    foreach ($ds as $v) {
                        ?>
                        <li class="active">
                            <a href="<?php echo $v["link"] ?>"><?php echo $v["title"] ?></a>
                        </li>
                        <?php
                    }
            }
            if ($a) {
                ?>
                <li class="active"><?php echo $a["title"] ?></li>
                    <?php
                }
                ?>
        </ol>
        <?php
    }

    public static function setMenuAcrive($param0) {
        self::$MenuActive = md5($param0);
    }

    public static function CheckMenuAcrive($param0) {
        return self::$MenuActive == md5($param0);
    }

}
