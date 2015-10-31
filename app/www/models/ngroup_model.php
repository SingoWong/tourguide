<?php
class NGroup_Model extends CI_Model {
    
    function __construct() {
        parent::__construct ();
    }
	
	/**
     * 查看正在进行的旅行团
     * @return multitype:
     */
    function getActiveNGroup($with_relation=false, $roleid='', $userid='') {
    		$this->load->model('Users_Insurance_Model');
			
        $ngroup = new NGroup();
        
		$today = strtotime(date('Y-m-d'));
        
		//權限
		if ($roleid == ROLE_ID_INSURANCE) {
			$ngroup->where('iid', $userid);
		} elseif ($roleid == ROLE_ID_REINSURANCE) {
			$uim = new Users_Insurance_Model();
			$uids = $uim->getInsuranceIdsByRid($userid);
			$ngroup->where_in('iid', $uids);
		} elseif ($roleid == ROLE_ID_ASSISTANCE) {
			$uim = new Users_Insurance_Model();
			$uids = $uim->getInsuranceIdsByAid($userid);
			$ngroup->where_in('iid', $uids);
		} elseif ($roleid == ROLE_ID_AGENCY) {
			$ngroup->group_start()->where('aid_tw', $userid)->or_where('aid_cn', $userid)->group_end();
		}

        $ngroup->where('end_date >', $today);
        $ngroup->get();
		
		if ($with_relation) {
			$ids = array();
			for ($i=0; $i<sizeof($ngroup->all); $i++) {
				$ids[] = $ngroup->all[$i]->gid; //导游
				$ids[] = $ngroup->all[$i]->iid; //保险公司
				$ids[] = $ngroup->all[$i]->aid_tw; //旅行社TW
				$ids[] = $ngroup->all[$i]->aid_cn; //旅行社CN
            }
			
			if (sizeof($ids) > 0) {
                $users = new Users();
                $users->where_in('id', $ids)->get();
                
                $us = array_to_hashmap($users->all, 'id');
                
                for ($i=0; $i<sizeof($ngroup->all); $i++) {
                    $ngroup->all[$i]->guide = $us[$ngroup->all[$i]->gid];
					$ngroup->all[$i]->insurance = $us[$ngroup->all[$i]->iid];
					$ngroup->all[$i]->agency_tw = $us[$ngroup->all[$i]->aid_tw];
					$ngroup->all[$i]->agency_cn = $us[$ngroup->all[$i]->aid_cn];
                }
				unset($us);
            }
		}
        
        return $ngroup->all;
    }

	/**
     * 按条件搜索旅行团
     * @param unknown $conditions
     * @return multitype:
     */
    function getNGroupByConditions($conditions, $with_relation=false, $roleid='', $userid='') {
        $ngroup = new NGroup();
        
		$ngroup->where('type', '0');
        foreach ($conditions as $field=>$value) {
            $ngroup->where($field, $value);
        }
		
		//權限
		if ($roleid == ROLE_ID_INSURANCE) {
			$ngroup->where('iid', $userid);
		} elseif ($roleid == ROLE_ID_REINSURANCE) {
			$uim = new Users_Insurance_Model();
			$uids = $uim->getInsuranceIdsByRid($userid);
			$ngroup->where_in('iid', $uids);
		} elseif ($roleid == ROLE_ID_ASSISTANCE) {
			$uim = new Users_Insurance_Model();
			$uids = $uim->getInsuranceIdsByAid($userid);
			$ngroup->where_in('iid', $uids);
		} elseif ($roleid == ROLE_ID_AGENCY) {
			$ngroup->group_start()->where('aid_tw', $userid)->or_where('aid_cn', $userid)->group_end();
		}
        
        $ngroup->get();
		
		if ($with_relation) {
			$ids = array();
			for ($i=0; $i<sizeof($ngroup->all); $i++) {
				$ids[] = $ngroup->all[$i]->gid; //导游
				$ids[] = $ngroup->all[$i]->iid; //保险公司
				$ids[] = $ngroup->all[$i]->aid_tw; //旅行社TW
				$ids[] = $ngroup->all[$i]->aid_cn; //旅行社CN
            }
			
			if (sizeof($ids) > 0) {
                $users = new Users();
                $users->where_in('id', $ids)->get();
                
                $us = array_to_hashmap($users->all, 'id');
                
                for ($i=0; $i<sizeof($ngroup->all); $i++) {
                    $ngroup->all[$i]->guide = $us[$ngroup->all[$i]->gid];
					$ngroup->all[$i]->insurance = $us[$ngroup->all[$i]->iid];
					$ngroup->all[$i]->agency_tw = $us[$ngroup->all[$i]->aid_tw];
					$ngroup->all[$i]->agency_cn = $us[$ngroup->all[$i]->aid_cn];
                }
				unset($us);
            }
		}
        
        return $ngroup->all;
    }

