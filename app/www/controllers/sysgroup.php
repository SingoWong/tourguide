<?php
class SysGroup extends Base_Controller {

    function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $this->load->model('Group_Model');
        
        $group_model = new Group_Model();
        $re = $group_model->getActiveGroup();
        
        $this->smarty->assign('rowset', $re);
        $this->smarty->display('./sysmanager/group_manager.html');
    }
    
    public function history() {
        $this->load->model('Group_Model');
        
        $date_start = $this->input->get('date_start');
        $date_end = $this->input->get('date_end');
        $guide = $this->input->get('guide');
        $code = $this->input->get('code');
        
        $conditions = array();
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
        $this->smarty->display('./sysmanager/group_history.html');
    }
    
    public function schedule() {
        $gid = $_REQUEST['gid'];
        
        $this->load->model('Group_Model');
        $group_model = new Group_Model();
        
        $rows = $group_model->getScheduleById($gid);
        
        $re = array();
        foreach ($rows as $row) {
            $r['id'] = $row->id;
            $r['gid'] = $row->gid;
            $r['day'] = $row->day;
            $r['route'] = $row->route;
            $r['type'] = $row->type;
            $r['time'] = date('H:m', $row->time);
            $r['hid'] = $row->hid;
            $r['rid'] = $row->rid;
            $r['hstatus'] = $row->hstatus;
            $r['rstatus'] = $row->rstatus;
            $r['detail'] = $row->detail;
            $r['location'] = $row->location;
            
            $re[$row->day][] = $r;
        }
        
        echo json_encode($re);
    }
}
?>