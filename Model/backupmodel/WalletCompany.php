<?php

class Model_WalletCompany extends Model_Adapter {

    public $Id;
    public $Address;
    public $KeyPassword;
    public $Note;
    function __construct($phieuhenchitiet = NULL) {
        if ($phieuhenchitiet) {
            $this->Id = $phieuhenchitiet->Id;
            $this->Address = $phieuhenchitiet->Address;
            $this->KeyPassword = $phieuhenchitiet->KeyPassword;
            $this->Note = $phieuhenchitiet->Note;
        }
        parent::__construct();
    }
    function DSWalletCompan() {
        $sql = "SELECT * FROM `scoin_wallet_company`";
        $this->Query($sql);
        return $this->fetchAll();
//        return $this->fetchRow();
    }
    function EditWalletCompan($wallet_company) {
        $sql = "UPDATE `scoin_wallet_company` SET `Address` = '{$wallet_company->Address}', `KeyPassword` = '{$wallet_company->Address}', `Note` = '{$wallet_company->Address}' WHERE `Id` = '{$wallet_company->Id}'";
        $this->Query($sql);
        return $this->Luu();
//        return $this->fetchRow();
    }
    function AddWalletCompan($wallet_company) {
        $sql = "INSERT INTO `scoin_wallet_company` SET `Address` = '{$wallet_company->Address}', `KeyPassword` = '{$wallet_company->Address}', `Note` = '{$wallet_company->Address}'";
        $this->Query($sql);
        return $this->Luu();
//        return $this->fetchRow();
    }
    
}

?>