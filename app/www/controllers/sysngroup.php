<?php
class SysNGroup extends Base_Controller {
    
    function __construct() {
        parent::__construct();
        
        $this->check_belogin(array(ROLE_ID_ADMIN, ROLE_ID_EMBRATUR, ROLE_ID_UNION, ROLE_ID_AGENCY, ROLE_ID_INSURANCE, ROLE_ID_REINSURANCE, ROLE_ID_ASSISTANCE));
    }
	
	public function index() {
        $this->load->model('NGroup_Model');
        
        $group_model = new NGroup_Model();
        $re = $group_model->getActiveNGroup(true, $this->role['id'], $this->user['id']);
        
        $this->smarty->assign('rowset', $re);
        $this->smarty->display('./sysmanager/ngroup_manager.html');
    }
    
    public function history() {
        $this->load->model('NGroup_Model');
        
        $date_start = $this->input->get('date_start');
        $date_end = $this->input->get('date_end');
        $insurance = $this->input->get('insurance');
        $passenger = $this->input->get('passenger');
        
        $conditions = array();
        if ($date_start != '') {
            $conditions['end_date >'] = strtotime($date_start);
        }
        if ($date_end != '') {
            $conditions['start_date <'] = strtotime($date_end);
        }
        if ($insurance != '') {
        		$this->load->model('Users_Model');
			$gde = new Users_Model();
			$re_gde = $gde->getUserByKeyword($insurance);
            $conditions['iid'] = $re_gde->id;
        }
        //TODO 旅客搜索
        
        $ngroup_model = new NGroup_Model();
        $re = $ngroup_model->getNGroupByConditions($conditions, true, $this->role['id'], $this->user['id']);
        
        $this->smarty->assign('rowset', $re);
        $this->smarty->display('./sysmanager/ngroup_history.html');
    }
	
	public function edit() {
		$this->load->model('NGroup_Model');
		$this->load->model('Users_Insurance_Model');
		$this->load->model('Users_Guide_Model');
		$this->load->model('Users_Agency_Model');
		$this->load->model('Users_Passenger_Model');
		
        $ngroup = new NGroup_Model();
        
        $gid = $this->input->get('id');
        $re = $ngroup->getNGroup($gid);
        
        if ($re && sizeof($re>0)) {
            $re->start_date = date('Y-m-d', $re->start_date);
            $re->end_date = date('Y-m-d', $re->end_date);
			
			$upm = new Users_Passenger_Model();
			$re_passenger = $upm->getPassengers($gid);
        }
		
		//初始化保險公司
		$insurance = new Users_Insurance_Model();
		$re_insurance = $insurance->getContractInsurance();
		$html_insurance = '';
		foreach($re_insurance as $ri) {
			if ($ri->users->id == $re->iid) {
				$selected = 'selected="selected"';
			} else {
				$selected = '';
			}
			$html_insurance .= '<option value="'.$ri->users->id.'" '.$selected.'>'.$ri->users->username.'（'.$ri->users->name.'）</option>';
		}
		
		//初始化導遊
		$guide = new Users_Guide_Model();
		$re_guide = $guide->getAgencyContractGuide(null, $this->user['id']);
		$html_guide = '';
		foreach($re_guide as $rg) {
			if ($rg->users->id == $re->gid) {
				$selected = 'selected="selected"';
			} else {
				$selected = '';
			}
			$html_guide .= '<option value="'.$rg->users->id.'" '.$selected.'>'.$rg->users->username.'（'.$rg->users->name.'）</option>';
		}
		
		//初始化旅行社
		$agency = new Users_Agency_Model();
		$re_agency = $agency->getAgencys();
		$html_agency_tw = '';
		$html_agency_cn = '';
		foreach($re_agency as $ra) {
			if ($ra->users->id == $re->aid_tw) {
				$tw_selected = 'selected="selected"';
			} else {
				$tw_selected = '';
			}
			if ($ra->users->id == $re->aid_cn) {
				$cn_selected = 'selected="selected"';
			} else {
				$cn_selected = '';
			}
			$html_agency_tw .= '<option value="'.$ra->users->id.'" '.$tw_selected.'>'.$ra->users->username.'（'.$ra->users->name.'）</option>';
			$html_agency_cn .= '<option value="'.$ra->users->id.'" '.$cn_selected.'>'.$ra->users->username.'（'.$ra->users->name.'）</option>';
		}
		
		if ($this->role['id'] == ROLE_ID_AGENCY) {
			$re->aid_tw = $this->user['id'];
			$re->aname_tw = $this->user['name'];
		} else {
			$re->aname_tw = '';
		}
		
		$this->smarty->assign('re_passenger', $re_passenger);
        $this->smarty->assign('html_guide', $html_guide);
		$this->smarty->assign('html_insurance', $html_insurance);
		$this->smarty->assign('html_agency_tw', $html_agency_tw);
		$this->smarty->assign('html_agency_cn', $html_agency_cn);
        $this->smarty->assign('id',$gid);
        $this->smarty->assign('row',$re);
        $this->smarty->display('./sysmanager/ngroup_edit_base.html');
	}
	
