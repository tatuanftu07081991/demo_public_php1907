<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/175em/oop/db.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/175em/model/generalData.php';

    class profileModel extends Db {
    	private $Property;
    	public function __construct($Property){
    		parent::__construct();
    		$this->Property = $Property;
    	}
    	public function getDepartment(){
            $sql = "SELECT * FROM department WHERE Id = ?";
            $result = $this->SelectSingle($sql, [$this->Property]);
            return $result;
        }

        public function getCompanyInfo(){
            $sql = "SELECT * FROM company WHERE Code = ?";
            $result = $this->SelectSingle($sql, [$this->Property]);
            return $result;
        }
    }

    class newCompanyModel extends Db
    {
        private $providerName, $providerCode, $fullAdress, $provinceName, $districtName, $address, $phoneNumber, $faxNumber, $taxNumber, $bankName, $bankAcc, $delegate, $position, $athorized, $contactPerson, $contactEmail, $contactPhone;

         public function __construct($providerName, $providerCode, $provinceName, $districtName, $address, $phoneNumber, $faxNumber, $taxNumber, $bankName, $bankAcc, $delegate, $position, $athorized, $contactPerson, $contactEmail, $contactPhone)
        {
            // kết nối DB
            parent::__construct();

            $this->providerName = $providerName;
            $this->providerCode = $providerCode;
            $this->fullAdress = $address.', '.$districtName.', '.$provinceName;
            $this->provinceName = $provinceName;
            $this->districtName = $districtName;
            $this->address = $address;
            $this->phoneNumber = $phoneNumber;
            $this->faxNumber = $faxNumber;
            $this->taxNumber = $taxNumber;
            $this->bankName = $bankName;
            $this->bankAcc = $bankAcc;
            $this->delegate = $delegate;
            $this->position = $position;

            $this->athorized = $athorized;
            $this->contactPerson = $contactPerson;
            $this->contactEmail = $contactEmail;
            $this->contactPhone = $contactPhone;
            
        }
        public function insertInfoCpn(){

            $sql = "INSERT INTO company(Code,Name,Address,Phone,Fax,TaxNum, BankAccount,Bank,Delegate,Position,Authorized,ContactPerson,ContactEmail,ContactPhone) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            
            $id_insert = $this->Insert($sql, [$this->providerCode, $this->providerName, $this->fullAdress, $this->phoneNumber, $this->faxNumber, $this->taxNumber, $this->bankAcc, $this->bankName, $this->delegate, $this->position, $this->athorized, $this->contactPerson, $this->contactEmail, $this->contactPhone]);
            return $id_insert;
        }
    }