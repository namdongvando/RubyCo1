<?php

namespace Model;

class MucLuc {

    static function add_table_of_content($content) {
        ob_start();
        preg_match_all("/<h[2,3](?:\sid=\"(.*)\")?(?:.*)?>(.*)<\/h[2,3]>/", $content, $matches);
        $tags = $matches[0];

        foreach ($tags as $tag) {
            echo "<a>" . strip_tags($tag) . "</a>";
        }

        $str = ob_get_clean();
        return $str;
    }

}
