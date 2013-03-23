<?php
	ob_start();
	require_once("../includes/UserClass.php");
	require_once("../includes/PostClass.php");
	require_once("../includes/BlogClass.php");
	require_once("../includes/CommentClass.php");
	require_once("config.php");
	
	$auth = new Auth();
	$post = new Post();
	$blog = new Blog();
	$comment = new Comment();
	$thisblog = new BlogConfig();
	$name=$thisblog->getBid();
	$id=$blog->getID($name);
	
	$result=$comment->createComment($_POST['comment_data'],$_POST['postid']);
	if($result) {
		ob_end_clean();
		header("Location: post.php?id=".$_POST['postid']);
		exit;
	}
?>