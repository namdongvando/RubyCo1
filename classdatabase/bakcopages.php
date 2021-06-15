<?php 
            namespace classdatabase;
            
            class bakcopages { 
                public 
             $idPa , 
             $idGroup , 
             $Name , 
             $Alias , 
             $Title , 
             $Des , 
             $Keyword , 
             $Summary , 
             $Content , 
             $Urlimages , 
             $isShow , 
             $Type , 
             $Note ; 
            
            function __construct($menu = null) {
                    if($menu){
                         $this->idPa = $menu['idPa']; $this->idGroup = $menu['idGroup']; $this->Name = $menu['Name']; $this->Alias = $menu['Alias']; $this->Title = $menu['Title']; $this->Des = $menu['Des']; $this->Keyword = $menu['Keyword']; $this->Summary = $menu['Summary']; $this->Content = $menu['Content']; $this->Urlimages = $menu['Urlimages']; $this->isShow = $menu['isShow']; $this->Type = $menu['Type']; $this->Note = $menu['Note'];
                    }
                     parent::__construct();
                 }
            
            } 