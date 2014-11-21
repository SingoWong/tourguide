<?php
class Hotel extends CI_Controller {

    function __construct() {
        parent::__construct();
    }
    
    /**
     * 饭店导航
     */
    public function index() {
        $this->smarty->display('./restaurant/menu.html');
    }
    
    /**
     * 今日订单
     */
    public function today() {
    
    }
    
    /**
     * 新增订单
     */
    public function new_order() {
    
    }
    
    /**
     * 接受订单
     */
    public function order_confirm() {
    
    }
    
    /**
     * 拒绝订单－拒绝理由
     */
    public function order_reject_reson() {
    
    }
    
    /**
     * 拒绝订单
     */
    public function order_reject() {
    
    }
    
    /**
     * 报表查询
     */
    public function report() {
    
    }
    
    /**
     * 报表结果
     */
    public function report_result() {
    
    }
}
?>