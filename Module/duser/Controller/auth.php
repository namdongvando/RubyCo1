<?php

namespace Module\duser\Controller;

use Module\duser\Model\Duser;

class auth {

    public function __construct() {
        if (Duser::CheckQuyen([Duser::CodeSuperAdmin, Duser::$CodeAdmin]) == FALSE) {
//            echo "Aba";
            \lib\Common::ToUrl("/backend/");
        }
    }

}
