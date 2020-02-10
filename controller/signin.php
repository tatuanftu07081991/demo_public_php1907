<?php	
    session_start();
    require_once 'user.php';

	    $UserName = $_POST['UserName'];
	    $Password = $_POST['Password'];
	    if($UserName && $Password){
	        $user = new userCtrl($UserName, $Password);
	        $_SESSION['user'] = $user->login($UserName, $Password);
	        if($_SESSION['user']) {
            	$_SESSION['error'] = '';
            	Header('Location: ../index.php');
            }   else {
            	$_SESSION['error'] = "User and pass is not available";
            	header('Location: ../signin');
            } 
	    }
	    else {
	    	$_SESSION['error'] = "Fill the infor of user and pass";
	    	header('Location: ../signin');
	    }
?>