<?php

namespace Model;

interface IModelDB {

    public function Post($model);

    public function Put($model);

    public function Delete($id);

    public function GetById($id);

    public static function ToSelect();

    public function GetAllPT($name, &$total, $indexPage = 1, $pageNumber = 10);
}
