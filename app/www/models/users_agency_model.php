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
    function getContractAgency($conditions, $with_relation=false, $page=0, $size=20) {
        $agency = new Users_Agency();
        
        $agency->where('sign_date_start <=', time());
        $agency->where('sign_date_end >=', time());
        foreach ($conditions as $field=>$value) {
        		if (is_array($value)) {
        			$agency->where_in($field, $value);
        		} else {
	            $agency->where($field, $value);
			}
        }
        $agency->get_paged($page,$size);
        
        if ($with_relation) {
            $ids = array();
            for ($i=0; $i<sizeof($agency->all); $i++) {
                $ids[] = $agency->all[$i]->uid;
            }
            
            if (sizeof($ids) > 0) {
                $users = new Users();
                $users->where_in('id', $ids)->get();
                
                $us = array_to_hashmap($users->all, 'id');
                
                for ($i=0; $i<sizeof($agency->all); $i++) {
                    $agency->all[$i]->users = $us[$agency->all[$i]->uid];
                }
            }
        }
        
        return array('rowset'=>$agency->all,'pager'=>$agency->paged);
    }
    
    /**
     * 已过期的旅行社
     * @param unknown $conditions
     * @return multitype:
     */
    function getExpiredAgency($conditions, $page=0, $size=20) {
        $agency = new Users_Agency();
        
        $agency->where('sign_date_end <', time());
        foreach ($conditions as $field=>$value) {
        		if (is_array($value)) {
        			$agency->where_in($field, $value);
        		} else {
	            $agency->where($field, $value);
			}
        }
        $agency->get_paged($page,$size);

        $ids = array();
        for ($i=0; $i<sizeof($agency->all); $i++) {
            $ids[] = $agency->all[$i]->uid;
        }
    
        if (sizeof($ids) > 0) {
            $users = new Users();
            $users->where_in('id', $ids)->get();
    
            $us = array_to_hashmap($users->all, 'id');
    
            for ($i=0; $i<sizeof($agency->all); $i++) {
                $agency->all[$i]->users = $us[$agency->all[$i]->uid];
            }
        }
        
        return array('rowset'=>$agency->all,'pager'=>$agency->paged);
    }
    
    /**
     * 根据用户编号获取详细数据
     * @param unknown $uid
     * @return multitype:
     */
    function getAgencyById($uid) {
        $agency = new Users_Agency();
        $users = new Users();
        
        $agency->where('uid', $uid)->get(1);
        $users->where('id', $uid)->get(1);
        
        $agency->all[0]->users = $users;
        
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
		$new_user['email'] = $row['email'];
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
			
			if ($row['email'] != '') {
				//TODO 更新SNS EndPoint
			}
        }
        
        return $re;
    }
    
    function update($uid, $row) {
        $this->load->model('Users_Model');
        $agency = new Users_Agency();
        
        $this->db->trans_start();
        
        $agency->where('uid', $uid)->get();

        if ($agency->result_count() > 0) {
            $re = $agency->where('uid',$uid)->update($row);
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
	
	/**
	 * 獲得旅行社簽約的餐廳
	 */
	function getAgencySignRestaurant($aid) {
		
	}
	
	/**
	 * 保存旅行社簽約的餐廳
	 */
	function saveAgencySignRestaurant($aid, $rids) {
		
	}
}
?>