<?php
if(isset($_GET['ac'])){
    include_once 'view/'.$_GET['ac'].'.php';
} else {
    if(isset($data_user['UserType'])) {
        switch ($data_user['UserType']) {
            case 1:
                include_once 'view/userType1.php';
                break;
            
            case 2:
                include_once 'view/userType2.php';
                break;

            default:
                include_once 'view/userType3.php';
                break;
        }
    }else {
            
            include_once 'view/userType1.php';
            include_once 'view/userType2.php';
            include_once 'view/userType3.php';
        }

}