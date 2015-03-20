<?php
class Accident extends Base_Controller {

    function __construct() {
        parent::__construct();

        $this->check_felogin(array(ROLE_ID_GUIDE,ROLE_ID_LEADER));
        
        $this->smarty->assign( 'url_menu', url('guide/index') );
        $this->smarty->assign( 'url_info', url('guide/info') );
        $this->smarty->assign( 'url_restaurant', url('guide/restaurant') );
        $this->smarty->assign( 'url_hotel', url('guide/hotel') );
        $this->smarty->assign( 'url_accident', url('accident/index') );
    }
    
    public function index() {
        
        $this->smarty->assign( 'url_bus_photo_choose', url('accident/bus_photo_choose') );
        $this->smarty->assign( 'url_medicine_photo_choose', url('accident/medicine_photo_choose') );
        $this->smarty->assign( 'url_desert_form', url('accident/desert_form') );
        $this->smarty->assign( 'url_natural_photo_choose', url('accident/natural_photo_choose') );
		$this->smarty->assign( 'url_t4_11', url('accident/t4_11_form') );
        $this->smarty->display('./accident/menu.html');
    }
    
    public function bus_photo_choose() {

        $this->smarty->assign( 'url_bus_photo_submit', url('accident/bus_photo_submit') );
        $this->smarty->display('./accident/bus_acc_choose.html');
    }
    
    public function bus_photo_submit() {
    		$this->load->model('Group_Model');
		$this->load->model('Accident_Model');
			
        //上傳圖片
        $upload = $this->file_upload('photo','accident',date('Ymd'));
		
		if ($upload['result']) {
			//生成紀錄，返回id號
	        $group = new Group_Model();
	        $re_group = $group->getCurrGroupByGuideId($this->user['id']);
			
			$row['group_aid'] = $re_group->aid;
			$row['gid'] = $re_group->id;
			$row['guide_id'] = $this->user['id'];
			$row['type'] = ACCIDENT_TYPE_BUS;
			$row['source'] = ($this->role['id']==ROLE_ID_LEADER)?'1':'0';
			
			$accident = new Accident_Model();
			$re_accident = $accident->createAccident($row);
			$accident->addAccidentRes($re_accident['id'], $upload['url']);
			
			if ($re_accident['result']) {
				redirect(url('accident/bus_form').'&id='.$re_accident['id']);
			} else {
				alert($re_accident['msg'],url('accident/bus_photo_choose'));
			}
		} else {
			alert($upload['msg'],url('accident/bus_photo_choose'));
		}
    }
    
    public function bus_form() {
        $id = $this->input->get('id');
        
        $this->smarty->assign('id', $id);
        $this->smarty->assign('time', date('Y-m-d H:i'));
        $this->smarty->assign('url_bus_submit', url('accident/bus_submit'));
        $this->smarty->display('./accident/bus_acc_form.html');
    }
    
    public function bus_submit() {
		$this->load->model('Accident_Model');
		
    		$id = $this->input->post('id');
        $time = $this->input->post('time');
        $location = $this->input->post('location');
        $driver_status = $this->input->post('driver_status');
        $member_status = $this->input->post('member_status');
        $bus_status = $this->input->post('bus_status');
        
        //保存提交的內容
        $accident['time'] = strtotime($time);
		$accident['location'] = $location;
		
		$accident_bus['aid'] = $id;
		$accident_bus['driver_status'] = $driver_status;
		$accident_bus['member_status'] = $member_status;
		$accident_bus['bus_status'] = $bus_status;
		
		$ac = new Accident_Model();
		$re = $ac->saveAccidentBus($id, $accident, $accident_bus);
		
		if ($re) {
			redirect(url('accident/bus_finish'));
		} else {
			alert('保存失敗，請重試', url('accident/bus_form').'&id='.$id);
		}
    }
    
    public function bus_finish() {
        
        $this->smarty->display('./accident/bus_acc_finish.html');
    }
    
