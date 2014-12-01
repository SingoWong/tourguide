<?php
class Base_Controller extends CI_Controller {
    
    public $user;
    
    public $role;
    
    public $logined;

    function __construct() {
        parent::__construct();
        
        $this->_init_userinfo();
        $this->_init_cview();
    }
    
    function check_belogin() {
        if (!$this->logined) {
            redirect(url('sysusers/login'));
        }
    }
    
    function check_felogin($role) {
        if (!$this->logined || $this->role['id'] != $role) {
            redirect(url('mobile/login').'&role='.$role);
        }
    }
    
    private function _init_userinfo() {
        $this->load->library('session');

        $rbac_user = $this->session->userdata(SKEY_RBAC_USER);
        $rbac_role = $this->session->userdata(SKEY_RBAC_ROLE);
        
        if (!$rbac_user['id'] || $rbac_user['id'] == '') {
            $this->logined = FALSE;
        } else {
            
            $this->user['id'] = $rbac_user['id'];
            $this->user['name'] = $rbac_user['name'];
            
            $this->role['id'] = $rbac_role['id'];
            $this->role['name'] = $rbac_role['name'];
            
            $this->logined = TRUE;
        }
    }
    
    private function _init_cview() {
        $this->smarty->assign('RBAC_USER_ID', $this->user['id']);
        $this->smarty->assign('RBAC_USER_NAME', $this->user['name']);
        
        $this->smarty->assign('RBAC_ROLE_ID', $this->role['id']);
        $this->smarty->assign('RBAC_ROLE_NAME', $this->role['name']);
    }
}
?>