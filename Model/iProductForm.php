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

    public static function Id($val = null);
    public static function Username($val = null);
    public static function CatId($val = null);
    public static function Name($val = null);
    public static function Alias($val = null);
    public static function Price($val = null);
    public static function DonViTinh($val = null);
    public static function OldPrice($val = null);
    public static function Summary($val = null);
    public static function Content($val = null);
    public static function UrlHinh($val = null);
    public static function DateCreate($val = null);
    public static function Number($val = null);
    public static function Note($val = null);
    public static function BuyTimes($val = null);
    public static function Views($val = null);
    public static function IsShow($val = null);
    public static function Serial($val = null);
    public static function Lang($val = null);
}
