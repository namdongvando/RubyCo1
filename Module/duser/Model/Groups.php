<?php

namespace Module\duser\Model;

class Groups implements IModel {

    public $id;
    public $name;

    public function __construct($id = null) {

        if ($id != null) {
            if (!is_array($id)) {
                $id = $this->GetById($id);
            }
            if ($id) {
                $this->id = $id["id"];
                $this->name = $id['name'];
            }
        }
    }

    function ListGroups() {
        return [
            -1 => [
                "id" => -1,
                "name" => 'supperadmin',
            ]
            , 0 => [
                "id" => 0,
                "name" => 'admin',
            ]
            , 1 => [
                "id" => 1,
                "name" => 'Chỉnh Sửa Nội Dung',
            ]
        ];
    }

    function ToSelectNoSuperAdmin() {
        return [
            1 => 'Chỉnh Sửa Nội Dung',
            0 => 'admin'
        ];
    }

    function ToSelect() {
        return [
            -1 => 'supperadmin',
            1 => 'Chỉnh Sửa Nội Dung',
            0 => 'admin'
        ];
    }

    public function Delete($id) {

    }

    public function GetAll() {
        return $this->ListGroups();
    }

    public function GetAllPT($keyword, &$total, $pagesIndex = 1, $pageNumber = 10) {

    }

    public function GetById($id) {
        $ds = $this->ListGroups();
        return $ds[$id];
    }

    public function Post($Model) {

    }

    public function Put($Model) {

    }

}
