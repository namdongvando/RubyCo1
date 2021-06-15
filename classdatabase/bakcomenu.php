<?php 
            namespace classdatabase;
            
            class bakcomenu { 
                public 
             $Id , 
             $Name , 
             $Link , 
             $Parent , 
             $Groups , 
             $OrderBy , 
             $Note , 
             $createDate , 
             $UpdateDate ; 
            
            function __construct($menu = null) {
                    if($menu){
                         $this->Id = $menu['Id']; $this->Name = $menu['Name']; $this->Link = $menu['Link']; $this->Parent = $menu['Parent']; $this->Groups = $menu['Groups']; $this->OrderBy = $menu['OrderBy']; $this->Note = $menu['Note']; $this->createDate = $menu['createDate']; $this->UpdateDate = $menu['UpdateDate'];
                    }
                     parent::__construct();
                 }
            
            } 