<?php
class SysAgency extends Base_Controller {
    
    function __construct() {
        parent::__construct();
        
        $this->check_belogin(array(ROLE_ID_ADMIN,ROLE_ID_EMBRATUR, ROLE_ID_UNION,ROLE_ID_AGENCY,ROLE_ID_UNION,ROLE_ID_INSURANCE,ROLE_ID_REINSURANCE,ROLE_ID_ASSISTANCE,ROLE_ID_FAMILY));
    }
    
    public function index() {
        $this->load->model('Users_Agency_Model');
        $users_agent_model = new Users_Agency_Model();
        
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
        
        $re = $users_agent_model->getContractAgency($conditions, true, $page);

        $this->smarty->assign('rowset', $re['rowset']);
		$this->smarty->assign('pager', pagerui($re['pager']));
        $this->smarty->display('./sysmanager/agency_manager.html');
    }
    
    public function expired() {
        $this->load->model('Users_Agency_Model');
        $users_agent_model = new Users_Agency_Model();
        
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
        
        $re = $users_agent_model->getExpiredAgency($conditions, $page);
        
        $this->smarty->assign('rowset', $re['rowset']);
		$this->smarty->assign('pager', pagerui($re['pager']));
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
		$row['email'] = $this->input->post('email');
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
        } elseif ($type == 'code') {
        		$row['code'] = $this->input->post('code');
			
			$this->load->model('Users_Model');
        		$users_model = new Users_Model();
				
			$users_model->update_username($uid, $row['code']);
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
    
	public function contractr() {
		$this->load->model('Contract_Restaurant_Model');
		$crm = new Contract_Restaurant_Model();
		
		$page = $this->input->get('page');
		$aid = $this->input->get('aid');
		if (!$aid || $aid == '') {
			$aid = $this->user['id'];
		}
		$re = $crm->getCRestaurantByAgency($aid,$page);
		
		$this->smarty->assign('aid', $aid);
		$this->smarty->assign('rowset', $re['rowset']);
		$this->smarty->assign('pager', pagerui($re['pager']));
        $this->smarty->display('./sysmanager/agency_contractr.html');
	}

	public function contractredit() {
		$this->load->model('Users_Restaurant_Model');
        $users_restaurant_model = new Users_Restaurant_Model();
        
        $name = $this->input->get('name');
        $username = $this->input->get('username');
		$page = $this->input->get('page');
		$aid = $this->input->get('aid');
        
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
        
        $re = $users_restaurant_model->getContractRestaurant($conditions, true, $page, 8);
        
		$this->smarty->assign('aid', $aid);
        $this->smarty->assign('rowset', $re['rowset']);
		$this->smarty->assign('pager', pagerui($re['pager']));
        $this->smarty->display('./sysmanager/agency_contractr_edit.html');
	}
	
	public function contractrsave() {
		$this->load->model('Contract_Restaurant_Model');
		$crm = new Contract_Restaurant_Model();
		
		$aid = $this->input->get('aid');
		$rid = $this->input->get('rid');
		
		$re = $crm->createContractAR($aid, $rid);
		
		if ($re['result']) {
			alert('添加成功',url('sysagency/contractr').'&aid='.$aid);
		} else {
			alert($re['msg'],null,TRUE);
		}
	}
	
	public function contractrremove() {
		$this->load->model('Contract_Restaurant_Model');
		$crm = new Contract_Restaurant_Model();
		
		$id = $this->input->get('id');
		$aid = $this->input->get('aid');
		
		$re = $crm->removeContractAR($id);
		
		if ($re) {
			alert('已成功解除合約關係',url('sysagency/contractr').'&aid='.$aid);
		} else {
			alert('解除合約關係失敗',null,TRUE);
		}
	}
	
	public function contracth() {
		$this->load->model('Contract_Hotel_Model');
		$chm = new Contract_Hotel_Model();
		
		$page = $this->input->get('page');
		$aid = $this->input->get('aid');
		if (!$aid || $aid == '') {
			$aid = $this->user['id'];
		}
		$re = $chm->getCHotelByAgency($aid, $page);
		
		$this->smarty->assign('aid', $aid);
		$this->smarty->assign('rowset', $re['rowset']);
		$this->smarty->assign('pager', pagerui($re['pager']));
        $this->smarty->display('./sysmanager/agency_contracth.html');
	}
	
	public function contracthedit() {
		$this->load->model('Users_Hotel_Model');
        $users_hotel_model = new Users_Hotel_Model();
        
        $name = $this->input->get('name');
        $username = $this->input->get('username');
		$page = $this->input->get('page');
		$aid = $this->input->get('aid');
        
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
        
        $re = $users_hotel_model->getContractHotel($conditions, true, $page, 8);
        
		$this->smarty->assign('aid', $aid);
        $this->smarty->assign('rowset', $re['rowset']);
		$this->smarty->assign('pager', pagerui($re['pager']));
        $this->smarty->display('./sysmanager/agency_contracth_edit.html');
	}
	
	public function contracthsave() {
		$this->load->model('Contract_Hotel_Model');
		$chm = new Contract_Hotel_Model();
		
		$aid = $this->input->get('aid');
		$hid = $this->input->get('hid');
		
		$re = $chm->createContractAH($aid, $hid);
		
		if ($re['result']) {
			alert('添加成功',url('sysagency/contracth').'&aid='.$aid);
		} else {
			alert($re['msg'],null,TRUE);
		}
	}

	public function contracthremove() {
		$this->load->model('Contract_Hotel_Model');
		$chm = new Contract_Hotel_Model();
		
		$id = $this->input->get('id');
		$aid = $this->input->get('aid');
		
		$re = $chm->removeContractAH($id);
		
		if ($re) {
			alert('已成功解除合約關係',url('sysagency/contracth').'&aid='.$aid);
		} else {
			alert('解除合約關係失敗',null,TRUE);
		}
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
            $re->start_departure_time = $re->start_departure_time?date('H:i', $re->start_departure_time):'';
            $re->start_arrive_time = $re->start_arrive_time?date('H:i', $re->start_arrive_time):'';
            $re->end_departure_time = $re->end_departure_time?date('H:i', $re->end_departure_time):'';
            $re->end_arrive_time = $re->end_arrive_time?date('H:i', $re->end_arrive_time):'';
        }
        
        $this->smarty->assign('id',$gid);
        $this->smarty->assign('row',$re);
        $this->smarty->display('./agency/group_edit_base.html');
    }
    
