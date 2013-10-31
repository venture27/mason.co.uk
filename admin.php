<?php
	
	session_start();
		if(!isset($_SESSION['email'])) {
			if(isset($_COOKIE['email'])) {
				$_SESSION['email']=$_COOKIE['email'];
				$_SESSION['name']=$_COOKIE['name'];
			}
			
			else {
			header('Location: index.php');
			}
		}

		if($_SESSION['email']!='admin') {
			header('Location: userpage.php');

		} else {
			require_once('includes/head.php');
			require_once('includes/vars.php');
			require_once('includes/functions.php');
			require_once('includes/connection.php');
			require_once('includes/footer.php');
		}
			
			
		
			
		

		


?>