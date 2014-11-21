<?php
class Users_Model extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}

	/**
	 * @deprecated
	 */
	function getUsers() {
		$user = new Users();
		$user = $user->get();
		
		return $user->all;
	}
	
	function stop($uid) {
	
	}
	
	function active($uid) {
	
	}
}
?>