    public function medicine_photo_choose() {

        $this->smarty->assign( 'url_medicine_photo_submit', url('accident/medicine_photo_submit') );
        $this->smarty->display('./accident/medicine_acc_choose.html');
    }
    
    public function medicine_photo_submit() {
        $this->load->model('Group_Model');
		$this->load->model('Accident_Model');
			
        //上傳圖片
        $upload = $this->file_upload('photo','accident',date('Ymd'));
		
		if ($upload['result']) {
			//生成紀錄，返回id號
	        $group = new Group_Model();
	        $re_group = $group->getCurrGroupByGuideId($this->user['id']);
			
			$row['group_aid'] = $re_group->aid;
			$row['gid'] = $re_group->id;
			$row['guide_id'] = $this->user['id'];
			$row['type'] = ACCIDENT_TYPE_MEDICINE;
			$row['source'] = ($this->role['id']==ROLE_ID_LEADER)?'1':'0';
			
			$accident = new Accident_Model();
			$re_accident = $accident->createAccident($row);
			$accident->addAccidentRes($re_accident['id'], $upload['url']);
			
			if ($re_accident['result']) {
				redirect(url('accident/medicine_form').'&id='.$re_accident['id']);
			} else {
				alert($re_accident['msg'],url('accident/medicine_photo_choose'));
			}
		} else {
			alert($upload['msg'],url('accident/medicine_photo_choose'));
		}
    }
    
    public function medicine_form() {
        $id = $this->input->get('id');
        
        $this->smarty->assign('id', $id);
        $this->smarty->assign('time', date('Y-m-d H:i'));
        $this->smarty->assign('url_bus_submit', url('accident/medicine_submit'));
        $this->smarty->display('./accident/medicine_acc_form.html');
    }
    
    public function medicine_submit() {
    		$this->load->model('Accident_Model');
		
    		$id = $this->input->post('id');
        $time = $this->input->post('time');
        $location = $this->input->post('location');
        $amount = $this->input->post('amount');
        $detail = $this->input->post('detail');
        
        //保存提交的內容
        $accident['time'] = strtotime($time);
		$accident['location'] = $location;
		
		$accident_medicine['aid'] = $id;
		$accident_medicine['amount'] = $amount;
		$accident_medicine['detail'] = $detail;
		
		$ac = new Accident_Model();
		$re = $ac->saveAccidentMedicine($id, $accident, $accident_medicine);
		
		if ($re) {
			redirect(url('accident/medicine_finish'));
		} else {
			alert('保存失敗，請重試', url('accident/medicine_form').'&id='.$id);
		}
    }
    
    public function medicine_finish() {

        $this->smarty->display('./accident/medicine_acc_finish.html');
    }
    
    public function desert_form() {
        $id = $this->input->get('id');
        
        $this->smarty->assign('id', $id);
        $this->smarty->assign('time', date('Y-m-d H:i'));
        $this->smarty->assign( 'url_desert_submit', url('accident/desert_submit') );
        $this->smarty->display('./accident/desert_form.html');
    }
    
    public function desert_submit() {
    		$this->load->model('Accident_Model');
		$this->load->model('Group_Model');
		
        $time = $this->input->post('time');
        $location = $this->input->post('location');
        $names = $this->input->post('name');
		
		//創建一個意外通告
		$group = new Group_Model();
        $re_group = $group->getCurrGroupByGuideId($this->user['id']);
		
		$row['group_aid'] = $re_group->aid;
		$row['gid'] = $re_group->id;
		$row['guide_id'] = $this->user['id'];
		$row['type'] = ACCIDENT_TYPE_DESERT;
		$row['source'] = ($this->role['id']==ROLE_ID_LEADER)?'1':'0';
		
		$accident_model = new Accident_Model();
		$re_accident = $accident_model->createAccident($row);
		$id = $re_accident['id'];
        
        //保存提交的內容
        $accident['time'] = strtotime($time);
		$accident['location'] = $location;
		
		$accident_desert['aid'] = $id;
		$accident_desert['name'] = $names;
		
		$ac = new Accident_Model();
		$re = $ac->saveAccidentDesert($id, $accident, $accident_desert);
		
		if ($re) {
			redirect(url('accident/desert_finish'));
		} else {
			alert('保存失敗，請重試', url('accident/desert_form'));
		}
    }
    