    public function groupsave() {
        $this->load->model('Group_Model');
        $group = new Group_Model();
        
		if ($this->input->post("id")) {
			$row['id'] = $this->input->post("id");
		}
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
        
        if ($re['result']=='1') {
            redirect(url('sysagency/grouproom').'&id='.$re['id']);
        } else {
        		alert('保存失敗',null,TRUE);
        }
    }
	
	public function groupedit_out() {
        $this->load->model('Group_Out_Model');
		$this->load->model('Users_Leader_Model');
		
        $group = new Group_Out_Model();
        $gid = $this->input->get('id');
        $re = $group->getGroupOutById($gid);
		
		if ($re && sizeof($re>0)) {
            $re->start_date = date('Y-m-d', $re->start_date);
            $re->end_date = date('Y-m-d', $re->end_date);
        }
		
		//獲得導遊列表
		$leader = new Users_Leader_Model();
		$re_leader = $leader->getAgencyContractLeader(null, $this->user['id']);
		$html_leader = '';
		$leaders = array();
		foreach($re_leader as $rg) {
			if ($rg->users->id == $re->lid) {
				$selected = 'selected="selected"';
			} else {
				$selected = '';
			}
			$html_leader .= '<option value="'.$rg->users->id.'" '.$selected.'>'.$rg->users->username.'（'.$rg->users->name.'）</option>';
			$leaders[$rg->users->id] = array('name'=>$rg->users->name, 'contact_tel'=>$rg->contact_tel);
		}
        
        $this->smarty->assign('id',$gid);
        $this->smarty->assign('row',$re);
		$this->smarty->assign('html_leader',$html_leader);
		$this->smarty->assign('json_leader',json_encode($leaders));
        $this->smarty->display('./agency/group_edit_out.html');
    }
    
