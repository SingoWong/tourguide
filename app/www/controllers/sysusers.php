<?php
class SysUsers extends CI_Controller {

    function __construct() {
        parent::__construct();
    }
    
    public function login() {

        $this->smarty->assign('url_do_login', url('sysusers/do_login'));
        $this->smarty->display('sysmanager/login.html');
    }
    
    public function do_login() {
        $this->load->model('Users_Model');
        
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        $users_model = new Users_Model();
        $re = $users_model->login($username, $password);
        
        if ($re['result'] == '1') {
            redirect($re['default_url']);
        } else {
            alert($re['msg'], url('sysusers/login'));
        }
    }
    
    public function logout() {
        $this->load->model('Users_Model');
        
        $user = new Users_Model();
        $user->logout();
        
        redirect(url('sysusers/login'));
    }
}
?>