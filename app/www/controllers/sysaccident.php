<?php
class SysAccident extends Base_Controller {

    function __construct() {
        parent::__construct();
        
        $this->check_belogin(ROLE_ID_ADMIN);
    }
    
    public function index() {
        $this->load->model('Accident_Model');
        $accident = new Accident_Model();
        
		if ($this->role['id'] == ROLE_ID_FAMILY) {
			$source = '2';
		} else {
			$source = '0';
		}
        $re = $accident->getAccident(true,0,$source);
		
		$this->smarty->assign('source', $source);
        $this->smarty->assign('rowset', $re->all);
        $this->smarty->assign('res', json_encode($re->res));
        $this->smarty->display('./sysmanager/accidents.html');
    }

	public function index_out() {
		$this->load->model('Accident_Model');
        $accident = new Accident_Model();
        
		$source = '1';
        $re = $accident->getAccident(true,0,$source);
        
		$this->smarty->assign('source', $source);
        $this->smarty->assign('rowset', $re->all);
        $this->smarty->assign('res', json_encode($re->res));
        $this->smarty->display('./sysmanager/accidents.html');
	}
}
?>