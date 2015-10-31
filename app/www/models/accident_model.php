<?php
define('ACCIDENT_TYPE_BUS', '0');
define('ACCIDENT_TYPE_MEDICINE', '1');
define('ACCIDENT_TYPE_DESERT', '2');
define('ACCIDENT_TYPE_NATURAL', '3');
define('ACCIDENT_TYPE_T1', '4');
define('ACCIDENT_TYPE_T2', '5');
define('ACCIDENT_TYPE_T3', '6');
define('ACCIDENT_TYPE_T4', '7');

class Accident_Model extends CI_Model {
    
    function __construct() {
        parent::__construct ();
    }

    /**
     * 获取所有意外通报
     * @return multitype:
     */
    function getAccident($with_relation=false, $group_aid=0, $source='0', $roleid=0, $userid=0) {
    		$this->load->model('Users_Insurance_Model');
		
        $accident = new Accidents();
        
		$accident->order_by('id', 'DESC');
		//$accident->where('source',$source);
		if ($roleid == ROLE_ID_INSURANCE) {
			$ngroup = new NGroup();
			$ngroup->where('iid', $userid)->get();
			
			$ngids = array(0);
			foreach ($ngroup->all as $ng) {
				$ngids[] = $ng->id;
			}
			$ngroup_peg = new NGroup_Passenger();
			$ngroup_peg->where_in('uid', $ngids)->get();
			
			$uids = array(0);
			foreach ($ngroup_peg->all as $ngp) {
				$uids[] = $ngp;
			}
			
			$accident->where_in('group_aid', $uids);
			
		} elseif ($roleid == ROLE_ID_REINSURANCE) {
			$ui = new Users_Insurance();
			$ui->where('rid', $userid)->get();
			
			$iids = array(0);
			foreach ($ui->all as $u) {
				$iids[] = $u->id;
			}
			
			$ngroup = new NGroup();
			$ngroup->where_in('iid', $iids)->get();
			
			$ngids = array(0);
			foreach ($ngroup->all as $ng) {
				$ngids[] = $ng->id;
			}
			$ngroup_peg = new NGroup_Passenger();
			$ngroup_peg->where_in('uid', $ngids)->get();
			
			$uids = array(0);
			foreach ($ngroup_peg->all as $ngp) {
				$uids[] = $ngp;
			}
			
			$accident->where_in('group_aid', $uids);
		} elseif ($roleid == ROLE_ID_ASSISTANCE) {
			$ui = new Users_Insurance();
			$ui->where('aid', $userid)->get();
			
			$iids = array(0);
			foreach ($ui->all as $u) {
				$iids[] = $u->id;
			}
			
			$ngroup = new NGroup();
			$ngroup->where_in('iid', $iids)->get();
			
			$ngids = array(0);
			foreach ($ngroup->all as $ng) {
				$ngids[] = $ng->id;
			}
			$ngroup_peg = new NGroup_Passenger();
			$ngroup_peg->where_in('uid', $ngids)->get();
			
			$uids = array(0);
			foreach ($ngroup_peg->all as $ngp) {
				$uids[] = $ngp;
			}
			
			$accident->where_in('group_aid', $uids);
		} elseif ($roleid == ROLE_ID_FAMILY) {
			$user = new Users();
			$user->where('id', $userid)->get();
			$username = $user->all[0]->username;
			$username = str_replace('H', '', $username);
			
			$user = new Users();
			$user->where('username', $username)->get();
			$userid = $user->all[0]->id;
			
			$accident->where('guide_id', $userid);
		} elseif ($roleid == ROLE_ID_UNION || $roleid == ROLE_ID_EMBRATUR || $roleid == ROLE_ID_ADMIN) {
			//訪問全部數據
		} elseif ($roleid == ROLE_ID_AGENCY) {
			$ngroup = new NGroup();
			$ngroup->where('aid_tw', $userid)->or_where('aid_cn', $userid)->get();
			$ids = array(0);
			foreach ($ngroup as $ng) {
				$ids[] = $ng->id;
			}
			
			$accident->where_in('gid', $ids);
		} else {
			if ($group_aid != 0) {
	            $accident->where('group_aid', $group_aid);
	        }
		}
		
		$accident->get();
        
        
        if ($with_relation) {
            $ids = array();
            for ($i=0; $i<sizeof($accident->all); $i++) {
                $ids[] = $accident->all[$i]->id;
            }
            
            if (sizeof($ids) > 0) {
                $accident_bus = new Accident_Bus();
                $accident_desert = new Accident_Desert();
                $accident_medicine = new Accident_Medicine();
				$accident_natural = new Accident_Natural();
                $accident_res = new Accident_Res();
                
                $accident_bus->where_in('aid', $ids)->get();
                $accident_desert->where_in('aid', $ids)->get();
                $accident_medicine->where_in('aid', $ids)->get();
				$accident_natural->where_in('aid', $ids)->get();
                $accident_res->where_in('aid', $ids)->get();
                
                $bus = array_to_hashmap($accident_bus->all, 'aid');
                $desert = array_to_hashmap($accident_desert->all, 'aid');
                $medicine = array_to_hashmap($accident_medicine->all, 'aid');
				$natural = array_to_hashmap($accident_natural->all, 'aid');
                
                for ($i=0; $i<sizeof($accident->all); $i++) {
                    $accident->all[$i]->bus = $bus[$accident->all[$i]->id];
                    $accident->all[$i]->desert = $desert[$accident->all[$i]->id];
                    $accident->all[$i]->medicine = $medicine[$accident->all[$i]->id];
					$accident->all[$i]->natural = $natural[$accident->all[$i]->id];
                }
                
                $res = array();
                for ($i=0; $i<sizeof($accident_res->all);$i++) {
                    $row['id'] = $accident_res->all[$i]->id;
                    $row['aid'] = $accident_res->all[$i]->aid;
                    $row['pic_url'] = $accident_res->all[$i]->pic_url;
                    
                    $res[] = $row;
                }
                $accident->res = $res;
            }

			unset($ids);
			$ids = array();
			for ($i=0; $i<sizeof($accident->all); $i++) {
                $ids[] = $accident->all[$i]->gid;
            }
			if (sizeof($ids) > 0) {
				$group = new Group();
				$group->where_in('id', $ids)->get();
				
                $us = array_to_hashmap($group->all, 'id');
                
                for ($i=0; $i<sizeof($accident->all); $i++) {
                    $accident->all[$i]->group = $us[$accident->all[$i]->gid];
                }
			}

			unset($ids);
			$ids = array();
			for ($i=0; $i<sizeof($accident->all); $i++) {
                $ids[] = $accident->all[$i]->guide_id;
            }
			if (sizeof($ids) > 0) {
				//Users
                $users = new Users();
                $users->where_in('id', $ids)->get();
                
                $us = array_to_hashmap($users->all, 'id');
                
                for ($i=0; $i<sizeof($accident->all); $i++) {
                    $accident->all[$i]->guide = $us[$accident->all[$i]->guide_id];
                }
				
				//Users_Guide or Users_Leader
				if ($source == '0') {
					$users_guide = new Users_Guide();
					$users_guide->where_in('uid',$ids)->get();
					
	                $us = array_to_hashmap($users_guide->all, 'uid');
	                
	                for ($i=0; $i<sizeof($accident->all); $i++) {
	                    $accident->all[$i]->contact = $us[$accident->all[$i]->guide_id];
	                }
				} elseif ($source == '1') {
					$users_leader = new Users_Leader();
					$users_leader->where_in('uid',$ids)->get();
					
	                $us = array_to_hashmap($users_leader->all, 'uid');
	                
	                for ($i=0; $i<sizeof($accident->all); $i++) {
	                    $accident->all[$i]->contact = $us[$accident->all[$i]->guide_id];
	                }
				}
            }
        }
        
        return $accident;
    }
    