    public function groupsave_out() {
        $this->load->model('Group_Out_Model');
        $group = new Group_Out_Model();
        
		if ($this->input->post("id")) {
			$row['id'] = $this->input->post("id");
		}
        $row['aid'] = $this->user['id'];
		$row['gid'] = $this->input->post('guide_id');
        $row['code'] = $this->input->post('code');
		$row['map'] = $this->input->post('map');
        $row['contact_name'] = $this->input->post('guide_name');
        $row['contact_tel'] = $this->input->post('guide_tel');
		$row['start_date'] = $this->input->post('start_date');
        $row['end_date'] = $this->input->post('end_date');
        
        $re = $group->saveGroupOut($row);
        
        if ($re['result']=='1') {
        		alert('保存成功',url('sysagency/groupedit_out'));
        } else {
        		alert('保存失敗',null,TRUE);
        }
    }
	
	public function groupmapupload() {
		//上傳文件
		$upload = $this->file_upload('file','group',date('Ymd'));
		
		echo json_encode($upload);
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
		$re_hotel = $hotel->getScheduleContractHotel(null, $gid);
		$html_hotel = '';
		foreach($re_hotel as $rh) {
			$html_hotel .= '<option value="'.$rh->users->id.'" region="'.$rh->region.'">'.$rh->users->name.'</option>';
			$regions_h[$rh->region] = '1';
		}
		
		$restaurant = new Users_Restaurant_Model();
		$re_restaurant = $restaurant->getScheduleContractRestaurant(null, $gid);
		$html_restaurant = '';
		foreach($re_restaurant as $rr) {
			$html_restaurant .= '<option value="'.$rr->users->name.'" region="'.$rr->region.'">'.$rr->users->name.'</option>';
			$regions_r[$rr->region] = '1';
		}
		
		$html_regions_r = '<option value="">所有地區</option>';
		foreach($regions_r as $r=>$v) {
			$html_regions_r .= '<option value="'.$r.'">'.$r.'</option>';
		}
        
		$html_regions_h = '<option value="">所有地區</option>';
		foreach($regions_h as $r=>$v) {
			$html_regions_h .= '<option value="'.$r.'">'.$r.'</option>';
		}
		
        $this->smarty->assign('id',$gid);
        $this->smarty->assign('rowset',$re);
		$this->smarty->assign('html_hotel',$html_hotel);
		$this->smarty->assign('html_restaurant',$html_restaurant);
		$this->smarty->assign('html_regions_r',$html_regions_r);
		$this->smarty->assign('html_regions_h',$html_regions_h);
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
			$hnames = $this->input->post("hname_".$day);
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
				if ($types[$i]=='4') {
					$row['location'] = $hnames[$i];
				} elseif ($types[$i]=='2'||$types[$i]=='3') {
					$row['location'] = $rnames[$i];
				} else {
					$row['location'] = $locations[$i];
				}
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
		$re_guide = $guide->getAgencyContractGuide(null, $this->user['id']);
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
			alert('導遊檔期已滿，請確認時間！', null, TRUE);
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

	public function groupprogress_out() {
        $this->load->model('Group_Model');
        
        $group_model = new Group_Model();
        $re = $group_model->getActiveGroupOutByAid($this->user['id'], true);
        
        $this->smarty->assign('rowset', $re);
        $this->smarty->display('./agency/group_manager_out.html');
    }
    
    public function grouphistory_out() {
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
        $re = $group_model->getGroupOutByConditions($conditions, true);
        
        $this->smarty->assign('rowset', $re);
        $this->smarty->display('./agency/group_history_out.html');
    }
    
    public function accident() {
        $this->load->model('Accident_Model');
        $accident = new Accident_Model();
        
		//$source = '0';
        $re = $accident->getAccident(true, $this->user['id'], $source, $this->role['id'], $this->user['id']);
        
		$this->smarty->assign('source', $source);
        $this->smarty->assign('rowset', $re->all);
        $this->smarty->assign('res', json_encode($re->res));
        $this->smarty->display('./agency/accidents.html');
    }
	
	public function accident_out() {
        $this->load->model('Accident_Model');
        $accident = new Accident_Model();
        
		$source = '1';
        $re = $accident->getAccident(true, $this->user['id'], $source, $this->role['id'], $this->user['id']);
        
		$this->smarty->assign('source', $source);
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
//          $r['location'] = ($row->type=='4')?$row->hotel->name:$row->location;
			if ($row->type=='4') {
            		$r['location'] = $row->hotel->name;
			} elseif ($row->type=='2' || $row->type=='3') {
				if ($row->rstatus == '4') {
					$r['location'] = $row->restaurant->name.' '.$row->location; //餐廳名和取消原因
				} else {
					$r['location'] = $row->restaurant->name?$row->restaurant->name:$row->location; //餐廳名
				}
            	} else {
            		$r['location'] = $row->location;
			}
            
            $re[$row->day][] = $r;
        }
        
        echo json_encode($re);
    }
	
