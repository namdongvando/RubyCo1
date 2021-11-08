<?php

namespace Model\News;

class HoiDap {

    public $Id;
    public $NewsId;
    public $CauHoi;
    public $TraLoi;
    public $NgayTao;
    public $IsActive;

    public function __construct($hoiDap = null) {
        if ($hoiDap) {
            if (!is_array($hoiDap)) {
                $id = $hoiDap;
                $hoiDap = $this->GetById($id);
            }
            if ($hoiDap) {
                $this->Id = isset($hoiDap["Id"]) ? $hoiDap["Id"] : null;
                $this->NewsId = isset($hoiDap["NewsId"]) ? $hoiDap["NewsId"] : null;
                $this->CauHoi = isset($hoiDap["CauHoi"]) ? $hoiDap["CauHoi"] : null;
                $this->TraLoi = isset($hoiDap["TraLoi"]) ? $hoiDap["TraLoi"] : null;
                $this->NgayTao = isset($hoiDap["NgayTao"]) ? $hoiDap["NgayTao"] : null;
                $this->IsActive = isset($hoiDap["IsActive"]) ? $hoiDap["IsActive"] : null;
            }
        }
    }

    function GetById() {
        $newservice = new HoiDapService();
        return $newservice->GetById($this->Id);
    }

    function ToArray() {
        $a["Id"] = $this->Id;
        $a["NewsId"] = $this->NewsId;
        $a["CauHoi"] = $this->CauHoi;
        $a["TraLoi"] = $this->TraLoi;
        $a["NgayTao"] = $this->NgayTao;
        $a["IsActive"] = $this->IsActive;
        return $a;
    }

    function GetByNews($newsid) {
        $newservice = new HoiDapService();
        return $newservice->GetByNewsId($newsid);
    }

}
