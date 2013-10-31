<?php
session_start();
if(!isset($_SESSION['email'])) {
	if(isset($_COOKIE['email'])) {
	  $_SESSION['email'] = $_COOKIE['email'];
	  $_SESSION['name'] = $_COOKIE['name'];
	}
	else {
		header('Location: login.php');
	}
 }
if($_SESSION['email']=='admin') {
	header('Location: admin.php');
}
else {
	require_once('includes/head.php');
	require_once('includes/news.php');
	echo '<div id="right_column">';
	require_once('includes/slider.php');
	require_once('includes/main_news.php');
	echo '</div><!--end right_column-->';
	


	require_once('includes/footer.php');
}//end else
?>