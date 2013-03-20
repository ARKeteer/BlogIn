<?php
	ob_start();
	require_once("includes/UserClass.php");
	require_once("includes/BlogClass.php");
	$auth = new Auth();
	$check=$auth->checkSession();
	if($check == 1) {
		if(isset($_POST['blogname'])) {
			$blog = new Blog();
			$result=$blog->createNew(mysql_real_escape_string($_POST['blogname']),mysql_real_escape_string($_POST['layout']),mysql_real_escape_string($_POST['blog_desc']));
			ob_end_clean();
			if($result == true) {
				header("Location: newblog.php");
			}
			else {
				header("Location: newblog.php?error=1");
			}
		}
	}
?>