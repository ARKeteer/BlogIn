<?php
	require_once('includes/UserClass.php');
	$auth=new Auth();
	$auth->logout();
	header("Location: /index.php");
	exit;
?>