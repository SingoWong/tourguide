<?php
define('STATUS_R_PANDING', '0');
define('STATUS_R_BOOKED', '1');
define('STATUS_R_CONFIRM', '2');
define('STATUS_R_PAYMENT', '3');
define('STATUS_R_CANCEL', '4');

class Group_Model extends CI_Model {
    
    function __construct() {
        parent::__construct ();
    }

    /**
     * 查看正在进行的旅行团
     * @return multitype:
     */
    function getActiveGroup() {
        $group = new Group();
        
        $today_start = strtotime(date('Y-m-d'));
        $today_end = strtotime(date('Y-m-d 23:59:59'));
        
        $group->where('start_date <=', $today_start);
        $group->where('end_date >', $today_end);
        $group->get();
        
        return $group->all;
    }
    
    /**
     * 查看旅行社下的旅行团
     * @param unknown $aid
     * @return multitype:
     */
    function getActiveGroupByAid($aid) {
        $group = new Group();
    
        $today_start = strtotime(date('Y-m-d'));
        $today_end = strtotime(date('Y-m-d 23:59:59'));
    
        $group->where('aid', $aid);
        $group->where('start_date <=', $today_start);
        $group->where('end_date >', $today_end);
        $group->get();
    
        return $group->all;
    }
    
    /**
     * 按条件搜索旅行团
     * @param unknown $conditions
     * @return multitype:
     */
    function getGroupByConditions($conditions) {
        $group = new Group();
        
        foreach ($conditions as $field=>$value) {
            $group->where($field, $value);
        }
        
        $group->get();
        
        return $group->all;
    }
    
    /**
     * 查看正在进行的旅行团(旅行社)
     * @param unknown $aid
     * @return multitype:
     */
    function getActiveGroupWithAid($aid) {
        $group = new Group();
    
        $today_start = strtotime(date('Y-m-d'));
        $today_end = strtotime(date('Y-m-d 23:59:59'));
    
        $group->where('aid', $aid);
        $group->where('start_date >=', $today_start);
        $group->where('end_date <', $today_end);
        $group->get();
    
        return $group->all;
    }
    
    /**
     * 按条件搜索旅行团(旅行社)
     * @param unknown $conditions
     * @param unknown $aid
     * @return multitype:
     */
    function getGroupByConditionsWithAid($conditions, $aid) {
        $group = new Group();
    
        $group->where('aid', $aid);
        foreach ($conditions as $field=>$value) {
            $group->where($field, $value);
        }
    
        $group->get();
    
        return $group->all;
    }
    
    /**
     * 获取旅行团的基本信息
     * @param unknown $gid
     * @return multitype:
     */
    function getGroupBase($gid) {
        $group = new Group();
        
        $group->where('id', $gid)->get(1);
        
        return $group->all[0];
    }
    
    /**
     * 获取旅行团住房信息
     * @param unknown $gid
     * @return multitype:array
     */
    function getGroupRoom($gid) {
        $room = new Group_Room();
        
        $room->where('gid', $gid)->get();
        
        return $room->all[0];
    }
    
    /**
     * 获取旅行团行程信息
     * @param unknown $gid
     * @return multitype:array
     */
    function getGroupSchedule($gid) {
        $schedule = new Group_Schedule();
        
        $schedule->where('gid', $gid)->get();
        
        return $schedule->all;
    }
    
    /**
     * 獲取一個行程信息
     * @param unknown $gid
     * @param unknown $day
     * @param unknown $route
     * @return multitype:
     */
    function getGroupScheduleWhitRoute($gid, $day, $route) {
        $schedule = new Group_Schedule();
        
        $schedule->where('gid', $gid);
        $schedule->where('day', $day);
        $schedule->where('route', $route);
        $schedule->get(1);
        
        return $schedule->all[0];
    }
    
    /**
     * 获取旅行团说明会信息
     * @param unknown $gid
     * @return multitype:
     */
    function getGroupInfo($gid) {
        $info = new Group_Info();
        
        $info->where('gid', $gid)->get(1);
        
        return $info->all[0];
    }
    
    /**
     * 保存旅行团基本资料 
     * @param unknown $row
     * @return boolean
     */
    function saveGroupBase($row) {
        $group = new Group();
        
        $group->where('id', $row['id'])->get();
        
        if ($group->result_count() > 0) {
            $row['start_date'] = strtotime($row['start_date']);
            $row['start_departure_time'] = strtotime($row['start_date'].' '.$row['start_departure_time'].':00');
            $row['start_arrive_time'] = strtotime($row['start_date'].' '.$row['start_arrive_time'].':00');
            $row['end_date'] = strtotime($row['end_date']);
            $row['end_departure_time'] = strtotime($row['end_date'].' '.$row['end_departure_time'].':00');
            $row['end_arrive_time'] = strtotime($row['end_date'].' '.$row['end_arrive_time'].':00');
            
            $re = $this->where('id', $row['id'])->update($row);
        } else {
            $group->aid = $row['aid'];
            $group->code = $row['code'];
            $group->gcode = $row['gcode'];
            $group->name = $row['name'];
            $group->continent = $row['continent'];
            $group->country = $row['country'];
            $group->city = $row['city'];
            $group->days = $row['days'];
            $group->start_date = strtotime($row['start_date']);
            $group->start_flight_code = $row['start_flight_code'];
            $group->start_flight_num = $row['start_flight_num'];
            $group->start_departure_time = strtotime($row['start_date'].' '.$row['start_departure_time'].':00');
            $group->start_arrive_time = strtotime($row['start_date'].' '.$row['start_arrive_time'].':00');
            $group->end_date = strtotime($row['end_date']);
            $group->end_flight_code = $row['end_flight_code'];
            $group->end_flight_num = $row['end_flight_num'];
            $group->end_departure_time = strtotime($row['end_date'].' '.$row['end_departure_time'].':00');
            $group->end_arrive_time = strtotime($row['end_date'].' '.$row['end_arrive_time'].':00');
            $group->op = $row['op'];
            $group->amount = $row['amount'];
            $group->contact_name = $row['contact_name'];
            $group->contact_tel = $row['contact_tel'];
            
            $re = $group->save();
        }
        
        if ($re) {
            $result = '1';
        } else {
            $result = '0';
        }
        
        return array('result'=>$result, 'id'=>$group->id);
    }
    
