<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model;

/**
 *
 * @author MSI
 */
interface iProductForm
{

    public function Id($val = null);
    public function Username($val = null);
    public function CatId($val = null);
    public function Name($val = null);
    public function Alias($val = null);
    public function Price($val = null);
    public function DonViTinh($val = null);
    public function OldPrice($val = null);
    public function Summary($val = null);
    public function Content($val = null);
    public function UrlHinh($val = null);
    public function DateCreate($val = null);
    public function Number($val = null);
    public function Note($val = null);
    public function BuyTimes($val = null);
    public function Views($val = null);
    public function IsShow($val = null);
    public function Serial($val = null);
    public function Lang($val = null);
}
