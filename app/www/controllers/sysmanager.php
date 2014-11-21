<?php
class Sysmanager extends CI_Controller {
	
	/**
	 * @var Users_Model
	 */
	var $Users_Model;
	
	function __construct()
	{
		parent::__construct();
	}

	public function main()
	{		
		$this->load->model('Users_Model');
		$users = $this->Users_Model->getUsers();

		$this->smarty->assign( 'rowset', $users );
		$this->smarty->display('sysmanager/main.html');
	}
}