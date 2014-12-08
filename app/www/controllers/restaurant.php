<?php
class Restaurant extends Base_Controller {

    function __construct() {
        parent::__construct();
        
        $this->check_felogin(ROLE_ID_RESTAURANT);
		
		$this->smarty->assign('url_today', url('restaurant/today'));
		$this->smarty->assign('url_new_order', url('restaurant/new_order'));
		$this->smarty->assign('url_report', url('restaurant/report'));
    }
    
    /**
     * 餐馆导航
     */
    public function index() {
		
        $this->smarty->display('./restaurant/menu.html');
    }
    
    /**
     * 今日订单
     */
    public function today() {
        $this->load->model('order_model');
		
		$order = new Order_Model();
		$re = $order->getOrdersToday($this->user['id']);
		
		$this->smarty->assign('rowset', $re);
		$this->smarty->display('./restaurant/today_order.html');
    }
    
    /**
     * 新增订单
     */
    public function new_order() {
        $this->load->model('order_model');
		
		$order = new Order_Model();
		$re = $order->getOrdersReview($this->user['id']);
		
		$this->smarty->assign('rowset', $re);
		$this->smarty->assign('url_approve', url('restaurant/order_confirm'));
		$this->smarty->assign('url_reject', url('restaurant/order_reject_reson'));
		$this->smarty->display('./restaurant/new_order.html');
    }
    
    /**
     * 接受订单
     */
    public function order_confirm() {
    	$this->load->model('order_model');
		
    	$oid = $this->input->get('oid');
		
		$order = new Order_Model();
		$re = $order->approve($oid);
    	
		if ($re) {
	    	alert('訂單已確認', url('restaurant/order_confirm_finish'));
		} else {
			alert('訂單確認失敗', null, true);
		}
    }
	
	/**
	 * 接受訂單成功提示
	 */
	public function order_confirm_finish() {
		$this->smarty->display('./restaurant/new_order_confirm.html');
	}
    
    /**
     * 拒绝订单－拒绝理由
     */
    public function order_reject_reson() {
        $oid = $this->input->get('oid');
		
		$this->smarty->assign('oid', $oid);
		$this->smarty->assign('url_reject_submit', url('restaurant/order_reject'));
		$this->smarty->display('./restaurant/new_order_reson.html');
    }
    
    /**
     * 拒绝订单
     */
    public function order_reject() {
    	$this->load->model('order_model');
		
        $oid = $this->input->post('oid');
		$reson = join(',',$this->input->post('reson'));
		
		$order = new Order_Model();
		$re = $order->reject($oid, $reson);
		
		if ($re) {
	    	alert('訂單已拒絕', url('restaurant/order_reject_finish'));
		} else {
			alert('訂單拒絕失敗', null, true);
		}
    }
	
	/**
	 * 拒絕訂單成功提示
	 */
	public function order_reject_finish() {
		$this->smarty->display('./restaurant/new_order_reject.html');
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