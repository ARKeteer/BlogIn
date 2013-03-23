<?php
require_once('../includes/BlogClass.php');
class BlogConfig {
	private $_blog;
	
	public function __construct() {
		$this->blog=new Blog();
	}
	public function  getBid() {
		$str=$_SERVER["REQUEST_URI"];
		$arr=explode("/",$str);
		$blogid=urldecode($arr[1]);
		return $blogid;
	}
}
?>