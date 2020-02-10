<?php

	$_DOMAIN = 'http://'.$_SERVER['HTTP_HOST'].'/175em/';
	// Require header
	require_once 'core/session.php';
	require_once 'includes/header.php';
	require_once 'view/nav.php';
	

	//Signin
	if (isset($_SESSION['user']) && $_SESSION['user']==true)
	{
		echo 	'
        		<div class="row">';
		 			require_once 'view/sidebar.php';
					require_once 'controller/controller.php';
				echo '</div>';
	}
	// Nếu không đăng nhập
	else
	{
		require_once 'controller/controller.php';	    
	}
	require_once 'controller/controller.php'; 
	//Require footer
	require_once 'includes/footer.php'; 
?>

