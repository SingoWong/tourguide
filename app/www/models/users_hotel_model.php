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
    function getContractHotel($conditions, $with_relation=false, $page=0, $size=20) {
        $hotel = new Users_Hotel();
        
        $hotel->where('sign_date_start <=', time());
        $hotel->where('sign_date_end >=', time());
        foreach ($conditions as $field=>$value) {
        		if (is_array($value)) {
        			$hotel->where_in($field, $value);
        		} else {
	            $hotel->where($field, $value);
			}
        }
        $hotel->get_paged($page,$size);

        if ($with_relation) {
            $ids = array();
            for ($i=0; $i<sizeof($hotel->all); $i++) {
                $ids[] = $hotel->all[$i]->uid;
            }
        
            if (sizeof($ids) > 0) {
                $users = new Users();
                $users->where_in('id', $ids)->get();
        
                $us = array_to_hashmap($users->all, 'id');
        
                for ($i=0; $i<sizeof($hotel->all); $i++) {
                    $hotel->all[$i]->users = $us[$hotel->all[$i]->uid];
                }
            }
        }

        return array('rowset'=>$hotel->all,'pager'=>$hotel->paged);
    }
    
    /**
     * 已过期的酒店
     * @param unknown $conditions
     * @return multitype:
     */
    function getExpiredHotel($conditions, $page=0, $size=20) {
        $hotel = new Users_Hotel();
        
        $hotel->where('sign_date_end <', time());
        foreach ($conditions as $field=>$value) {
        		if (is_array($value)) {
        			$hotel->where_in($field, $value);
        		} else {
	            $hotel->where($field, $value);
			}
        }
        $hotel->get_paged($page,$size);
        
        return array('rowset'=>$hotel->all,'pager'=>$hotel->paged);
    }
	
	/**
	 * 获取可选的饭店
	 */
	function getScheduleContractHotel($conditions, $aid) {
        $hotel = new Users_Hotel();
        
        $hotel->where('sign_date_start <=', time());
        $hotel->where('sign_date_end >=', time());
        foreach ($conditions as $field=>$value) {
        		if (is_array($value)) {
        			$hotel->where_in($field, $value);
        		} else {
	            $hotel->where($field, $value);
			}
        }
        $hotel->get();

        if ($with_relation) {
            $ids = array();
            for ($i=0; $i<sizeof($hotel->all); $i++) {
                $ids[] = $hotel->all[$i]->uid;
            }
        
            if (sizeof($ids) > 0) {
                $users = new Users();
                $users->where_in('id', $ids)->get();
        
                $us = array_to_hashmap($users->all, 'id');
        
                for ($i=0; $i<sizeof($hotel->all); $i++) {
                    $hotel->all[$i]->users = $us[$hotel->all[$i]->uid];
                }
            }
        }

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
        $this->load->model('Users_Model');
        
        $this->db->trans_start();
        
        $users_model = new Users_Model();
        $new_user['username'] = $row['code'];
        $new_user['name'] = $row['name'];
        $nu_re = $users_model->create($new_user, ROLE_ID_HOTEL);
        
        if ($nu_re['result']) {
            $row['uid'] = $nu_re['uid'];
            $hotel = new Users_Hotel();
        
            $hotel->where('uid', $row['uid'])->get();
        
            if ($hotel->result_count() > 0) {
                $re = false;
            } else {
                $hotel->uid = $row['uid'];
				$hotel->title = $row['title'];
				$hotel->region = $row['region'];
                $hotel->address = $row['address'];
                $hotel->code = $row['code'];
                $hotel->contact = $row['contact'];
                $hotel->contact_tel = $row['contact_tel'];
                $hotel->status = '0';
                $hotel->sign_date_start = $row['sign_date_start'];
                $hotel->sign_date_end = $row['sign_date_end'];
        
                $re = $hotel->save();
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