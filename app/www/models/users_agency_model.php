<?php
class Users_Agency_Model extends CI_Model {
    
    function __construct() {
        parent::__construct ();
    }

    /**
     * 合同中的旅行社
     * @param unknown $conditions
     * @return multitype:
     */
    function getContractAgency($conditions) {
        $agency = new Users_Agency();
        
        $agency->where('sign_date_start <=', time());
        $agency->where('sign_date_end >=', time());
        $agency->get();
        
        return $agency->all;
    }
    
    /**
     * 已过期的旅行社
     * @param unknown $conditions
     * @return multitype:
     */
    function getExpiredAgency($conditions) {
        $agency = new Users_Agency();
        
        $agency->where('sign_date_end <', time());
        $agency->get();
        
        return $agency->all;
    }
    
    /**
     * 根据用户编号获取详细数据
     * @param unknown $uid
     * @return multitype:
     */
    function getAgencyById($uid) {
        $agency = new Users_Agency();
        
        $agency->where('uid', $uid)->get(1);
        
        return $agency->all;
    }
    
    /**
     * 保存旅行社信息
     * @param unknown $row
     * @return boolean
     */
    function save($row) {
        $agency = new Users_Agency();
        
        $agency->where('uid', $row['uid'])->get();
        
        if ($agency->result_count() > 0) {
            $re = $agency->where('uid', $row['uid'])->update($row);
        } else {
            $agency->uid = $row['uid'];
            $agency->address = $row['address'];
            $agency->code = $row['code'];
            $agency->contact = $row['contact'];
            $agency->contact_tel = $row['contact_tel'];
            $agency->status = '0';
        
            $re = $agency->save();
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
        $agency = new Users_Agency();
        
        $agency->where('uid', $uid)->get();
        
        if ($agency->result_count() > 0) {
            $row['start_date'] = $start_date;
            $row['end_date'] = $end_date;
            $re = $agency->where('uid', $uid)->update($row);
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
        $agency = new Users_Agency();
        
        $re = $agency->where('uid', $uid)->update($profile);
        
        return $re;
    }
}
?>