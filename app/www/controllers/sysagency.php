<?php
class SysAgency extends Base_Controller {
    
    function __construct() {
        parent::__construct();
        
        $this->check_belogin(array(ROLE_ID_ADMIN,ROLE_ID_AGENCY));
    }
    
    public function index() {
        $this->load->model('Users_Agency_Model');
        $users_agent_model = new Users_Agency_Model();
        
        $name = $this->input->get('name');
        $username = $this->input->get('username');
        
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
        
        $re = $users_agent_model->getContractAgency($conditions, true);

        $this->smarty->assign('rowset', $re);
        $this->smarty->display('./sysmanager/agency_manager.html');
    }
    
    public function expired() {
        $this->load->model('Users_Agency_Model');
        $users_agent_model = new Users_Agency_Model();
        
        $name = $this->input->get('name');
        $username = $this->input->get('username');
        
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
        
        $re = $users_agent_model->getExpiredAgency($conditions, true);
        
        $this->smarty->assign('rowset', $re);
        $this->smarty->display('./sysmanager/agency_expired.html');
    }
    
    public function edit() {
    
        $this->smarty->display('./sysmanager/agency_edit.html');
    }
    
    public function save() {
        $this->load->model('Users_Agency_Model');
        $users_agent_model = new Users_Agency_Model();
        
        $row['name'] = $this->input->post('name');
        $row['address'] = $this->input->post('address');
        $row['code'] = $this->input->post('code');
        $row['contact'] = $this->input->post('contact');
        $row['contact_tel'] = $this->input->post('contact_tel');
        $row['sign_date_start'] = strtotime($this->input->post('sign_date_start'));
        $row['sign_date_end'] = strtotime($this->input->post('sign_date_end'));
        
        $re = $users_agent_model->save($row);
        
        if ($re) {
            alert('保存成功', url('sysagency/index'));
        } else {
            alert('保存失敗', null, true);
        }
    }
    
    public function updateprofile() {
        $this->load->model('Users_Agency_Model');
        $users_agent_model = new Users_Agency_Model();
        
        $uid = $this->input->get('id');
        $type = $this->input->get('type');
        
        $re = $users_agent_model->getAgencyById($uid);
        
        $this->smarty->assign('profile', $re);
        $this->smarty->assign('type', $type);
        $this->smarty->display('./sysmanager/agency_profile_edit.html');
    }
    
    public function saveprofile() {
        $this->load->model('Users_Agency_Model');
        $users_agent_model = new Users_Agency_Model();
        
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
        
        $re = $users_agent_model->update($uid, $row);
        
        if ($re) {
            alert('保存成功', url('sysagency/index'));
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
            alert('重置成功', url('sysagency/index'));
        } else {
            alert('重置失敗', url('sysagency/index'));
        }
    }
    
    public function suspended() {
        $this->load->model('Users_Model');
        $users = new Users_Model();
        
        $uid = $this->input->get('id');
        
        $re = $users->suspended($uid);
        
        if ($re['result']) {
            alert('停權成功', url('sysagency/index'));
        } else {
            alert('停權失敗', url('sysagency/index'));
        }
    }
    
    public function renewal() {
        $uid = $this->input->get('id');
        
        $this->smarty->assign('uid', $uid);
        $this->smarty->display('./sysmanager/agency_renewal.html');
    }
    
    /*****************************
     * 旅行社后台管理
     *****************************/
    
    public function info() {
        $this->load->model('Users_Agency_Model');
        $users_agent_model = new Users_Agency_Model();
        
        $re = $users_agent_model->getAgencyById($this->user['id']);
        
        $this->smarty->assign('profile', $re);
        $this->smarty->display('./agency/profile.html');
    }
    
    public function groupedit() {
        $this->load->model('Group_Model');
        $group = new Group_Model();
        
        $gid = $this->input->get('id');
        $re = $group->getGroupBase($gid);
        
        if ($re && sizeof($re>0)) {
            $re->start_date = date('Y-m-d', $re->start_date);
            $re->end_date = date('Y-m-d', $re->end_date);
            $re->start_departure_time = date('H:i', $re->start_departure_time);
            $re->start_arrive_time = date('H:i', $re->start_arrive_time);
            $re->end_departure_time = date('H:i', $re->end_departure_time);
            $re->end_arrive_time = date('H:i', $re->end_arrive_time);
        }
        
        $this->smarty->assign('id',$gid);
        $this->smarty->assign('row',$re);
        $this->smarty->display('./agency/group_edit_base.html');
    }
	