	public function guide() {
		$this->load->model('Users_Guide_Model');
		
		$guide = new Users_Guide_Model();
		$re_guide = $guide->getContractGuide(null, TRUE, 0, 300);
		$guides = array();
		foreach($re_guide['rowset'] as $rg) {
			$row = array('id'=>$rg->users->id, 'name'=>$rg->users->username.'（'.$rg->users->name.'）', 'nickname'=>$rg->users->name, 'contact_tel'=>$rg->contact_tel);
			$guides[] = $row;
		}
		
		echo json_encode($guides);
	}
	
	public function leader() {
		$this->load->model('Users_Leader_Model');
		
		$leader = new Users_Leader_Model();
		$re_leader = $leader->getContractLeader(null, TRUE, 0, 300);
		$leaders = array();
		foreach($re_leader['rowset'] as $rg) {
			$row = array('id'=>$rg->users->id, 'name'=>$rg->users->username.'（'.$rg->users->name.'）', 'nickname'=>$rg->users->name, 'contact_tel'=>$rg->contact_tel);
			$leaders[] = $row;
		}
		
		echo json_encode($leaders);
	}
	
	public function guideedit() {
		
        $this->smarty->display('./agency/guide_edit.html');
	}
	
	public function leaderedit() {
		
        $this->smarty->display('./agency/leader_edit.html');
	}
	
	public function guidesave() {
		$this->load->model('Users_Guide_Model');
        $users_guide_model = new Users_Guide_Model();
    
        $row['name'] = $this->input->post('name');
        $row['code'] = $this->input->post('code');
        $row['contact_tel'] = $this->input->post('contact_tel');
        $row['sign_date_start'] = strtotime($this->input->post('sign_date_start'));
        $row['sign_date_end'] = strtotime($this->input->post('sign_date_end'));
    
        $re = $users_guide_model->save($row);
		
		if ($re) {
            echo '<script>alert("保存成功");</script>';
			echo '<script>window.parent.onbuildguide();</script>';
        } else {
            alert('保存失敗', null, true);
        }
	}
	
	public function leadersave() {
		$this->load->model('Users_Leader_Model');
        $users_leader_model = new Users_Leader_Model();
    
        $row['name'] = $this->input->post('name');
        $row['code'] = $this->input->post('code');
        $row['contact_tel'] = $this->input->post('contact_tel');
        $row['sign_date_start'] = strtotime($this->input->post('sign_date_start'));
        $row['sign_date_end'] = strtotime($this->input->post('sign_date_end'));
    
        $re = $users_leader_model->save($row);
		
		if ($re) {
            echo '<script>alert("保存成功");</script>';
			echo '<script>window.parent.onbuildleader();</script>';
        } else {
            alert('保存失敗', null, true);
        }
	}
	
