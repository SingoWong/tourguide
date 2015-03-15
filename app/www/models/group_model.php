<?php
class Group_Model extends CI_Model {
    
    function __construct() {
        parent::__construct ();
    }

    /**
     * 查看正在进行的旅行团
     * @return multitype:
     */
    function getActiveGroup($with_relation=false) {
        $group = new Group();
        
//      $today_start = strtotime(date('Y-m-d'));
//      $today_end = strtotime(date('Y-m-d 23:59:59'));
		$today = strtotime(date('Y-m-d'));
        
//      $group->where('start_date <=', $today_start);
        $group->where('end_date >', $today);
        $group->get();
		
		if ($with_relation) {
			$ids_gid = array();
			for ($i=0; $i<sizeof($group->all); $i++) {
				$ids_gid[] = $group->all[$i]->gid;
            }
			
			if (sizeof($ids_gid) > 0) {
                $users = new Users();
                $users->where_in('id', $ids_gid)->get();
                
                $us = array_to_hashmap($users->all, 'id');
                
                for ($i=0; $i<sizeof($group->all); $i++) {
                    $group->all[$i]->guide = $us[$group->all[$i]->gid];
                }
				unset($us);
            }
		}
        
        return $group->all;
    }
    
    /**
     * 查看旅行社下的旅行团
     * @param unknown $aid
     * @return multitype:
     */
    function getActiveGroupByAid($aid, $with_relation=false) {
        $group = new Group();
    
//      $today_start = strtotime(date('Y-m-d'));
//      $today_end = strtotime(date('Y-m-d 23:59:59'));
		$today = strtotime(date('Y-m-d'));
    
        $group->where('aid', $aid);
		$group->where('type', '0');
//      $group->where('start_date <=', $today_start);
        $group->where('end_date >', $today);
        $group->get();
		
		if ($with_relation) {
			$ids_gid = array();
			for ($i=0; $i<sizeof($group->all); $i++) {
				$ids_gid[] = $group->all[$i]->gid;
            }
			
			if (sizeof($ids_gid) > 0) {
                $users = new Users();
                $users->where_in('id', $ids_gid)->get();
                
                $us = array_to_hashmap($users->all, 'id');
                
                for ($i=0; $i<sizeof($group->all); $i++) {
                    $group->all[$i]->guide = $us[$group->all[$i]->gid];
                }
				unset($us);
            }
		}
    
        return $group->all;
    }
	
	/**
     * 查看旅行社下的旅行团(Out)
     * @param unknown $aid
     * @return multitype:
     */
    function getActiveGroupOutByAid($aid, $with_relation=false) {
        $group = new Group();
    
//      $today_start = strtotime(date('Y-m-d'));
//      $today_end = strtotime(date('Y-m-d 23:59:59'));
		$today = strtotime(date('Y-m-d'));
    
        $group->where('aid', $aid);
		$group->where('type', '1');
//      $group->where('start_date <=', $today_start);
        $group->where('end_date >', $today);
        $group->get();
		
		if ($with_relation) {
			$ids_gid = array();
			for ($i=0; $i<sizeof($group->all); $i++) {
				$ids_gid[] = $group->all[$i]->gid;
            }
			
			if (sizeof($ids_gid) > 0) {
                $users = new Users();
                $users->where_in('id', $ids_gid)->get();
                
                $us = array_to_hashmap($users->all, 'id');
                
                for ($i=0; $i<sizeof($group->all); $i++) {
                    $group->all[$i]->guide = $us[$group->all[$i]->gid];
                }
				unset($us);
            }
		}
    
        return $group->all;
    }
    
    /**
     * 按条件搜索旅行团
     * @param unknown $conditions
     * @return multitype:
     */
    function getGroupByConditions($conditions, $with_relation=false) {
        $group = new Group();
        
		$group->where('type', '0');
        foreach ($conditions as $field=>$value) {
            $group->where($field, $value);
        }
        
        $group->get();
		
		if ($with_relation) {
			$ids_gid = array();
			for ($i=0; $i<sizeof($schedule->all); $i++) {
				$ids_gid[] = $group->all[$i]->gid;
            }
			
			if (sizeof($ids_gid) > 0) {
                $users = new Users();
                $users->where_in('id', $ids_gid)->get();
                
                $us = array_to_hashmap($users->all, 'id');
                
                for ($i=0; $i<sizeof($group->all); $i++) {
                    $group->all[$i]->guide = $us[$group->all[$i]->gid];
                }
				unset($us);
            }
		}
        
        return $group->all;
    }
	
