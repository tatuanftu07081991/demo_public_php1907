<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/175em/oop/db.php';

    class Process extends Db {
        
    	public function __construct()
        {
            parent::__construct();
        }

        public function update_process($timeReceive, $priority, $checkTime, $checkingStatus, $Causal, $url1, $url2, $damageLevel, $resolveType, $conclusion, $idRequest) {          
            
            $sql = "UPDATE processing 
            SET HardCopyReceived = ?, Priority = ?, CheckingTime = ?, CheckingStatus = ?, 
            CausalEstimated = ?, DamagePhoto1 = ?, DamagePhoto2 = ?, DamageLevel = ?, ResolvedType = ?, DamageConclusion = ?
            WHERE RequestId = ?";
        
            $this->Update($sql, [$timeReceive, $priority, $checkTime, $checkingStatus, $Causal, $url1, $url2, $damageLevel, $resolveType, $conclusion, $idRequest]);
            
        }

        public function update_request($id, $status) {
            $sql = "UPDATE request 
            SET RequestStatus = ?
            WHERE Id = ?";
        
            $this->Update($sql, [$status, $id]);
        }
        
    }