    /**
     * 获取意外基本信息
     * @param unknown $aid
     * @return multitype:
     */
    function getAccidentById($aid) {
        $accident = new Accident();
        
        $accident->where('id',$aid)->get(1);
        
        return $accident->all;
    }
    
    /**
     * 获取游览车意外信息
     * @param unknown $aid
     * @return multitype:
     */
    function getAccidentBusById($aid) {
        $accident_bug = new Accident_Bus();
        
        $accident_bug->where('aid',$aid)->get(1);
        
        return $accident_bug->all;
    }
    
    /**
     * 获取团员脱团情况
     * @param unknown $aid
     * @return multitype:
     */
    function getAccidentDesertById($aid) {
        $accident_desert = new Accident_Desert();
        
        $accident_desert->where('aid',$aid)->get();
        
        return $accident_desert->all;
    }
    
    /**
     * 获取团员伤亡情况
     * @param unknown $aid
     * @return Accident_Medicine
     */
    function getAccidentMedicineById($aid) {
        $accident_medicine = new Accident_Medicine();
        
        $accident_medicine->where('aid',$aid)->get();
        
        return $accident_medicine;
    }
    
    /**
     * 获取意外的所有图片
     * @param unknown $aid
     * @return multitype:
     */
    function getAccidentResById($aid) {
        $accident_res = new Accident_Res();
        
        $accident_res->where('aid',$aid)->get();
        
        return $accident_res->all;
    }
	