	/**
     * 按条件搜索旅行团
     * @param unknown $conditions
     * @return multitype:
     */
    function getGroupOutByConditions($conditions, $with_relation=false) {
        $group = new Group();
        
		$group->where('type', '1');
        foreach ($conditions as $field=>$value) {
            $group->where($field, $value);
        }
        
        $group->get();
		
		if ($with_relation) {
			$ids_gid = array();
			for ($i=0; $i<sizeof($schedule->all); $i++) {
				$ids_gid[] = $group->all[$i]->gid;
            }
			
			if (sizeof($ids_gid) > 0) {
                $users = new Users();
                $users->where_in('id', $ids_gid)->get();
                
                $us = array_to_hashmap($users->all, 'id');
                
                for ($i=0; $i<sizeof($group->all); $i++) {
                    $group->all[$i]->guide = $us[$group->all[$i]->gid];
                }
				unset($us);
            }
		}
        
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
		
		for ($i=0; $i<sizeof($schedule->all); $i++) {
			$schedule->all[$i]->detail = htmlspecialchars(str_replace(array("\r\n", "\r", "\n"), "", $schedule->all[$i]->detail));
		}
        
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
            
            $re = $group->where('id', $row['id'])->update($row);
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
			$group->map = $row['map'];
            
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
			$schedual->tab = $row['tab'];
			
			$sre = $schedual->save();
            $result[] = $sre; 
			
			//酒店下單
			if ($row['type']=='4') {
				$this->load->model('order_model');
				$order = new Order_Model();
				
				$hrow['gid'] = $row['gid'];
				$hrow['sid'] = $schedual->id;
				$hrow['day'] = $row['day'];
				$hrow['route'] = $row['route'];
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
	function updateGroupSchedualRstatus($sid, $status, $reson) {
		$schedual = new Group_Schedule();
		
		$row['rstatus'] = $status;
		$row['location'] = $reson;
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
		$group = new Group();
       	$info = new Group_Info();
        
        $info->where('gid', $gid)->get();
        
        if ($info->result_count() > 0) {
        	//更新團號信息
        	$re = $group->where('id', $gid)->update(array('gid'=>$row['guide_id']));
			//更新開團會信息
            $re = $info->where('gid', $gid)->update($row);
        } else {
        	//更新團號信息
        	$re = $group->where('id', $gid)->update(array('gid'=>$row['guide_id']));
			//更新開團會信息
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
	 * 獲取旅行團行程資訊
	 */
	function getScheduleBySid($sid) {
		$schedule = new Group_Schedule();
        
        $schedule->where('id', $sid);
        $schedule->get(1);
		
		return $schedule->all[0];
	}
    
    /**
     * 获取旅行团的行程资讯
     * @param unknown $gid
     * @return multitype:
     */
    function getScheduleById($gid, $with_relation=false) {
        $schedule = new Group_Schedule();
        
        $schedule->where('gid', $gid);
        $schedule->get();
		
		if ($with_relation) {
			$ids_rid = array();
			$ids_hid = array();
			for ($i=0; $i<sizeof($schedule->all); $i++) {
				$ids_rid[] = $schedule->all[$i]->rid;
				$ids_hid[] = $schedule->all[$i]->hid;
            }
			
			if (sizeof($ids_rid) > 0) {
                $users = new Users();
                $users->where_in('id', $ids_rid)->get();
                
                $us = array_to_hashmap($users->all, 'id');
                
                for ($i=0; $i<sizeof($schedule->all); $i++) {
                    $schedule->all[$i]->restaurant = $us[$schedule->all[$i]->rid];
                }
				unset($us);
            }
			
			if (sizeof($ids_hid) > 0) {
                $users = new Users();
                $users->where_in('id', $ids_hid)->get();
                
                $us = array_to_hashmap($users->all, 'id');
                
                for ($i=0; $i<sizeof($schedule->all); $i++) {
                    $schedule->all[$i]->hotel = $us[$schedule->all[$i]->hid];
                }
				unset($us);
            }
		}
        
        return $schedule->all;
    }
	
	/**
	 * 更新行程訂餐狀態為已支付
	 */
	function paymentScheduleRestaurant($sid) {
		$schedule = new Group_Schedule();
		
		$row['rstatus'] = STATUS_R_PAYMENT;
		$re = $schedule->where('id',$sid)->update($row);
		
		return $re;
	}
    
    /**
     * 获得导游当前的旅行团信息
     * @param unknown $gid
     * @return multitype:
     */
    function getCurrGroupByGuideId($gid) {
        $group = new Group();
        
		$today = strtotime(date('Y-m-d'));
        
        $group->where('gid', $gid);
		$group->where('type', '0');
        $group->where('end_date >', $today);
        $group->get();
		
		$group_info = new Group_Info();
		$group_info->where('gid', $group->all[0]->id);
		$group_info->get();
		
		$group->all[0]->info = $group_info->all[0];
        
        return $group->all[0];
    }
	
	function getCurrSchedualByGuideId($gid) {
		$group = new Group();
		$schedual = new Group_Schedule();
        
		$today = strtotime(date('Y-m-d'));
        
        $group->where('gid', $gid);
		$group->where('type', '0');
        $group->where('end_date >', $today);
        $group->get();
		
		$schedual->where('gid', $group->all[0]->id);
		$schedual->where_in('type', array(2,3));
		$schedual->get();
		
		return $schedual->all;
	}
	
	/**
	 * 检查导游是否已经有空闲
	 */
	function checkGroupGuide($gid, $guide_id) {
		$group = new Group();
		$group_info = new Group_Info();
		
		$group->where('gid', $gid)->get();
		
		$start_date = $group->all[0]->start_date;
		$end_date = $group->all[0]->end_date;
		
		$group->where('gid', $guide_id)->get();
		
		foreach ($group->all as $gp) {
			if (($start_date > $gp->start_date && $start_date < $gp->end_date) || 
				($end_date > $gp->start_date && $end_date < $gp->end_date)) {
				return false;
			}
		}
		
		return true;
	}
}
?>