    public function desert_finish() {

        $this->smarty->display('./accident/desert_finish.html');
    }
    
    public function natural_photo_choose() {

        $this->smarty->assign( 'url_natural_photo_submit', url('accident/natural_photo_submit') );
        $this->smarty->display('./accident/natural_choose.html');
    }
    
    public function natural_photo_submit() {
        $this->load->model('Group_Model');
		$this->load->model('Accident_Model');
			
        //上傳圖片
        $upload = $this->file_upload('photo','accident',date('Ymd'));
		
		if ($upload['result']) {
			//生成紀錄，返回id號
	        $group = new Group_Model();
	        $re_group = $group->getCurrGroupByGuideId($this->user['id']);
			
			$row['group_aid'] = $re_group->aid;
			$row['gid'] = $re_group->id;
			$row['guide_id'] = $this->user['id'];
			$row['type'] = ACCIDENT_TYPE_NATURAL;
			$row['source'] = ($this->role['id']==ROLE_ID_LEADER)?'1':'0';
			
			$accident = new Accident_Model();
			$re_accident = $accident->createAccident($row);
			$accident->addAccidentRes($re_accident['id'], $upload['url']);
			
			if ($re_accident['result']) {
				redirect(url('accident/natural_form').'&id='.$re_accident['id']);
			} else {
				alert($re_accident['msg'],url('accident/natural_photo_choose'));
			}
		} else {
			alert($upload['msg'],url('accident/natural_photo_choose'));
		}
    }
    
    public function natural_form() {
        $id = $this->input->get('id');
        
        $this->smarty->assign('id', $id);
        $this->smarty->assign('time', date('Y-m-d H:i'));
        $this->smarty->assign('url_natural_submit', url('accident/natural_submit'));
        $this->smarty->display('./accident/natural_form.html');
    }
    
    public function natural_submit() {
    		$this->load->model('Accident_Model');
		
    		$id = $this->input->post('id');
        $time = $this->input->post('time');
        $location = $this->input->post('location');
        $atype = $this->input->post('atype');
        
        //保存提交的內容
        $accident['time'] = strtotime($time);
		$accident['location'] = $location;
		
		$accident_natural['aid'] = $id;
		$accident_natural['atype'] = $atype;
		
		$ac = new Accident_Model();
		$re = $ac->saveAccidentNatural($id, $accident, $accident_natural);
		
		if ($re) {
			redirect(url('accident/natural_finish'));
		} else {
			alert('保存失敗，請重試', url('accident/natural_form').'&id='.$id);
		}
    }
    
    public function natural_finish() {

        $this->smarty->display('./accident/natural_finish.html');
    }
	
	public function t4_11_form() {
		$this->load->model('Group_Model');
		$this->load->model('Users_Guide_Model');
		
		$group = new Group_Model();
	    $re_group = $group->getCurrGroupByGuideId($this->user['id']);
		
		$guide = new Users_Guide_Model();
		$re_guide = $guide->getGuideById($this->user['id']);
        
		$this->smarty->assign('group', $re_group);
		$this->smarty->assign('guide', $re_guide);
		$this->smarty->assign('date', date('Y-m-d'));
		$this->smarty->assign('adate', date('Y-m-d'));
        $this->smarty->assign('time', date('H:i'));
		$this->smarty->assign('atime', date('H:i'));
        $this->smarty->assign('url_submit', url('accident/t4_11_submit'));
        $this->smarty->display('./accident/t4_11_form.html');
	}
	
	public function t4_11_submit() {
		
	}
	
	public function t4_11_finish() {
		
	}
}
?>