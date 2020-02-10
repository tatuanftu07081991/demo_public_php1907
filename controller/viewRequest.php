<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/175em/model/viewRequest.php';

class RequestCtrl extends viewRequest {

	public function __construct()
        {
            parent::__construct();
        }

	public function requestList($id, $type, $page, $limit){		
			$start = ($page - 1) * $limit;
			return $this->getRequestList($id, $type, $start, $limit);
	}

	public function requestCount($id, $type){
			return $this->getCountRequest($id, $type);		
	}
}
?>