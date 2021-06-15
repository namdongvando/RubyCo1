<?php 
            namespace classdatabase;
            
            class bakconews { 
                public 
             $ID , 
             $PageID , 
             $Name , 
             $Alias , 
             $Summary , 
             $Content , 
             $title , 
             $keyword , 
             $description , 
             $AnHien , 
             $NgayDang , 
             $UrlHinh , 
             $TinNoiBat , 
             $SoLanXem , 
             $Stt ; 
            
            function __construct($menu = null) {
                    if($menu){
                         $this->ID = $menu['ID']; $this->PageID = $menu['PageID']; $this->Name = $menu['Name']; $this->Alias = $menu['Alias']; $this->Summary = $menu['Summary']; $this->Content = $menu['Content']; $this->title = $menu['title']; $this->keyword = $menu['keyword']; $this->description = $menu['description']; $this->AnHien = $menu['AnHien']; $this->NgayDang = $menu['NgayDang']; $this->UrlHinh = $menu['UrlHinh']; $this->TinNoiBat = $menu['TinNoiBat']; $this->SoLanXem = $menu['SoLanXem']; $this->Stt = $menu['Stt'];
                    }
                     parent::__construct();
                 }
            
            } 