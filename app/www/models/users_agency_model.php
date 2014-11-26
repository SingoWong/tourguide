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
        foreach ($conditions as $field=>$value) {
            $agency->where($field, $value);
        }
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
        foreach ($conditions as $field=>$value) {
            $agency->where($field, $value);
        }
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
        
        return $agency->all[0];
    }
    
    /**
     * 保存旅行社信息
     * @param unknown $row
     * @return boolean
     */
    function save($row) {
        $this->load->model('Users_Model');

        $this->db->trans_start();
        
        $users_model = new Users_Model();
        $new_user['username'] = $row['code'];
        $new_user['name'] = $row['name'];
        $nu_re = $users_model->create($new_user, ROLE_ID_AGENCY);
        
        if ($nu_re['result']) {
            $row['uid'] = $nu_re['uid'];
            $agency = new Users_Agency();
            
            $agency->where('uid', $row['uid'])->get();
            
            if ($agency->result_count() > 0) {
                $re = false;
            } else {
                $agency->uid = $row['uid'];
                $agency->address = $row['address'];
                $agency->code = $row['code'];
                $agency->contact = $row['contact'];
                $agency->contact_tel = $row['contact_tel'];
                $agency->status = '0';
                $agency->sign_date_start = $row['sign_date_start'];
                $agency->sign_date_end = $row['sign_date_end'];
                
                $re = $agency->save();
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