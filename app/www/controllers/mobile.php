<?php
class Mobile extends Base_Controller {

    function __construct() {
        parent::__construct();
    }
    
    public function login() {
        $role = $this->input->get('role');
        
        if ($role == ROLE_ID_GUIDE) {
            $title = '導遊登陸';
            $url_forgot = url('mobile/guide_forgot');
			$dialog = '1';
        } elseif ($role == ROLE_ID_RESTAURANT) {
            $title = '餐廳登陸';
            $url_forgot = url('mobile/restaurant_forgot');
        } elseif ($role == ROLE_ID_HOTEL) {
            $title = '飯店登陸';
            $url_forgot = url('mobile/hotel_forgot');
        } elseif ($role == ROLE_ID_LEADER) {
            $title = '領隊登陸';
            $url_forgot = url('mobile/leader_forgot');
        }
        
        $this->smarty->assign('title', $title);
		$this->smarty->assign('dialog', $dialog);
        $this->smarty->assign('url_do_login', url('mobile/do_login'));
        $this->smarty->assign('url_services', url('mobile/services'));
        $this->smarty->assign('url_policy', url('mobile/policy'));
        $this->smarty->assign('url_forgot', $url_forgot);
        $this->smarty->display('./mobile/login.html');
    }
    
    public function do_login() {
        $this->load->model('Users_Model');
        
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        
        $user = new Users_Model();
        $re = $user->login($username, $password);
        
        if ($re['result'] == '1') {
        		if ($re['first'] == '1') {
        			redirect(url('mobile/first_login').'&url='.urlencode($re['default_url']));
        		} else {
        			redirect($re['default_url']);
        		}
        } else {
            alert($re['msg'], url('mobile/login'));
        }
    }
	
	public function first_login() {
		$url = $this->input->get('url');
		
		$this->smarty->assign('url_confirm', url('mobile/secret').'&url='.urlencode($url));
		$this->smarty->assign('url_cancel', url('mobile/logout'));
		$this->smarty->display('./mobile/first.html');
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
	
	public function leader_forgot() {

        $this->smarty->display('./leader/forgot.html');
	}
    
    public function services() {
        
        $this->smarty->display('./mobile/services.html');
    }
    
    public function policy() {

        $this->smarty->display('./mobile/policy.html');
    }
	
	public function resecret() {
		$this->load->model('Users_Model');

		$uid = $this->user['id'];
		$user = new Users_Model();
		$profile = $user->getUserByUid($uid);
		
		$this->smarty->assign('profile', $profile);
		$this->smarty->assign('url_default', $url);
        $this->smarty->assign('url_resecret_save', url('mobile/resecret_save'));
        $this->smarty->display('./mobile/resecret.html');
    }
	
	public function resecret_save() {
		$this->load->model('Users_Model');
		
		$uid = $this->user['id'];
		$oldpassword = $this->input->post('oldpassword');
		$password = $this->input->post('password');
		$repassword = $this->input->post('repassword');
		
		if ($password != $repassword) {
			alert('兩次輸入的密碼不正確，請核對後再試。', null, TRUE);
		} else {
			$user = new Users_Model();
			
			$re = $user->checkpassword($uid, $oldpassword);
			
			if ($re['result'] == '1') {
				$o = $user->getUserByUid($uid);
				$sre = $user->setpassword($o->username, $password);
			
				if ($sre && $ure) {
					alert('密碼修改成功', url('mobile/resecret'));
				} else {
					alert('密碼修改失敗', null, TRUE);
				}
			} else {
				alert('密碼不正確', null, TRUE);
			}
		}
	}
    
    public function secret() {
    		$url = $this->input->get('url');
			
		$this->smarty->assign('url_default', $url);
        $this->smarty->assign('url_secret_save', url('mobile/secret_save'));
        $this->smarty->display('./mobile/secret.html');
    }
	
	public function secret_save() {
		$this->load->model('Users_Model');
		
		$uid = $this->user['id'];
		$password = $this->input->post('password');
		$repassword = $this->input->post('repassword');
		$url = $this->input->post('url');
		
		if ($password != $repassword) {
			alert('兩次輸入的密碼不正確，請核對後再試。', null, TRUE);
		} else {
			$user = new Users_Model();
			$o = $user->getUserByUid($uid);
			$sre = $user->setpassword($o->username, $password);
			$ure = $user->unlock($uid);
			
			if ($sre && $ure) {
				alert('密碼修改成功', $url);
			} else {
				alert('密碼修改失敗', null, TRUE);
			}
		}
	}
    
    public function logout() {
    		$this->load->model('Users_Model');
		
        $user = new Users_Model();
        $user->logout();
		
		redirect('/');
    }
}
?>