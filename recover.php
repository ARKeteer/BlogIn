<?php
	//ob_start();
	require_once('includes/UserClass.php');
	$auth=new Auth();
	if($auth->getAns(mysql_real_escape_string($_POST['email'])) == $_POST['answer'] ) {
			$result=$auth->recoverpasswd(mysql_real_escape_string($_POST['email']),mysql_real_escape_string($_POST['password']));
			if($result==true) {
				header("Location: index.php?login=1");
				exit;
			}
			header("Location: index.php?logfail=1");
		}
ob_end_clean();
?>