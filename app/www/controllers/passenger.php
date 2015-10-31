<?php
class Passenger extends Base_Controller {

    function __construct() {
        parent::__construct();
		
        $this->check_felogin(array(ROLE_ID_PASSENGER));
        
		$this->load->model('NGroup_Model');
		$this->load->model('Users_Assistance_Model');
		$uam = new Users_Assistance_Model();
		$ass = $uam->getAssistanceByPid($this->user['id']);
		
		$assistance_tel = $ass->contact_tel;
		
        $this->smarty->assign( 'url_menu', '/' );
		$this->smarty->assign( 'assistance_tel', $assistance_tel );
    }
    
    public function index() {
   		
        $this->smarty->assign( 'url_bus_photo_choose', url('passenger/bus_photo_choose') );
        $this->smarty->assign( 'url_medicine_photo_choose', url('passenger/medicine_photo_choose') );
        $this->smarty->assign( 'url_natural_photo_choose', url('passenger/natural_photo_choose') );
        $this->smarty->display('./passenger/menu.html');
    }
	
	public function bus_photo_choose() {

        $this->smarty->assign( 'url_bus_photo_submit', url('passenger/bus_photo_submit') );
        $this->smarty->display('./passenger/bus_acc_choose.html');
    }
    
    public function bus_photo_submit() {
    		$this->load->model('Group_Model');
		$this->load->model('Accident_Model');
			
        //上傳圖片
        $upload = $this->file_upload('photo','accident',date('Ymd'));
		
		if ($upload['result']) {
			$ngroup = new NGroup_Model();
			$re_group = $ngroup->getNGroupByPid($this->user['id']);
			
			$row['group_aid'] = '0';
			$row['aid_tw'] = $re_group->aid_tw;
			$row['aid_cn'] = $re_group->aid_cn;
			$row['iid'] = $re_group->iid;
			$row['gid'] = $re_group->id; //团编号
			$row['guide_id'] = $this->user['id'];
			$row['type'] = ACCIDENT_TYPE_BUS;
			$row['source'] = '2';
			$row['fid'] = $ngroup->getFidByUid($this->user['id']);
			
			$accident = new Accident_Model();
			$re_accident = $accident->createAccident($row);
			$accident->addAccidentRes($re_accident['id'], $upload['url']);
			
			if ($re_accident['result']) {
				redirect(url('passenger/bus_form').'&id='.$re_accident['id']);
			} else {
				alert($re_accident['msg'],url('passenger/bus_photo_choose'));
			}
		} else {
			alert($upload['msg'],url('passenger/bus_photo_choose'));
		}
    }
    
