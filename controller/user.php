<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/175em/model/user.php';

class UserCtrl extends UserModel {

	public function login($UserName, $Password){
			parent::__construct($UserName, $Password);            
			return $this->loginVerify();  
					
	}

	public function signUp($UserName, $Password,$FullName, $Title, $DpId, $Email, $UserType, $Phone, $Phone1){
			parent::__construct($UserName, $Password,$FullName, $Title, $DpId, $Email, $UserType, $Phone, $Phone1);  

			return $this->signUpVerify();      
	}

	public function editInfo($UserName, $Password,$FullName, $Title, $DpId, $Email, $UserType, $Phone, $Phone1) {
			parent::__construct($UserName, $Password,$FullName, $Title, $DpId, $Email, $UserType, $Phone, $Phone1);
			$result = $this->editInfomation();
			return "Success";
	}
	

	public function userList($page,$limit){
			parent::__construct(($page - 1)*$limit, $limit);
			return $this->getUserList();
	}

	public function userCount(){
			return $this->getCountUser();
			
	}

	public function CodeActive($id){
			return $this->GetCodeActive($id);
	}

	public function SetActive($id)
	{
			return $this->SetActiveCode($id);
	}

	public function SetLock($id)
	{
			return $this->SetLockCode($id);
	}
	

}

class validateFrom {
	public function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	public function is_username($username) {
	    $parttern = "/^[A-Za-z0-9_\.]{6,32}$/";
	    if (preg_match($parttern, $username))
	        return true;
	}

	function is_password($password) {
	    $parttern = "/^[a-z0-9_-]{5,18}$/";
	    if (preg_match($parttern, $password))
	        return true;
	}

	function is_email($email) {
	    $parttern = "/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/";
	    if (preg_match($parttern, $email))
	        return true;
	}

}

class changePwCtrl extends changePwModel
{        
	function changePw($PwNew, $Id)
	{
			parent::__construct($PwNew, $Id);
			$result = $this->updatePw();
			return "COMPLETE";
	}
}
?>