	public function groupmapupload() {
		//上傳文件
		$upload = $this->file_upload('file','group',date('Ymd'));
		
		echo json_encode($upload);
	}
    
    public function groupsave() {
        $this->load->model('Group_Model');
        $group = new Group_Model();
        
        $row['aid'] = $this->user['id'];
        $row['code'] = $this->input->post('code');
        $row['gcode'] = $this->input->post('gcode');
        $row['name'] = $this->input->post('name');
        $row['continent'] = $this->input->post('continent');
        $row['country'] = $this->input->post('country');
        $row['city'] = $this->input->post('city');
        $row['days'] = $this->input->post('days');
        $row['start_date'] = $this->input->post('start_date');
        $row['start_flight_code'] = $this->input->post('start_flight_code');
        $row['start_flight_num'] = $this->input->post('start_flight_num');
        $row['start_departure_time'] = $this->input->post('start_departure_time');
        $row['start_arrive_time'] = $this->input->post('start_arrive_time');
        $row['end_date'] = $this->input->post('end_date');
        $row['end_flight_code'] = $this->input->post('end_flight_code');
        $row['end_flight_num'] = $this->input->post('end_flight_num');
        $row['end_departure_time'] = $this->input->post('end_departure_time');
        $row['end_arrive_time'] = $this->input->post('end_arrive_time');
        $row['op'] = $this->input->post('op');
        $row['amount'] = $this->input->post('amount');
        $row['contact_name'] = $this->input->post('contact_name');
        $row['contact_tel'] = $this->input->post('contact_tel');
		$row['map'] = $this->input->post('map');
        
        $re = $group->saveGroupBase($row);
        
        if ($re['result']) {
            redirect(url('sysagency/grouproom').'&id='.$re['id']);
        }
    }
    
    public function grouproom() {
        $this->load->model('Group_Model');
        $group = new Group_Model();
        
        $gid = $this->input->get('id');
        if (!$gid || $gid == '') {
            alert('请先填写资料');
            redirect(url('sysagency/groupedit'));
        }
        
        $re = $group->getGroupRoom($gid);
        
        $html_rooms_single = $this->_gen_room_selector('single_room', $re->single_room);
        $html_rooms_double = $this->_gen_room_selector('double_room', $re->double_room);
        $html_rooms_full = $this->_gen_room_selector('full_room', $re->full_room);
        $html_rooms_plus = $this->_gen_room_selector('plus_room', $re->plus_room);
        $html_rooms_kid = $this->_gen_room_selector('kid_room', $re->kid_room);
        
        $this->smarty->assign('id',$gid);
        $this->smarty->assign('row',$re);
        $this->smarty->assign('html_rooms_single', $html_rooms_single);
        $this->smarty->assign('html_rooms_double', $html_rooms_double);
        $this->smarty->assign('html_rooms_full', $html_rooms_full);
        $this->smarty->assign('html_rooms_plus', $html_rooms_plus);
        $this->smarty->assign('html_rooms_kid', $html_rooms_kid);
        $this->smarty->display('./agency/group_edit_room.html');
    }
    
    public function grouproomsave() {
        $this->load->model('Group_Model');
        $group = new Group_Model();
        
        $gid = $this->input->post('id');
        $row['single_room'] = $this->input->post('single_room');
        $row['double_room'] = $this->input->post('double_room');
        $row['full_room'] = $this->input->post('full_room');
        $row['plus_room'] = $this->input->post('plus_room');
        $row['kid_room'] = $this->input->post('kid_room');
        
        $re = $group->saveGroupRoom($gid, $row);
        
        if ($re['result']) {
            redirect(url('sysagency/groupschedule').'&id='.$gid);
        }
    }
    
