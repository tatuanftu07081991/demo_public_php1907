<?php
	session_start();
    require_once 'user.php';
    var_dump($_SESSION['user']);
        $PwOld = $_POST['PwOld'];
        $PwNew = $_POST['PwNew'];
        $RePw = $_POST['RePw'];

        if($PwOld && $PwNew && $RePw){

            if (password_verify($PwOld, $_SESSION['user']['Password'])){
                if($PwNew == $RePw) {
                    $Pw = new changePwCtrl($PwNew, $_SESSION['user']['Id']);
                    $_SESSION['error'] = $Pw->changePw($PwNew, $_SESSION['user']['Id']);
                    $_SESSION['user']['Password'] = $PwNew;

                } else {
                    $_SESSION['error'] = "Password nhập lại sai";
                }
            } else {
                $_SESSION['error'] = "Nhập password cũ sai";
            }
        }
        else $_SESSION['error'] = "Xin hãy nhập đầy đủ thông tin";

        header('Location: ../changePW');
?>