<?php
class SysEmbratur extends Base_Controller {
    
    function __construct() {
        parent::__construct();
        
        $this->check_belogin(array(ROLE_ID_ADMIN,ROLE_ID_EMBRATUR));
    }
	
    public function index() {
        $this->smarty->display('./sysembratur/main.html');
    }
	
	public function profile() {
		
		$this->smarty->assign('union_username', EMBRATUR_USERNAME);
		$this->smarty->display('./sysembratur/profile.html');
	}
	
	public function save() {
		$this->load->model('Users_Model');
		
		$password = $this->input->post('password');
		
		$users = new Users_Model();
		$re = $users->setpassword(EMBRATUR_USERNAME, $password);
		
		if ($re['result']) {
            alert('保存成功', url('sysembratur/profile'));
        } else {
            alert('保存失敗', null, true);
        }
	}
}
?>