	public function report() {
		$name = $this->input->get('name');
		$start_date = $this->input->get('start_date');
		$end_date = $this->input->get('end_date');
		$aid = $this->user['id'];
		
		$re = $this->_get_agency_report_data($name, $start_date, $end_date, $aid);
		
		$this->smarty->assign('start_date', $start_date);
		$this->smarty->assign('end_date', $end_date);
		$this->smarty->assign('name', $name);
		$this->smarty->assign('rowset', $re['rowset']);
		$this->smarty->assign('total', $re['total']);
        $this->smarty->display('./agency/report.html');
	}
	
	public function reportexplore() {
		$report = $this->input->get("report");
		$name = $this->input->get("name");
		$start_date = $this->input->get("start_date");
		$end_date = $this->input->get("end_date");
		
		header('Content-Encoding: UTF-8');
		header("Content-type:application/vnd.ms-excel;charset=UTF-8");
		header("Content-Disposition:attachment;filename=report_".$report."_".$name."_(".$start_date."-".$end_date.").xls");
		
		$re = $this->_get_agency_report_data($name, $start_date, $end_date);
		
		$html .= "序號\t";
		$html .= "用餐日期\t";
		$html .= "團號\t";
		$html .= "導遊\t";
		$html .= "餐別\t";
		$html .= "\n";
		for ($i=0;$i<sizeof($re['rowset']);$i++) {
			$item = $re['rowset'][$i];
			
			$html .= $item->id."\t";
			$html .= $item->date."\t";
			$html .= $item->code."\t";
			$html .= $item->guide_name."\t";
			if ($item->type == '0') {
				$html .= '機';
			} elseif ($item->type == '1') {
				$html .= '景';
			} elseif ($item->type == '2') {
				$html .= '中';
			} elseif ($item->type == '3') {
				$html .= '晚';
			} elseif ($item->type == '4') {
				$html .= '住';
			}
			$html .= "\t\n";
		}
		$html .= "\t\n";
		$html .= "總計 ".$re['total']->count." 筆 (".$re['total']->count."筆*5=".$re['total']->summation.")";
		$html .= "\t\n";
		
		echo $html;
	}

	public function reportprinter() {
		
		$report = $this->input->get("report");
		$name = $this->input->get("name");
		$start_date = $this->input->get("start_date");
		$end_date = $this->input->get("end_date");
		
	}
	
	public function mailtosetup() {
		$this->load->model('Users_Agency_Model');
        $users_agent_model = new Users_Agency_Model();
        
        $re = $users_agent_model->getAgencyById($this->user['id']);
        
        $this->smarty->assign('profile', $re);
        $this->smarty->display('./agency/mailtosetup.html');
	}
	
	public function mailtosetup_save() {
		$this->load->model('Users_Agency_Model');
        $users_agent_model = new Users_Agency_Model();
		
		$uid = $this->user['id'];
		$mailto_union = ($this->input->post('mailto_union') == 'on') ? '1' : '0';
		$mailto_dt = ($this->input->post('mailto_dt') == 'on') ? '1' : '0';
		
		$row['mailto_union'] = $mailto_union;
		$row['mailto_dt'] = $mailto_dt;
		$re = $users_agent_model->update($uid, $row);
        
        if ($re) {
            alert('保存成功', url('sysagency/mailtosetup'));
        } else {
            alert('保存失敗', null, true);
        }
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
	
	private function _get_agency_report_data($name, $start_date, $end_date, $aid) {
		$this->load->model('Report_Model');
		
		$conditions = array();
        if ($name && $name != '') {
        		$this->load->model('Users_Model');
			$users = new Users_Model();
			$re = $users->getUsersByName($name, $name);
			
			$ids = array(0);
			foreach ($re as $r) {
				$ids[] = $r->id;
			}
			if (sizeof($ids) > 0) {
	            $conditions['aid'] = $ids;
			}
        }
		if (!$start_date || $start_date == '') {
			$start_date = date('Y-m-d', strtotime('-1 Month'));
		}
		if (!$end_date || $end_date == '') {
			$end_date = date('Y-m-d');
		}
		$conditions['date >='] = strtotime($start_date);
		$conditions['date <='] = strtotime($end_date);
		$conditions['aid'] = $aid;
		
		$report = new Report_Model();
		$re = $report->getReportAgency($conditions);
		
		return $re;
	}
}
?>