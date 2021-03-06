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
    function getContractRestaurant($conditions, $with_relation=false, $page=0, $size=20) {
        $restaurant = new Users_Restaurant();
        
        $restaurant->where('sign_date_start <=', time());
        $restaurant->where('sign_date_end >=', time());
        foreach ($conditions as $field=>$value) {
        		if (is_array($value)) {
        			$restaurant->where_in($field, $value);
        		} else {
	            $restaurant->where($field, $value);
			}
        }
        $restaurant->get_paged($page,$size);

        if ($with_relation) {
            $ids = array();
            for ($i=0; $i<sizeof($restaurant->all); $i++) {
                $ids[] = $restaurant->all[$i]->uid;
            }
            
            if (sizeof($ids) > 0) {
                $users = new Users();
                $users->where_in('id', $ids)->get();
        
                $us = array_to_hashmap($users->all, 'id');
        
                for ($i=0; $i<sizeof($restaurant->all); $i++) {
                    $restaurant->all[$i]->users = $us[$restaurant->all[$i]->uid];
                }
            }
        }

		return array('rowset'=>$restaurant->all,'pager'=>$restaurant->paged);
    }
    
    /**
     * 已过期的餐馆
     * @param unknown $conditions
     * @return multitype:
     */
    function getExpiredRestaurant($conditions, $page=0, $size=20) {
        $restaurant = new Users_Restaurant();
        
        $restaurant->where('sign_date_end <', time());
        foreach ($conditions as $field=>$value) {
        		if (is_array($value)) {
        			$restaurant->where_in($field, $value);
        		} else {
	            $restaurant->where($field, $value);
			}
        }
        $restaurant->get_paged($page,$size);

        $ids = array();
        for ($i=0; $i<sizeof($restaurant->all); $i++) {
            $ids[] = $restaurant->all[$i]->uid;
        }
    
        if (sizeof($ids) > 0) {
            $users = new Users();
            $users->where_in('id', $ids)->get();
    
            $us = array_to_hashmap($users->all, 'id');
    
            for ($i=0; $i<sizeof($restaurant->all); $i++) {
                $restaurant->all[$i]->users = $us[$restaurant->all[$i]->uid];
            }
        }
        
		return array('rowset'=>$restaurant->all,'pager'=>$restaurant->paged);
    }

	/**
	 * 获取可选的餐厅
	 */
	function getScheduleContractRestaurant($conditions, $gid) {
		//篩選合作的餐廳
		if ($gid != '0') {
			$group = new Group();
			$group->where('id',$gid)->get();
			$aid = $group->all[0]->aid;
			
			$agency_restaurant = new  Users_Agency_Restaurant();
			$agency_restaurant->where('aid', $aid)->get();
			$rids = array(0);
			foreach ($agency_restaurant as $ar) {
				$rids[] = $ar->rid;
			}
		}
		
        $restaurant = new Users_Restaurant();
        
        $restaurant->where('sign_date_start <=', time());
        $restaurant->where('sign_date_end >=', time());
        foreach ($conditions as $field=>$value) {
        		if (is_array($value)) {
        			$restaurant->where_in($field, $value);
        		} else {
	            $restaurant->where($field, $value);
			}
        }
		if (sizeof($rids) > 0) {
            $restaurant->where_in('uid', $rids);
		}
//      $restaurant->get_paged(1,100);
		$restaurant->get();

        $ids = array();
        for ($i=0; $i<sizeof($restaurant->all); $i++) {
            $ids[] = $restaurant->all[$i]->uid;
        }
        
        if (sizeof($ids) > 0) {
            $users = new Users();
            $users->where_in('id', $ids)->get();
    
            $us = array_to_hashmap($users->all, 'id');
    
            for ($i=0; $i<sizeof($restaurant->all); $i++) {
                $restaurant->all[$i]->users = $us[$restaurant->all[$i]->uid];
            }
        }

		return $restaurant->all;
    }
    
    /**
     * 根据用户编号获取详细数据
     * @param unknown $uid
     * @return multitype:
     */
    function getRestaurantById($uid) {
        $restaurant = new Users_Restaurant();
        $users = new Users();
        
        $restaurant->where('uid', $uid)->get(1);
        $users->where('id', $uid)->get(1);
        
        $restaurant->all[0]->users = $users;
        
        return $restaurant->all[0];
    }
    
    /**
     * 保存餐馆信息
     * @param unknown $row
     * @return boolean
     */
    function save($row) {
        $this->load->model('Users_Model');
        
        $this->db->trans_start();
        
        $users_model = new Users_Model();
        $new_user['username'] = $row['code'];
        $new_user['name'] = $row['name'];
        $nu_re = $users_model->create($new_user, ROLE_ID_RESTAURANT);
        
        if ($nu_re['result']) {
            $row['uid'] = $nu_re['uid'];
            $restaurant = new Users_Restaurant();
        
            $restaurant->where('uid', $row['uid'])->get();
        
            if ($restaurant->result_count() > 0) {
                $re = false;
            } else {
                $restaurant->uid = $row['uid'];
				$restaurant->title = $row['title'];
				$restaurant->region = $row['region'];
                $restaurant->address = $row['address'];
                $restaurant->code = $row['code'];
                $restaurant->contact = $row['contact'];
                $restaurant->contact_tel = $row['contact_tel'];
                $restaurant->status = '0';
                $restaurant->sign_date_start = $row['sign_date_start'];
                $restaurant->sign_date_end = $row['sign_date_end'];
        
                $re = $restaurant->save();
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
    
    function update($uid, $row) {
        $restaurant = new Users_Restaurant();
        
        $this->db->trans_start();
        
        $restaurant->where('uid', $uid)->get();

        if ($restaurant->result_count() > 0) {
            $re = $restaurant->where('uid',$uid)->update($row);
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
	
	/**
	 * 根據用戶編號獲得餐廳名
	 */
	function getRestaurantNameById($uid) {
        $users = new Users();

        $users->where('id', $uid)->get(1);
        
        return $users->all[0]->name;
	}
	
	/**
	 * 根據用戶編號獲得餐廳名
	 */
	function getRestaurantContactById($uid) {
		$restaurant = new Users_Restaurant();
		
		$restaurant->where('uid', $uid)->get(1);
		
		return $restaurant->all[0]->contact_tel;
	}
}
?>