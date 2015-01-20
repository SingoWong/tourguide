<?php
class Users_Leader_Model extends CI_Model {
    
    function __construct() {
        parent::__construct ();
    }

    /**
     * 合同中的領隊
     * @param unknown $conditions
     * @return multitype:
     */
    function getContractLeader($conditions, $with_relation=false, $page=0, $size=20) {
        $leader = new Users_Leader();
        
        $leader->where('sign_date_start <=', time());
        $leader->where('sign_date_end >=', time());
		foreach ($conditions as $field=>$value) {
        		if (is_array($value)) {
        			$leader->where_in($field, $value);
        		} else {
	            $leader->where($field, $value);
			}
        }
        $leader->get_paged($page,$size);
		
		if ($with_relation) {
            $ids = array();
            for ($i=0; $i<sizeof($leader->all); $i++) {
                $ids[] = $leader->all[$i]->uid;
            }
        
            if (sizeof($ids) > 0) {
                $users = new Users();
                $users->where_in('id', $ids)->get();
        
                $us = array_to_hashmap($users->all, 'id');
        
                for ($i=0; $i<sizeof($leader->all); $i++) {
                    $leader->all[$i]->users = $us[$leader->all[$i]->uid];
                }
            }
        }
        
		return array('rowset'=>$leader->all,'pager'=>$leader->paged);
    }
    
    /**
     * 已过期的領隊
     * @param unknown $conditions
     * @return multitype:
     */
    function getExpiredLeader($conditions, $with_relation=false, $page=0, $size=20) {
        $leader = new Users_Leader();
        
        $leader->where('sign_date_end <', time());
		foreach ($conditions as $field=>$value) {
        		if (is_array($value)) {
        			$leader->where_in($field, $value);
        		} else {
	            $leader->where($field, $value);
			}
        }
        $leader->get_paged($page,$size);
		
		if ($with_relation) {
            $ids = array();
            for ($i=0; $i<sizeof($leader->all); $i++) {
                $ids[] = $leader->all[$i]->uid;
            }
        
            if (sizeof($ids) > 0) {
                $users = new Users();
                $users->where_in('id', $ids)->get();
        
                $us = array_to_hashmap($users->all, 'id');
        
                for ($i=0; $i<sizeof($leader->all); $i++) {
                    $leader->all[$i]->users = $us[$leader->all[$i]->uid];
                }
            }
        }
        
		return array('rowset'=>$leader->all,'pager'=>$leader->paged);
    }

	/**
	 * 获取可选择的領隊
	 */
	function getAgencyContractLeader($conditions, $aid) {
		$leader = new Users_Leader();
        
        $leader->where('sign_date_start <=', time());
        $leader->where('sign_date_end >=', time());
		foreach ($conditions as $field=>$value) {
        		if (is_array($value)) {
        			$leader->where_in($field, $value);
        		} else {
	            $leader->where($field, $value);
			}
        }
        $leader->get();
		
        $ids = array();
        for ($i=0; $i<sizeof($leader->all); $i++) {
            $ids[] = $leader->all[$i]->uid;
        }
    
        if (sizeof($ids) > 0) {
            $users = new Users();
            $users->where_in('id', $ids)->get();
    
            $us = array_to_hashmap($users->all, 'id');
    
            for ($i=0; $i<sizeof($leader->all); $i++) {
                $leader->all[$i]->users = $us[$leader->all[$i]->uid];
            }
        }
        
		return $leader->all;
	}
    
    /**
     * 根据用户编号获取详细数据
     * @param unknown $uid
     * @return multitype:
     */
    function getLeaderById($uid) {
        $leader = new Users_Leader();
        
        $leader->where('uid', $uid)->get(1);
        
        return $leader->all;
    }
    
    /**
     * 保存領隊信息
     * @param unknown $row
     * @return boolean
     */
    function save($row) {
        $this->load->model('Users_Model');
        
        $this->db->trans_start();
        
        $users_model = new Users_Model();
        $new_user['username'] = $row['contact_tel'];
        $new_user['name'] = $row['name'];
        $nu_re = $users_model->create($new_user, ROLE_ID_LEADER);
        
        if ($nu_re['result']) {
            $row['uid'] = $nu_re['uid'];
            $leader = new Users_Leader();
        
            $leader->where('uid', $row['uid'])->get();
        
            if ($leader->result_count() > 0) {
                $re = false;
            } else {
                $leader->uid = $row['uid'];
                $leader->code = $row['code'];
                $leader->contact_tel = $row['contact_tel'];
                $leader->status = '0';
                $leader->sign_date_start = $row['sign_date_start'];
                $leader->sign_date_end = $row['sign_date_end'];
        
                $re = $leader->save();
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
        $leader = new Users_Leader();
        
        $leader->where('uid', $uid)->get();
        
        if ($leader->result_count() > 0) {
            $row['start_date'] = $start_date;
            $row['end_date'] = $end_date;
            $re = $leader->where('uid', $uid)->update($row);
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
        $leader = new Users_Leader();
        
        $re = $leader->where('uid', $uid)->update($profile);
        
        return $re;
    }
}
?>