	/**
	 * 獲取(表一)入境接待通報表
	 * @param unknown $aid
     * @return multitype:
	 */
	function getAccidentT1($aid) {
		$accident_t1 = new Accident_T1();
		
		$accident_t1->where('aid',$aid)->get();
		
		return $accident_t1->all;
	}
	
	/**
	 * 獲取(表二)出境通報表
	 * @param unknown $aid
     * @return multitype:
	 */
	function getAccidentT2($aid) {
		$accident_t2 = new Accident_T2();
		
		$accident_t2->where('aid',$aid)->get();
		
		return $accident_t2->all;
	}
	
	/**
	 * 獲取(表三)旅客離團申報書
	 * @param unknown $aid
     * @return multitype:
	 */
	function getAccidentT3($aid) {
		$accident_t3 = new Accident_T3();
		
		$accident_t3->where('aid',$aid)->get();
		
		return $accident_t3->all;
	}
	
	/**
	 * 獲取(表四)通報案件申報書
	 * @param unknown $aid
     * @return multitype:
	 */
	function getAccidentT4_11($aid) {
		$accident_t4_11 = new Accident_T4_11();
		
		$accident_t4_11->where('aid',$aid)->get();
		
		return $accident_t4_11->all;
	}
	
	/**
	 * 創建一個意外
	 */
	function createAccident($row) {
		$accident = new Accidents();
		
		$accident->group_aid = $row['group_aid'];
		$accident->gid = $row['gid'];
		$accident->guide_id = $row['guide_id'];
		$accident->type = $row['type'];
		$accident->source = $row['source'];
			
		if ($accident->save()) {
			$re['result'] = '1';
			$re['id'] = $accident->id;
			
			//发送消息
			$this->load->model('Users_Insurance_Model');
			$uim = new Users_Insurance_Model();
			$reii = $uim->getInsuranceById($row['iid']);
			
			//保險公司
			$this->load->model('Notify_Model');
			$notify = new Notify_Model();
			$ntf['uid'] = $row['iid'];
			$ntf['message'] = '有新的意外通報！！';
			$notify->setNotify($ntf);
			//再保險公司
			$this->load->model('Notify_Model');
			$notify = new Notify_Model();
			$ntf['uid'] = $reii->rid;
			$ntf['message'] = '有新的意外通報！！';
			$notify->setNotify($ntf);
			//救援公司
			$this->load->model('Notify_Model');
			$notify = new Notify_Model();
			$ntf['uid'] = $reii->aid;
			$ntf['message'] = '有新的意外通報！！';
			$notify->setNotify($ntf);
			//旅行社tw
			$this->load->model('Notify_Model');
			$notify = new Notify_Model();
			$ntf['uid'] = $row['aid_tw'];
			$ntf['message'] = '有新的意外通報！！';
			$notify->setNotify($ntf);
			//旅行社cn
			$this->load->model('Notify_Model');
			$notify = new Notify_Model();
			$ntf['uid'] = $row['aid_cn'];
			$ntf['message'] = '有新的意外通報！！';
			$notify->setNotify($ntf);
			//總後台
			$notify->setNotify($ntf);
			$ntf['uid'] = 1;
			$ntf['message'] = '有新的意外通報！！';
			$notify->setNotify($ntf);
			//全聯會
			$notify->setNotify($ntf);
			$ntf['uid'] = 11811;
			$ntf['message'] = '有新的意外通報！！';
			$notify->setNotify($ntf);
			//觀光局
			$notify->setNotify($ntf);
			$ntf['uid'] = 12758;
			$ntf['message'] = '有新的意外通報！！';
			$notify->setNotify($ntf);
			//家屬
			if ($row['fid'] && $row['fid'] != '') {
				$notify->setNotify($ntf);
				$ntf['uid'] = $row['fid'];
				$ntf['message'] = '有新的意外通報！！';
				$notify->setNotify($ntf);
			}
		} else {
			$re['result'] = '0';
			$re['msg'] = '保存失敗，請重試';
		}
		
		return $re;
	}

	/**
	 * 創建一個意外圖片
	 */
	function addAccidentRes($aid, $url) {
		$accident_res = new Accident_Res();
		
		$accident_res->aid = $aid;
		$accident_res->pic_url = $url;
		
		if ($accident_res->save()) {
			$re['result'] = '1';
		} else {
			$re['result'] = '0';
		}
		
		return $re;
	}
	
