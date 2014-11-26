<?php
class SysAgency extends Base_Controller {
    
    function __construct() {
        parent::__construct();
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
        
        $id = $this->input->get('id');
        $re = $group->getGroupBase($id);
        
        $this->smarty->assign('id',$id);
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
            $this->load->helper('url');
            redirect('index.php?'.url('sysagency/grouproom').'&id='.$re['id']);
        }
    }
    
    public function grouproom() {
        $this->load->model('Group_Model');
        $group = new Group_Model();
        
        $id = $this->input->get('id');
        $re = $group->getGroupRoom($id);
        
        $this->smarty->assign('id',$id);
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
            $this->load->helper('url');
            redirect('index.php?'.url('sysagency/groupschedule').'&id='.$re['id']);
        }
    }
    
    public function groupschedule() {
        $this->load->model('Group_Model');
        $group = new Group_Model();
        
        $gid = $this->input->post('id');
        
    }
    
    public function groupschedulesave() {
        
    }
    
    public function groupinfo() {
        $this->load->model('Group_Model');
        $group = new Group_Model();
        
        $id = $this->input->get('id');
        $re = $group->getGroupInfo($id);
        
        $this->smarty->assign('id',$id);
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
            $this->load->helper('url');
            redirect('index.php?'.url('sysagency/groupprogress'));
        }
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