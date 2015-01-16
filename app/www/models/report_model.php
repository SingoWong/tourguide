<?php
class Report_Model extends CI_Model {
    
    function __construct() {
        parent::__construct ();
    }
	
	public function logRestaurantPayment($order, $receive) {
        $this->load->model('Group_Model');
        $this->load->model('Users_Restaurant_Model');
		
		$group = new Group_Model();
		$re_group = $group->getGroupBase($order->gid);
		$re_schedule = $group->getScheduleBySid($order->sid);
		
		$user = new Users_Restaurant_Model();
		$re_user = $user->getRestaurantById($order->rid);
				
		$row['aid'] = $re_group->aid;
		$row['gid'] = $order->gid;
		$row['sid'] = $order->sid;
		$row['rid'] = $order->rid;
		$row['code'] = $re_group->code;
		$row['date'] = date('Y-m-d');
		$row['name'] = $re_user->users->name;
		$row['type'] = $re_schedule->type;
		$row['guide_id'] = $re_group->gid;
		$row['guide_name'] = $re_group->contact_name;
		$row['receive'] = $receive;
		
		$this->_logReportAgency($row);
		$this->_logReportRestaurant($rrow);
		$this->_logReportGuide($rrow);
	}
	
	public function logHotelPayment($order, $receive) {
        $this->load->model('Group_Model');
        $this->load->model('Users_Restaurant_Model');
		
		$group = new Group_Model();
		$re_group = $group->getGroupBase($order->gid);
		$re_schedule = $group->getScheduleBySid($order->sid);
		
		$user = new Users_Restaurant_Model();
		$re_user = $user->getRestaurantById($order->hid);
				
		$row['aid'] = $re_group->aid;
		$row['gid'] = $order->gid;
		$row['sid'] = $order->sid;
		$row['hid'] = $order->hid;
		$row['code'] = $re_group->code;
		$row['date'] = date('Y-m-d');
		$row['name'] = $re_user->users->name;
		$row['type'] = $re_schedule->type;
		$row['guide_id'] = $re_group->gid;
		$row['guide_name'] = $re_group->contact_name;
		$row['receive'] = $receive;
		
		$this->_logReportAgency($row);
		$this->_logReportHotel($rrow);
		$this->_logReportGuide($rrow);
	}
	
	public function getReportAgency($conditions, $page, $size=20) {
		$report_agency = new Report_Agency();
        
        foreach ($conditions as $field=>$value) {
        		$report_agency->where($field, $value);
        }
        $report_agency->get_paged($page,$size);
        
        return array('rowset'=>$report_agency->all,'pager'=>$report_agency->paged);
	}
	
	public function getReportHotel($conditions, $page, $size=20) {
		$report_hotel = new Report_Hotel();
        
        foreach ($conditions as $field=>$value) {
        		$report_hotel->where($field, $value);
        }
        $report_hotel->get_paged($page,$size);
        
        return array('rowset'=>$report_hotel->all,'pager'=>$report_hotel->paged);
	}
	
	public function getReportRestaurant($conditions, $page, $size=20) {
		$report_restaurant = new Report_Restaurant();
        
        foreach ($conditions as $field=>$value) {
        		$report_restaurant->where($field, $value);
        }
        $report_restaurant->get_paged($page,$size);
        
        return array('rowset'=>$report_restaurant->all,'pager'=>$report_restaurant->paged);
	}
	
	public function getReportGuide($conditions, $page, $size=20) {
		$report_guide = new Report_Guide();
        
        foreach ($conditions as $field=>$value) {
        		$report_guide->where($field, $value);
        }
        $report_guide->get_paged($page,$size);
        
        return array('rowset'=>$report_guide->all,'pager'=>$report_guide->paged);
	}
	
	private function _logReportAgency($row) {
		$report_agency = new Report_Agency();
		
        $report_agency->where('code',$row['code']);
        $report_agency->get();
        
        if ($report_agency->result_count() > 0) {
        		$re = $report_agency->update($row);
		} else {
			$report_agency->code = $row['code'];
			$report_agency->date = $row['date'];
			$report_agency->name = $row['name'];
			$report_agency->type = $row['type'];
			$report_agency->guide_id = $row['guide_id'];
			$report_agency->guide_name = $row['guide_name'];
			$report_agency->receive = $row['receive'];
			
			$re = $report_agency->save();
		}
		
		return $re;
	}
	
	private function _logReportHotel($row) {
		$report_hotel = new Report_Hotel();
		
        $report_hotel->where('code',$row['code']);
        $report_hotel->get();
        
        if ($report_hotel->result_count() > 0) {
        		$re = $report_hotel->update($row);
		} else {
			$report_hotel->code = $row['code'];
			$report_hotel->date = $row['date'];
			$report_hotel->name = $row['name'];
			$report_hotel->type = $row['type'];
			$report_hotel->guide_id = $row['guide_id'];
			$report_hotel->guide_name = $row['guide_name'];
			$report_hotel->receive = $row['receive'];
			
			$re = $report_hotel->save();
		}
		
		return $re;
	}
	
	private function _logReportRestaurant($row) {
		$report_restaurant = new Report_Restaurant();
		
        $report_restaurant->where('code',$row['code']);
        $report_restaurant->get();
        
        if ($report_restaurant->result_count() > 0) {
        		$re = $report_restaurant->update($row);
		} else {
			$report_restaurant->code = $row['code'];
			$report_restaurant->date = $row['date'];
			$report_restaurant->name = $row['name'];
			$report_restaurant->type = $row['type'];
			$report_restaurant->guide_id = $row['guide_id'];
			$report_restaurant->guide_name = $row['guide_name'];
			$report_restaurant->receive = $row['receive'];
			
			$re = $report_restaurant->save();
		}
		
		return $re;
	}
	
	private function _logReportGuide($row) {
		$report_guide = new Report_Guide();
		
        $report_guide->where('code',$row['code']);
        $report_guide->get();
        
        if ($report_guide->result_count() > 0) {
        		$re = $report_guide->update($row);
		} else {
			$report_guide->code = $row['code'];
			$report_guide->date = $row['date'];
			$report_guide->name = $row['name'];
			$report_guide->type = $row['type'];
			$report_guide->guide_id = $row['guide_id'];
			$report_guide->guide_name = $row['guide_name'];
			$report_guide->receive = $row['receive'];
			
			$re = $report_guide->save();
		}
		
		return $re;
	}
}
?>