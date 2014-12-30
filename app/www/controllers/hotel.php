<?php
class Hotel extends Base_Controller {

    function __construct() {
        parent::__construct();
        
        $this->check_felogin(ROLE_ID_HOTEL);
		
		$this->smarty->assign('url_menu', url('hotel/index'));
		$this->smarty->assign('url_today', url('hotel/today'));
		$this->smarty->assign('url_new_order', url('hotel/new_order'));
		$this->smarty->assign('url_report', url('hotel/report'));
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
    		$this->load->model('order_model');
		
		$status = $this->input->get('status');
		
		$conditions = array();
		if ($status != '') {
			$conditions['status'] = $status;
		}
		
		$order = new Order_Model();
		$re = $order->getHotelOrdersToday($this->user['id']);
		
		$this->smarty->assign('status', $status);
		$this->smarty->assign('rowset', $re);
		$this->smarty->display('./hotel/today_order.html');
    }
    
    /**
     * 新增订单
     */
    public function new_order() {
    		$this->load->model('order_model');
		
		$order = new Order_Model();
		$re = $order->getHotelOrdersReview($this->user['id']);
		
		$this->smarty->assign('rowset', $re);
		$this->smarty->assign('url_approve', url('hotel/order_confirm'));
		$this->smarty->assign('url_reject', url('hotel/order_reject_reson'));
		$this->smarty->display('./hotel/new_order.html');
    }
    
    /**
     * 接受订单
     */
    public function order_confirm() {
    		$this->load->model('order_model');
		
    		$oid = $this->input->get('oid');
		
		$order = new Order_Model();
		$re = $order->approveHotelOrder($oid);
    	
		if ($re) {
	    		alert('訂單已確認', url('hotel/order_confirm_finish'));
		} else {
			alert('訂單確認失敗', null, true);
		}
    }
    
    /**
	 * 接受訂單成功提示
	 */
	public function order_confirm_finish() {
		$this->smarty->display('./hotel/new_order_confirm.html');
	}
    
    /**
     * 拒绝订单
     */
    public function order_reject_reson() {
    	$oid = $this->input->get('oid');
		
		$this->smarty->assign('oid', $oid);
		$this->smarty->assign('url_reject_submit', url('hotel/order_reject'));
		$this->smarty->display('./hotel/new_order_reson.html');
    }
	
	/**
     * 拒绝订单
     */
    public function order_reject() {
    	$this->load->model('order_model');
		
        $oid = $this->input->post('oid');
		$reson = join(',',$this->input->post('reson'));
		
		$order = new Order_Model();
		$re = $order->rejectHotelOrder($oid, $reson);
		
		if ($re) {
	    	alert('訂單已拒絕', url('hotel/order_reject_finish'));
		} else {
			alert('訂單拒絕失敗', null, true);
		}
    }
	
	/**
	 * 拒絕訂單成功提示
	 */
	public function order_reject_finish() {
		$this->smarty->display('./hotel/new_order_reject.html');
	}
    
    /**
     * 报表查询
     */
    public function report() {
    	
		$this->smarty->assign('url_hotel_result',url('hotel/report_result'));
    		$this->smarty->display('./hotel/report_search.html');
    }
    
    /**
     * 报表结果
     */
    public function report_result() {
    		$this->load->model('order_model');
		
		$agency = $this->input->post('agency');
		$guide = $this->input->post('guide');
		$date = $this->input->post('date');
		
		$conditions = array();
		
		$order = new Order_Model();
		$re = $order->getHotelOrdersReport($this->user['id'], $conditions, true);
		
		$this->smarty->assign('rowset', $re);
    		$this->smarty->display('./hotel/report_result.html');
    }
}
?>