    public function groupschedule() {
        $this->load->model('Group_Model');
		$this->load->model('Users_Hotel_Model');
		$this->load->model('Users_Restaurant_Model');
		
        $gid = $this->input->get('id');
        if (!$gid || $gid == '') {
            alert('请先填写资料');
            redirect(url('sysagency/groupedit'));
        }

		$group = new Group_Model();
        $re = $group->getGroupSchedule($gid);
		
		$hotel = new Users_Hotel_Model();
		$re_hotel = $hotel->getContractHotel(null, true);
		$html_hotel = '';
		foreach($re_hotel as $rh) {
			$html_hotel .= '<option value="'.$rh->users->id.'">'.$rh->users->name.'</option>';
		}
		
		$restaurant = new Users_Restaurant_Model();
		$re_restaurant = $restaurant->getContractRestaurant(null, true);
		$html_restaurant = '';
		foreach($re_restaurant as $rh) {
			$html_restaurant .= '<option value="'.$rh->users->name.'">'.$rh->users->name.'</option>';
		}
        
        $this->smarty->assign('id',$gid);
        $this->smarty->assign('rowset',$re);
		$this->smarty->assign('html_hotel',$html_hotel);
		$this->smarty->assign('html_restaurant',$html_restaurant);
        $this->smarty->display('./agency/group_edit_schedule.html');
    }
    
    public function groupschedulesave() {
        $this->load->model('Group_Model');
        $group = new Group_Model();
        
        $gid = $this->input->post("id");
        $days = $this->input->post("days");
        
        $rows = array();
        foreach ($days as $day) {
            $types = $this->input->post("type_".$day);
            $times = $this->input->post("time_".$day);
            $hids = $this->input->post("hid_".$day);
			$rnames = $this->input->post("rname_".$day);
            $locations = $this->input->post("location_".$day);
            $moneys = $this->input->post("money_".$day);
            $details = $this->input->post("detail_".$day);
			$tabs = $this->input->post("tab_".$day);
            
            for ($i=0;$i<sizeof($types);$i++) {
                $row['gid'] = $gid;
                $row['day'] = $day;
                $row['route'] = $i+1;
                $row['type'] = $types[$i];
                $row['time'] = $times[$i];
                $row['hid'] = $hids[$i];
                $row['location'] = ($types[$i]=='2'||$types[$i]=='3')?$rnames[$i]:$locations[$i];
                $row['money'] = $moneys[$i];
                $row['detail'] = $details[$i];
				$row['tab'] = $tabs;
                
                $rows[] = $row;
            }
        }
        
        $re = $group->saveGroupSchedual($gid, $rows);
        
        if ($re['result']) {
            redirect(url('sysagency/groupinfo').'&id='.$gid);
        }
    }
    
    public function groupinfo() {
        $this->load->model('Group_Model');
		$this->load->model('Users_Guide_Model');
		
        $group = new Group_Model();
        
        $gid = $this->input->get('id');
        if (!$gid || $gid == '') {
            alert('请先填写资料');
            redirect(url('sysagency/groupedit'));
        }
		
		$re_group = $group->getGroupBase($gid);
        $re = $group->getGroupInfo($gid);
		
		//獲得導遊列表
		$guide = new Users_Guide_Model();
		$re_guide = $guide->getContractGuide(null, TRUE);
		$html_guide = '';
		$guides = array();
		foreach($re_guide as $rg) {
			if ($rg->users->id == $re->guide_id) {
				$selected = 'selected="selected"';
			} else {
				$selected = '';
			}
			$html_guide .= '<option value="'.$rg->users->id.'" '.$selected.'>'.$rg->users->username.'（'.$rg->users->name.'）</option>';
			$guides[$rg->users->id] = array('name'=>$rg->users->name, 'contact_tel'=>$rg->contact_tel);
		}
        
        $this->smarty->assign('id',$gid);
		$this->smarty->assign('group',$re_group);
        $this->smarty->assign('row',$re);
		$this->smarty->assign('html_guide',$html_guide);
		$this->smarty->assign('json_guide',json_encode($guides));
        $this->smarty->display('./agency/group_edit_info.html');
    }
    
