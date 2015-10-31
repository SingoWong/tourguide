<?php
class Users_ReInsurance_Model extends CI_Model {
    
    function __construct() {
        parent::__construct ();
    }

    /**
     * 合同中的旅行社
     * @param unknown $conditions
     * @return multitype:
     */
    function getReInsurance($conditions, $with_relation=false, $page=0, $size=20) {
        $reinsurance = new Users_ReInsurance();
        
        //$insurance->where('sign_date_start <=', time());
        //$insurance->where('sign_date_end >=', time());
        foreach ($conditions as $field=>$value) {
        		if (is_array($value)) {
        			$reinsurance->where_in($field, $value);
        		} else {
	            $reinsurance->where($field, $value);
			}
        }
        $reinsurance->get_paged($page,$size);
        
        if ($with_relation) {
            $ids = array();
            for ($i=0; $i<sizeof($reinsurance->all); $i++) {
                $ids[] = $reinsurance->all[$i]->uid;
            }
            
            if (sizeof($ids) > 0) {
                $users = new Users();
                $users->where_in('id', $ids)->get();
                
                $us = array_to_hashmap($users->all, 'id');
                
                for ($i=0; $i<sizeof($reinsurance->all); $i++) {
                    $reinsurance->all[$i]->users = $us[$reinsurance->all[$i]->uid];
                }
            }
        }
        
        return array('rowset'=>$reinsurance->all,'pager'=>$reinsurance->paged);
    }
    
    /**
     * 根据用户编号获取详细数据
     * @param unknown $uid
     * @return multitype:
     */
    function getReInsuranceById($uid) {
        $reinsurance = new Users_ReInsurance();
        $users = new Users();
        
        $reinsurance->where('uid', $uid)->get(1);
        $users->where('id', $uid)->get(1);
        
        $reinsurance->all[0]->user = $users->all[0];
        
        return $reinsurance->all[0];
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
        $nu_re = $users_model->create($new_user, ROLE_ID_REINSURANCE);
        
        if ($nu_re['result']) {
            $row['uid'] = $nu_re['uid'];
            $reinsurance = new Users_ReInsurance();
            
            $reinsurance->where('uid', $row['uid'])->get();
            
            if ($reinsurance->result_count() > 0) {
                $re = false;
            } else {
                $reinsurance->uid = $row['uid'];
                $reinsurance->contact = $row['contact'];
                $reinsurance->contact_tel = $row['contact_tel'];
                $reinsurance->status = '0';
                
                $re = $reinsurance->save();
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
        $reinsurance = new Users_ReInsurance();
        
        $this->db->trans_start();
        
        $reinsurance->where('uid', $uid)->get();

        if ($reinsurance->result_count() > 0) {
            $re = $reinsurance->where('uid',$uid)->update($row);
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
	
	function getContractReInsurance($conditions=array()) {
		$reinsurance = new Users_ReInsurance();
        
		foreach ($conditions as $field=>$value) {
        		if (is_array($value)) {
        			$reinsurance->where_in($field, $value);
        		} else {
	            $reinsurance->where($field, $value);
			}
        }
        $reinsurance->get();
		
        $ids = array();
        for ($i=0; $i<sizeof($reinsurance->all); $i++) {
            $ids[] = $reinsurance->all[$i]->uid;
        }
    
        if (sizeof($ids) > 0) {
            $users = new Users();
            $users->where_in('id', $ids)->get();
    
            $us = array_to_hashmap($users->all, 'id');
    
            for ($i=0; $i<sizeof($reinsurance->all); $i++) {
                $reinsurance->all[$i]->users = $us[$reinsurance->all[$i]->uid];
            }
        }
        
		return $reinsurance->all;
	}
}
?>