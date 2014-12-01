<?php
class SysAccident extends Base_Controller {

    function __construct() {
        parent::__construct();
        
        $this->check_belogin();
    }
    
    public function index() {
        $this->load->model('Accident_Model');
        $accident = new Accident_Model();
        
        $re = $accident->getAccident(true);
        
        $this->smarty->assign('rowset', $re->all);
        $this->smarty->assign('res', json_encode($re->res));
        $this->smarty->display('./sysmanager/accidents.html');
    }
}
?>