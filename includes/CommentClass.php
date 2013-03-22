<?php
	
	require_once('UserClass.php');
	require_once('PostClass.php');
	require_once('AuthClass.php');
	
	class Comment {
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
		
		public function createComment($comment,$parentpost) {
			$user_id=$this->auth->getUID();
			$this->sqltemp="INSERT INTO `blogin`.`comments` (`comment_data`,`parent_post`,`poster_id`) VALUES('".$comment."','".$parentpost."','".$user_id."');";
			$result=mysqli_query($this->con,$this->sqltemp);
			return $result;
		}
		
		public function updateComment($c_id,$commentdata) {
			$this->sqltemp="UPDATE `blogin`.`comments` SET `comment_data`='".$commentdata."' WHERE  `comments`.`comment_id`=".$c_id.";";
			$result=mysqli_query($this->con,$this->sqltemp);
			return $result;
		}
		
		public function deleteComment($comment_id) {
			
		}
	}
	
?>