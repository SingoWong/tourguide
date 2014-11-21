<?php
class SmartyFunction {
	
	public function __construct() {
		$this->CI = &get_instance ();
	}
	
	public function init() {
		$this->smarty->register_function('url','url');
	}
	
	function url($params) {
		extract ( $params );
		$this->load->helper ( 'url' );
		
		return url ( $action );
	}
}