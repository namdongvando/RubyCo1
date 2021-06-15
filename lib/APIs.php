<?php

namespace lib;

class APIs {

    function ArrayToApi($array) {
        $a = new \Model_Adapter();
        if ($array) {
            $a = json_encode($array, JSON_UNESCAPED_UNICODE);
            echo html_entity_decode($a);
        } else {
            echo "[]";
        }
    }

    public function ArrayToString($array) {
        $a = json_encode($array, JSON_UNESCAPED_UNICODE);
        return html_entity_decode($a);
    }

    public static function dataResful($data, $pageIndex, $pageNumber, $Tong) {
        return json_encode([
            "data" => $data,
            "pageIndex" => intval($pageIndex),
            "pageNumber" => intval($pageNumber),
            "totalCount" => $Tong,
                ], JSON_UNESCAPED_UNICODE);
    }

}
