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
		$this->smarty->assign( 'url_t1', url('accident/t1_form') );
		$this->smarty->assign( 'url_t2', url('accident/t2_form') );
		$this->smarty->assign( 'url_t3', url('accident/t3_form') );
		$this->smarty->assign( 'url_t4', url('accident/t4_form') );
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
	
	public function t1_form() {
		$this->load->model('Group_Model');
		$this->load->model('Users_Guide_Model');
		$this->load->model('Users_Agency_Model');
		
		$group = new Group_Model();
	    $re_group = $group->getCurrGroupByGuideId($this->user['id']);
		
		$guide = new Users_Guide_Model();
		$re_guide = $guide->getGuideById($this->user['id']);
		
		$agency = new Users_Agency_Model();
		$re_agency = $agency->getAgencyById($re_group->aid);
        
		$this->smarty->assign('group', $re_group);
		$this->smarty->assign('guide', $re_guide);
		$this->smarty->assign('agency', $re_agency);
		$this->smarty->assign('date', date('Y-m-d'));
		$this->smarty->assign('adate', date('Y-m-d'));
        $this->smarty->assign('time', date('H:i'));
		$this->smarty->assign('atime', date('H:i'));
        $this->smarty->assign('url_submit', url('accident/t1_submit'));
        $this->smarty->display('./accident/t1_form.html');
	}
	
	public function t1_submit() {
		$this->load->model('Group_Model');
		$this->load->model('Accident_Model');
		
		$group = new Group_Model();
	    $re_group = $group->getCurrGroupByGuideId($this->user['id']);
		$row['group_aid'] = $re_group->aid;
		$row['gid'] = $re_group->id;
		$row['guide_id'] = $this->user['id'];
		$row['type'] = ACCIDENT_TYPE_T1;
		$row['source'] = ($this->role['id']==ROLE_ID_LEADER)?'1':'0';
		
        $accident_model = new Accident_Model();
		$re_accident = $accident_model->createAccident($row);
		$id = $re_accident['id'];
		
		$accident['time'] = strtotime($this->input->post('date').' '.$this->input->post('time'));
		
		$accident_t1['aid'] = $id;
		$accident_t1['group_code'] = $this->input->post('group_code');
		$accident_t1['guide_code'] = $this->input->post('guide_code');
		$accident_t1['guide_name'] = $this->input->post('guide_name');
		$accident_t1['guide_tel'] = $this->input->post('guide_tel');
		$accident_t1['agency_name'] = $this->input->post('agency_name');
		$accident_t1['etime'] = strtotime($this->input->post('edate').' '.$this->input->post('etime'));
		$accident_t1['airport'] = $this->input->post('airport');
		$accident_t1['flight_code'] = $this->input->post('flight_code');
		$accident_t1['permission_count'] = $this->input->post('permission_count');
		$accident_t1['actual_count'] = $this->input->post('actual_count');
		$accident_t1['noenter_count'] = $this->input->post('noenter_count');
		$accident_t1['members_name'] = $this->input->post('members_name');
		$accident_t1['leaders_name'] = $this->input->post('leaders_name');
		$accident_t1['leaders_tel'] = $this->input->post('leaders_tel');
		
		$ac = new Accident_Model();
		$re = $ac->saveAccidentT1($id, $accident, $accident_t1);
		
		if ($re) {
			redirect(url('accident/common_finish'));
		} else {
			alert('保存失敗，請重試', url('accident/t1_form'));
		}
	}
	
	public function t2_form() {
		$this->load->model('Group_Model');
		$this->load->model('Users_Guide_Model');
		$this->load->model('Users_Agency_Model');
		
		$group = new Group_Model();
	    $re_group = $group->getCurrGroupByGuideId($this->user['id']);
		
		$guide = new Users_Guide_Model();
		$re_guide = $guide->getGuideById($this->user['id']);
		
		$agency = new Users_Agency_Model();
		$re_agency = $agency->getAgencyById($re_group->aid);
        
		$this->smarty->assign('group', $re_group);
		$this->smarty->assign('guide', $re_guide);
		$this->smarty->assign('agency', $re_agency);
		$this->smarty->assign('date', date('Y-m-d'));
		$this->smarty->assign('adate', date('Y-m-d'));
        $this->smarty->assign('time', date('H:i'));
		$this->smarty->assign('atime', date('H:i'));
        $this->smarty->assign('url_submit', url('accident/t2_submit'));
        $this->smarty->display('./accident/t2_form.html');
	}
	
	public function t2_submit() {
		$this->load->model('Group_Model');
		$this->load->model('Accident_Model');
		
		$group = new Group_Model();
	    $re_group = $group->getCurrGroupByGuideId($this->user['id']);
		$row['group_aid'] = $re_group->aid;
		$row['gid'] = $re_group->id;
		$row['guide_id'] = $this->user['id'];
		$row['type'] = ACCIDENT_TYPE_T2;
		$row['source'] = ($this->role['id']==ROLE_ID_LEADER)?'1':'0';
		
        $accident_model = new Accident_Model();
		$re_accident = $accident_model->createAccident($row);
		$id = $re_accident['id'];
		
		$accident['time'] = strtotime($this->input->post('date').' '.$this->input->post('time'));
		
		$accident_t2['aid'] = $id;
		$accident_t2['group_code'] = $this->input->post('group_code');
		$accident_t2['guide_code'] = $this->input->post('guide_code');
		$accident_t2['guide_name'] = $this->input->post('guide_name');
		$accident_t2['guide_tel'] = $this->input->post('guide_tel');
		$accident_t2['agency_name'] = $this->input->post('agency_name');
		$accident_t2['etime'] = strtotime($this->input->post('edate').' '.$this->input->post('etime'));
		$accident_t2['otime'] = strtotime($this->input->post('odate').' '.$this->input->post('otime'));
		$accident_t2['airport'] = $this->input->post('airport');
		$accident_t2['flight_code'] = $this->input->post('flight_code');
		$accident_t2['permission_count'] = $this->input->post('permission_count');
		$accident_t2['actual_count'] = $this->input->post('actual_count');
		$accident_t2['noleave_name'] = $this->input->post('noleave_name');
		$accident_t2['noleave_reson'] = $this->input->post('noleave_reson');
		$accident_t2['noleave_otime'] = strtotime($this->input->post('noleave_odate').' '.$this->input->post('noleave_otime'));
		$accident_t2['noleave_flight_code'] = $this->input->post('noleave_flight_code');
		$accident_t2['ahead_name'] = $this->input->post('ahead_name');
		$accident_t2['ahead_reson'] = $this->input->post('ahead_reson');
		$accident_t2['ahead_otime'] = strtotime($this->input->post('ahead_odate').' '.$this->input->post('ahead_otime'));
		$accident_t2['ahead_flight_code'] = $this->input->post('ahead_flight_code');
		
		$ac = new Accident_Model();
		$re = $ac->saveAccidentT2($id, $accident, $accident_t2);
		
		if ($re) {
			redirect(url('accident/common_finish'));
		} else {
			alert('保存失敗，請重試', url('accident/t2_form'));
		}
	}
	
	public function t3_form() {
		$this->load->model('Group_Model');
		$this->load->model('Users_Guide_Model');
		$this->load->model('Users_Agency_Model');
		
		$group = new Group_Model();
	    $re_group = $group->getCurrGroupByGuideId($this->user['id']);
		
		$guide = new Users_Guide_Model();
		$re_guide = $guide->getGuideById($this->user['id']);
		
		$agency = new Users_Agency_Model();
		$re_agency = $agency->getAgencyById($re_group->aid);
        
		$this->smarty->assign('group', $re_group);
		$this->smarty->assign('guide', $re_guide);
		$this->smarty->assign('agency', $re_agency);
		$this->smarty->assign('date', date('Y-m-d'));
		$this->smarty->assign('adate', date('Y-m-d'));
        $this->smarty->assign('time', date('H:i'));
		$this->smarty->assign('atime', date('H:i'));
        $this->smarty->assign('url_submit', url('accident/t3_submit'));
        $this->smarty->display('./accident/t3_form.html');
	}
	
	public function t3_submit() {
		$this->load->model('Group_Model');
		$this->load->model('Accident_Model');
		
		$group = new Group_Model();
	    $re_group = $group->getCurrGroupByGuideId($this->user['id']);
		$row['group_aid'] = $re_group->aid;
		$row['gid'] = $re_group->id;
		$row['guide_id'] = $this->user['id'];
		$row['type'] = ACCIDENT_TYPE_T3;
		$row['source'] = ($this->role['id']==ROLE_ID_LEADER)?'1':'0';
		
        $accident_model = new Accident_Model();
		$re_accident = $accident_model->createAccident($row);
		$id = $re_accident['id'];
		
		$accident['time'] = strtotime($this->input->post('date').' '.$this->input->post('time'));
		
		$accident_t3['aid'] = $id;
		$accident_t3['group_code'] = $this->input->post('group_code');
		$accident_t3['guide_code'] = $this->input->post('guide_code');
		$accident_t3['guide_name'] = $this->input->post('guide_name');
		$accident_t3['guide_tel'] = $this->input->post('guide_tel');
		$accident_t3['agency_name'] = $this->input->post('agency_name');
		$accident_t3['level'] = $this->input->post('level');
		$accident_t3['reson'] = $this->input->post('reson');
		$accident_t3['ff_name'] = $this->input->post('ff_name');
		$accident_t3['ff_address'] = $this->input->post('ff_address');
		$accident_t3['ff_tel'] = $this->input->post('ff_tel');
		$accident_t3['ltime'] = strtotime($this->input->post('ldate').' '.$this->input->post('ltime'));
		$accident_t3['btime'] = strtotime($this->input->post('bdate').' '.$this->input->post('btime'));
		$accident_t3['members_name'] = $this->input->post('members_name');
		
		$ac = new Accident_Model();
		$re = $ac->saveAccidentT3($id, $accident, $accident_t3);
		
		if ($re) {
			redirect(url('accident/common_finish'));
		} else {
			alert('保存失敗，請重試', url('accident/t3_form'));
		}
	}
	
	public function t4_form() {
		$this->load->model('Group_Model');
		$this->load->model('Users_Guide_Model');
		$this->load->model('Users_Agency_Model');
		
		$group = new Group_Model();
	    $re_group = $group->getCurrGroupByGuideId($this->user['id']);
		
		$guide = new Users_Guide_Model();
		$re_guide = $guide->getGuideById($this->user['id']);
		
		$agency = new Users_Agency_Model();
		$re_agency = $agency->getAgencyById($re_group->aid);
        
		$this->smarty->assign('group', $re_group);
		$this->smarty->assign('guide', $re_guide);
		$this->smarty->assign('agency', $re_agency);
		$this->smarty->assign('date', date('Y-m-d'));
		$this->smarty->assign('adate', date('Y-m-d'));
        $this->smarty->assign('time', date('H:i'));
		$this->smarty->assign('atime', date('H:i'));
        $this->smarty->assign('url_submit', url('accident/t4_submit'));
        $this->smarty->display('./accident/t4_form.html');
	}
	
	public function t4_submit() {
		$this->load->model('Group_Model');
		$this->load->model('Accident_Model');
		
		$group = new Group_Model();
	    $re_group = $group->getCurrGroupByGuideId($this->user['id']);
		$row['group_aid'] = $re_group->aid;
		$row['gid'] = $re_group->id;
		$row['guide_id'] = $this->user['id'];
		$row['type'] = ACCIDENT_TYPE_T4;
		$row['source'] = ($this->role['id']==ROLE_ID_LEADER)?'1':'0';
		
        $accident_model = new Accident_Model();
		$re_accident = $accident_model->createAccident($row);
		$id = $re_accident['id'];
		
		$accident['time'] = strtotime($this->input->post('date').' '.$this->input->post('time'));
		
		$accident_t4['aid'] = $id;
		$accident_t4['group_code'] = $this->input->post('group_code');
		$accident_t4['guide_code'] = $this->input->post('guide_code');
		$accident_t4['guide_name'] = $this->input->post('guide_name');
		$accident_t4['guide_tel'] = $this->input->post('guide_tel');
		$accident_t4['agency_name'] = $this->input->post('agency_name');
		$accident_t4['level'] = $this->input->post('level');
		$accident_t4['atime'] = strtotime($this->input->post('adate').' '.$this->input->post('atime'));
		$accident_t4['reason'] = $this->input->post('reason');
		
		$accident_t4['detail'] = $this->input->post('detail'); //案件說明
		$accident_t4['members_name'] = $this->input->post('members_name'); //旅客姓名名單
		
		$ac = new Accident_Model();
		$re = $ac->saveAccidentT4($id, $accident, $accident_t4);
		
		if ($re) {
			redirect(url('accident/common_finish'));
		} else {
			alert('保存失敗，請重試', url('accident/t4_form'));
		}
	}
	
	public function common_finish() {
		
        $this->smarty->display('./accident/common_finish.html');
	}
}
?>