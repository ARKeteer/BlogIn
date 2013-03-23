<?php
	
	// Clean user class!
	// Original file is messed up so much!
	
	class Auth {
		
		/* Properties of this class */
		// Site key : Random key used for hashing password.
		private $_siteKey;
		// MySQLi connection parameter
		private $_con;
		// Temp string for storing SQL queries
		private $_sqltemp;
		// Temp variable for storing SQL query results.
		private $_selection;
		// Temp variable used for random string
		private $_temp;
		
		/* Function that returns random string(?) */
		private function randomString() {
			$rand=md5(microtime(true));
			return $rand;
		}
		
		/* Constructor : Duties are Initialize siteKey, initialize MySQLi connection */
		public function __construct()
		{
			$this->siteKey = 'snqlw2emaAasAsamxkLaQakAA';
			$this->con=mysqli_connect('localhost','root','','blogin');
			
			// Check connection
			if (mysqli_connect_errno($this->con))
			{
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			if(!isset($_SESSION)) 
			{ 
				session_start(); 
			}
		}
		
		/* Using hash_hmac and sha512 algo this will hash data */
		protected function hashData($data)
    	{
			return hash_hmac('sha512', $data, $this->_siteKey);
		}
		
		/* Used for signup page */
		public function createUser($name, $email, $password)
		{			
			$user_salt = $this->randomString();
			$password = $user_salt . $password;
			$password = $this->hashData($password);
			//$code = $this->randomString();
			$this->sqltemp="INSERT INTO users (fname, email, password, user_salt) VALUES ('".mysql_real_escape_string($name)."','".mysql_real_escape_string($email)."','".mysql_real_escape_string($password)."','".mysql_real_escape_string($user_salt)."')";
			$created = mysqli_query($this->con,$this->sqltemp);
			if($created != false){
				return true;
			}
			return false;
		}
		
		public function login($email, $password)
		{
			$this->sqltemp = "SELECT * FROM users where email = '".mysql_real_escape_string($email)."';";
			
			$this->selection = mysqli_fetch_array(mysqli_query($this->con,$this->sqltemp));
			
			$password = $this->selection['user_salt'] . $password;
			$password = $this->hashData($password);
			$match=false;	
			//Check email and password hash match database row
			if($email = $this->selection['email'] AND $password = $this->selection['password']) {
				$match=true;
			}
				
			if($match == true) {
				
				//Email/Password combination exists, set sessions
				//First, generate a random string.
				$random = $this->randomString();
				
				//Build the token
				$token = $_SERVER['HTTP_USER_AGENT'] . $random;
				$token = $this->hashData($token);
				//Setup sessions vars
				session_start();
				$_SESSION['token'] = $token;
				$_SESSION['user_id'] = $this->selection['id'];
					
				//Delete old logged_in_member records for user
				$this->sqltemp="DELETE FROM logged_in_member WHERE session_id='".session_id()."';";
				$inserted=mysqli_query($this->con,$this->sqltemp);
				
				//Insert new logged_in_member record for user
				$this->sqltemp="INSERT INTO logged_in_member (user_id, session_id, token) VALUES (".$this->selection['id'].",'".session_id()."','".mysql_real_escape_string($token)."');";
				$inserted = mysqli_query($this->con,$this->sqltemp);
				
				//Logged in
				if($inserted != false) {
					return true;
				} 
			}
			return false;
		}
		
		public function checkSession()
		{
			//Select the row
			$this->sqltemp="SELECT * FROM logged_in_member WHERE session_id='".session_id()."';";
			mysql_connect('localhost','root','');
			mysql_select_db('blogin');
			$select =  mysql_fetch_array(mysql_query($this->sqltemp));
			mysql_close();
			if($select) {
				//Check ID and Token
				if(session_id() == $select['session_id'] && $_SESSION['token'] == $select['token']) {
					return 1;
				}
			}
			return 0;
		}
		
		public function getUID() {
			$this->sqltemp="SELECT user_id FROM logged_in_member WHERE session_id='".session_id()."';";
			$this->temp=mysqli_query($this->con,$this->sqltemp);
			$this->selection=mysqli_fetch_row($this->temp);
			return $this->selection[0];
		}
		
		public function getUIDbyEmail($email) {
			$this->sqltemp="SELECT id FROM users WHERE email='".mysql_real_escape_string($email)."';";
			$this->temp=mysqli_query($this->con,$this->sqltemp);
			$this->selection=mysqli_fetch_row($this->temp);
			return $this->selection[0];
		}
		
		public function getUser() {
			$this->sqltemp="SELECT user_id FROM logged_in_member WHERE session_id='".session_id()."';";
			$this->temp=mysqli_query($this->con,$this->sqltemp);
			$this->selection=mysqli_fetch_row($this->temp);
			$this->sqltemp="SELECT fname FROM users WHERE id=".$this->selection[0].";";
			$this->temp=mysqli_query($this->con,$this->sqltemp);
			$this->selection=mysqli_fetch_row($this->temp);
			return $this->selection[0];
		}
		
		public function getUserbyID($uid) {
			$this->sqltemp="SELECT fname FROM users WHERE id=".mysql_real_escape_string($uid).";";
			$this->temp=mysqli_query($this->con,$this->sqltemp);
			$this->selection=mysqli_fetch_row($this->temp);
			return $this->selection[0];
		}
		
		public function getUserObj($uid) {
			$this->sqltemp="SELECT fname FROM users WHERE id=".mysql_real_escape_string($uid).";";
			$this->temp=mysqli_query($this->con,$this->sqltemp);
			return $this->temp;
		}
		
		public function getLname() {
			$this->sqltemp="SELECT user_id FROM logged_in_member WHERE session_id='".session_id()."';";
			$this->temp=mysqli_query($this->con,$this->sqltemp);
			$this->selection=mysqli_fetch_row($this->temp);
			$this->sqltemp="SELECT lname FROM users WHERE id=".$this->selection[0].";";
			$this->temp=mysqli_query($this->con,$this->sqltemp);
			$this->selection=mysqli_fetch_row($this->temp);
			return $this->selection[0];
		}
		
		public function getLnamebyID($uid) {
			$this->sqltemp="SELECT lname FROM users WHERE id=".mysql_real_escape_string($uid).";";
			$this->temp=mysqli_query($this->con,$this->sqltemp);
			$this->selection=mysqli_fetch_row($this->temp);
			return $this->selection[0];
		}
		
		public function getFullName($uid) {
			return $this->getLnamebyID($uid)." ".$this->getUserbyID($uid);
		}
		
		public function getEmail() {
			$this->sqltemp="SELECT user_id FROM logged_in_member WHERE session_id='".session_id()."';";
			$this->temp=mysqli_query($this->con,$this->sqltemp);
			$this->selection=mysqli_fetch_row($this->temp);
			$this->sqltemp="SELECT email FROM users WHERE id=".$this->selection[0].";";
			$this->temp=mysqli_query($this->con,$this->sqltemp);
			$this->selection=mysqli_fetch_row($this->temp);
			return $this->selection[0];
		}
		
		public function getBio() {
			$this->sqltemp="SELECT user_id FROM logged_in_member WHERE session_id='".session_id()."';";
			$this->temp=mysqli_query($this->con,$this->sqltemp);
			$this->selection=mysqli_fetch_row($this->temp);
			$this->sqltemp="SELECT biography FROM users WHERE id=".$this->selection[0].";";
			$this->temp=mysqli_query($this->con,$this->sqltemp);
			$this->selection=mysqli_fetch_row($this->temp);
			return $this->selection[0];
		}
		
		public function setfname($newname) {
			$this->sqltemp="SELECT user_id FROM logged_in_member WHERE session_id='".session_id()."';";
			$this->temp=mysqli_query($this->con,$this->sqltemp);
			$this->selection=mysqli_fetch_row($this->temp);
			$this->sqltemp="UPDATE users SET fname='".mysql_real_escape_string($newname)."' WHERE id = '".$this->selection[0]."';";
			$this->temp=mysqli_query($this->con,$this->sqltemp);
			return $this->temp;
		}
		
		public function setlname($newname) {
			$this->sqltemp="SELECT user_id FROM logged_in_member WHERE session_id='".session_id()."';";
			$this->temp=mysqli_query($this->con,$this->sqltemp);
			$this->selection=mysqli_fetch_row($this->temp);
			$this->sqltemp="UPDATE users SET lname='".$newname."' WHERE id = '".$this->selection[0]."';";
			$this->temp=mysqli_query($this->con,$this->sqltemp);
			return $this->temp;
		}

		public function setemail($newname) {
			$this->sqltemp="SELECT user_id FROM logged_in_member WHERE session_id='".session_id()."';";
			$this->temp=mysqli_query($this->con,$this->sqltemp);
			$this->selection=mysqli_fetch_row($this->temp);
			$this->sqltemp="UPDATE users SET email='".$newname."' WHERE id = '".$this->selection[0]."';";
			$this->temp=mysqli_query($this->con,$this->sqltemp);
			return $this->temp;
		}

		public function setbio($newname) {
			$this->sqltemp="SELECT user_id FROM logged_in_member WHERE session_id='".session_id()."';";
			$this->temp=mysqli_query($this->con,$this->sqltemp);
			$this->selection=mysqli_fetch_row($this->temp);
			$this->sqltemp="UPDATE users SET biography='".$newname."' WHERE id = '".$this->selection[0]."';";
			$this->temp=mysqli_query($this->con,$this->sqltemp);
			return $this->temp;
		}

		public function setpasswd($newpwd) {
			$this->sqltemp="SELECT user_id FROM logged_in_member WHERE session_id='".session_id()."';";
			$this->temp=mysqli_query($this->con,$this->sqltemp);
			$this->selection=mysqli_fetch_row($this->temp);
			$this->sqltemp = "SELECT * FROM users where id = '".$this->selection[0]."';";			
			$this->selection = mysqli_fetch_array(mysqli_query($this->con,$this->sqltemp));
			$password = $this->selection['user_salt'] . $newpwd;
			$password = $this->hashData($password);
			$this->sqltemp="UPDATE users SET password='".mysql_real_escape_string($password)."' WHERE id = '".$this->selection['id']."';";
			$this->temp=mysqli_query($this->con,$this->sqltemp);
			return $this->temp;
		}
		
		public function setquestion($quest,$ans) {
			$this->sqltemp="UPDATE users SET question='".mysql_real_escape_string($quest)."', answer='".mysql_real_escape_string($ans)."' WHERE id='".$this->getUID()."'";
			$this->temp=mysqli_query($this->con,$this->sqltemp);
			return $this->temp;
		}
		
		public function getQuest($email) {
			$this->sqltemp="SELECT question FROM users WHERE email='".mysql_real_escape_string($email)."';";
			$this->temp=mysqli_query($this->con,$this->sqltemp);
			$this->selection=mysqli_fetch_array($this->temp);
			return $this->selection[0];
		}
		
		public function getAns($email) {
			$this->sqltemp="SELECT answer FROM users WHERE email='".mysql_real_escape_string($email)."';";
			$this->temp=mysqli_query($this->con,$this->sqltemp);
			$this->selection=mysqli_fetch_array($this->temp);
			return $this->selection[0];
		}
		
		public function recoverpasswd($email,$newpwd) {
			$this->sqltemp = "SELECT * FROM users where email = '".mysql_real_escape_string($email)."';";			
			$this->selection = mysqli_fetch_array(mysqli_query($this->con,$this->sqltemp));
			$password = $this->selection['user_salt'] . $newpwd;
			$password = $this->hashData($password);
			$this->sqltemp="UPDATE users SET password='".mysql_real_escape_string($password)."' WHERE email = '".mysql_real_escape_string($email)."';";
			$this->temp=mysqli_query($this->con,$this->sqltemp);
			return $this->temp;
		}
	}
?>