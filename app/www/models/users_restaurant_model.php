<?php
class Users_Restaurant_Model extends CI_Model {
    
    function __construct() {
        parent::__construct ();
    }

    /**
     * 合同中的餐馆
     * @param unknown $conditions
     * @return multitype:
     */
    function getContractRestaurant($conditions) {
        $restaurant = new Users_Restaurant();
        
        $restaurant->where('sign_date_start <=', time());
        $restaurant->where('sign_date_end >=', time());
        $restaurant->get();
        
        return $restaurant->all;
    }
    
    /**
     * 已过期的餐馆
     * @param unknown $conditions
     * @return multitype:
     */
    function getExpiredRestaurant($conditions) {
        $restaurant = new Users_Restaurant();
        
        $restaurant->where('sign_date_end <', time());
        $restaurant->get();
        
        return $restaurant->all;
    }
    
    /**
     * 根据用户编号获取详细数据
     * @param unknown $uid
     * @return multitype:
     */
    function getRestaurantById($uid) {
        $restaurant = new Users_Restaurant();
        
        $restaurant->where('uid', $uid)->get(1);
        
        return $restaurant->all;
    }
    
    /**
     * 保存餐馆信息
     * @param unknown $row
     * @return boolean
     */
    function save($row) {
        $restaurant = new Users_Restaurant();
        
        $restaurant->where('uid', $row['uid'])->get();
        
        if ($restaurant->result_count() > 0) {
            $re = $restaurant->where('uid', $row['uid'])->update($row);
        } else {
            $restaurant->uid = $row['uid'];
            $restaurant->address = $row['address'];
            $restaurant->code = $row['code'];
            $restaurant->contact = $row['contact'];
            $restaurant->contact_tel = $row['contact_tel'];
            $restaurant->status = '0';
        
            $re = $restaurant->save();
        }
        
        return $re;
    }
    
    /**
     * 续约
     * @param unknown $uid
     * @param unknown $start_date
     * @param unknown $end_date
     * @return boolean
     */
    function renewal($uid, $start_date, $end_date) {
        $restaurant = new Users_Restaurant();
        
        $restaurant->where('uid', $uid)->get();
        
        if ($restaurant->result_count() > 0) {
            $row['start_date'] = $start_date;
            $row['end_date'] = $end_date;
            $re = $restaurant->where('uid', $uid)->update($row);
        } else {
            $re = FALSE;
        }
        
        return $re;
    }
    
    /**
     * 更新资料
     * @param unknown $uid
     * @param unknown $profile
     * @return boolean
     */
    function updateProfile($uid, $profile) {
        $restaurant = new Users_Restaurant();
        
        $re = $restaurant->where('uid', $uid)->update($profile);
        
        return $re;
    }
}
?>