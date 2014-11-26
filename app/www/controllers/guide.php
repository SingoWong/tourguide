<?php
class Guide extends Base_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');

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
        
        $this->smarty->assign( 'url_info_journey', url('guide/info_journey') );
        $this->smarty->display('./guide/info_base.html');
    }
    
    /**
     * 行程资讯
     */
    public function info_journey() {
        
        $this->smarty->assign( 'url_info_journey', url('guide/info_journey') );
        $this->smarty->display('./guide/info_journey.html');
    }
    
    /**
     * 订餐资讯
     */
    public function restaurant() {
        $this->smarty->display('./guide/restaurant_base.html');
    }
    
    /**
     * 搜索餐馆
     */
    public function restaurant_search() {
        $this->smarty->display('./guide/restaurant_search.html');
    }
    
    /**
     * 餐馆搜索结果
     */
    public function restaurant_result() {
        $this->smarty->display('./guide/restaurant_result.html');
    }
    
    /**
     * 输入订餐详细资讯
     */
    public function restaurant_detail() {
        $this->smarty->display('./guide/restaurant_detail.html');
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
     * 订房资讯
     */
    public function hotel() {
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
}
?>