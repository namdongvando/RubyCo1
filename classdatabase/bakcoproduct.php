<?php 
            namespace classdatabase;
            
            class bakcoproduct { 
                public 
             $ID , 
             $Username , 
             $catID , 
             $nameProduct , 
             $Alias , 
             $Price , 
             $oldPrice , 
             $Summary , 
             $Content , 
             $UrlHinh , 
             $DateCreate , 
             $Number , 
             $Note , 
             $BuyTimes , 
             $Views , 
             $isShow , 
             $Serial , 
             $lang ; 
            
            function __construct($menu = null) {
                    if($menu){
                         $this->ID = $menu['ID']; $this->Username = $menu['Username']; $this->catID = $menu['catID']; $this->nameProduct = $menu['nameProduct']; $this->Alias = $menu['Alias']; $this->Price = $menu['Price']; $this->oldPrice = $menu['oldPrice']; $this->Summary = $menu['Summary']; $this->Content = $menu['Content']; $this->UrlHinh = $menu['UrlHinh']; $this->DateCreate = $menu['DateCreate']; $this->Number = $menu['Number']; $this->Note = $menu['Note']; $this->BuyTimes = $menu['BuyTimes']; $this->Views = $menu['Views']; $this->isShow = $menu['isShow']; $this->Serial = $menu['Serial']; $this->lang = $menu['lang'];
                    }
                     parent::__construct();
                 }
            
            } 