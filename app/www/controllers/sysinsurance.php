<?php
class SysInsurance extends Base_Controller {
    
    function __construct() {
        parent::__construct();
        
        $this->check_belogin(array(ROLE_ID_ADMIN,ROLE_ID_INSURANCE));
    }
    
    public function index() {
        $this->load->model('Users_Insurance_Model');
        $users_insurance_model = new Users_Insurance_Model();
        
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
        
        $re = $users_insurance_model->getInsurance($conditions, true, $page);

        $this->smarty->assign('rowset', $re['rowset']);
		$this->smarty->assign('pager', pagerui($re['pager']));
        $this->smarty->display('./sysmanager/insurance_manager.html');
    }
    
    public function edit() {
    		$this->load->model('Users_Assistance_Model');
		$this->load->model('Users_ReInsurance_Model');
		
    		//查詢再保險公司
    		$assistance = new Users_Assistance_Model();
		$re_assistance = $assistance->getContractAssistance();
		$html_assistance = '';
		foreach($re_assistance as $ri) {
			if ($ri->users->id == $re->iid) {
				$selected = 'selected="selected"';
			} else {
				$selected = '';
			}
			$html_assistance .= '<option value="'.$ri->users->id.'" '.$selected.'>'.$ri->users->username.'（'.$ri->users->name.'）</option>';
		}
    		
    		//查詢救援公司
    		$reinsurance = new Users_ReInsurance_Model();
		$re_reinsurance = $reinsurance->getContractReInsurance();
		$html_reinsurance = '';
		foreach($re_reinsurance as $ri) {
			if ($ri->users->id == $re->iid) {
				$selected = 'selected="selected"';
			} else {
				$selected = '';
			}
			$html_reinsurance .= '<option value="'.$ri->users->id.'" '.$selected.'>'.$ri->users->username.'（'.$ri->users->name.'）</option>';
		}
    		
		$this->smarty->assign('html_assistance', $html_assistance);
		$this->smarty->assign('html_reinsurance', $html_reinsurance);
        $this->smarty->display('./sysmanager/insurance_edit.html');
    }
    
    public function save() {
        $this->load->model('Users_Insurance_Model');
        $users_insurance_model = new Users_Insurance_Model();
        
        $row['name'] = $this->input->post('name');
        $row['username'] = $this->input->post('username');
        $row['contact'] = $this->input->post('contact');
        $row['contact_tel'] = $this->input->post('contact_tel');
		$row['email'] = $this->input->post('email');
		$row['rid'] = $this->input->post('rid');
		$row['aid'] = $this->input->post('aid');
        
        $re = $users_insurance_model->save($row);
        
        if ($re) {
            alert('保存成功', url('sysinsurance/index'));
        } else {
            alert('保存失敗', null, true);
        }
    }
    
    public function updateprofile() {
        $this->load->model('Users_Insurance_Model');
        $users_insurance_model = new Users_Insurance_Model();
        
        $uid = $this->input->get('id');
        $type = $this->input->get('type');
        
        $re = $users_insurance_model->getInsuranceById($uid);
        
        $this->smarty->assign('profile', $re);
        $this->smarty->assign('type', $type);
        $this->smarty->display('./sysmanager/insurance_profile_edit.html');
    }
    
    public function saveprofile() {
        $this->load->model('Users_Insurance_Model');
        $users_insurance_model = new Users_Insurance_Model();
        
        $uid = $this->input->post('id');
        $type = $this->input->post('type');
        
        if ($type == 'address') {
            $row['address'] = $this->input->post('address');
        } elseif ($type == 'contact') {
            $row['contact'] = $this->input->post('contact');
        } elseif ($type == 'contact_tel') {
            $row['contact_tel'] = $this->input->post('contact_tel');
        } elseif ($type == 'renewal') {
            $row['sign_date_start'] = strtotime($this->input->post('sign_date_start'));
            $row['sign_date_end'] = strtotime($this->input->post('sign_date_end'));
        } elseif ($type == 'code') {
        		$row['code'] = $this->input->post('code');
			
			$this->load->model('Users_Model');
        		$users_model = new Users_Model();
				
			$users_model->update_username($uid, $row['code']);
		}
        
        $re = $users_insurance_model->update($uid, $row);
        
        if ($re) {
            alert('保存成功', url('sysinsurance/index'));
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
            alert('重置成功', url('sysinsurance/index'));
        } else {
            alert('重置失敗', url('sysinsurance/index'));
        }
    }
	
}
?>