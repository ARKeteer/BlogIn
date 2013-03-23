<?php
	ob_start();
	require_once("../includes/UserClass.php");
	require_once("../includes/PostClass.php");
	require_once("../includes/BlogClass.php");
	require_once("config.php");
	
	$auth = new Auth();
	$post = new Post();
	$blog = new Blog();
	$thisblog = new BlogConfig();
	$name=$thisblog->getBid();
	$id=$blog->getID($name);
	$check=$auth->checkSession();
	if($check == 0 OR $auth->getUID() != $blog->getOwnerID($id)) {
		header("Location: /index.php");
		exit;
	}
	else {
		$result=$post->createPost($id,0,$_POST['post_title'],$_POST['post_data']);
		header("Location: posts.php");
		exit;
	}
	
	ob_end_clean();
?>