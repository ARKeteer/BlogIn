<?php
	require_once('includes/UserClass.php');
	require_once('includes/BlogClass.php');
	require_once('includes/PostClass.php');
	
	echo "Welcome to sandboxed Testing console of Blogin.... <br>";
	echo "This page will not provide UI so that you can easily test out your php codes <br>";
	echo "Edit me and see change in output <br><br>";
	echo "Now lets try to add a new author in our blog.<br>";
	$blog=new Blog();
	$auth=new Auth();
	$post=new Post();
	
	$blog->createNew("dshjkhs",2,"jdsbnkjjksb sbhfkjsbkfjhsk kshfhs");
	/*
	//if($auth->getUID() == $blog->getOwner())
	$result=$blog->addAuthor(6,$auth->getUIDbyEmail("aazam@gmail.com"));
	echo $blog->getOwnerID(9)."<br>";
	echo $blog->getOwnerName(9)."<br>";
	if(!$result) {
		echo "Wah!<br>";
	}
	$result=$blog->isAuthor(10,6);
	if($result) {
		echo "Done! Now checking with wrong collection<br>";
	}
	
	$result=$blog->isAuthor(10,5);
	if(!$result) {
		echo "Done! Wow this project rocks!<br>";
	}
	
	echo $auth->getQuest(mysql_real_escape_string("bhush94@gmail.com"))."<br>";
	
	echo "<br><br>".$post->getpostdata(1)."<br><br>"."<br><br>";
	echo $post->getPostDate(1)." ".$post->getPostTime(1)."<br>";
	echo $post->getAuthor(1)."<br>";
	echo $auth->getFullName(12); 
	echo $post->updatePost("TITLEPAGE","LOREM IPSUM DOLLAR SIT AMET",11);
	
	
	$result=$blog->search("blog");
	
	$result=$post->getposts(6);
	while($row = mysqli_fetch_array($result))
			{
				echo $row['post_title']."<br><br>";
				echo $row['post_data']."<br><br>";
			}
	
	*/
	
	exit;
	
?>