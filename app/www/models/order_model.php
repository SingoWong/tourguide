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
			$restaurant_order->eattime = $row['eattime'];
			$restaurant_order->attention = $row['attention'];
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
			$srow['rid'] = $row['rid'];
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
	function getRestaurantOrdersToday($rid, $with_relation=false) {
		$orders = new Restaurant_Order();
		
		$orders->where('status !=', STATUS_RORDER_PAYMENG);
		$orders->where('status !=', STATUS_RORDER_CANCEL);
		//$orders->where('created >=', strtotime(date('Y-m-d 00:00:00')));
		//$orders->where('created <', strtotime(date('Y-m-d 23:59:59')));
		$orders->where('rid', $rid);
		$orders->get();
		
		if ($with_relation) {
            $ids_sid = array();
			$ids_gid = array();
			$ids_aid = array();
            for ($i=0; $i<sizeof($orders->all); $i++) {
                $ids_sid[] = $orders->all[$i]->sid;
				$ids_gid[] = $orders->all[$i]->gid;
            }
            
            if (sizeof($ids_sid) > 0) {
                $schedule = new Group_Schedule();
                $schedule->where_in('id', $ids_sid)->get();
                
                $us = array_to_hashmap($schedule->all, 'id');
                
                for ($i=0; $i<sizeof($orders->all); $i++) {
                    $orders->all[$i]->schedule = $us[$orders->all[$i]->sid];
                }
				unset($us);
            }
			
			if (sizeof($ids_gid) > 0) {
                $group = new Group();
                $group->where_in('id', $ids_gid)->get();
                
                $us = array_to_hashmap($group->all, 'id');
                
                for ($i=0; $i<sizeof($orders->all); $i++) {
                    $orders->all[$i]->group = $us[$orders->all[$i]->gid];
					$ids_aid[] = $orders->all[$i]->group->aid;
                }
				unset($us);
				
				$info = new Group_Info();
                $info->where_in('gid', $ids_gid)->get();
                
                $us = array_to_hashmap($info->all, 'gid');
                
                for ($i=0; $i<sizeof($orders->all); $i++) {
                    $orders->all[$i]->info = $us[$orders->all[$i]->gid];
                }
				unset($us);
            }
			
			if (sizeof($ids_aid) > 0) {
                $users = new Users();
                $users->where_in('id', $ids_aid)->get();
                
                $us = array_to_hashmap($users->all, 'id');
                
                for ($i=0; $i<sizeof($orders->all); $i++) {
                    $orders->all[$i]->agency = $us[$orders->all[$i]->group->aid];
                }
				unset($us);
            }
        }
		
		return $orders->all;
	}
	
	/**
	 * 餐廳－获取新进订单
	 */
	function getRestaurantOrdersReview($rid, $with_relation=false) {
		$orders = new Restaurant_Order();
		
		$orders->where('status', STATUS_RORDER_PANDING);
		$orders->where('rid', $rid);
		$orders->get();
		
		if ($with_relation) {
            $ids_sid = array();
			$ids_gid = array();
			$ids_aid = array();
            for ($i=0; $i<sizeof($orders->all); $i++) {
                $ids_sid[] = $orders->all[$i]->sid;
				$ids_gid[] = $orders->all[$i]->gid;
            }
            
            if (sizeof($ids_sid) > 0) {
                $schedule = new Group_Schedule();
                $schedule->where_in('id', $ids_sid)->get();
                
                $us = array_to_hashmap($schedule->all, 'id');
                
                for ($i=0; $i<sizeof($orders->all); $i++) {
                    $orders->all[$i]->schedule = $us[$orders->all[$i]->sid];
                }
				unset($us);
            }
			
			if (sizeof($ids_gid) > 0) {
                $group = new Group();
                $group->where_in('id', $ids_gid)->get();
                
                $us = array_to_hashmap($group->all, 'id');
                
                for ($i=0; $i<sizeof($orders->all); $i++) {
                    $orders->all[$i]->group = $us[$orders->all[$i]->gid];
					$ids_aid[] = $orders->all[$i]->group->aid;
                }
				unset($us);
            }
			
			if (sizeof($ids_aid) > 0) {
                $users = new Users();
                $users->where_in('id', $ids_aid)->get();
                
                $us = array_to_hashmap($users->all, 'id');
                
                for ($i=0; $i<sizeof($orders->all); $i++) {
                    $orders->all[$i]->agency = $us[$orders->all[$i]->group->aid];
                }
				unset($us);
            }
        }
		
		return $orders->all;
	}
	
	/**
	 * 餐廳－订单确认
	 */
	function approveRestaurantOrder($oid) {
		$order = new Restaurant_Order();
		
		$row['status'] = STATUS_RORDER_CONFIRM;
		$re = $order->where('id',$oid)->update($row);
		
		//更改行程狀態(確認)
		$this->load->model('group_model');
		$re_order = $order->where('id',$oid)->get(1);
		$sid = $re_order->sid;
		$group = new Group_Model();
		$group->updateGroupSchedualRstatus($sid, STATUS_R_CONFIRM);
		
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
		
		//更改行程狀態(取消)
		$this->load->model('group_model');
		$re_order = $order->where('id',$oid)->get(1);
		$sid = $re_order->sid;
		$group = new Group_Model();
		$group->updateGroupSchedualRstatus($sid, STATUS_R_CANCEL);
		
		return $re;
	}
	
	/**
	 * 獲取餐廳收據地址
	 */
	function getRestaurantReceiveUrl($sid) {
		$order = new Restaurant_Order();
		
		$order->where('sid', $sid)->get(1);
		
		return $order->all[0]->receive_url;
	}
	
	/**
	 * 導遊餐廳結帳
	 */
	function paymentRestaurant($oid, $mode, $receive_url) {
		$this->db->trans_start();
		
		//更新訂單狀態
		$order = new Restaurant_Order();
		$orow['receive_url'] = $receive_url;
		$orow['status'] = STATUS_RORDER_PAYMENG;
		$re_o = $order->where('id',$oid)->update($orow);
		
		//更新行程訂餐狀態
		$order->where('id',$oid)->get(1);
		$this->load->model('Group_Model');
		$group = new Group_Model();
		$re_s = $group->paymentScheduleRestaurant($order->all[0]->sid);
		
		if ($this->db->trans_status() === FALSE || !$re_o || !$re_s){
            $this->db->trans_rollback();
            $result = FALSE;
        } else {
            $this->db->trans_commit();
            $result = TRUE;
        }
		
		return $result;
	}
	
	/**
	 * 獲取下單訂單信息
	 */
	function getRestaurantOrder($gid, $day, $route) {
		$schedule = new Group_Schedule();
		$schedule->where('gid',$gid);
		$schedule->where('day',$day);
		$schedule->where('route',$route);
		$sre = $schedule->get(1);
		
		$order = new Restaurant_Order();
		$order->where('sid',$sre->id)->get(1);
		
		return $order->all[0];
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
		$hotel_order->where('day',$row['day']);
        $hotel_order->where('route',$row['route']);
        $hotel_order->get();
        
		if ($hotel_order->result_count() > 0) {
			//TODO 處理更換飯店的情況
			
			$hotel_order->where('gid',$row['gid']);
			$hotel_order->where('day',$row['day']);
			$hotel_order->where('route',$row['route']);
			
            $re = $hotel_order->update($row);
        } else {
            $hotel_order->gid = $row['gid'];
            $hotel_order->sid = $row['sid'];
			$hotel_order->day = $row['day'];
			$hotel_order->route = $row['route'];
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