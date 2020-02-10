<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/175em/oop/db.php';

 class Process extends Db {
 	public function __construct()
        {
            parent::__construct();
        }

    public function update_Pw($i){
		$sql = "UPDATE user 
		            SET Password = ?
		            WHERE Id = ?";
		$this->Update($sql, [password_hash("123456", PASSWORD_BCRYPT), $i]);
	}
}

$Pw = new Process;
for ($i=1; $i < 195 ; $i++) { 
	$Pw->update_Pw($i);
}
