<?php
class Accident extends Base_Controller {

    function __construct() {
        parent::__construct();

        $this->check_felogin(ROLE_ID_GUIDE);
        
        $this->smarty->assign( 'url_menu', url('guide/index') );
        $this->smarty->assign( 'url_info', url('guide/info') );
        $this->smarty->assign( 'url_restaurant', url('guide/restaurant') );
        $this->smarty->assign( 'url_hotel', url('guide/hotel') );
        $this->smarty->assign( 'url_accident', url('accident/index') );
    }
    
    public function index() {
        
        $this->smarty->assign( 'url_bus_photo_choose', url('accident/bus_photo_choose') );
        $this->smarty->assign( 'url_medicine_photo_choose', url('accident/medicine_photo_choose') );
        $this->smarty->assign( 'url_desert_form', url('accident/desert_form') );
        $this->smarty->assign( 'url_natural_photo_choose', url('accident/natural_photo_choose') );
        $this->smarty->display('./accident/menu.html');
    }
    
    public function bus_photo_choose() {

        $this->smarty->assign( 'url_bus_photo_submit', url('accident/bus_photo_submit') );
        $this->smarty->display('./accident/bus_acc_choose.html');
    }
    
    public function bus_photo_submit() {
        //TODO 生成紀錄，並上傳圖片，返回id號
        $id = '1';
        redirect(url('accident/bus_form').'&id='.$id);
    }
    
    public function bus_form() {
        $id = $this->input->get('id');
        
        $this->smarty->assign('id', $id);
        $this->smarty->assign('time', date('Y-m-d H:i'));
        $this->smarty->assign('url_bus_submit', url('accident/bus_submit'));
        $this->smarty->display('./accident/bus_acc_form.html');
    }
    
    public function bus_submit() {
        $time = $this->input->post('time');
        $location = $this->input->post('location');
        $driver_status = $this->input->post('driver_status');
        $member_status = $this->input->post('member_status');
        $ubs_status = $this->input->post('bus_status');
        
        //TODO 保存提交的內容
        
        redirect(url('accident/bus_finish'));
    }
    
    public function bus_finish() {
        
        $this->smarty->display('./accident/bus_acc_finish.html');
    }
    
    public function medicine_photo_choose() {

        $this->smarty->assign( 'url_medicine_photo_submit', url('accident/medicine_photo_submit') );
        $this->smarty->display('./accident/medicine_acc_choose.html');
    }
    
    public function medicine_photo_submit() {
        //TODO 生成紀錄，並上傳圖片，返回id號
        $id = '1';
        redirect(url('accident/medicine_form').'&id='.$id);
    }
    
    public function medicine_form() {
        $id = $this->input->get('id');
        
        $this->smarty->assign('id', $id);
        $this->smarty->assign('time', date('Y-m-d H:i'));
        $this->smarty->assign('url_bus_submit', url('accident/medicine_submit'));
        $this->smarty->display('./accident/medicine_acc_form.html');
    }
    
    public function medicine_submit() {
        $time = $this->input->post('time');
        $location = $this->input->post('location');
        $amount = $this->input->post('amount');
        $detail = $this->input->post('detail');
        
        //TODO 保存提交的內容
        
        redirect(url('accident/medicine_finish'));
    }
    
    public function medicine_finish() {

        $this->smarty->display('./accident/medicine_acc_finish.html');
    }
    
    public function desert_form() {
        $id = $this->input->get('id');
        
        $this->smarty->assign('id', $id);
        $this->smarty->assign('time', date('Y-m-d H:i'));
        $this->smarty->assign( 'url_desert_submit', url('accident/desert_submit') );
        $this->smarty->display('./accident/desert_form.html');
    }
    
    public function desert_submit() {
        $time = $this->input->post('time');
        $location = $this->input->post('location');
        $names = $this->input->post('name');

        //TODO 保存提交的內容
        foreach ($names as $name) {
            
        }
        
        redirect(url('accident/desert_finish'));
    }
    
    public function desert_finish() {

        $this->smarty->display('./accident/desert_finish.html');
    }
    
    public function natural_photo_choose() {

        $this->smarty->assign( 'url_natural_photo_submit', url('accident/natural_photo_submit') );
        $this->smarty->display('./accident/natural_choose.html');
    }
    
    public function natural_photo_submit() {
        //TODO 生成紀錄，並上傳圖片，返回id號
        $id = '1';
        
        redirect(url('accident/natural_form').'&id='.$id);
    }
    
    public function natural_form() {
        $id = $this->input->get('id');
        
        $this->smarty->assign('id', $id);
        $this->smarty->assign('time', date('Y-m-d H:i'));
        $this->smarty->assign('url_natural_submit', url('accident/natural_submit'));
        $this->smarty->display('./accident/natural_form.html');
    }
    
    public function natural_submit() {
        $time = $this->input->post('time');
        $location = $this->input->post('location');
        $name = $this->input->post('names[]');
        
        //TODO 保存提交的內容
        
        redirect(url('accident/natural_finish'));
    }
    
    public function natural_finish() {

        $this->smarty->display('./accident/natural_finish.html');
    }
}
?>