	function saveAccidentBus($id, $accident, $bus) {
		$this->db->trans_start();
		
		$accidents = new Accidents();
		$accidents->where('id',$id)->update($accident);
		
		$accidents_bus = new Accident_Bus();
		$accidents_bus->aid = $bus['aid'];
		$accidents_bus->driver_status = $bus['driver_status'];
		$accidents_bus->member_status = $bus['member_status'];
		$accidents_bus->bus_status = $bus['bus_status'];
		$accidents_bus->save();
		
		if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result = '0';
        } else {
            $this->db->trans_commit();
            $result = '1';
        }
        
        return array('result'=>$result);
	}
	
	function saveAccidentMedicine($id, $accident, $medicine) {
		$this->db->trans_start();
		
		$accidents = new Accidents();
		$accidents->where('id',$id)->update($accident);
		
		$accidents_medicine = new Accident_Medicine();
		$accidents_medicine->aid = $medicine['aid'];
		$accidents_medicine->amount = $medicine['amount'];
		$accidents_medicine->detail = $medicine['detail'];
		$accidents_medicine->save();
		
		if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result = '0';
        } else {
            $this->db->trans_commit();
            $result = '1';
        }
        
        return array('result'=>$result);
	}

	function saveAccidentDesert($id, $accident, $desert) {
		$this->db->trans_start();
		
		$accidents = new Accidents();
		$accidents->where('id',$id)->update($accident);
		
		$accident_desert = new Accident_Desert();
		$accident_desert->aid = $desert['aid'];
		$accident_desert->name = $desert['name'];
		$accident_desert->save();
		
		if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result = '0';
        } else {
            $this->db->trans_commit();
            $result = '1';
        }
        
        return array('result'=>$result);
	}
	
	function saveAccidentNatural($id, $accident, $accident_natural) {
		$this->db->trans_start();
		
		$accidents = new Accidents();
		$accidents->where('id',$id)->update($accident);
		
		$accidents_natural = new Accident_Natural();
		$accidents_natural->aid = $accident_natural['aid'];
		$accidents_natural->atype = $accident_natural['atype'];
		$accidents_natural->save();
		
		if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result = '0';
        } else {
            $this->db->trans_commit();
            $result = '1';
        }
        
        return array('result'=>$result);
	}
	
	function saveAccidentT1($id, $accident, $accident_t1, $poster, $receiver) {
		$this->db->trans_start();
		
		$accidents = new Accidents();
		$accidents->where('id',$id)->update($accident);
		
		$accidents_t1 = new Accident_T1();
		$accidents_t1->aid = $accident_t1['aid'];
		$accidents_t1->group_code = $accident_t1['group_code'];
		$accidents_t1->guide_code = $accident_t1['guide_code'];
		$accidents_t1->guide_name = $accident_t1['guide_name'];
		$accidents_t1->guide_tel = $accident_t1['guide_tel'];
		$accidents_t1->agency_name = $accident_t1['agency_name'];
		$accidents_t1->etime = $accident_t1['etime'];
		$accidents_t1->airport = $accident_t1['airport'];
		$accidents_t1->flight_code = $accident_t1['flight_code'];
		$accidents_t1->permission_count = $accident_t1['permission_count'];
		$accidents_t1->actual_count = $accident_t1['actual_count'];
		$accidents_t1->noenter_count = $accident_t1['noenter_count'];
		$accidents_t1->members_name = $accident_t1['members_name'];
		$accidents_t1->leaders_name = $accident_t1['leaders_name'];
		$accidents_t1->leaders_tel = $accident_t1['leaders_tel'];
		$accidents_t1->sented = time();
		$accidents_t1->save();
		
		if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result = '0';
        } else {
            $this->db->trans_commit();
            $result = '1';
			
			//发送邮件
			$subject = '入境接待通報表 '.$accident_t1['guide_name'].' '.$accident_t1['guide_tel'];
			$message = '';
			$message .= '報告人：'.$poster."\n";
			$message .= '發生時間：'.date('Y-m-d H:i', $accident['time'])."\n";
			$message .= '觀光團號：'.$accident_t1['group_code']."\n";
			$message .= '隨團導遊證號：'.$accident_t1['guide_code']."\n";
			$message .= '隨團導遊姓名：'.$accident_t1['guide_name']."\n";
			$message .= '隨團導遊手機：'.$accident_t1['guide_tel']."\n";
			$message .= '接待旅行社：'.$accident_t1['agency_name']."\n";
			
			$message .= '入境時間：'.date('Y-m-d H:i', $accident_t1['etime'])."\n";
			$message .= '機場/港口：'.$accident_t1['airport']."\n";
			$message .= '航班/船班：'.$accident_t1['flight_code']."\n";
			$message .= '入境/未入境旅客名單'."\n";
			$message .= '許可入境旅客（人）：'.$accident_t1['permission_count']."\n";
			$message .= '實際入境旅客（人）'.$accident_t1['actual_count']."\n";
			$message .= '未入境旅客（人）'.$accident_t1['noenter_count']."\n";
			$message .= '未入境旅客為：'.$accident_t1['members_name']."\n";
			$message .= '大陸領隊姓名：'.$accident_t1['leaders_name']."\n";
			$message .= '大陸領隊手機：'.$accident_t1['leaders_tel']."\n";

			$this->_sendEmail($subject, $message, $id, $receiver);
        }
        
        return array('result'=>$result);
	}

	function saveAccidentT2($id, $accident, $accident_t2, $poster, $receiver) {
		$this->db->trans_start();
		
		$accidents = new Accidents();
		$accidents->where('id',$id)->update($accident);
		
		$accidents_t2 = new Accident_T2();
		$accidents_t2->aid = $accident_t2['aid'];
		$accidents_t2->group_code = $accident_t2['group_code'];
		$accidents_t2->guide_code = $accident_t2['guide_code'];
		$accidents_t2->guide_name = $accident_t2['guide_name'];
		$accidents_t2->guide_tel = $accident_t2['guide_tel'];
		$accidents_t2->agency_name = $accident_t2['agency_name'];
		$accidents_t2->etime = $accident_t2['etime'];
		$accidents_t2->etime = $accident_t2['otime'];
		$accidents_t2->airport = $accident_t2['airport'];
		$accidents_t2->flight_code = $accident_t2['flight_code'];
		$accidents_t2->permission_count = $accident_t2['permission_count'];
		$accidents_t2->actual_count = $accident_t2['actual_count'];
		$accidents_t2->noleave_name = $accident_t2['noleave_name'];
		$accidents_t2->noleave_reson = $accident_t2['noleave_reson'];
		$accidents_t2->noleave_otime = $accident_t2['noleave_otime'];
		$accidents_t2->noleave_flight_code = $accident_t2['noleave_flight_code'];
		$accidents_t2->ahead_name = $accident_t2['ahead_name'];
		$accidents_t2->ahead_reson = $accident_t2['ahead_reson'];
		$accidents_t2->ahead_otime = $accident_t2['ahead_otime'];
		$accidents_t2->ahead_flight_code = $accident_t2['ahead_flight_code'];
		$accidents_t2->sented = time();
		$accidents_t2->save();
		
		if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result = '0';
        } else {
            $this->db->trans_commit();
            $result = '1';
			
			//发送邮件
			$subject = '出境通報表 '.$accident_t2['guide_name'].' '.$accident_t2['guide_tel'];
			$message = '';
			$message .= '報告人：'.$poster."\n";
			$message .= '發生時間：'.date('Y-m-d H:i', $accident['time'])."\n";
			$message .= '觀光團號：'.$accident_t2['group_code']."\n";
			$message .= '隨團導遊證號：'.$accident_t2['guide_code']."\n";
			$message .= '隨團導遊姓名：'.$accident_t2['guide_name']."\n";
			$message .= '隨團導遊手機：'.$accident_t2['guide_tel']."\n";
			$message .= '接待旅行社：'.$accident_t2['agency_name']."\n";
			
			$message .= '入境時間：'.date('Y-m-d H:i', $accident_t2['etime'])."\n";
			$message .= '出境時間：'.date('Y-m-d H:i', $accident_t2['otime'])."\n";
			$message .= '機場/港口：'.$accident_t2['airport']."\n";
			$message .= '航班/船班：'.$accident_t2['flight_code']."\n";
			$message .= '出境人數'."\n";
			$message .= '原入境旅客（人）：'.$accident_t2['permission_count']."\n";
			$message .= '實際出境旅客（人）'.$accident_t2['actual_count']."\n";
			$message .= '未出境旅客'."\n";
			$message .= '姓名：'.$accident_t2['noleave_name']."\n";
			$message .= '事由：'.$accident_t2['noleave_reson']."\n";
			$message .= '出境時間：'.date('Y-m-d H:i', $accident_t2['noleave_otime'])."\n";
			$message .= '出境航班：'.$accident_t2['noleave_flight_code']."\n";
			$message .= '已提前出境'."\n";
			$message .= '姓名：'.$accident_t2['ahead_name']."\n";
			$message .= '事由：'.$accident_t2['ahead_reson']."\n";
			$message .= '出境時間：'.date('Y-m-d H:i', $accident_t2['ahead_otime'])."\n";
			$message .= '出境航班：'.$accident_t2['ahead_flight_code']."\n";
			
			$this->_sendEmail($subject, $message, $id, $receiver);
        }
        
        return array('result'=>$result);
	}

	function saveAccidentT3($id, $accident, $accident_t3, $poster, $receiver) {
		$this->db->trans_start();
		
		$accidents = new Accidents();
		$accidents->where('id',$id)->update($accident);
		
		$accidents_t3 = new Accident_T3();
		$accidents_t3->aid = $accident_t3['aid'];
		$accidents_t3->group_code = $accident_t3['group_code'];
		$accidents_t3->guide_code = $accident_t3['guide_code'];
		$accidents_t3->guide_name = $accident_t3['guide_name'];
		$accidents_t3->guide_tel = $accident_t3['guide_tel'];
		$accidents_t3->agency_name = $accident_t3['agency_name'];
		$accidents_t3->level = $accident_t3['level'];
		$accidents_t3->reson = $accident_t3['reson'];
		$accidents_t3->ff_name = $accident_t3['ff_name'];
		$accidents_t3->ff_address = $accident_t3['ff_address'];
		$accidents_t3->ff_tel = $accident_t3['ff_tel'];
		$accidents_t3->urgen_detail = $accident_t3['urgen_detail'];
		$accidents_t3->ltime = $accident_t3['ltime'];
		$accidents_t3->btime = $accident_t3['btime'];
		$accidents_t3->members_name = $accident_t3['members_name'];
		$accidents_t3->sented = time();
		$accidents_t3->save();
		
		if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result = '0';
        } else {
            $this->db->trans_commit();
            $result = '1';
			
			//发送邮件
			$subject = '旅客離團申報書 '.$accident_t3['guide_name'].' '.$accident_t3['guide_tel'];
			$message = '';
			$message .= '報告人：'.$poster."\n";
			$message .= '發生時間：'.date('Y-m-d H:i', $accident['time'])."\n";
			$message .= '觀光團號：'.$accident_t3['group_code']."\n";
			$message .= '隨團導遊證號：'.$accident_t3['guide_code']."\n";
			$message .= '隨團導遊姓名：'.$accident_t3['guide_name']."\n";
			$message .= '隨團導遊手機：'.$accident_t3['guide_tel']."\n";
			$message .= '接待旅行社：'.$accident_t3['agency_name']."\n";
			if ($accident_t3['level'] == '1') {
			$message .= '通報級別：初報'."\n";
			} elseif ($accident_t3['level'] == '2') {
			$message .= '通報級別：續報'."\n";
			} elseif ($accident_t3['level'] == '3') {
			$message .= '通報級別：结報'."\n";
			}
			
			$message .= '通報事由：'.$accident_t3['reson']."\n";
			if ($accident_t3['reson'] == '傷病') {
			$message .= '(應補送合格醫師所開立之醫生診斷證明)'."\n";
			} elseif ($accident_t3['reson'] == '探訪親友') {
			$message .= '1. 親友姓名：'.$accident_t3['ff_name']."\n";
			$message .= '2. 地址：'.$accident_t3['ff_address']."\n";
			$message .= '3. 聯絡電話及手機：'.$accident_t3['ff_tel']."\n";
			} elseif ($accident_t3['reson'] == '緊急事故') {
			$message .= '事故摘要：'.$accident_t3['urgen_detail']."\n";
			}
			$message .= '離團時間：'.date('Y-m-d H:i',$accident_t3['ltime'])."\n";
			$message .= '歸團時間：'.date('Y-m-d H:i',$accident_t3['btime'])."\n";
			$message .= '旅客姓名名單：'.$accident_t3['members_name']."\n";
			
			$this->_sendEmail($subject, $message, $id, $receiver);
        }
        
        return array('result'=>$result);
	}
	
	function saveAccidentT4($id, $accident, $accident_t4, $poster, $receiver) {
		$this->db->trans_start();
		
		$accidents = new Accidents();
		$accidents->where('id',$id)->update($accident);
		
		$accidents_t4 = new Accident_T4();
		$accidents_t4->aid = $accident_t4['aid'];
		$accidents_t4->group_code = $accident_t4['group_code'];
		$accidents_t4->guide_code = $accident_t4['guide_code'];
		$accidents_t4->guide_name = $accident_t4['guide_name'];
		$accidents_t4->guide_tel = $accident_t4['guide_tel'];
		$accidents_t4->agency_name = $accident_t4['agency_name'];
		$accidents_t4->level = $accident_t4['level'];
		$accidents_t4->atime = $accident_t4['atime'];
		$accidents_t4->reason = $accident_t4['reason'];
		$accidents_t4->detail = $accident_t4['detail'];
		$accidents_t4->members_name = $accident_t4['members_name'];
		$accidents_t4->sented = time();
		$accidents_t4->save();
		
		if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
            $result = '0';
        } else {
            $this->db->trans_commit();
            $result = '1';
			
			//发送邮件
			$subject = '通報案件申報書 '.$accident_t4['guide_name'].' '.$accident_t4['guide_tel'];
			$message = '';
			$message .= '報告人：'.$poster."\n";
			$message .= '發生時間：'.date('Y-m-d H:i', $accident['time'])."\n";
			$message .= '觀光團號：'.$accident_t4['group_code']."\n";
			$message .= '隨團導遊證號：'.$accident_t4['guide_code']."\n";
			$message .= '隨團導遊姓名：'.$accident_t4['guide_name']."\n";
			$message .= '隨團導遊手機：'.$accident_t4['guide_tel']."\n";
			$message .= '接待旅行社：'.$accident_t4['agency_name']."\n";
			if ($accident_t4['level'] == '1') {
				$message .= '通報級別：初報'."\n";
			} elseif ($accident_t4['level'] == '2') {
				$message .= '通報級別：續報'."\n";
			} elseif ($accident_t4['level'] == '3') {
				$message .= '通報級別：结報'."\n";
			}
			$message .= '變更時間：'.date('Y-m-d H:i',$accident_t4['atime'])."\n";
			if ($accident_t4['reson'] == '1') {
				$message .= '通報事由：住宿旅館變更'."\n";
			} elseif ($accident_t4['reson'] == '2') {
				$message .= '通報事由：導遊人員變更'."\n";
			} elseif ($accident_t4['reson'] == '3') {
				$message .= '通報事由：旅遊糾紛'."\n";
			} elseif ($accident_t4['reson'] == '4') {
				$message .= '通報事由：出租車輛及遊覽車駕駛通報'."\n";
			} elseif ($accident_t4['reson'] == '5') {
				$message .= '通報事由：緊急事故'."\n";
			} elseif ($accident_t4['reson'] == '6') {
				$message .= '通報事由：治安案件'."\n";
			} elseif ($accident_t4['reson'] == '7') {
				$message .= '通報事由：疫情通報'."\n";
			} elseif ($accident_t4['reson'] == '8') {
				$message .= '通報事由：違法、違規、逾期停留、違規脫團、行方不明、從事與許可目的不符活動、違常通報'."\n";
			} elseif ($accident_t4['reson'] == '9') {
				$message .= '通報事由：分車通報'."\n";
			} elseif ($accident_t4['reson'] == '10') {
				$message .= '通報事由：其他通報'."\n";
			} elseif ($accident_t4['reson'] == '11') {
				$message .= '通報事由：購物點變更'."\n";
			}
			
			if ($accident_t4['reson'] == '2') {
				$message .= '車別：'.$accident_t4['car']."\n";
				$message .= '原始本島導遊姓名：'.$accident_t4['org_tw_guide_name']."\n";
				$message .= '原始本島導遊電話：'.$accident_t4['org_tw_guide_tel']."\n";
				$message .= '變更後本島導遊證號：'.$accident_t4['tw_guide_code']."\n";
				$message .= '變更後本島導遊姓名：'.$accident_t4['tw_guide_name']."\n";
				$message .= '變更後本島導遊電話：'.$accident_t4['tw_guide_tel']."\n";
				$message .= '原始離島導遊姓名：'.$accident_t4['org_tw_lguide_name']."\n";
				$message .= '原始離島導遊電話：'.$accident_t4['org_tw_lguide_tel']."\n";
				$message .= '變更後離島導遊證號：'.$accident_t4['tw_lguide_code']."\n";
				$message .= '變更後離島導遊姓名：'.$accident_t4['tw_lguide_name']."\n";
				$message .= '變更後離島導遊電話：'.$accident_t4['tw_lguide_tel']."\n";
			} elseif ($accident_t4['reson'] == '4') {
				$message .= '車別：'.$accident_t4['car']."\n";
				$message .= '帶團日期'."\n";
				$message .= '開始時間：'.date('Y-m-d H:i', $accident_t4['group_start_time'])."\n";
				$message .= '結束時間：'.date('Y-m-d H:i', $accident_t4['group_end_time'])."\n";
				$message .= '車種：'.$accident_t4['car_type']."\n";
				$message .= '車號：'.$accident_t4['car_code']."\n";
				$message .= '□派車單'."\n";
				$message .= '駕駛登記證號：'.$accident_t4['driver_code']."\n";
				$message .= '駕駛姓名：'.$accident_t4['driver_name']."\n";
				$message .= '□未連續帶團切結書'."\n";
			} elseif ($accident_t4['reson'] == '9') {
				$message .= '車別：'.$accident_t4['car']."\n";
				$message .= '原始車輛：'.$accident_t4['org_car']."\n";
				$message .= '原始車種：'.$accident_t4['org_car_type']."\n";
				$message .= '遊覽車駕駛登記證號：'.$accident_t4['guide_driver_code']."\n";
				$message .= '遊覽車駕駛姓名：'.$accident_t4['guide_driver_name']."\n";
				$message .= '本島導遊證號：'.$accident_t4['tw_cguide_code']."\n";
				$message .= '本島導遊姓名：'.$accident_t4['tw_cguide_name']."\n";
				$message .= '本島導遊電話：'.$accident_t4['tw_cguide_tel']."\n";
				$message .= '離島導遊證號：'.$accident_t4['tw_lcguide_code']."\n";
				$message .= '離島導遊姓名：'.$accident_t4['tw_lcguide_name']."\n";
				$message .= '離島導遊電話：'.$accident_t4['tw_lcguide_tel']."\n";
			} elseif ($accident_t4['reson'] == '10') {
				$message .= '□1.提前出境'."\n";
				$message .= '時間：'.date('Y-m-d H:i', $accident_t4['ahead_ltime'])."\n";
				$message .= '機場/港口：'.$accident_t4['ahead_airport']."\n";
				$message .= '航班：'.$accident_t4['ahead_flight_code']."\n";
				$message .= '送機人員：'.$accident_t4['ahead_domembers']."\n";
				$message .= '□2.延期出境'."\n";
				$message .= '時間：'.date('Y-m-d H:i', $accident_t4['postpone_ltime'])."\n";
				$message .= '機場/港口：'.$accident_t4['postpone_airport']."\n";
				$message .= '航班：'.$accident_t4['postpone_flight_code']."\n";
				$message .= '送機人員：'.$accident_t4['postpone_domembers']."\n";
				$message .= '□3.旅客人數未達入境最低限額'."\n";
			}
			
			$message .= '案件說明：'.$accident_t4['detail']."\n";
			$message .= '旅客姓名名單：'.$accident_t4['members_name']."\n";
			
			$this->_sendEmail($subject, $message, $id, $receiver);
        }
        
        return array('result'=>$result);
	}

	private function _sendEmail($subject, $message, $id, $receiver) {
		require dirname ( __FILE__ ) . '/../../../core/libraries/aws/aws-autoloader.php';
		$config = array('key'=>AWS_KEY,'secret'=>AWS_SECRET,'region'=>AWS_REGION);
		$aws = Aws\Common\Aws::factory($config);
		$sns = $aws->get("Sns");
		
		//向逍遙遊發送郵件s
		$rowset = array(
			'TopicArn'=>AWS_SNS_TOPIC_ARN_BULLETIN,
			'Subject'=>$subject,
			'Message'=>$message
		);
		$sns->publish($rowset);
		
		if ($receiver['mailto_union'] == '1') {
			//選擇向全聯會發送郵件
			$rowset = array(
				'TopicArn'=>AWS_SNS_TOPIC_ARN_UNION,
				'Subject'=>$subject,
				'Message'=>$message
			);
			$sns->publish($rowset);
		}
		
		if ($receiver['mailto_dt'] == '1') {
			//選擇向觀光局發送郵件
			$rowset = array(
				'TopicArn'=>AWS_SNS_TOPIC_ARN_DT,
				'Subject'=>$subject,
				'Message'=>$message
			);
			$sns->publish($rowset);
		}
		
		if ($receiver['agency_arn'] && $receiver['agency_arn'] != '') {
			$rowset = array(
				'TopicArn'=>$receiver['agency_arn'],
				'Subject'=>$subject,
				'Message'=>$message
			);
			$sns->publish($rowset);
		}
		
		if ($receiver['guide_arn'] && $receiver['guide_arn'] != '') {
			$rowset = array(
				'TopicArn'=>$receiver['guide_arn'],
				'Subject'=>$subject,
				'Message'=>$message
			);
			$sns->publish($rowset);
		}
	}
}
?>