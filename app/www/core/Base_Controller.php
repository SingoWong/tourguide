<?php
class Base_Controller extends CI_Controller {
    
    public $user;
    
    public $role;

    function __construct() {
        parent::__construct();
        
        $this->_init_userinfo();
        $this->_init_cview();
    }
    
    private function _init_userinfo() {
        $this->user['id'] = 22;
        $this->user['name'] = '南湖国旅';
        
        $this->role['id'] = 31;
        $this->role['name'] = '旅行社';
    }
    
    private function _init_cview() {
        $this->smarty->assign('RBAC_USER_ID', $this->user['id']);
        $this->smarty->assign('RBAC_USER_NAME', $this->user['name']);
        
        $this->smarty->assign('RBAC_ROLE_ID', $this->role['id']);
        $this->smarty->assign('RBAC_ROLE_NAME', $this->role['name']);
    }
}
?>