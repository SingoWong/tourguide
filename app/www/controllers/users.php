<?php
class Users extends CI_Controller {

    function __construct() {
        parent::__construct();
    }
    
    /**
     * 用户登录界面
     */
    public function login() {
        $type = $this->output->get('type');
        
    }
    
    /**
     * 用户登录
     */
    public function do_login() {
        
    }
    
    /**
     * 忘记密码
     */
    public function forgot() {
        
    }
}
?>