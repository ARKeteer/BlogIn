<?php
	
	require_once('UserClass.php');
	require_once('PostClass.php');
	require_once('UserClass.php');
	
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
		
		public function deleteComment($comment_id) {
			$this->sqltemp="DELETE FROM `blogin`.`comments` WHERE `comments`.`comment_id` = ".$comment_id.";";
			$result=mysqli_query($this->con,$this->sqltemp);
			return $result;
		}
		
		public function getComments($postid) {
			$this->sqltemp="SELECT * FROM `blogin`.`comments` WHERE `comments`.`parent_post`=".mysql_real_escape_string($postid).";";
			$this->selection=mysqli_query($this->con,$this->sqltemp);
			return $this->selection;
		}
		
		public function getComment($c_id) {
			$this->sqltemp="SELECT * FROM `blogin`.`comments` WHERE `comments`.`comment_id`=".mysql_real_escape_string($postid).";";
			$this->selection=mysqli_query($this->con,$this->sqltemp);
			return $this->selection;
		}
		
		public function voteup($commentid) {
			$result=$this->getComment($c_id);
			$this->temp=mysql_fetch_array($result);
			$temp=$this->temp['marked_up']+1;
			$this->sqltemp="UPDATE `blogin`.`comments` SET `marked_up`=".$temp." WHERE `comments`.`comment_id`=".$c_id.";";
			$result=mysqli_query($this->con,$this->sqltemp);
			return $result;
		}
		
		public function votedown($commentid) {
			$result=$this->getComment($c_id);
			$this->temp=mysql_fetch_array($result);
			$temp=$this->temp['marked_down']+1;
			$this->sqltemp="UPDATE `blogin`.`comments` SET `marked_down`=".$temp." WHERE `comments`.`comment_id`=".$c_id.";";
			$result=mysqli_query($this->con,$this->sqltemp);
			return $result;
		}
	}
	
?>