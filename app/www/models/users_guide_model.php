<?php
class Users_Guide_Model extends CI_Model {
    
    function __construct() {
        parent::__construct ();
    }

    /**
     * 合同中的导游
     * @param unknown $conditions
     * @return multitype:
     */
    function getContractGuide($conditions) {
        $guide = new Users_Guide();
        
        $guide->where('sign_date_start <=', time());
        $guide->where('sign_date_end >=', time());
        $guide->get();
        
        return $guide->all;
    }
    
    /**
     * 已过期的导游
     * @param unknown $conditions
     * @return multitype:
     */
    function getExpiredGuide($conditions) {
        $guide = new Users_Guide();
        
        $guide->where('sign_date_end <', time());
        $guide->get();
        
        return $guide->all;
    }
    
    /**
     * 根据用户编号获取详细数据
     * @param unknown $uid
     * @return multitype:
     */
    function getGuideById($uid) {
        $guide = new Users_Guide();
        
        $guide->where('uid', $uid)->get(1);
        
        return $guide->all;
    }
    
    /**
     * 保存导游信息
     * @param unknown $row
     * @return boolean
     */
    function save($row) {
        $this->load->model('Users_Model');
        
        $this->db->trans_start();
        
        $users_model = new Users_Model();
        $new_user['username'] = $row['code'];
        $new_user['name'] = $row['name'];
        $nu_re = $users_model->create($new_user, ROLE_ID_GUIDE);
        
        if ($nu_re['result']) {
            $row['uid'] = $nu_re['uid'];
            $guide = new Users_Guide();
        
            $guide->where('uid', $row['uid'])->get();
        
            if ($guide->result_count() > 0) {
                $re = false;
            } else {
                $guide->uid = $row['uid'];
                $guide->code = $row['code'];
                $guide->contact_tel = $row['contact_tel'];
                $guide->status = '0';
                $guide->sign_date_start = $row['sign_date_start'];
                $guide->sign_date_end = $row['sign_date_end'];
        
                $re = $guide->save();
            }
        } else {
            $re = false;
        }
        
        if ($this->db->trans_status() === FALSE || !$re){
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
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
        $guide = new Users_Guide();
        
        $guide->where('uid', $uid)->get();
        
        if ($guide->result_count() > 0) {
            $row['start_date'] = $start_date;
            $row['end_date'] = $end_date;
            $re = $guide->where('uid', $uid)->update($row);
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
        $guide = new Users_Guide();
        
        $re = $guide->where('uid', $uid)->update($profile);
        
        return $re;
    }
}
?>