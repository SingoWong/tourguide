<?php
class Guide extends Base_Controller {

    function __construct() {
        parent::__construct();
        
        $this->check_felogin(ROLE_ID_GUIDE);
        
        $this->smarty->assign( 'url_menu', url('guide/index') );
        $this->smarty->assign( 'url_info', url('guide/info') );
        $this->smarty->assign( 'url_restaurant', url('guide/restaurant') );
        $this->smarty->assign( 'url_hotel', url('guide/hotel') );
        $this->smarty->assign( 'url_accident', url('accident/index') );
    }
    
    /**
     * 导游界面导航
     */
    public function index() {
        $this->smarty->display('./guide/menu.html');
    }
    
    /**
     * 团号资讯
     */
    public function info() {
        $this->load->model('Group_Model');
        $group = new Group_Model();
        
        $re = $group->getCurrGroupByGuideId($this->user['id']);
        
        $this->smarty->assign('info', $re);
        $this->smarty->assign( 'url_info_journey', url('guide/info_journey') );
        $this->smarty->display('./guide/info_base.html');
    }
    
    /**
     * 行程资讯
     */
    public function info_journey() {
        $this->load->model('Group_Model');
        $group = new Group_Model();
        
        $re['info'] = $group->getCurrGroupByGuideId($this->user['id']);
        $schedule = $group->getScheduleById($re['info']->id);
        
        $rows = array();
        foreach ($schedule as $row) {
            $r['id'] = $row->id;
            $r['gid'] = $row->gid;
            $r['day'] = $row->day;
            $r['route'] = $row->route;
            $r['type'] = $row->type;
            $r['type_label'] = $this->_get_type_label($row->type);
            $r['time'] = date('H:m', $row->time);
            $r['hid'] = $row->hid;
            $r['rid'] = $row->rid;
            $r['hstatus'] = $row->hstatus;
            $r['rstatus'] = $row->rstatus;
            $r['detail'] = $row->detail;
            $r['location'] = $row->location;
        
            $rows[$row->day][] = $r;
        }
        
        $re['schedule'] = json_encode($rows);
        
        $this->smarty->assign($re);
        $this->smarty->assign( 'url_info_journey', url('guide/info_journey') );
        $this->smarty->display('./guide/info_journey.html');
    }
    
    /**
     * 订餐资讯
     */
    public function restaurant() {
        $this->load->model('Group_Model');
        $group = new Group_Model();
        
        $re['info'] = $group->getCurrGroupByGuideId($this->user['id']);
        $schedule = $group->getScheduleById($re['info']->id);
        
        $rows = array();
        foreach ($schedule as $row) {
            $r['id'] = $row->id;
            $r['gid'] = $row->gid;
            $r['day'] = $row->day;
            $r['route'] = $row->route;
            $r['type'] = $row->type;
            $r['type_label'] = $this->_get_type_label($row->type);
            $r['time'] = date('H:m', $row->time);
            $r['hid'] = $row->hid;
            $r['rid'] = $row->rid;
            $r['hstatus'] = $row->hstatus;
            $r['rstatus'] = $row->rstatus;
            $r['rstatus_label'] = $this->_get_rstatus_label($row->rstatus);
            $r['detail'] = $row->detail;
            $r['location'] = $row->location;
        
            $rows[$row->day][] = $r;
        }
        
        $re['schedule'] = json_encode($rows);
        
        $this->smarty->assign($re);
        $this->smarty->assign('url_restaurant_search', url('guide/restaurant_search').'&gid='.$re['info']->id);
        $this->smarty->assign('url_restaurant_payment', url('guide/restaurant_payment').'&gid='.$re['info']->id);
        $this->smarty->assign('url_restaurant_payment_checklist', url('guide/restaurant_payment_checklist').'&gid='.$re['info']->id);
        $this->smarty->display('./guide/restaurant_base.html');
    }
    
