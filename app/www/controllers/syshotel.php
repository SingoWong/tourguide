<?php
class SysHotel extends Base_Controller {

    function __construct() {
        parent::__construct();
        
        $this->check_belogin(ROLE_ID_ADMIN);
    }
    
    public function index() {
        $this->load->model('Users_Hotel_Model');
        $users_hotel_model = new Users_Hotel_Model();
        
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
        
        $re = $users_hotel_model->getContractHotel($conditions, true, $page);
        
        $this->smarty->assign('rowset', $re['rowset']);
		$this->smarty->assign('pager', pagerui($re['pager']));
        $this->smarty->display('./sysmanager/hotel_manager.html');
    }
    
    public function expired() {
        $this->load->model('Users_Hotel_Model');
        $users_hotel_model = new Users_Hotel_Model();
        
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
        
        $re = $users_hotel_model->getExpiredHotel($conditions, $page);
        
        $this->smarty->assign('rowset', $re['rowset']);
		$this->smarty->assign('pager', pagerui($re['pager']));
        $this->smarty->display('./sysmanager/hotel_expired.html');
    }
    
    public function edit() {
    
        $this->smarty->display('./sysmanager/hotel_edit.html');
    }
    
    public function save() {
        $this->load->model('Users_Hotel_Model');
        $users_hotel_model = new Users_Hotel_Model();
    
        $row['name'] = $this->input->post('name');
		$row['title'] = $this->input->post('title');
		$row['region'] = $this->input->post('region');
        $row['address'] = $this->input->post('address');
        $row['code'] = $this->input->post('code');
        $row['contact'] = $this->input->post('contact');
        $row['contact_tel'] = $this->input->post('contact_tel');
        $row['sign_date_start'] = strtotime($this->input->post('sign_date_start'));
        $row['sign_date_end'] = strtotime($this->input->post('sign_date_end'));
    
        $re = $users_hotel_model->save($row);

        if ($re) {
            alert('保存成功', url('syshotel/index'));
        } else {
            alert('保存失敗', null, true);
        }
    }

    public function updateprofile() {
        $this->load->model('Users_Hotel_Model');
        $users_hotel_model = new Users_Hotel_Model();
    
        $uid = $this->input->get('id');
        $type = $this->input->get('type');
    
        $re = $users_hotel_model->getHotelById($uid);
    
        $this->smarty->assign('profile', $re);
        $this->smarty->assign('type', $type);
        $this->smarty->display('./sysmanager/hotel_profile_edit.html');
    }
    
    public function saveprofile() {
        $this->load->model('Users_Hotel_Model');
        $users_hotel_model = new Users_Hotel_Model();
    
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
    
        $re = $users_hotel_model->updateProfile($uid, $row);
    
        if ($re) {
            alert('保存成功', url('syshotel/index'));
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
            alert('重置成功', url('syshotel/index'));
        } else {
            alert('重置失敗', url('syshotel/index'));
        }
    }
    
    public function suspended() {
        $this->load->model('Users_Model');
        $users = new Users_Model();
    
        $uid = $this->input->get('id');
    
        $re = $users->suspended($uid);
    
        if ($re['result']) {
            alert('停權成功', url('syshotel/index'));
        } else {
            alert('停權失敗', url('syshotel/index'));
        }
    }
    
    public function renewal() {
        $uid = $this->input->get('id');
    
        $this->smarty->assign('uid', $uid);
        $this->smarty->display('./sysmanager/hotel_renewal.html');
    }
	
	public function contracta() {
		$hid = $this->input->get('hid');
		
        $this->smarty->display('./sysmanager/hotel_contracta.html');
	}
	
	public function contractaedit() {
		$hid = $this->input->get('hid');
		
        $this->smarty->display('./sysmanager/hotel_contracta_edit.html');
	}
}
?>