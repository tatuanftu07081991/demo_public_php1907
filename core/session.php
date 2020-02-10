<?php
 require_once $_SERVER['DOCUMENT_ROOT'].'/175em/controller/infoUser.php';
 require_once $_SERVER['DOCUMENT_ROOT'].'/175em/controller/user.php';

 $_DOMAIN = 'http://'.$_SERVER['HTTP_HOST'].'/175em/';
// Require các thư viện PHP
if (empty($_SESSION))
{
	session_start();
}

date_default_timezone_set('Asia/Ho_Chi_Minh'); 
$date_current = '';
$date_current = date("Y-m-d H:i:sa");
 
// Kiểm tra session
if (isset($_SESSION['user']))
{
    if(isset($_SESSION['user']['UserType']) && $_SESSION['user']['UserType'] != 3 ) {
    	if(empty($_SESSION['user']['Department'])) {
    		$DpId = new profileCtrl($_SESSION['user']['DepartmentId']);
        	$_SESSION['user']['Department'] = $DpId->departmentName($_SESSION['user']['DepartmentId']);
    	}    	
    } else if(isset($_SESSION['user']['UserType']) && $_SESSION['user']['UserType'] == 3 ){
    	$CpnInfo = new profileCtrl($_SESSION['user']['FullName']);
        $company = $CpnInfo->companyInfo($_SESSION['user']['FullName']);
    }
    $data_user = $_SESSION['user'];
}
else
{
    $data_user = '';
}
?>