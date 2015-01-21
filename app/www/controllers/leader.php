<?php
class Leader extends Base_Controller {

    function __construct() {
        parent::__construct();
        
        $this->check_felogin(ROLE_ID_LEADER);
        
        $this->smarty->assign( 'url_menu', url('leader/index') );
    }
    
    /**
     * 领队界面导航
     */
    public function index() {
    		$this->load->model('Group_Out_Model');
        $group = new Group_Out_Model();
        
        $re = $group->getCurrGroupByLeaderId($this->user['id']);
		
        $this->smarty->assign('info', $re);
        $this->smarty->assign( 'url_accident', url('accident/index') );
        $this->smarty->display('./leader/menu.html');
    }
}
?>