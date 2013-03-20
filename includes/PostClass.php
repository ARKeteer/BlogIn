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
		
		/* Function that returns random (Really!?) string */
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
			//Lets check if he/she is authorized to post or not?
			
			if($this->blogobj->getOwner() == $this->auth->getUID() OR $this->blogobj->isAuthor($this->auth->getUID,$blog_id)) {
				// Lets create post here
			}
		}
		
		public function getpostdata($postid) {
			
		}
		
		public function getPostTime($postid) {
			
		}
		
		public function getAuthor($postid) {
			
		}
		
		public function updatePost($blog_id,$is_draft,$title,$postdata,$postid) {
			
		}
	}
?>