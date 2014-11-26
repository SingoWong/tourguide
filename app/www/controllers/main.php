<?php
class Main extends CI_Controller {

	function __construct() {
		parent::__construct();
	}
	
	/**
	 * 主菜单
	 */
	public function index() {
	    $this->load->helper('url');
	    
	    $this->smarty->assign( 'url_guide', url('guide/index') );
	    $this->smarty->assign( 'url_restaurant', url('restaurant/index') );
	    $this->smarty->assign( 'url_hotel', url('hotel/index') );
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