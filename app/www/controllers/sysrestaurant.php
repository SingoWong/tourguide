<?php
class SysRestaurant extends Base_Controller {
    
    function __construct() {
        parent::__construct();
        
        $this->check_belogin(ROLE_ID_ADMIN);
    }
    
    public function index() {
        $this->load->model('Users_Restaurant_Model');
        $users_restaurant_model = new Users_Restaurant_Model();
        
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
        
        $re = $users_restaurant_model->getContractRestaurant($conditions, true, $page);
        
        $this->smarty->assign('rowset', $re['rowset']);
		$this->smarty->assign('pager', pagerui($re['pager']));
        $this->smarty->display('./sysmanager/restaurant_manager.html');
    }
    
    public function expired() {
        $this->load->model('Users_Restaurant_Model');
        $users_restaurant_model = new Users_Restaurant_Model();
        
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
        
        $re = $users_restaurant_model->getExpiredRestaurant($conditions, $page);
        
        $this->smarty->assign('rowset', $re['rowset']);
		$this->smarty->assign('pager', pagerui($re['pager']));
        $this->smarty->display('./sysmanager/restaurant_expired.html');
    }
    
    public function edit() {
        
        $this->smarty->display('./sysmanager/restaurant_edit.html');
    }
    
    public function save() {
        $this->load->model('Users_Restaurant_Model');
        $users_restaurant_model = new Users_Restaurant_Model();
        
        $row['name'] = $this->input->post('name');
		$row['title'] = $this->input->post('title');
		$row['region'] = $this->input->post('region');
        $row['address'] = $this->input->post('address');
        $row['code'] = $this->input->post('code');
        $row['contact'] = $this->input->post('contact');
        $row['contact_tel'] = $this->input->post('contact_tel');
        $row['sign_date_start'] = strtotime($this->input->post('sign_date_start'));
        $row['sign_date_end'] = strtotime($this->input->post('sign_date_end'));
        
        $re = $users_restaurant_model->save($row);

        if ($re) {
            alert('保存成功', url('sysrestaurant/index'));
        } else {
            alert('保存失敗', null, true);
        }
    }

    public function updateprofile() {
        $this->load->model('Users_Restaurant_Model');
        $users_restaurant_model = new Users_Restaurant_Model();
    
        $uid = $this->input->get('id');
        $type = $this->input->get('type');
    
        $re = $users_restaurant_model->getRestaurantById($uid);
    
        $this->smarty->assign('profile', $re);
        $this->smarty->assign('type', $type);
        $this->smarty->display('./sysmanager/restaurant_profile_edit.html');
    }
    
    public function saveprofile() {
        $this->load->model('Users_Restaurant_Model');
        $users_restaurant_model = new Users_Restaurant_Model();
    
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
        }
    
        $re = $users_restaurant_model->update($uid, $row);
    
        if ($re) {
            alert('保存成功', url('sysrestaurant/index'));
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
            alert('重置成功', url('sysrestaurant/index'));
        } else {
            alert('重置失敗', url('sysrestaurant/index'));
        }
    }
    
    public function suspended() {
        $this->load->model('Users_Model');
        $users = new Users_Model();
    
        $uid = $this->input->get('id');
    
        $re = $users->suspended($uid);
    
        if ($re['result']) {
            alert('停權成功', url('sysrestaurant/index'));
        } else {
            alert('停權失敗', url('sysrestaurant/index'));
        }
    }
    
    public function renewal() {
        $uid = $this->input->get('id');
    
        $this->smarty->assign('uid', $uid);
        $this->smarty->display('./sysmanager/restaurant_renewal.html');
    }
	
	public function contracta() {
		$this->load->model('Contract_Restaurant_Model');
		$crm = new Contract_Restaurant_Model();
		
		$page = $this->input->get('page');
		$rid = $this->input->get('rid');
		$re = $crm->getCAgencyByRestaurant($rid, $page);
		
		$this->smarty->assign('rid', $rid);
		$this->smarty->assign('rowset', $re['rowset']);
		$this->smarty->assign('pager', pagerui($re['pager']));
        $this->smarty->display('./sysmanager/restaurant_contracta.html');
	}
	
	public function contractaedit() {
		$this->load->model('Users_Agency_Model');
        $users_agency_model = new Users_Agency_Model();
        
        $name = $this->input->get('name');
        $username = $this->input->get('username');
		$page = $this->input->get('page');
		$rid = $this->input->get('rid');
        
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
        
        $re = $users_agency_model->getContractAgency($conditions, true, $page, 8);
        
		$this->smarty->assign('rid', $rid);
        $this->smarty->assign('rowset', $re['rowset']);
		$this->smarty->assign('pager', pagerui($re['pager']));
        $this->smarty->display('./sysmanager/restaurant_contracta_edit.html');
	}
	
	public function contractasave() {
		$this->load->model('Contract_Restaurant_Model');
		$crm = new Contract_Restaurant_Model();
		
		$aid = $this->input->get('aid');
		$rid = $this->input->get('rid');
		
		$re = $crm->createContractAR($aid, $rid);
		
		if ($re['result']) {
			alert('添加成功',url('sysrestaurant/contracta').'&rid='.$rid);
		} else {
			alert($re['msg'],null,TRUE);
		}
	}
	
	public function contractaremove() {
		$this->load->model('Contract_Restaurant_Model');
		$crm = new Contract_Restaurant_Model();
		
		$id = $this->input->get('id');
		$rid = $this->input->get('rid');
		
		$re = $crm->removeContractAR($id);
		
		if ($re) {
			alert('已成功解除合約關係',url('sysrestaurant/contracta').'&rid='.$rid);
		} else {
			alert('解除合約關係失敗',null,TRUE);
		}
	}
}
?>