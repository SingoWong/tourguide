<?php
define('STATUS_RORDER_PANDING', '0'); //已下單未確認
define('STATUS_RORDER_CONFIRM', '1'); //已下單已確認（定位）
define('STATUS_RORDER_UNDERWAY', '2');//用餐中
define('STATUS_RORDER_PAYMENG', '3'); //已結帳
define('STATUS_RORDER_CANCEL', '4');  //已取消

define('STATUS_HORDER_PANDING', '0'); //已下單未確認
define('STATUS_HORDER_CONFIRM', '1'); //已下單已確認
define('STATUS_HORDER_CHKIN', '2');   //到店CHKIN
define('STATUS_HORDER_CHKOUT', '3');  //CHKOUT結帳
define('STATUS_HORDER_CANCEL', '4');  //已取消

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
			$restaurant_order->status = STATUS_RORDER_PANDING;
			$restaurant_order->created = time();
            
            $re = $restaurant_order->save();
        }
        
        //更新行程狀態
        $rstatus = STATUS_RORDER_CONFIRM;
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
	 * 餐廳－获取今日订单
	 */
	function getRestaurantOrdersToday($rid) {
		$orders = new Restaurant_Order();
		
		$orders->where('status !=', STATUS_RORDER_PANDING);
		$orders->where('created >=', strtotime(date('Y-m-d 00:00:00')));
		$orders->where('created <', strtotime(date('Y-m-d 23:59:59')));
		$orders->where('rid', $rid);
		$orders->get();
		
		return $orders->all;
	}
	
	/**
	 * 餐廳－获取新进订单
	 */
	function getRestaurantOrdersReview($rid) {
		$orders = new Restaurant_Order();
		
		$orders->where('status', STATUS_RORDER_PANDING);
		$orders->where('rid', $rid);
		$orders->get();
		
		return $orders->all;
	}
	
	/**
	 * 餐廳－订单确认
	 */
	function approveRestaurantOrder($oid) {
		$order = new Restaurant_Order();
		
		$row['status'] = STATUS_RORDER_CONFIRM;
		$re = $order->where('id',$oid)->update($row);
		
		return $re;
	}
	
	/**
	 * 餐廳－訂單拒絕
	 */
	function rejectRestaurantOrder($oid, $reson) {
		$order = new Restaurant_Order();
		
		$row['status'] = STATUS_RORDER_CANCEL;
		$row['reject_reson'] = $reson;
		$re = $order->where('id',$oid)->update($row);
		
		return $re;
	}
	
	/**
     * 保存飯店訂單
     * @param unknown $row
     * @return multitype:string NULL
     */
    function saveHotelOrder($row) {
        $this->db->trans_start();
        
        //保存訂單信息
        $hotel_order = new Hotel_Order();
        $hotel_order->where('gid',$row['gid']);
        $hotel_order->where('sid',$row['sid']);
        $hotel_order->get();
        
        if ($hotel_order->result_count() > 0) {
            $hotel_order->where('gid',$row['gid']);
            $hotel_order->where('sid',$row['sid']);
			
            $re = $hotel_order->update($row);
        } else {
            $hotel_order->gid = $row['gid'];
            $hotel_order->sid = $row['sid'];
            $hotel_order->hid = $row['hid'];
			$hotel_order->status = STATUS_HORDER_PANDING;
			$hotel_order->created = time();
            
            $re = $hotel_order->save();
        }
        
        //更新行程狀態
        $hstatus = STATUS_HORDER_CONFIRM;
        $schedule = new Group_Schedule();
        $schedule->where('id',$row['sid'])->get();
        
        if ($schedule->result_count() > 0) {
            $srow['hstatus'] = $hstatus;
            $re_s = $schedule->where('id',$row['sid'])->update($srow);
        }
        
        if ($this->db->trans_status() === FALSE || !$re){
            $this->db->trans_rollback();
            $result = '0';
        } else {
            $this->db->trans_commit();
            $result = '1';
        }
        
        return array('result'=>$result, 'id'=>$hotel_order->id);
    }

	/**
	 * 飯店－获取今日订单
	 */
	function getHotelOrdersToday($hid) {
		$orders = new Hotel_Order();
		
		$orders->where('status !=', STATUS_HORDER_PANDING);
		$orders->where('created >=', strtotime(date('Y-m-d 00:00:00')));
		$orders->where('created <', strtotime(date('Y-m-d 23:59:59')));
		$orders->where('hid', $hid);
		$orders->get();
		
		return $orders->all;
	}
	
	/**
	 * 飯店－获取新进订单
	 */
	function getHotelOrdersReview($hid) {
		$orders = new Hotel_Order();
		
		$orders->where('status', STATUS_HORDER_PANDING);
		$orders->where('hid', $hid);
		$orders->get();
		
		return $orders->all;
	}
	
	/**
	 * 飯店－订单确认
	 */
	function approveHotelOrder($oid) {
		$order = new Hotel_Order();
		
		$row['status'] = STATUS_HORDER_CONFIRM;
		$re = $order->where('id',$oid)->update($row);
		
		return $re;
	}
	
	/**
	 * 飯店－訂單拒絕
	 */
	function rejectHotelOrder($oid, $reson) {
		$order = new Hotel_Order();
		
		$row['status'] = STATUS_HORDER_CANCEL;
		$row['reject_reson'] = $reson;
		$re = $order->where('id',$oid)->update($row);
		
		return $re;
	}
}
?>