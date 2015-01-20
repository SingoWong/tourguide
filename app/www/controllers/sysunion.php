<?php
class SysUnion extends Base_Controller {
    
    function __construct() {
        parent::__construct();
        
        $this->check_belogin(array(ROLE_ID_ADMIN,ROLE_ID_UNION));
    }
	
    public function index() {
        $this->smarty->display('./union/main.html');
    }
	
	public function profile() {
		
		$this->smarty->assign('union_username', UNION_USERNAME);
		$this->smarty->display('./union/profile.html');
	}
	
	public function save() {
		$this->load->model('Users_Model');
		
		$password = $this->input->post('password');
		
		$users = new Users_Model();
		$re = $users->setpassword(UNION_USERNAME, $password);
		
		if ($re['result']) {
            alert('保存成功', url('sysunion/profile'));
        } else {
            alert('保存失敗', null, true);
        }
	}
}
?>