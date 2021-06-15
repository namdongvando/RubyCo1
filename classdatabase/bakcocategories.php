<?php 
            namespace classdatabase;
            
            class bakcocategories { 
                public 
             $catID , 
             $catName , 
             $Path , 
             $Link , 
             $Note , 
             $parentCatID , 
             $banner , 
             $Public , 
             $Serial , 
             $Lang ; 
            
            function __construct($menu = null) {
                    if($menu){
                         $this->catID = $menu['catID']; $this->catName = $menu['catName']; $this->Path = $menu['Path']; $this->Link = $menu['Link']; $this->Note = $menu['Note']; $this->parentCatID = $menu['parentCatID']; $this->banner = $menu['banner']; $this->Public = $menu['Public']; $this->Serial = $menu['Serial']; $this->Lang = $menu['Lang'];
                    }
                     parent::__construct();
                 }
            
            } 