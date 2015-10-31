<?php
class SysReInsurance extends Base_Controller {
    
    function __construct() {
        parent::__construct();
        
        $this->check_belogin(array(ROLE_ID_ADMIN,ROLE_ID_REINSURANCE));
    }
    
    public function index() {
        $this->load->model('Users_ReInsurance_Model');
        $users_reinsurance_model = new Users_ReInsurance_Model();
        
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
        
        $re = $users_reinsurance_model->getReInsurance($conditions, true, $page);

        $this->smarty->assign('rowset', $re['rowset']);
		$this->smarty->assign('pager', pagerui($re['pager']));
        $this->smarty->display('./sysmanager/reinsurance_manager.html');
    }
    
    public function edit() {
    
        $this->smarty->display('./sysmanager/reinsurance_edit.html');
    }
    
    public function save() {
        $this->load->model('Users_ReInsurance_Model');
        $users_reinsurance_model = new Users_ReInsurance_Model();
        
        $row['name'] = $this->input->post('name');
        $row['username'] = $this->input->post('username');
        $row['contact'] = $this->input->post('contact');
        $row['contact_tel'] = $this->input->post('contact_tel');
		$row['email'] = $this->input->post('email');
        
        $re = $users_reinsurance_model->save($row);
        
        if ($re) {
            alert('保存成功', url('sysreinsurance/index'));
        } else {
            alert('保存失敗', null, true);
        }
    }
    
    public function updateprofile() {
        $this->load->model('Users_ReInsurance_Model');
        $users_reinsurance_model = new Users_ReInsurance_Model();
        
        $uid = $this->input->get('id');
        $type = $this->input->get('type');
        
        $re = $users_reinsurance_model->getReInsuranceById($uid);
        
        $this->smarty->assign('profile', $re);
        $this->smarty->assign('type', $type);
        $this->smarty->display('./sysmanager/reinsurance_profile_edit.html');
    }
    
    public function saveprofile() {
        $this->load->model('Users_ReInsurance_Model');
        $users_reinsurance_model = new Users_ReInsurance_Model();
        
        $uid = $this->input->post('id');
        $type = $this->input->post('type');
        
        if ($type == 'contact') {
            $row['contact'] = $this->input->post('contact');
        } elseif ($type == 'contact_tel') {
            $row['contact_tel'] = $this->input->post('contact_tel');
        }
        
        $re = $users_reinsurance_model->update($uid, $row);
        
        if ($re) {
            alert('保存成功', url('sysreinsurance/index'));
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
            alert('重置成功', url('sysreinsurance/index'));
        } else {
            alert('重置失敗', url('sysreinsurance/index'));
        }
    }
    
}
?>