	/**
     * 获取旅行团的基本信息
     * @param unknown $gid
     * @return multitype:
     */
    function getNGroup($gid) {
        $ngroup = new NGroup();
        
        $ngroup->where('id', $gid)->get(1);
        
        return $ngroup->all[0];
    }
	
	/**
     * 保存旅行团基本资料 
     * @param unknown $row
     * @return boolean
     */
    function saveNGroup($row, $passengers) {
        $ngroup = new NGroup();
		
//		$this->db->trans_start();
        
        $ngroup->where('id', $row['id'])->get();
        
        if ($ngroup->result_count() > 0) {
        		$nrow['type'] = $row['type'];
			$nrow['code'] = $row['code'];
            $nrow['iid'] = $row['iid'];
            $nrow['policyno'] = $row['policyno'];
            $nrow['start_date'] = strtotime($row['start_date']);
            $nrow['end_date'] = strtotime($row['end_date']);
            $nrow['gid'] = $row['gid'];
            $nrow['aid_tw'] = $row['aid_tw'];
            $nrow['aid_cn'] = $row['aid_cn'];
            $nrow['pic'] = $row['pic'];
            $nrow['op'] = $row['op'];
            $nrow['op_tel'] = $row['op_tel'];
			$nrow['regulator'] = $row['regulator'];
            $nrow['regulator_tel'] = $row['regulator_tel'];
			
            $re = $ngroup->where('id', $row['id'])->update($nrow);
			$ngid = $row['id'];
        } else {
            $ngroup->type = $row['type'];
            $ngroup->code = $row['code'];
            $ngroup->iid = $row['iid'];
            $ngroup->policyno = $row['policyno'];
            $ngroup->start_date = strtotime($row['start_date']);
            $ngroup->end_date = strtotime($row['end_date']);
            $ngroup->gid = $row['gid'];
            $ngroup->aid_tw = $row['aid_tw'];
			$ngroup->aid_cn = $row['aid_cn'];
            $ngroup->pic = $row['pic'];
            $ngroup->op = $row['op'];
            $ngroup->op_tel = $row['op_tel'];
            $ngroup->regulator = $row['regulator'];
            $ngroup->regulator_tel = $row['regulator_tel'];
            
            $re = $ngroup->save();
			$ngid = $ngroup->id;
        }

		//保存旅客关系表
		$ngp = new NGroup_Passenger();
		$ngp->where('ngid', $ngid)->get();
		$ngp->delete_all();
		
		foreach ($passengers as $pid) {
			$ngp = new NGroup_Passenger();
			$ngp->ngid = $ngid;
			$ngp->uid = $pid;
			$ngp->save();
		}
        
//      if ($this->db->trans_status() === FALSE || !$re){
//          $this->db->trans_rollback();
//			$result = '0';
//      } else {
//          $this->db->trans_commit();
//			
//			if ($row['email'] != '') {
//				//TODO 更新SNS EndPoint
//			}
//			
//			$result = '1';
//      }

		$result = '1';
        
        return array('result'=>$result, 'id'=>$ngid);
    }

	public function getNGroupByPid($pid) {
		$png = new NGroup_Passenger();
		$png->where('uid', $pid);
		$png->order_by('id desc');
		$png->get(1);
		
		$ng = new NGroup();
		$ng->where('id', $png->all[0]->ngid);
		$ng->get(1);
		
		return $ng->all[0];
	}
	
	public function getNGroupByAid($aid) {
		$ng = new NGroup();
		$ng->where('aid_tw', $aid);
		$ng->or_where('aid_cn', $aid);
		$ng->order_by('id desc');
		$ng->get(1);
		
		return $ng->all[0];
	}
	
	public function getFidByUid($uid) {
		$user = new Users();
		$user->where('id', $uid)->get(1);
		$username = 'H'.$user->all[0]->username;
		
		$user = new Users();
		$user->where('username', $username)->get(1);
		
		return $user->all[0]->id;
	}
	
}
?>