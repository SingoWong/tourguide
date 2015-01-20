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
        $this->smarty->display('./leader/menu.html');
    }
}
?>