	public function save() {
		$this->load->model('NGroup_Model');
        $ngroup = new NGroup_Model();
        
		if ($this->input->post("id")) {
			$row['id'] = $this->input->post("id");
		}
		$row['type'] = $this->input->post('type');
        $row['code'] = $this->input->post('code');
        $row['iid'] = $this->input->post('iid');
        $row['policyno'] = $this->input->post('policyno');
        $row['start_date'] = $this->input->post('start_date');
        $row['end_date'] = $this->input->post('end_date');
        $row['gid'] = $this->input->post('gid');
        $row['aid_tw'] = $this->input->post('aid_tw');
        $row['aid_cn'] = $this->input->post('aid_cn');
        $row['pic'] = $this->input->post('pic');
        $row['op'] = $this->input->post('op');
        $row['op_tel'] = $this->input->post('op_tel');
        $row['regulator'] = $this->input->post('regulator');
        $row['regulator_tel'] = $this->input->post('regulator_tel');
		$passengers = $this->input->post('pids');
        
        $re = $ngroup->saveNGroup($row, $passengers);
        
        if ($re['result']=='1') {
            alert('保存成功',url('sysngroup/index'));
        } else {
        		alert('保存失敗',null,TRUE);
        }
	}

	public function picupload() {
		//上傳文件
		$upload = $this->file_upload('file','group',date('Ymd'));
		
		echo json_encode($upload);
	}
	
	public function newpasenger() {
		$this->load->model('Users_Passenger_Model');
		
		$idc = $this->input->get("idc");
		$name = $this->input->get("name");
		$policyno = $this->input->get("policyno");
		
		$passm = new Users_Passenger_Model();
		$re = $passm->save($idc, $name, $policyno);
		
		if ($re['result']) {
			output(array('result'=>'1', 'idc'=>$idc, 'name'=>$name, 'uid'=>$re['uid']));
		} else {
			output(array('result'=>'0'));
		}
	}
	
	public function query() {
        $this->load->model('NGroup_Model');
        
        $group_model = new NGroup_Model();
        $re = $group_model->getActiveNGroup(true, $this->role['id'], $this->user['id']);
        
        $this->smarty->assign('rowset', $re);
        $this->smarty->display('./sysmanager/ngroup_manager_query.html');
    }
    
    public function queryhistory() {
        $this->load->model('NGroup_Model');
        
        $date_start = $this->input->get('date_start');
        $date_end = $this->input->get('date_end');
        $insurance = $this->input->get('insurance');
        $passenger = $this->input->get('passenger');
        
        $conditions = array();
        if ($date_start != '') {
            $conditions['end_date >'] = strtotime($date_start);
        }
        if ($date_end != '') {
            $conditions['start_date <'] = strtotime($date_end);
        }
        if ($insurance != '') {
        		$this->load->model('Users_Model');
			$gde = new Users_Model();
			$re_gde = $gde->getUserByKeyword($insurance);
            $conditions['iid'] = $re_gde->id;
        }
        //TODO 旅客搜索
        
        $ngroup_model = new NGroup_Model();
        $re = $ngroup_model->getNGroupByConditions($conditions, true, $this->role['id']);
        
        $this->smarty->assign('rowset', $re);
        $this->smarty->display('./sysmanager/ngroup_history_query.html');
    }
	
}
?>