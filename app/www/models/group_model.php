<?php
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
        
        $group->where('start_date >=', $today_start)->where('end_date <', $today_end)->get();
        
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
     * 获取旅行团的基本信息
     * @param unknown $gid
     * @return multitype:
     */
    function getGroupBase($gid) {
        $group = new Group();
        
        $group->where('id', $gid)->get();
        
        return $group->all;
    }
    
    /**
     * 获取旅行团住房信息
     * @param unknown $gid
     * @return multitype:array
     */
    function getGroupRoom($gid) {
        $room = new Group_Room();
        
        $room->where('gid', $gid)->get();
        
        return $room->all;
    }
    
    /**
     * 获取旅行团行程信息
     * @param unknown $gid
     * @return multitype:array
     */
    function getGroupSchedule($gid) {
        $schedule = new Group_Schedule();
        
        $schedule->where('gid', $gid)->get();
        
        return $room->all;
    }
    
    /**
     * 获取旅行团说明会信息
     * @param unknown $gid
     * @return multitype:
     */
    function getGroupInfo($gid) {
        $info = new Group_Info();
        
        $info->where('gid', $gid)->get();
        
        return $info->all;
    }
    
    /**
     * 保存旅行团基本资料 
     * @param unknown $row
     * @return boolean
     */
    function saveGroupBase($row) {
        $group = new Group();
        
        $group->id = $row['id'];
        $group->aid = $row['aid'];
        $group->code = $row['code'];
        $group->name = $row['name'];
        $group->continent = $row['continent'];
        $group->country = $row['country'];
        $group->city = $row['city'];
        $group->days = $row['days'];
        $group->start_date = strtotime($row['start_date']);
        $group->start_flight_code = $row['start_flight_code'];
        $group->start_flight_num = $row['start_flight_num'];
        $group->start_departure_time = strtotime($row['start_departure_time']);
        $group->start_arrive_time = strtotime($row['start_arrive_time']);
        $group->end_date = strtotime($row['end_date']);
        $group->end_flight_code = $row['end_flight_code'];
        $group->end_flight_num = $row['end_flight_num'];
        $group->end_departure_time = strtotime($row['end_departure_time']);
        $group->end_arrive_time = strtotime($row['end_arrive_time']);
        $group->op = $row['op'];
        $group->amount = $row['amount'];
        $group->contact_name = $row['contact_name'];
        $group->contact_tel = $row['contact_tel'];
        
        return $group->save();
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
            $room->plus_room = $row['plus_room'];
            
            $re = $room->save();
        }
        
        return $re;
    }
    
    /**
     * 保存行程信息
     * @param unknown $gid
     * @param unknown $rows
     * @return boolean
     */
    function saveGroupSchedual($gid, $rows) {
        $schedual = new Group_Schedule();
        
        $schedual->where('gid', $gid)->delete_all();
        
        foreach ($rows as $row) {
            $schedual->gid = $row['gid'];
            $schedual->day = $row['day'];
            $schedual->route = $row['route'];
            $schedual->type = $row['type'];
            $schedual->time = strtotime($row['time']);
            $schedual->money = $row['money'];
            $schedual->detail = $row['detail'];
            $schedual->hid = $row['hid'];
            $schedual->rid = $row['rid'];
            
            $result[] = $schedual->save();
        }
        
        return ( ! empty($result) && ! in_array(FALSE, $result));
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
            $info->gid = $row['gid'];
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
        
        return $re;
    }
}
?>