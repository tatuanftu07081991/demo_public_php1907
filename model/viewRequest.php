<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/175em/oop/db.php';

    class viewRequest extends Db {

    	public function __construct()
        {
            parent::__construct();
        }

    	// public function searchRequest($id) {            
     //        $sql = "SELECT * FROM request WHERE ProposedBy = ? ";
     //        $result = $this->SelectList($sql, [$id]);
     //        return $result;
     //    }

     //    public function searchRq($id) {

     //        $sql = "SELECT request.Id,request.RequestStatus,request.TimeOfMalfunction AS MalTime, request.Status, request.Discription, equipment.Name AS NameEq, department.Name AS NameDp
     //        FROM request 
     //        INNER JOIN processing ON request.Id = processing.RequestId
     //        INNER JOIN equipment ON request.Equipment = equipment.Id
     //        INNER JOIN department ON request.Department = department.Id
     //        WHERE processing.ResponsibleStaff = ?";
     //        $result = $this->SelectList($sql, [$id]);
     //        return $result;
     //    }

        public function getCountRequest($id, $type){
            // nếu userType là hình thức phòng ban gửi request nhờ sửa chữa
            if ($type == 2) {
                $sql = "SELECT * FROM request
                WHERE ProposedBy = ?";
                $result = $this->countRecord($sql,[$id]);
                return $result;
            } 
            // nếu userType là kỹ sư sửa chữa
            else if($type == 1) {
                $sql = "SELECT request.Id,request.RequestStatus,request.TimeOfMalfunction AS MalTime, request.Status, request.Discription, equipment.Name AS NameEq, department.Name AS NameDp
                FROM request 
                INNER JOIN processing ON request.Id = processing.RequestId
                INNER JOIN equipment ON request.Equipment = equipment.Id
                INNER JOIN department ON request.Department = department.Id
                WHERE processing.ResponsibleStaff = ?";

                $result = $this->countRecord($sql, [$id]);
                return $result;
            }
            
        }

        public function getRequestList($id, $type, $start, $limit){
            if ($type == 2) {
                $sql = "SELECT request.Id,request.RequestStatus,request.TimeOfMalfunction AS MalTime, request.Status, request.Discription, equipment.Name AS NameEq, department.Name AS NameDp 
                FROM request 
                INNER JOIN equipment ON request.Equipment = equipment.Id
                INNER JOIN department ON request.Department = department.Id
                WHERE ProposedBy = ?
                ORDER BY Id ASC LIMIT ?, ?";
                $result = $this->SelectList($sql, [$id, $start, $limit]);
                return $result;
            } 
            else if($type == 1) {
                $sql = "SELECT request.Id,request.RequestStatus,request.TimeOfMalfunction AS MalTime, request.Status, request.Discription, equipment.Name AS NameEq, department.Name AS NameDp
                
                FROM request 
                INNER JOIN processing ON request.Id = processing.RequestId
                INNER JOIN equipment ON request.Equipment = equipment.Id
                INNER JOIN department ON request.Department = department.Id
                WHERE processing.ResponsibleStaff = ?
                ORDER BY Id ASC LIMIT ?, ?";
                $result = $this->SelectList($sql, [$id, $start, $limit]);
                return $result;
            }
        }


    }