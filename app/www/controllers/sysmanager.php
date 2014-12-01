<?php
class SysManager extends Base_Controller {
	
	function __construct() {
		parent::__construct();
		
        $this->check_belogin();
	}

	public function main() {
		$this->smarty->display('sysmanager/main.html');
	}
}