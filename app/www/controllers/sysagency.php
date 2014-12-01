<?php
class SysAgency extends Base_Controller {
    
    function __construct() {
        parent::__construct();
        
        $this->check_belogin();
    }
    
    public function index() {
        $this->load->model('Users_Agency_Model');
        $users_agent_model = new Users_Agency_Model();
        
        $name = $this->input->get('name');
        $username = $this->input->get('username');
        
        $conditions = array();
        if ($name && $name != '') {
            $conditions['name'] = $name;
        }
        if ($username && $username != '') {
            $conditions['username'] = $username;
        }
        
        $re = $users_agent_model->getContractAgency($conditions);

        $this->smarty->assign('rowset', $re);
        $this->smarty->display('./sysmanager/agency_manager.html');
    }
    
    public function expired() {
        $this->load->model('Users_Agency_Model');
        $users_agent_model = new Users_Agency_Model();
        
        $name = $this->input->get('name');
        $username = $this->input->get('username');
        
        $conditions = array();
        if ($name && $name != '') {
            $conditions['name'] = $name;
        }
        if ($username && $username != '') {
            $conditions['username'] = $username;
        }
        
        $re = $users_agent_model->getExpiredAgency($conditions);
        
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
        
        $this->smarty->assign('id',$gid);
        $this->smarty->assign('row',$re);
        $this->smarty->display('./agency/group_edit_base.html');
    }
    
    public function groupsave() {
        $this->load->model('Group_Model');
        $group = new Group_Model();
        
        $row['aid'] = $this->user['id'];
        $row['code'] = $this->input->post('code');
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
        
        $this->smarty->assign('id',$gid);
        $this->smarty->assign('row',$re);
        $this->smarty->display('./agency/group_edit_room.html');
    }
    
    public function grouproomsave() {
        $this->load->model('Group_Model');
        $group = new Group_Model();
        
        $gid = $this->input->post('id');
        $row['single_room'] = $this->input->post('single_room');
        $row['double_room'] = $this->input->post('double_room');
        $row['plus_room'] = $this->input->post('plus_room');
        
        $re = $group->saveGroupRoom($gid, $row);
        
        if ($re['result']) {
            redirect(url('sysagency/groupschedule').'&id='.$gid);
        }
    }
    
    public function groupschedule() {
        $this->load->model('Group_Model');
        $group = new Group_Model();
        
        $gid = $this->input->get('id');
        if (!$gid || $gid == '') {
            alert('请先填写资料');
            redirect(url('sysagency/groupedit'));
        }

        $re = $group->getGroupSchedule($gid);
        
        $this->smarty->assign('id',$gid);
        $this->smarty->assign('row',$re);
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
            $locations = $this->input->post("location_".$day);
            $moneys = $this->input->post("money_".$day);
            $details = $this->input->post("detail_".$day);
            
            for ($i=0;$i<sizeof($types);$i++) {
                $row['gid'] = $gid;
                $row['day'] = $day;
                $row['route'] = $i+1;
                $row['type'] = $types[$i];
                $row['time'] = $times[$i];
                $row['hid'] = $hids[$i];
                $row['location'] = $locations[$i];
                $row['money'] = $moneys[$i];
                $row['detail'] = $details[$i];
                
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
        $group = new Group_Model();
        
        $gid = $this->input->get('id');
        if (!$gid || $gid == '') {
            alert('请先填写资料');
            redirect(url('sysagency/groupedit'));
        }
        $re = $group->getGroupInfo($gid);
        
        $this->smarty->assign('id',$gid);
        $this->smarty->assign('row',$re);
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
        
        $re = $group->saveGroupInfo($gid, $row);
        
        if ($re['result']) {
            redirect(url('sysagency/groupprogress'));
        }
    }
    
    public function groupprogress() {
        $this->load->model('Group_Model');
        
        $group_model = new Group_Model();
        $re = $group_model->getActiveGroupByAid($this->user['id']);
        
        $this->smarty->assign('rowset', $re);
        $this->smarty->display('./agency/group_manager.html');
    }
    
    public function grouphistory() {
        $this->load->model('Group_Model');
        
        $date_start = $this->input->get('date_start');
        $date_end = $this->input->get('date_end');
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
            $conditions['contact_name'] = $guide;
        }
        if ($code != '') {
            $conditions['code'] = $code;
        }
        
        $group_model = new Group_Model();
        $re = $group_model->getGroupByConditions($conditions);
        
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
}
?>