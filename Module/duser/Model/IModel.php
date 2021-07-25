<?php

namespace Module\duser\Model;

interface IModel {

    public function Post($Model);

    public function Put($Model);

    public function Delete($id);

    public function GetById($id);

    public function GetAll();

    public function GetAllPT($keyword, &$total, $pagesIndex = 1, $pageNumber = 10);
}
