<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/175em/model/generalData.php';
// code xử lý phần tỉnh thành phố update từ bảng generalData.php để chuyển dữ liệu sang view/insertCompany.php
$provinceList = new AdressName();

$ProvinceNameList = $provinceList->getAsList1('provinceName');

//code xử lý query khi submit
if(isset($_POST['btnSubmit'])) {

	$providerName = $_POST['providerName'];
	$providerCode = $_POST['providerCode'];
	if($providerCode && $providerName) {
		$sql = "SELECT * FROM company WHERE Code=?";
		$db->setQuery($sql);
		$db->executeSQL([$providerCode]);
		//var_dump($db->executeSQL([$providerCode]));
		if($db->loadRecord() > 0){
			$infor = 'USER EXIST';
			//var_dump($db->loadRow([$providerCode]));
		} else {
			$sql = "INSERT INTO company(Code,Name) VALUES(?,?)";
			$db->setQuery($sql);
			$db->executeSQL([$providerCode,$providerName]);
			$infor = "Provider Created";
		}
	} else {
		header('Location: index.php');
	}
}
require_once 'view/insertCompany.php';