    /**
     * 搜索餐馆
     */
    public function restaurant_search() {
        $gid = $this->input->get('gid');
        $day = $this->input->get('day');
        $route = $this->input->get('route');

        $this->smarty->assign('gid',$gid);
        $this->smarty->assign('day',$day);
        $this->smarty->assign('route',$route);
        $this->smarty->assign('url_restaurant_result', url('guide/restaurant_result'));
        $this->smarty->display('./guide/restaurant_search.html');
    }
    
    /**
     * 餐馆搜索结果
     */
    public function restaurant_result() {
        $this->load->model('users_restaurant_model');
        
        $gid = $this->input->post('gid');
        $day = $this->input->post('day');
        $route = $this->input->post('route');
        $city = $this->input->post('city');
        $name = $this->input->post('name');
        $scenic = $this->input->post('scenic');
        
        $conditions = array();
        if ($city != '') {
            
        }
        if ($name != '') {
            
        }
        if ($scenic != '') {
        
        }
        
        $restaurant = new Users_Restaurant_Model();
        $re = $restaurant->getContractRestaurant($conditions);
        
        $this->smarty->assign('url_restaurant_detail', url('guide/restaurant_detail').'&gid='.$gid.'&day='.$day.'&route='.$route);
        $this->smarty->assign('rowset',$re);
        $this->smarty->display('./guide/restaurant_result.html');
    }
    
    /**
     * 输入订餐详细资讯
     */
    public function restaurant_detail() {
        $gid = $this->input->get('gid');
        $day = $this->input->get('day');
        $route = $this->input->get('route');
        $rid = $this->input->get('rid');
        
        $this->smarty->assign('gid',$gid);
        $this->smarty->assign('day',$day);
        $this->smarty->assign('route',$route);
        $this->smarty->assign('rid',$rid);
        $this->smarty->assign('url_restaurant_submit', url('guide/restaurant_submit'));
        $this->smarty->display('./guide/restaurant_detail.html');
    }
    
    /**
     * 保存訂餐訂單
     */
    public function restaurant_submit() {
        dump($_POST);
    }
    
    /**
     * 订餐下单成功
     */
    public function restaurant_order() {
        $this->smarty->display('./guide/restaurant_order.html');
    }
    
    /**
     * 餐厅已经回复
     */
    public function restaurant_confirm() {
        
        $this->smarty->display('./guide/restaurant_confirm.html');
    }
    
    /**
     * 检查餐厅是否已经回复
     */
    public function restaurant_check() {
        
    }
    
    /**
     * 餐厅结账支付方式
     */
    public function restaurant_payment() {
        $gid = $this->input->get('gid');
        $day = $this->input->get('day');
        $route = $this->input->get('route');
        
        $this->smarty->assign('url_restaurant_payment_checklist', url('guide/restaurant_payment_checklist').'&gid='.$gid.'&day='.$day.'&route='.$route);
        $this->smarty->display('./guide/restaurant_payment.html');
    }
    
    /**
     * 餐厅结账账单信息
     */
    public function restaurant_payment_checklist() {
        $gid = $this->input->get('gid');
        $day = $this->input->get('day');
        $route = $this->input->get('route');
        $mode = $this->input->get('mode');

        $this->smarty->assign('gid',$gid);
        $this->smarty->assign('day',$day);
        $this->smarty->assign('route',$route);
        $this->smarty->assign('mode',$mode);
        $this->smarty->assign('url_restaurant_payment_submit', url('guide/restaurant_payment_submit'));
        $this->smarty->display('./guide/restaurant_payment_checklist.html');
    }
    
    /**
     * 提交小票
     */
    public function restaurant_payment_submit() {
        $gid = $this->input->post('gid');
        $day = $this->input->post('day');
        $route = $this->input->post('route');
        $mode = $this->input->post('mode');
        $url = $this->input->post('url');
        
        //上传图片文件
        dump($_POST);
    }
    
