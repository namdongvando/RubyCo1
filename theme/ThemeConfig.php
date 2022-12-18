<?php

namespace theme;

class ThemeConfig
{

    const pathFile = ROOT_DIR . "/theme/config/homeconfig.json";
    const HomeCategory = "HomeCategory";
    const DichVu = "DichVu";
    const GioiThieu = "GioiThieu";
    const ChungToiLaAi = "ChungToiLaAi";
    const tabhome1 = "tabhome1";
    const TaiSaoChonChungToi = "TaiSaoChonChungToi";
    const VanBanPhapLuat = "VanBanPhapLuat";

    public function __construct()
    {
    }

    static function getThemConfig($json = true)
    {
        if ($json)
            return json_decode(file_get_contents(self::pathFile));
        return json_decode(file_get_contents(self::pathFile), JSON_OBJECT_AS_ARRAY);
    }

    static function getThemConfigByKey($key)
    {
        $a = self::getThemConfig(FALSE);
        if (isset($a[$key]))
            return $a[$key];
        return [];
    }
}
