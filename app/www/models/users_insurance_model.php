<?php
class Users_Insurance_Model extends CI_Model {
    
    function __construct() {
        parent::__construct ();
    }

    /**
     * 合同中的旅行社
     * @param unknown $conditions
     * @return multitype:
     */
    function getInsurance($conditions, $with_relation=false, $page=0, $size=20) {
        $insurance = new Users_Insurance();
        
        //$insurance->where('sign_date_start <=', time());
        //$insurance->where('sign_date_end >=', time());
        foreach ($conditions as $field=>$value) {
        		if (is_array($value)) {
        			$insurance->where_in($field, $value);
        		} else {
	            $insurance->where($field, $value);
			}
        }
        $insurance->get_paged($page,$size);
        
        if ($with_relation) {
            $ids = array();
            for ($i=0; $i<sizeof($insurance->all); $i++) {
                $ids[] = $insurance->all[$i]->uid;
				$ids[] = $insurance->all[$i]->rid;
				$ids[] = $insurance->all[$i]->aid;
            }
            
            if (sizeof($ids) > 0) {
                $users = new Users();
                $users->where_in('id', $ids)->get();
                
                $us = array_to_hashmap($users->all, 'id');
                
                for ($i=0; $i<sizeof($insurance->all); $i++) {
                    $insurance->all[$i]->users = $us[$insurance->all[$i]->uid];
					$insurance->all[$i]->reinsurance = $us[$insurance->all[$i]->rid];
					$insurance->all[$i]->assistance = $us[$insurance->all[$i]->aid];
                }
            }
        }
        
        return array('rowset'=>$insurance->all,'pager'=>$insurance->paged);
    }
    
    /**
     * 根据用户编号获取详细数据
     * @param unknown $uid
     * @return multitype:
     */
    function getInsuranceById($uid) {
        $insurance = new Users_Insurance();
        $users = new Users();
        
        $insurance->where('uid', $uid)->get(1);
        $users->where('id', $uid)->get(1);
        
        $insurance->all[0]->user = $users->all[0];
        
        return $insurance->all[0];
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
        $new_user['username'] = $row['username'];
        $new_user['name'] = $row['name'];
		$new_user['email'] = $row['email'];
        $nu_re = $users_model->create($new_user, ROLE_ID_INSURANCE);
        
        if ($nu_re['result']) {
            $row['uid'] = $nu_re['uid'];
            $insurance = new Users_Insurance();
            
            $insurance->where('uid', $row['uid'])->get();
            
            if ($insurance->result_count() > 0) {
                $re = false;
            } else {
                $insurance->uid = $row['uid'];
                $insurance->contact = $row['contact'];
                $insurance->contact_tel = $row['contact_tel'];
                $insurance->status = '0';
				$insurance->aid = $row['aid'];
				$insurance->rid = $row['rid'];
                
                $re = $insurance->save();
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
        $insurance = new Users_Insurance();
        
        $this->db->trans_start();
        
        $insurance->where('uid', $uid)->get();

        if ($insurance->result_count() > 0) {
            $re = $insurance->where('uid',$uid)->update($row);
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
	
	function getContractInsurance($conditions=array()) {
		$insurance = new Users_Insurance();
        
		foreach ($conditions as $field=>$value) {
        		if (is_array($value)) {
        			$insurance->where_in($field, $value);
        		} else {
	            $insurance->where($field, $value);
			}
        }
        $insurance->get();
		
        $ids = array(0);
        for ($i=0; $i<sizeof($insurance->all); $i++) {
            $ids[] = $insurance->all[$i]->uid;
        }
    
        if (sizeof($ids) > 0) {
            $users = new Users();
            $users->where_in('id', $ids)->get();
    
            $us = array_to_hashmap($users->all, 'id');
    
            for ($i=0; $i<sizeof($insurance->all); $i++) {
                $insurance->all[$i]->users = $us[$insurance->all[$i]->uid];
            }
        }
        
		return $insurance->all;
	}
	
	function getInsuranceIdsByRid($rid) {
		$ui = new Users_Insurance();
		
		$ui->where('rid', $rid);
		$ui->get();
		
		$uids = array(0);
		foreach ($ui as $u) {
			$uids[] = $u->uid;
		}
		
		return $uids;
	}
	
	function getInsuranceIdsByAid($aid) {
		$ui = new Users_Insurance();
		
		$ui->where('aid', $aid);
		$ui->get();
		
		$uids = array(0);
		foreach ($ui as $u) {
			$uids[] = $u->uid;
		}
		
		return $uids;
	}
	
}
?>