    /**
     * 餐厅结账成功
     */
    public function restaurant_payment_finish() {
        
        $this->smarty->display('./guide/restaurant_payment_finish.html');
    }
    
    /**
     * 订房资讯
     */
    public function hotel() {
        $this->load->model('Group_Model');
        $group = new Group_Model();
        
        $re['info'] = $group->getCurrGroupByGuideId($this->user['id']);
        $schedule = $group->getScheduleById($re['info']->id);
        
        $rows = array();
        foreach ($schedule as $row) {
            $r['id'] = $row->id;
            $r['gid'] = $row->gid;
            $r['day'] = $row->day;
            $r['route'] = $row->route;
            $r['type'] = $row->type;
            $r['type_label'] = $this->_get_type_label($row->type);
            $r['time'] = date('H:m', $row->time);
            $r['hid'] = $row->hid;
            $r['rid'] = $row->rid;
            $r['hstatus'] = $row->hstatus;
            $r['rstatus'] = $row->rstatus;
            $r['detail'] = $row->detail;
            $r['location'] = $row->location;
        
            $rows[$row->day][] = $r;
        }
        
        $re['schedule'] = json_encode($rows);
        
        $this->smarty->assign($re);
        $this->smarty->assign('url_hotel_payment', url('guide/hotel_payment').'&gid='.$re['info']->id);
        $this->smarty->display('./guide/hotel_base.html');
    }
    
    /**
     * 住房Checkin成功
     */
    public function hotel_checkin() {
        
        $this->smarty->display('./guide/hotel_checkin.html');
    }
    
    /**
     * 住房完成
     */
    public function hotel_finish() {
        
        $this->smarty->display('./guide/hotel_finish.html');
    }
    
    /**
     * 选择饭店付款的支付方式
     */
    public function hotel_payment() {
        $gid = $this->input->get('gid');
        $day = $this->input->get('day');
        $route = $this->input->get('route');
        
        $this->smarty->assign('url_hotel_payment_checklist', url('guide/hotel_payment_checklist').'&gid='.$gid.'&day='.$day.'&route='.$route);
        $this->smarty->display('./guide/hotel_payment.html');
    }
    
    /**
     * 饭店付款检查清单
     */
    public function hotel_payment_checklist() {
        $gid = $this->input->get('gid');
        $day = $this->input->get('day');
        $route = $this->input->get('route');
        $mode = $this->input->get('mode');
        
        $this->smarty->assign('gid',$gid);
        $this->smarty->assign('day',$day);
        $this->smarty->assign('route',$route);
        $this->smarty->assign('mode',$mode);
        $this->smarty->assign('url_hotel_payment_submit', url('guide/hotel_payment_submit'));
        $this->smarty->display('./guide/hotel_payment_checklist.html');
    }
    
    /**
     * 饭店付款提交小票
     */
    public function hotel_payment_submit() {
        $gid = $this->input->post('gid');
        $day = $this->input->post('day');
        $route = $this->input->post('route');
        $mode = $this->input->post('mode');
        $url = $this->input->post('url');
        
        //上传图片文件
        dump($_POST);
    }
    
    /**
     * 餐厅结账成功
     */
    public function hotel_payment_finish() {
        
        $this->smarty->display('./guide/hotel_payment_finish.html');
    }
    
    private function _get_type_label($type) {
        switch ($type) {
            case '0':
                $label = '機';
                break;
            case '1':
                $label = '景';
                break;
            case '2':
                $label = '中';
                break;
            case '3':
                $label = '晚';
                break;
            case '4':
                $label = '住';
                break;
        }
        
        return $label;
    }
    
    private function _get_rstatus_label($status) {
        switch ($status) {
            case '0':
                $label = '未訂餐';
                break;
            case '1':
                $label = '已訂餐未確認';
                break;
            case '2':
                $label = '已訂餐已確認';
                break;
            case '3':
                $label = '餐畢付款';
                break;
        }
        
        return $label;
    }
}
?>