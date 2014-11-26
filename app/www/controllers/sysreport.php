<?php
class SysReport extends Base_Controller {

    function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $this->load->helper('url');
        
        redirect(url('sysreport/agency'));
    }
    
    public function agency() {
        
        $this->smarty->display('./sysmanager/report_agency.html');
    }
    
    public function restaurant() {

        $this->smarty->display('./sysmanager/report_restaurant.html');
    }
    
    public function hotel() {

        $this->smarty->display('./sysmanager/report_hotel.html');
    }
    
    public function guide() {

        $this->smarty->display('./sysmanager/report_guide.html');
    }
}
?>