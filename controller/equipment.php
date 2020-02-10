<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/175em/model/equipment.php';

class EqCtrl extends EqModel {
	
	public function EqList($page,$limit){
			parent::__construct(($page - 1)*$limit, $limit);
			return $this->getEqList();
	}

	public function EqCount(){
			return $this->getCountEq();			
	}
}