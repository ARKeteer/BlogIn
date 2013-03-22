<?php
	
	require_once("UserClass.php");
		
	class Blog {
		
		private $_siteKey;
		private $_con;
		private $_sqltemp;
		private $_selection;
		private $_temp;
		private $_auth;
		
		/* Function that returns random string */
		private function randomString() {
			$rand=md5(microtime(true));
			return $rand;
		}
		
		public function __construct() {
			
			$this->auth=new Auth();
			$this->siteKey = 'snqlw2emaAasAsamxkLaQakAA';
			$this->con=mysqli_connect('localhost','root','','blogin');
			
			// Check connection
			if (mysqli_connect_errno($this->con))
			{
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			
		}
		
		/* Used to create a new blog */
		public function createNew($blogname,$layout,$about) {
			$blog_salt=$this->randomString();
			$this->sqltemp="INSERT INTO blogs (b_name,b_layout,blogger_id,description,blog_salt) VALUES('".mysql_real_escape_string($blogname)."',".mysql_real_escape_string($layout).",".$this->auth->getUID().",'".mysql_real_escape_string($about)."','".mysql_real_escape_string($blog_salt)."');";
			$result=mysqli_query($this->con,$this->sqltemp);
			return $result;
		}
		
		/* Used to set the name of blog */
		public function setName($newName,$blog_id) {
			$this->sqltemp="UPDATE TABLE blogs CHANGE b_name='".mysql_real_escape_string($newName)."' WHERE b_id=".mysql_real_escape_string($blog_id).";";
			$result=mysqli_query($this->con,$this->sqltemp);
			return $result;
		}
		
		/* Used to get name of blog based on id*/
		public function getName($blog_id) {
			$this->sqltemp="SELECT b_name FROM blogs WHERE b_id=".mysql_real_escape_string($blog_id).";";
			$this->selection=mysqli_fetch_array(mysqli_query($this->con,$this->sqltemp));
			return $this->selection[0];
		}
		
		public function getAbout($blog_id) {
			$this->sqltemp="SELECT description FROM blogs WHERE b_id=".mysql_real_escape_string($blog_id).";";
			$this->selection=mysqli_fetch_array(mysqli_query($this->con,$this->sqltemp));
			return $this->selection[0];
		}
				
		/* Used to get all blogs of currently logged in user*/
		public function getallblogs() {
			$uid=$this->auth->getUID();
			$this->sqltemp="SELECT b_id FROM blogs WHERE blogger_id=".mysql_real_escape_string($uid).";";
			$this->selection=mysqli_fetch_array(mysqli_query($this->con,$this->sqltemp));
			return $this->selection;
		}
		
		/* Used to remove the blog based on blog_id */
		public function deleteblog($blog_id) {
			$this->sqltemp="DELETE * FROM blogs WHERE $b_id=".mysql_real_escape_string($blog_id).";";
			$result=mysqli_query($this->con,$this->sqltemp);
			
			//TODO in next
			// 1. Delete entries from the author table based on the blog id.
			// 2. Remove entries from the posts table based on the blog id.
			// 3. Remove entries from subscribers table.
			
			return $result;
		}
		
		public function addAuthor($blog_id,$user_id) {
			$this->sqltemp="INSERT INTO authors (blog_id, author_id) VALUES(".mysql_real_escape_string($blog_id).",".mysql_real_escape_string($user_id).");";
			$result=mysqli_query($this->con,$this->sqltemp);
			return $result;
		}
		
		public function getOwnerID($blogid) {
			$this->sqltemp="SELECT `users`.`id` FROM blogs LEFT JOIN `blogin`.`users` ON `blogs`.`blogger_id` = `users`.`id` WHERE `blogs`.`b_id`=".mysql_real_escape_string($blogid).";";
			$result=mysqli_fetch_array(mysqli_query($this->con,$this->sqltemp));
			return $result[0];
		}
		
		public function getOwnerName($blogid) {
			$this->sqltemp="SELECT `users`.`fname` FROM blogs LEFT JOIN `blogin`.`users` ON `blogs`.`blogger_id` = `users`.`id` WHERE `blogs`.`b_id`=".mysql_real_escape_string($blogid).";";
			$result=mysqli_fetch_array(mysqli_query($this->con,$this->sqltemp));
			return $result[0];
		}
	
		public function isAuthor($uid,$blog_id) {
			ob_start();
			$this->sqltemp="SELECT `authors`.`author_id` FROM authors WHERE `blog_id`=".mysql_real_escape_string($blog_id)." AND `author_id`=".mysql_real_escape_string($uid).";";
			$result=mysqli_fetch_array(mysqli_query($this->con,$this->sqltemp));
			if(is_null($result)) {
				ob_end_clean();
				return false;
			}
			ob_end_clean();
			return true;
		}
		
		public function search($searchterm) {
			$this->sqltemp="SELECT`b_id`,`b_name`,`description` FROM `blogs` WHERE `b_name` LIKE '%".mysql_real_escape_string($searchterm)."%' OR `description` LIKE '%".mysql_real_escape_string($searchterm)."%';";
			echo $this->sqltemp."<br>";
			$this->selection=mysqli_query($this->con,$this->sqltemp);
			return $this->selection;
		}
		
	}
		
?>