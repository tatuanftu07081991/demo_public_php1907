<?php 
    require_once 'classes/DB.php';
    //Nếu đang có kết nối database thì ngắt
    if(isset($db)){
        $db->__destruct();
    }

?>