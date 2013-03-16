<?php
	require_once("includes/UserClass.php");
	$auth=new Auth();
	if($auth->checkSession()){
		header("Location: dashboard.php");
		exit;
	}
	if($auth->login($_POST['email'],$_POST['password'])) {
		header("Location: dashboard.php");
		exit;
	}
	else {
		header("Location: index.php?logfail=1");
		exit;
	}
?>