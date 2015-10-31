<?php
class SysAssistance extends Base_Controller {
    
    function __construct() {
        parent::__construct();
        
        $this->check_belogin(array(ROLE_ID_ADMIN,ROLE_ID_ASSISTANCE));
    }
    
    public function index() {
        $this->load->model('Users_Assistance_Model');
        $users_assistance_model = new Users_Assistance_Model();
        
        $name = $this->input->get('name');
        $username = $this->input->get('username');
		$page = $this->input->get('page');
        
        $conditions = array();
        if (($name && $name != '') || ($username && $username != '')) {
        		$this->load->model('Users_Model');
			$users = new Users_Model();
			$re = $users->getUsersByName($name, $username);
			
			$ids = array(0);
			foreach ($re as $r) {
				$ids[] = $r->id;
			}
			if (sizeof($ids) > 0) {
	            $conditions['uid'] = $ids;
			}
        }
        
        $re = $users_assistance_model->getAssistance($conditions, true, $page);

        $this->smarty->assign('rowset', $re['rowset']);
		$this->smarty->assign('pager', pagerui($re['pager']));
        $this->smarty->display('./sysmanager/assistance_manager.html');
    }
    
    public function edit() {
    
        $this->smarty->display('./sysmanager/assistance_edit.html');
    }
    
    public function save() {
        $this->load->model('Users_Assistance_Model');
        $users_assistance_model = new Users_Assistance_Model();
        
        $row['name'] = $this->input->post('name');
        $row['username'] = $this->input->post('username');
        $row['contact'] = $this->input->post('contact');
        $row['contact_tel'] = $this->input->post('contact_tel');
		$row['email'] = $this->input->post('email');
        
        $re = $users_assistance_model->save($row);
        
        if ($re) {
            alert('保存成功', url('sysassistance/index'));
        } else {
            alert('保存失敗', null, true);
        }
    }
    
    public function updateprofile() {
        $this->load->model('Users_Assistance_Model');
        $users_assistance_model = new Users_Assistance_Model();
        
        $uid = $this->input->get('id');
        $type = $this->input->get('type');
        
        $re = $users_assistance_model->getAssistanceById($uid);
        
        $this->smarty->assign('profile', $re);
        $this->smarty->assign('type', $type);
        $this->smarty->display('./sysmanager/assistance_profile_edit.html');
    }
    
    public function saveprofile() {
        $this->load->model('Users_Assistance_Model');
        $users_assistance_model = new Users_Assistance_Model();
        
        $uid = $this->input->post('id');
        $type = $this->input->post('type');
        
        if ($type == 'contact') {
            $row['contact'] = $this->input->post('contact');
        } elseif ($type == 'contact_tel') {
            $row['contact_tel'] = $this->input->post('contact_tel');
        }
        
        $re = $users_assistance_model->update($uid, $row);
        
        if ($re) {
            alert('保存成功', url('sysassistance/index'));
        } else {
            alert('保存失敗', null, true);
        }
    }
    
    public function resetpassword() {
        $this->load->model('Users_Model');
        $users = new Users_Model();
        
        $uid = $this->input->get('id');
        
        $re = $users->reset($uid);
        
        if ($re['result']) {
            alert('重置成功', url('sysassistance/index'));
        } else {
            alert('重置失敗', url('sysassistance/index'));
        }
    }
    
}
?>