    /**
     * 保存旅行团房间信息
     * @param unknown $gid
     * @param unknown $row
     * @return boolean
     */
    function saveGroupRoom($gid, $row) {
        $room = new Group_Room();
        
        $room->where('gid', $gid)->get();
        
        if ($room->result_count() > 0) {
            $re = $room->where('gid', $gid)->update($row);
        } else {
            $room->gid = $gid;
            $room->single_room = $row['single_room'];
            $room->double_room = $row['double_room'];
            $room->full_room = $row['full_room'];
            $room->plus_room = $row['plus_room'];
            $room->kid_room = $row['kid_room'];
            
            $re = $room->save();
        }
        
        if ($re) {
            $result = '1';
        } else {
            $result = '0';
        }
        
        return array('result'=>$result);
    }
    
    /**
     * 保存行程信息
     * @param unknown $gid
     * @param unknown $rows
     * @return boolean
     */
    function saveGroupSchedual($gid, $rows) {
        $schedual = new Group_Schedule();
        
        $this->db->trans_start();
        
        $schedual->where('gid', $gid)->get();
        $schedual->delete_all();
        
        foreach ($rows as $row) {
            $schedual = new Group_Schedule();
            
            $schedual->gid = $row['gid'];
            $schedual->day = $row['day'];
            $schedual->route = $row['route'];
            $schedual->type = $row['type'];
            $schedual->time = strtotime($row['time']);
            $schedual->money = $row['money'];
            $schedual->location = $row['location'];
            $schedual->detail = $row['detail'];
            $schedual->hid = $row['hid'];
			
			$sre = $schedual->save();
            $result[] = $sre; 
			
			//酒店下單
			if ($row['type']=='4') {
				$this->load->model('order_model');
				$order = new Order_Model();
				
				$hrow['gid'] = $row['gid'];
				$hrow['sid'] = $sre->id;
				$hrow['hid'] = $row['hid'];
				$order->saveHotelOrder($hrow);
			}
        }
        
        if ($this->db->trans_status() === FALSE || !( ! empty($result) && ! in_array(FALSE, $result))){
            $this->db->trans_rollback();
            $result = '0';
        } else {
            $this->db->trans_commit();
            $result = '1';
        }
        
        return array('result'=>$result);
    }
    
	/**
	 * 更新行程訂餐狀態
	 */
	function updateGroupSchedualRstatus($sid, $status) {
		$schedual = new Group_Schedule();
		
		$row['rstatus'] = $status;
		$re = $schedual->where('id', $sid)->update($row);
		
		return $re;
	}
	
	/**
	 * 更新行程訂房狀態
	 */
	function updateGroupSchedualHstatus($sid, $status) {
		$schedual = new Group_Schedule();
		
		$row['hstatus'] = $status;
		$re = $schedual->where('id', $sid)->update($row);
		
		return $re;
	}
	
    /**
     * 保存旅游团说明会信息
     * @param unknown $gid
     * @param unknown $row
     * @return boolean
     */
    function saveGroupInfo($gid, $row) {
        $info = new Group_Info();
        
        $info->where('gid', $gid)->get();
        
        if ($info->result_count() > 0) {
            $re = $info->where('gid', $gid)->update($row);
        } else {
            $info->gid = $gid;
            $info->leader = $row['leader'];
            $info->leader_tel = $row['leader_tel'];
            $info->attention = $row['attention'];
            $info->guide_id = $row['guide_id'];
            $info->guide_name = $row['guide_name'];
            $info->guide_tel = $row['guide_name'];
            $info->regulator = $row['regulator'];
            $info->regulator_tel = $row['regulator_tel'];
            $info->member_names = $row['member_names'];
        
            $re = $info->save();
        }
        
        if ($re) {
            $result = '1';
        } else {
            $result = '0';
        }
        
        return array('result'=>$result);
    }
    
    /**
     * 获取旅行团的行程资讯
     * @param unknown $gid
     * @return multitype:
     */
    function getScheduleById($gid) {
        $schedule = new Group_Schedule();
        
        $schedule->where('gid', $gid);
        $schedule->get();
        
        return $schedule->all;
    }
    
    /**
     * 获得导游当前的旅行团信息
     * @param unknown $gid
     * @return multitype:
     */
    function getCurrGroupByGuideId($gid) {
        $group = new Group();
        
        $today_start = strtotime(date('Y-m-d'));
        $today_end = strtotime(date('Y-m-d 23:59:59'));
        
        $group->where('gid', $gid);
        $group->where('start_date <=', $today_start);
        $group->where('end_date >', $today_end);
        $group->get();
        
        return $group->all[0];
    }
}
?>