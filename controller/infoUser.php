<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/175em/model/infoUser.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/175em/model/generalData.php';

    class profileCtrl extends profileModel {
    	public function departmentName($Property){
    		parent::__construct($Property);
        	$result = $this->getDepartment();
        	if($result) {
        		return $result['Name'];
        	} else return "Khong ton tai";
        }

        public function companyInfo($Property){
        	parent::__construct($Property);
        	$result = $this->getCompanyInfo();
        	if($result) {
        		return $result;
        	} else return null;
        }
    } 

    /**
     * 
     */
    class addressCtrl extends Adress
    {
        private $data_result;
        
        function getList($key=null, $name)
        {
            $this->data_result = parent::__construct($key);
            //$this->data_result = $this->getData(); 
            $selectList = '<select id="'.$name.'" class="form-control" name="'.$name.'">';
            $selectList .= '<option value="">Xin mời chọn</option>';
            foreach($this->data_result as $key1 => $value){               
                $selectList .= '<option value="'.$key1.'">'.$key1.'</option>';
            }                 
            $selectList .= '</select>';  
            return $selectList;   
        }
    }

    /**
     * 
     */
    class newCompanyCtrl extends newCompanyModel
    {
        
        function insertCompany($providerName, $providerCode, $provinceName, $districtName, $address, $phoneNumber, $faxNumber, $taxNumber, $bankName, $bankAcc, $delegate, $position, $athorized, $contactPerson, $contactEmail, $contactPhone)
        {
            parent::__construct($providerName, $providerCode, $provinceName, $districtName, $address, $phoneNumber, $faxNumber, $taxNumber, $bankName, $bankAcc, $delegate, $position, $athorized, $contactPerson, $contactEmail, $contactPhone);
            $result = $this->insertInfoCpn();
            if(!empty($result)) {
                return "Provider Created";
            }
            else "ERROR";
        }
    }

?>