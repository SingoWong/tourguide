<?php
class Mobile extends CI_Controller {

    function __construct() {
        parent::__construct();
    }
    
    public function login() {
        $role = $this->input->get('role');
        
        if ($role == ROLE_ID_GUIDE) {
            $title = '導遊登陸';
            $url_forgot = url('mobile/guide_forgot');
        } elseif ($role == ROLE_ID_RESTAURANT) {
            $title = '餐廳登陸';
            $url_forgot = url('mobile/restaurant_forgot');
        } elseif ($role == ROLE_ID_HOTEL) {
            $title = '飯店登陸';
            $url_forgot = url('mobile/hotel_forgot');
        }
        
        $this->smarty->assign('title', $title);
        $this->smarty->assign('url_do_login', url('mobile/do_login'));
        $this->smarty->assign('url_services', url('mobile/services'));
        $this->smarty->assign('url_policy', url('mobile/policy'));
        $this->smarty->assign('url_forgot_guide', $url_forgot);
        $this->smarty->display('./mobile/login.html');
    }
    
    public function do_login() {
        $this->load->model('Users_Model');
        
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        
        $user = new Users_Model();
        $re = $user->login($username, $password);
        
        if ($re['result'] == '1') {
            redirect($re['default_url']);
        } else {
            alert($re['msg'], url('mobile/login'));
        }
    }
    
    public function guide_forgot() {

        $this->smarty->display('./guide/forgot.html');
    }
    
    public function restaurant_forgot() {

        $this->smarty->display('./restaurant/forgot.html');
    }
    
    public function hotel_forgot() {

        $this->smarty->display('./hotel/forgot.html');
    }
    
    public function services() {
        
        $this->smarty->display('./mobile/services.html');
    }
    
    public function policy() {

        $this->smarty->display('./mobile/policy.html');
    }
    
    public function secret() {
        
    }
    
    public function logout() {
        $user = new Users_Model();
        $user->logout();
    }
}
?>