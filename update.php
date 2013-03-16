<?php
	require_once("includes/UserClass.php");
	$auth=new Auth();
	if(isset($_POST['fname'])) {
		$auth->setfname($_POST['fname']);
	}
	if(isset($_POST['lname'])) {
		$auth->setlname($_POST['lname']);
	}
	if(isset($_POST['email'])) {
		$auth->setemail($_POST['email']);
	}
	if(isset($_POST['password'])) {
		$auth->setpasswd($_POST['password']);
	}
	if(isset($_POST['bio'])) {
		$auth->setbio($_POST['bio']);
	}
	header("Location: profile.php?done=1");	
?>