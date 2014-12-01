<?php
class SysHotel extends Base_Controller {

    function __construct() {
        parent::__construct();
        
        $this->check_belogin(ROLE_ID_ADMIN);
    }
    
    public function index() {
        $this->load->model('Users_Hotel_Model');
        $users_hotel_model = new Users_Hotel_Model();
        
        $name = $this->input->get('name');
        $username = $this->input->get('username');
        
        $conditions = array();
        if ($name && $name != '') {
            $conditions['name'] = $name;
        }
        if ($username && $username != '') {
            $conditions['username'] = $username;
        }
        
        $re = $users_hotel_model->getContractHotel($conditions);
        
        $this->smarty->assign('rowset', $re);
        $this->smarty->display('./sysmanager/hotel_manager.html');
    }
    
    public function expired() {
        $this->load->model('Users_Hotel_Model');
        $users_hotel_model = new Users_Hotel_Model();
        
        $name = $this->input->get('name');
        $username = $this->input->get('username');
        
        $conditions = array();
        if ($name && $name != '') {
            $conditions['name'] = $name;
        }
        if ($username && $username != '') {
            $conditions['username'] = $username;
        }
        
        $re = $users_hotel_model->getExpiredHotel($conditions);
        
        $this->smarty->assign('rowset', $re);
        $this->smarty->display('./sysmanager/hotel_expired.html');
    }
    
    public function edit() {
    
        $this->smarty->display('./sysmanager/hotel_edit.html');
    }
    
    public function save() {
        $this->load->model('Users_Hotel_Model');
        $users_hotel_model = new Users_Hotel_Model();
    
        $row['name'] = $this->input->post('name');
        $row['address'] = $this->input->post('address');
        $row['code'] = $this->input->post('code');
        $row['contact'] = $this->input->post('contact');
        $row['contact_tel'] = $this->input->post('contact_tel');
        $row['sign_date_start'] = strtotime($this->input->post('sign_date_start'));
        $row['sign_date_end'] = strtotime($this->input->post('sign_date_end'));
    
        $re = $users_hotel_model->save($row);
    }
}
?>