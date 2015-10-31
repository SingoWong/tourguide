<?php
class Users_Assistance_Model extends CI_Model {
    
    function __construct() {
        parent::__construct ();
    }

    /**
     * 合同中的旅行社
     * @param unknown $conditions
     * @return multitype:
     */
    function getAssistance($conditions, $with_relation=false, $page=0, $size=20) {
        $assistance = new Users_Assistance();
        
        //$insurance->where('sign_date_start <=', time());
        //$insurance->where('sign_date_end >=', time());
        foreach ($conditions as $field=>$value) {
        		if (is_array($value)) {
        			$assistance->where_in($field, $value);
        		} else {
	            $assistance->where($field, $value);
			}
        }
        $assistance->get_paged($page,$size);
        
        if ($with_relation) {
            $ids = array();
            for ($i=0; $i<sizeof($assistance->all); $i++) {
                $ids[] = $assistance->all[$i]->uid;
            }
            
            if (sizeof($ids) > 0) {
                $users = new Users();
                $users->where_in('id', $ids)->get();
                
                $us = array_to_hashmap($users->all, 'id');
                
                for ($i=0; $i<sizeof($assistance->all); $i++) {
                    $assistance->all[$i]->users = $us[$assistance->all[$i]->uid];
                }
            }
        }
        
        return array('rowset'=>$assistance->all,'pager'=>$assistance->paged);
    }
    
    /**
     * 根据用户编号获取详细数据
     * @param unknown $uid
     * @return multitype:
     */
    function getAssistanceById($uid) {
        $assistance = new Users_Assistance();
        $users = new Users();
        
        $assistance->where('uid', $uid)->get(1);
        $users->where('id', $uid)->get(1);
        
        $assistance->all[0]->user = $users->all[0];
        
        return $assistance->all[0];
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
        $nu_re = $users_model->create($new_user, ROLE_ID_ASSISTANCE);
        
        if ($nu_re['result']) {
            $row['uid'] = $nu_re['uid'];
            $assistance = new Users_Assistance();
            
            $assistance->where('uid', $row['uid'])->get();
            
            if ($assistance->result_count() > 0) {
                $re = false;
            } else {
                $assistance->uid = $row['uid'];
                $assistance->contact = $row['contact'];
                $assistance->contact_tel = $row['contact_tel'];
                $assistance->status = '0';
                
                $re = $assistance->save();
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
        $assistance = new Users_Assistance();
        
        $this->db->trans_start();
        
        $assistance->where('uid', $uid)->get();

        if ($assistance->result_count() > 0) {
            $re = $assistance->where('uid',$uid)->update($row);
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
	
	function getContractAssistance($conditions=array()) {
		$assistance = new Users_Assistance();
        
		foreach ($conditions as $field=>$value) {
        		if (is_array($value)) {
        			$assistance->where_in($field, $value);
        		} else {
	            $assistance->where($field, $value);
			}
        }
        $assistance->get();
		
        $ids = array();
        for ($i=0; $i<sizeof($assistance->all); $i++) {
            $ids[] = $assistance->all[$i]->uid;
        }
    
        if (sizeof($ids) > 0) {
            $users = new Users();
            $users->where_in('id', $ids)->get();
    
            $us = array_to_hashmap($users->all, 'id');
    
            for ($i=0; $i<sizeof($assistance->all); $i++) {
                $assistance->all[$i]->users = $us[$assistance->all[$i]->uid];
            }
        }
        
		return $assistance->all;
	}
	
	function getAssistanceByPid($pid) {
		$ngroup_png = new NGroup_Passenger();
		$ngroup_png->where('uid', $pid);
		$ngroup_png->order_by('id desc');
		$ngroup_png->get(1);
		
		$ngid = $ngroup_png->all[0]->ngid;
		
		$ngroup = new NGroup();
		$ngroup->where('id', $ngid);
		$ngroup->get(1);
		$iid = $ngroup->all[0]->iid;
		
		$ui = new Users_Insurance();
		$ui->where('uid', $iid);
		$ui->get(1);
		$aid = $ui->all[0]->aid;
		
		$uas = new Users_Assistance();
		$uas->where('uid', $aid);
		$uas->get(1);
		
		return $uas->all[0];
	}
	
}
?>