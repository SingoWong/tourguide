<?php
class Users_Hotel_Model extends CI_Model {
    
    function __construct() {
        parent::__construct ();
    }

    /**
     * 合同中的酒店
     * @param unknown $conditions
     * @return multitype:
     */
    function getContractHotel($conditions) {
        $hotel = new Users_Hotel();
        
        $hotel->where('sign_date_start <=', time());
        $hotel->where('sign_date_end >=', time());
        $hotel->get();
        
        return $hotel->all;
    }
    
    /**
     * 已过期的酒店
     * @param unknown $conditions
     * @return multitype:
     */
    function getExpiredHotel($conditions) {
        $hotel = new Users_Hotel();
        
        $hotel->where('sign_date_end <', time());
        $hotel->get();
        
        return $hotel->all;
    }
    
    /**
     * 根据用户编号获取详细数据
     * @param unknown $uid
     * @return multitype:
     */
    function getHotelById($uid) {
        $hotel = new Users_Hotel();
        
        $hotel->where('uid', $uid)->get(1);
        
        return $hotel->all;
    }
    
    /**
     * 保存酒店信息
     * @param unknown $row
     * @return boolean
     */
    function save($row) {
        $hotel = new Users_Hotel();
        
        $hotel->where('uid', $row['uid'])->get();
        
        if ($hotel->result_count() > 0) {
            $re = $hotel->where('uid', $row['uid'])->update($row);
        } else {
            $hotel->uid = $row['uid'];
            $hotel->address = $row['address'];
            $hotel->code = $row['code'];
            $hotel->contact = $row['contact'];
            $hotel->contact_tel = $row['contact_tel'];
            $hotel->status = '0';
        
            $re = $hotel->save();
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
        $hotel = new Users_Hotel();
        
        $hotel->where('uid', $uid)->get();
        
        if ($hotel->result_count() > 0) {
            $row['start_date'] = $start_date;
            $row['end_date'] = $end_date;
            $re = $hotel->where('uid', $uid)->update($row);
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
        $hotel = new Users_Hotel();
        
        $re = $hotel->where('uid', $uid)->update($profile);
        
        return $re;
    }
}
?>