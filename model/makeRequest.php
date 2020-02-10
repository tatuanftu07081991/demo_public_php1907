<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/175em/oop/db.php';

    class Request extends Db {
        
    	public function __construct()
        {
            parent::__construct();
        }

    	public function insertRequest($dpment, $machineCode, $rqProduct, $malTime, $crTime, $dcrtion, $status, $prPerson, $rqStatus) {    		
    		
            $sql = "INSERT INTO request(Department,Equipment,RequetedProduct,
            TimeOfMalfunction,CreatedTime,Discription, Status, ProposedBy, RequestStatus) VALUES(?,?,?,?,?,?,?,?,?)";
        
            $id_insert = $this->Insert($sql, [$dpment, $machineCode, $rqProduct, $malTime, $crTime, $dcrtion, $status, $prPerson, $rqStatus]);
            return $id_insert;
            
    	}


        public function insertProcess_step1($rqId, $category) {
            $sql = "SELECT user.Id, user.Email  
            FROM category INNER JOIN user
            ON category.ResponsibleUserId1 = user.Id
            WHERE category.Id = ?";

            $result = $this->SelectSingle($sql, [$category]);
            $sql1 = "INSERT INTO processing(RequestId,ResponsibleStaff) VALUES(?,?)";
            $id_insert = $this->Insert($sql1, [$rqId, $result['Id']]);

            return $result['Email'];
        }
        
    }