    public function groupinfosave() {
        $this->load->model('Group_Model');
		
        $group = new Group_Model();
        
        $gid = $this->input->post('id');
        $row['leader'] = $this->input->post('leader');
        $row['leader_tel'] = $this->input->post('leader_tel');
        $row['attention'] = $this->input->post('attention');
        $row['guide_id'] = $this->input->post('guide_id');
        $row['guide_name'] = $this->input->post('guide_name');
        $row['guide_tel'] = $this->input->post('guide_tel');
        $row['regulator'] = $this->input->post('regulator');
        $row['regulator_tel'] = $this->input->post('regulator_tel');
        $row['member_names'] = $this->input->post('member_names');
		
		//檢查導遊是否已經占團
		if (!$group->checkGroupGuide($gid, $row['guide_id'])) {
			alert('导游档期已满，请确认时间！', null, TRUE);
			exit();
		}
        
        $re = $group->saveGroupInfo($gid, $row);
		
        if ($re['result']) {
            redirect(url('sysagency/groupprogress'));
        }
    }
    
    public function groupprogress() {
        $this->load->model('Group_Model');
        
        $group_model = new Group_Model();
        $re = $group_model->getActiveGroupByAid($this->user['id'], true);
        
        $this->smarty->assign('rowset', $re);
        $this->smarty->display('./agency/group_manager.html');
    }
    
    public function grouphistory() {
        $this->load->model('Group_Model');
        
        $date_start = $this->input->get('start_date');
        $date_end = $this->input->get('end_date');
        $guide = $this->input->get('guide');
        $code = $this->input->get('code');
        
        $conditions['aid'] = $this->user['id'];
        if ($date_start != '') {
            $conditions['end_date >'] = strtotime($date_start);
        }
        if ($date_end != '') {
            $conditions['start_date <'] = strtotime($date_end);
        }
        if ($guide != '') {
        		$this->load->model('Users_Model');
			$gde = new Users_Model();
			$re_gde = $gde->getUserByKeyword($guide);
            $conditions['gid'] = $re_gde->id;
        }
        if ($code != '') {
            $conditions['code'] = $code;
        }
        
        $group_model = new Group_Model();
        $re = $group_model->getGroupByConditions($conditions, true);
        
        $this->smarty->assign('rowset', $re);
        $this->smarty->display('./agency/group_history.html');
    }
    
    public function accident() {
        $this->load->model('Accident_Model');
        $accident = new Accident_Model();
        
        $re = $accident->getAccident(true, $this->user['id']);
        
        $this->smarty->assign('rowset', $re->all);
        $this->smarty->assign('res', json_encode($re->res));
        $this->smarty->display('./agency/accidents.html');
    }
	
	public function schedule() {
        $gid = $_REQUEST['gid'];
        
        $this->load->model('Group_Model');
		
        $group_model = new Group_Model();
        $rows = $group_model->getScheduleById($gid, true);
        
        $re = array();
        foreach ($rows as $row) {
            $r['id'] = $row->id;
            $r['gid'] = $row->gid;
            $r['day'] = $row->day;
            $r['route'] = $row->route;
            $r['type'] = $row->type;
            $r['time'] = date('H:i', $row->time);
            $r['hid'] = $row->hid;
            $r['rid'] = $row->rid;
            $r['hstatus'] = $row->hstatus;
            $r['rstatus'] = $row->rstatus;
            $r['detail'] = $row->detail;
            $r['location'] = ($row->type=='4')?$row->hotel->name:$row->location;
            
            $re[$row->day][] = $r;
        }
        
        echo json_encode($re);
    }
    
    private function _gen_room_selector($id, $default) {
        $html = '<select id="'.$id.'" name="'.$id.'" onchange="calc();">';
        for ($i=0;$i<=15;$i++) {
            $val = $i;
            if ($val == $default) {
                $html .= '<option value="'.$val.'" selected="selected">'.$val.'</option>';
            } else {
                $html .= '<option value="'.$val.'">'.$val.'</option>';
            }
        }
		$html .= '</select>';
		
		return $html;
    }
}
?>