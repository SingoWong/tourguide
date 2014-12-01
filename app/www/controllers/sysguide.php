<?php
class SysGuide extends Base_Controller {

    function __construct() {
        parent::__construct();
        
        $this->check_belogin();
    }
    
    public function index() {
        $this->load->model('Users_Guide_Model');
        $users_guide_model = new Users_Guide_Model();
        
        $name = $this->input->get('name');
        $username = $this->input->get('username');
        
        $conditions = array();
        if ($name && $name != '') {
            $conditions['name'] = $name;
        }
        if ($username && $username != '') {
            $conditions['username'] = $username;
        }
        
        $re = $users_guide_model->getContractGuide($conditions);
        
        $this->smarty->assign('rowset', $re);
        $this->smarty->display('./sysmanager/guide_manager.html');
    }
    
    public function expired() {
        $this->load->model('Users_Guide_Model');
        $users_guide_model = new Users_Guide_Model();
        
        $name = $this->input->get('name');
        $username = $this->input->get('username');
        
        $conditions = array();
        if ($name && $name != '') {
            $conditions['name'] = $name;
        }
        if ($username && $username != '') {
            $conditions['username'] = $username;
        }
        
        $re = $users_guide_model->getExpiredGuide($conditions);
        
        $this->smarty->assign('rowset', $re);
        $this->smarty->display('./sysmanager/guide_expired.html');
    }
    
    public function edit() {
    
        $this->smarty->display('./sysmanager/guide_edit.html');
    }

    public function save() {
        $this->load->model('Users_Guide_Model');
        $users_guide_model = new Users_Guide_Model();
    
        $row['name'] = $this->input->post('name');
        $row['code'] = $this->input->post('code');
        $row['contact_tel'] = $this->input->post('contact_tel');
        $row['sign_date_start'] = strtotime($this->input->post('sign_date_start'));
        $row['sign_date_end'] = strtotime($this->input->post('sign_date_end'));
    
        $re = $users_guide_model->save($row);
    }
}
?>