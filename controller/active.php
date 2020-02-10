<?php
require_once 'user.php';

$id = $_GET['id'];
$code = $_GET['code'];

$user = new userCtrl;
$result = implode("", $user->CodeActive($id));

if($result == $code) {
	$user->SetActive($id);
	echo "Tài khoản của bạn đã được kích hoạt";
} else {
	echo "Chuoi nhap sai";
}
?>
