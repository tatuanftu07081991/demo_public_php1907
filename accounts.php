<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/175em/controller/user.php';

$action = trim(addslashes(htmlspecialchars($_POST['action'])));

if($action == 'lock_acc') {
	$id_acc = trim(addslashes(htmlspecialchars($_POST['id_acc'])));
	$user = new userCtrl;
	$user->SetLock($id_acc);
	
} else if($action == 'active_acc')  {
	$id_acc = trim(addslashes(htmlspecialchars($_POST['id_acc'])));
	$user = new userCtrl;
	$user->SetActive($id_acc);
	// password_hash(string, PASSWORD_BCRYPT);
	// password_verify(password, hash)
}

?>