    public function bus_form() {
        $id = $this->input->get('id');
        
        $this->smarty->assign('id', $id);
        $this->smarty->assign('time', date('Y-m-d H:i'));
        $this->smarty->assign('url_bus_submit', url('passenger/bus_submit'));
        $this->smarty->display('./passenger/bus_acc_form.html');
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
			redirect(url('passenger/bus_finish'));
		} else {
			alert('保存失敗，請重試', url('passenger/bus_form').'&id='.$id);
		}
    }
    
    public function bus_finish() {
        
        $this->smarty->display('./passenger/bus_acc_finish.html');
    }
	
	public function medicine_photo_choose() {

        $this->smarty->assign( 'url_medicine_photo_submit', url('passenger/medicine_photo_submit') );
        $this->smarty->display('./passenger/medicine_acc_choose.html');
    }
    
    public function medicine_photo_submit() {
        $this->load->model('Group_Model');
		$this->load->model('Accident_Model');
			
        //上傳圖片
        $upload = $this->file_upload('photo','accident',date('Ymd'));
		
		if ($upload['result']) {
			//生成紀錄，返回id號
//	        $group = new Group_Model();
//	        $re_group = $group->getCurrGroupByGuideId($this->user['id']);
			
			$ngroup = new NGroup_Model();
			$re_group = $ngroup->getNGroupByPid($this->user['id']);
			
			$row['group_aid'] = '0';
			$row['aid_tw'] = $re_group->aid_tw;
			$row['aid_cn'] = $re_group->aid_cn;
			$row['iid'] = $re_group->iid;
			$row['gid'] = $re_group->id; //团编号
			$row['guide_id'] = $this->user['id'];
			$row['type'] = ACCIDENT_TYPE_MEDICINE;
			$row['source'] = '2';
			$row['fid'] = $ngroup->getFidByUid($this->user['id']);
			
			$accident = new Accident_Model();
			$re_accident = $accident->createAccident($row);
			$accident->addAccidentRes($re_accident['id'], $upload['url']);
			
			if ($re_accident['result']) {
				redirect(url('passenger/medicine_form').'&id='.$re_accident['id']);
			} else {
				alert($re_accident['msg'],url('passenger/medicine_photo_choose'));
			}
		} else {
			alert($upload['msg'],url('passenger/medicine_photo_choose'));
		}
    }
    
    public function medicine_form() {
        $id = $this->input->get('id');
        
        $this->smarty->assign('id', $id);
        $this->smarty->assign('time', date('Y-m-d H:i'));
        $this->smarty->assign('url_bus_submit', url('passenger/medicine_submit'));
        $this->smarty->display('./passenger/medicine_acc_form.html');
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
			redirect(url('passenger/medicine_finish'));
		} else {
			alert('保存失敗，請重試', url('passenger/medicine_form').'&id='.$id);
		}
    }
    
    public function medicine_finish() {

        $this->smarty->display('./passenger/medicine_acc_finish.html');
    }
	
	public function natural_photo_choose() {

        $this->smarty->assign( 'url_natural_photo_submit', url('passenger/natural_photo_submit') );
        $this->smarty->display('./passenger/natural_choose.html');
    }
    
    public function natural_photo_submit() {
        $this->load->model('Group_Model');
		$this->load->model('Accident_Model');
			
        //上傳圖片
        $upload = $this->file_upload('photo','accident',date('Ymd'));
		
		if ($upload['result']) {
			//生成紀錄，返回id號
//	        $group = new Group_Model();
//	        $re_group = $group->getCurrGroupByGuideId($this->user['id']);
			
			$ngroup = new NGroup_Model();
			$re_group = $ngroup->getNGroupByPid($this->user['id']);
			
			$row['group_aid'] = '0';
			$row['aid_tw'] = $re_group->aid_tw;
			$row['aid_cn'] = $re_group->aid_cn;
			$row['iid'] = $re_group->iid;
			$row['gid'] = $re_group->id; //团编号
			$row['guide_id'] = $this->user['id'];
			$row['type'] = ACCIDENT_TYPE_NATURAL;
			$row['source'] = '2';
			$row['fid'] = $ngroup->getFidByUid($this->user['id']);
			
			$accident = new Accident_Model();
			$re_accident = $accident->createAccident($row);
			$accident->addAccidentRes($re_accident['id'], $upload['url']);
			
			if ($re_accident['result']) {
				redirect(url('passenger/natural_form').'&id='.$re_accident['id']);
			} else {
				alert($re_accident['msg'],url('passenger/natural_photo_choose'));
			}
		} else {
			alert($upload['msg'],url('passenger/natural_photo_choose'));
		}
    }
    
    public function natural_form() {
        $id = $this->input->get('id');
        
        $this->smarty->assign('id', $id);
        $this->smarty->assign('time', date('Y-m-d H:i'));
        $this->smarty->assign('url_natural_submit', url('passenger/natural_submit'));
        $this->smarty->display('./passenger/natural_form.html');
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
			redirect(url('passenger/natural_finish'));
		} else {
			alert('保存失敗，請重試', url('passenger/natural_form').'&id='.$id);
		}
    }
    
    public function natural_finish() {

        $this->smarty->display('./passenger/natural_finish.html');
    }
	
}
?>