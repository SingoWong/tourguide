<?php
class Accident extends Base_Controller {

    function __construct() {
        parent::__construct();

        $this->check_felogin(ROLE_ID_GUIDE);
        
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
			$row['type'] = ACCIDENT_TYPE_BUS;
			
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
			$row['type'] = ACCIDENT_TYPE_MEDICINE;
			
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
        $time = $this->input->post('time');
        $location = $this->input->post('location');
        $amount = $this->input->post('amount');
        $detail = $this->input->post('detail');
        
        //TODO 保存提交的內容
        
        redirect(url('accident/medicine_finish'));
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
        $time = $this->input->post('time');
        $location = $this->input->post('location');
        $names = $this->input->post('name');

        //TODO 保存提交的內容
        foreach ($names as $name) {
            
        }
        
        redirect(url('accident/desert_finish'));
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
			$row['type'] = ACCIDENT_TYPE_NATURAL;
			
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
}
?>