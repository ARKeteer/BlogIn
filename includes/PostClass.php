<?php
	require_once("UserClass.php");
	require_once("BlogClass.php");
	
	class Post {
		private $_siteKey;
		private $_con;
		private $_sqltemp;
		private $_selection;
		private $_temp;
		private $_auth;
		private $_blogobj;
		
		/* Function that returns random string */
		private function randomString() {
			$rand=md5(microtime(true));
			return $rand;
		}
		
		public function __construct() {
			$this->auth=new Auth();
			$this->blogobj=new Blog();
			$this->siteKey = 'snqlw2emaAasAsamxkLaQakAA';
			$this->con=mysqli_connect('localhost','root','','blogin');
			// Check connection
			if (mysqli_connect_errno($this->con))
			{
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
		}
		
		public function createPost($blog_id,$is_draft,$title,$postdata) {
			if($this->blogobj->getOwnerID($blog_id) == $this->auth->getUID() || $this->blogobj->isAuthor($this->auth->getUID(),$blog_id)) {
				$this->sqltemp="INSERT INTO `posts`(`post_title`,`post_data`,`is_draft`,`author`,`parent_blog`,`post_date`,`post_time`) VALUES('".mysql_real_escape_string($title)."','".mysql_real_escape_string($postdata)."',NULL,'".$this->auth->getUID()."','".mysql_real_escape_string($blog_id)."',CURRENT_DATE(),CURRENT_TIME());";
				$result=mysqli_query($this->con,$this->sqltemp);
				return $result;
			}
			return false;
		}
		
		public function getposttitle($postid) {
			$this->sqltemp="SELECT `post_title` FROM posts WHERE `post_id`=".mysql_real_escape_string($post_id);
			$result=mysqli_fetch_array(mysqli_query($this->con,$this->sqltemp));
			return $result[0];
		}
		
		public function getpost($postid) {
			$this->sqltemp="SELECT * FROM posts WHERE `post_id`=".mysql_real_escape_string($postid);
			$result=mysqli_fetch_array(mysqli_query($this->con,$this->sqltemp));
			return $result;
		}
		
		public function getPostTime($postid) {
			$this->sqltemp="SELECT `post_time` FROM posts WHERE `post_id`=".mysql_real_escape_string($post_id);
			$result=mysqli_fetch_array(mysqli_query($this->con,$this->sqltemp));
			return $result[0];
		}
		
		public function getPostDate($postid) {
			$this->sqltemp="SELECT `post_date` FROM posts WHERE `post_id`=".mysql_real_escape_string($post_id);
			$result=mysqli_fetch_array(mysqli_query($this->con,$this->sqltemp));
			return $result[0];
		}
		
		public function getAuthor($postid) {
			$this->sqltemp="SELECT `author` FROM posts WHERE `post_id`=".mysql_real_escape_string($post_id);
			$result=mysqli_fetch_array(mysqli_query($this->con,$this->sqltemp));
			return $this->auth->getFullName($result[0]);
		}
		
		public function updatePost($title,$postdata,$postid) {
			$this->sqltemp="UPDATE `blogin`.`posts` SET `post_title` = '".mysql_real_escape_string($title)."', `post_data` = '".mysql_real_escape_string($postdata)."' WHERE `posts`.`post_id` = ".mysql_real_escape_string($post_id).";";
			$result=mysqli_query($this->con,$this->sqltemp);
			return $result;
		}

		public function getposts($blogid) {
			$this->sqltemp="SELECT * FROM posts WHERE `posts`.`parent_blog`=".mysql_real_escape_string($blogid)." ORDER BY `post_date` DESC,`post_time` DESC;";
			$this->selection=mysqli_query($this->con,$this->sqltemp);
			return $this->selection;
		}
	}
?>