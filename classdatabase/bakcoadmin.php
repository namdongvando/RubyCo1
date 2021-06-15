<?php 
            namespace classdatabase;
            
            class bakcoadmin { 
                public 
             $Username , 
             $Password , 
             $Random , 
             $Name , 
             $Email , 
             $Phone , 
             $Address , 
             $Note , 
             $Groups , 
             $Urrlimages ; 
            
            function __construct($menu = null) {
                    if($menu){
                         $this->Username = $menu['Username']; $this->Password = $menu['Password']; $this->Random = $menu['Random']; $this->Name = $menu['Name']; $this->Email = $menu['Email']; $this->Phone = $menu['Phone']; $this->Address = $menu['Address']; $this->Note = $menu['Note']; $this->Groups = $menu['Groups']; $this->Urrlimages = $menu['Urrlimages'];
                    }
                     parent::__construct();
                 }
            
            } 