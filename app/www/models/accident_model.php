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
    function getAccident($with_relation=false, $group_aid=0, $source='0') {
        $accident = new Accidents();
        
		$accident->order_by('id', 'DESC');
		$accident->where('source',$source);
        if ($group_aid == 0) {
            $accident->get();
        } else {
            $accident->where('group_aid', $group_aid)->get();
        }
        
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
			
		if ($accident->save()) {
			$re['result'] = '1';
			$re['id'] = $accident->id;
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
	
	function saveAccidentT1($id, $accident, $accident_t1, $poster) {
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

			$this->_sendEmail($subject, $message, $id);
        }
        
        return array('result'=>$result);
	}

	function saveAccidentT2($id, $accident, $accident_t2) {
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
			$message .= '報告人：'."\n";
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
			
			$this->_sendEmail($subject, $message, $id);
        }
        
        return array('result'=>$result);
	}

	function saveAccidentT3($id, $accident, $accident_t3) {
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
			$message .= '報告人：'."\n";
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
			
			$this->_sendEmail($subject, $message, $id);
        }
        
        return array('result'=>$result);
	}
	
	function saveAccidentT4($id, $accident, $accident_t4) {
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
        }
        
        return array('result'=>$result);
	}

	private function _sendEmail($subject, $message, $id) {
		require dirname ( __FILE__ ) . '/../../../core/libraries/aws/aws-autoloader.php';
		$config = array('key'=>AWS_KEY,'secret'=>AWS_SECRET,'region'=>AWS_REGION);
		$aws = Aws\Common\Aws::factory($config);
		$sns = $aws->get("Sns");
		$rowset = array(
			'TopicArn'=>AWS_SNS_TOPIC_ARN_BULLETIN,
			'Subject'=>$subject,
			'Message'=>$message
		);
		$sns->publish($rowset);
	}
}
?>