<?php
class Main extends CI_Controller {

	function __construct() {
		parent::__construct();
	}
	
	/**
	 * 主菜单
	 */
	public function index() {
	    $this->smarty->display('./mobile/menu.html');
	}
	
	/**
	 * 隐私权政策
	 */
	public function policy() {
	    $this->smarty->display('./mobile/policy.html');
	}
	
	/**
	 * 服务条款
	 */
	public function services() {
	    $this->smarty->display('./mobile/services.html');
	}
}