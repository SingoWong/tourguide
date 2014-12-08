<?php
define('STATUS_RORDER_PANDING', '0'); //已下單未確認
define('STATUS_RORDER_CONFIRM', '1'); //已下單已確認（定位）
define('STATUS_RORDER_UNDERWAY', '2');//用餐中
define('STATUS_RORDER_PAYMENG', '3'); //已結帳
define('STATUS_RORDER_CANCEL', '4');  //已取消

class Order_Model extends CI_Model {
    
    function __construct() {
        parent::__construct ();
    }

    /**
     * 保存訂餐訂單
     * @param unknown $row
     * @return multitype:string NULL
     */
    function saveRestaurantOrder($row) {
        $this->db->trans_start();
        
        //保存訂單信息
        $restaurant_order = new Restaurant_Order();
        $restaurant_order->where('gid',$row['gid']);
        $restaurant_order->where('sid',$row['sid']);
        $restaurant_order->get();
        
        if ($restaurant_order->result_count() > 0) {
            $restaurant_order->where('gid',$row['gid']);
            $restaurant_order->where('sid',$row['sid']);
			
            $re = $restaurant_order->update($row);
        } else {
            $restaurant_order->gid = $row['gid'];
            $restaurant_order->sid = $row['sid'];
            $restaurant_order->rid = $row['rid'];
            $restaurant_order->amount = $row['amount'];
            $restaurant_order->price_unit = $row['price_unit'];
            $restaurant_order->option = $row['option'];
			$restaurant_order->status = '0';
			$restaurant_order->created = time();
            
            $re = $restaurant_order->save();
        }
        
        //更新行程狀態
        $rstatus = '1';
        $schedule = new Group_Schedule();
        $schedule->where('id',$row['sid'])->get();
        
        if ($schedule->result_count() > 0) {
            $srow['rstatus'] = $rstatus;
            $re_s = $schedule->where('id',$row['sid'])->update($srow);
        }
        
        if ($this->db->trans_status() === FALSE || !$re){
            $this->db->trans_rollback();
            $result = '0';
        } else {
            $this->db->trans_commit();
            $result = '1';
        }
        
        return array('result'=>$result, 'id'=>$restaurant_order->id);
    }

	/**
	 * 获取今日订单
	 */
	function getOrdersToday($rid) {
		$orders = new Restaurant_Order();
		
		$orders->where('status !=', STATUS_RORDER_PANDING);
		$orders->where('created >=', strtotime(date('Y-m-d 00:00:00')));
		$orders->where('created <', strtotime(date('Y-m-d 23:59:59')));
		$orders->get();
		
		return $orders->all;
	}
	
	/**
	 * 获取新进订单
	 */
	function getOrdersReview($rid) {
		$orders = new Restaurant_Order();
		
		$orders->where('status', STATUS_RORDER_PANDING);
		$orders->get();
		
		return $orders->all;
	}
	
	/**
	 * 订单确认
	 */
	function approve($oid) {
		$order = new Restaurant_Order();
		
		$row['status'] = STATUS_RORDER_CONFIRM;
		$re = $order->where('id',$oid)->update($row);
		
		return $re;
	}
	
	/**
	 * 訂單拒絕
	 */
	function reject($oid, $reson) {
		$order = new Restaurant_Order();
		
		$row['status'] = STATUS_RORDER_CANCEL;
		$row['reject_reson'] = $reson;
		$re = $order->where('id',$oid)->update($row);
		
		return $re;
	}
}
?>