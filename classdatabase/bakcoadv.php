<?php 
            namespace classdatabase;
            
            class bakcoadv { 
                public 
             $ID , 
             $Name , 
             $Content , 
             $Attribute , 
             $DataAttribute , 
             $Group , 
             $Urlimages , 
             $Link , 
             $isShow , 
             $createDate , 
             $updateDate ; 
            
            function __construct($menu = null) {
                    if($menu){
                         $this->ID = $menu['ID']; $this->Name = $menu['Name']; $this->Content = $menu['Content']; $this->Attribute = $menu['Attribute']; $this->DataAttribute = $menu['DataAttribute']; $this->Group = $menu['Group']; $this->Urlimages = $menu['Urlimages']; $this->Link = $menu['Link']; $this->isShow = $menu['isShow']; $this->createDate = $menu['createDate']; $this->updateDate = $menu['updateDate'];
                    }
                     parent::__construct();
                 }
            
            } 