<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/175em/model/pagination.php';

class PaginationCtrl extends PaginationModel {
	
	public function List($tableName, $page,$limit){
			parent::__construct($tableName, ($page - 1)*$limit, $limit);
			return $this->getList();
	}

	public function Count(){
			return $this->getCount();			
	}
}