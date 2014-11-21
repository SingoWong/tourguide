<?php
class Guide extends CI_Controller {

    function __construct() {
        parent::__construct();
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
        
    }
    
    /**
     * 行程资讯
     */
    public function info_journey() {
        
    }
    
    /**
     * 订餐资讯
     */
    public function restaurant() {
        
    }
    
    /**
     * 搜索餐馆
     */
    public function restaurant_search() {
        
    }
    
    /**
     * 餐馆搜索结果
     */
    public function restaurant_result() {
        
    }
    
    /**
     * 输入订餐详细资讯
     */
    public function restaurant_detail() {
        
    }
    
    /**
     * 订餐下单成功
     */
    public function restaurant_order() {
        
    }
    
    /**
     * 餐厅已经回复
     */
    public function restaurant_confirm() {
        
    }
    
    /**
     * 检查餐厅是否已经回复
     */
    public function restaurant_check() {
        
    }
}
?>