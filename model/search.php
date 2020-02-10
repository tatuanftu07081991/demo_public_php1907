<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/175em/oop/db.php';

    class SearchModel extends Db {
    	public function __construct()
        {
            parent::__construct();
        }
    	public function searchName($name) {    		
    		$sql = "SELECT * FROM equipment WHERE Name LIKE ? ";
            $result = $this->SelectList($sql, ["%".$name."%"]);
            return $result;
    	}

    	public function searchNameFull($name) {    		
    		$sql = "SELECT equipment.ID AS Id, equipment.Name, Category, SN, Model, Department, country.Name AS Country 
            FROM equipment INNER JOIN country
            ON equipment.Country = country.Id
            WHERE equipment.Name = ?";
            $result = $this->SelectList($sql, [$name]);
            return $result;
        }
        
    }