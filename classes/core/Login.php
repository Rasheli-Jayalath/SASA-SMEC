<?php session_start(); ?>

<?php

class Login  {
	
	public static  $login_username;		

	public function __construct(){
		$this->login_username = $_SESSION["wu_uname"] ;
	}

	function get_name() {
		return $this->login_username;
	}

}