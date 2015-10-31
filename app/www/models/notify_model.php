<?php
class Notify_Model extends CI_Model {
    
    function __construct() {
        parent::__construct ();
    }

	function getGuideNotifyByUid($uid) {
		$time = time();
		$alert_ltime = strtotime(date('Y-m-d 10:00:00'));
		$alert_dtime = strtotime(date('Y-m-d 16:00:00'));
		
		$this->load->model('Group_Model');
        $group = new Group_Model();
		$scheduals = $group->getCurrSchedualByGuideId($uid);

		foreach ($scheduals as $schedual) {
			if ($schedual->type='2' && $schedual->rstatus='0' && $time > $alert_ltime && $time < $schedual->time) {
				$row['id'] = $scheduals->id;
				$row['message'] = '提醒您!! 您尚未訂餐，請立即訂餐!!';
				$row['btn1'] = '立即訂餐';
				$row['link1'] = 'index.php?ctr=guide&act=restaurant';
				$row['btn2'] = '稍後訂餐';
				$row['link2'] = 'javascript:$(\'#dialog-x\').hide();';
				$row['sound'] = true;
				$this->show_dialog($row, $uid);
			} elseif ($schedual->type='2' && $schedual->rstatus='1' && $time > ($schedual->time - 3600) && $time < $schedual->time) {
				$row['id'] = $scheduals->id;
				$row['message'] = '提醒您!! 您的訂單尚未完成，是否考慮「重新訂餐」或「電話確認」?';
				$row['btn1'] = '重新訂餐';
				$row['link1'] = 'index.php?ctr=guide&act=restaurant';
				$row['btn2'] = '電話確認';
				$row['link2'] = 'index.php?ctr=guide&act=restaurant';
				$row['sound'] = true;
				$this->show_dialog($row, $uid);
			} elseif ($schedual->type='3' && $schedual->rstatus='0' && $time > $alert_ltime && $time < $schedual->time) {
				$row['id'] = $scheduals->id;
				$row['message'] = '提醒您!! 您尚未訂餐，請立即訂餐!!';
				$row['btn1'] = '立即訂餐';
				$row['link1'] = 'index.php?ctr=guide&act=restaurant';
				$row['btn2'] = '稍後訂餐';
				$row['link2'] = 'javascript:$(\'#dialog-x\').hide();';
				$row['sound'] = true;
				$this->show_dialog($row, $uid);
			} elseif ($schedual->type='3' && $schedual->rstatus='1' && $time > ($schedual->time - 3600) && $time < $schedual->time) {
				$row['id'] = $scheduals->id;
				$row['message'] = '提醒您!! 您的訂單尚未完成，是否考慮「重新訂餐」或「電話確認」?';
				$row['btn1'] = '重新訂餐';
				$row['link1'] = 'index.php?ctr=guide&act=restaurant';
				$row['btn2'] = '電話確認';
				$row['link2'] = 'index.php?ctr=guide&act=restaurant';
				$row['sound'] = true;
				$this->show_dialog($row, $uid);
			}
		}
		
		//TODO
	}

	function getRestaurantNotifyById($uid) {
		$orders = new Restaurant_Order();
		
		$orders->where('status', STATUS_RORDER_PANDING);
		$orders->where('rid', $uid);
		$orders->get();
		
		if ($orders->result_count() > 0) {
			$row['id'] = $orders->id;
			$row['message'] = '您有新進訂單!!';
			$row['btn1'] = '立即檢視';
			$row['link1'] = 'index.php?ctr=restaurant&act=new_order';
			$row['btn2'] = '稍後檢視';
			$row['link2'] = 'javascript:$(\'#dialog-x\').hide();';
			$row['sound'] = false;
			$this->show_dialog($row, $uid);
		}
		
		//TODO
	}
	
	function getAccidentNotifyById($uid) {
		$notify = $this->_getNotifyByUid($uid);
		
		$id = $notify->id;
		
		if ($id && $id != '') {
			$row['id'] = $id;
			$row['message'] = $notify->message;
			$row['btn1'] = '立即檢視';
			$row['link1'] = '/index.php?ctr=sysagency&act=accident';
			$row['btn2'] = '稍後檢視';
			$row['link2'] = 'javascript:$(\'#dialog-x\').hide();';
			$row['sound'] = true;
			
			$this->show_dialog($row, $uid);
		}
	}
	
	public function setNotify($row) {
		$notify = new TNotify();
		
		$notify->uid = $row['uid'];
		$notify->message = $row['message'];
		$notify->btn1 = $row['btn1'];
		$notify->link1 = $row['link1'];
		$notify->btn2 = $row['btn2'];
		$notify->link2 = $row['link2'];
		
		$re = $notify->save();
		
		return $re;
	}
	
	private function _getNotifyByUid($uid) {
		$notify = new TNotify();
		
        $notify->where('uid', $uid);
		$notify->where('status', '0');
        $notify->get(1);
		
		$result = $notify->all[0];
		
		//更新为已读取
		$id = $notify->all[0]->id;
		$notify->where('id', $id)->update(array('status'=>'1'));
		
		return $result;
	}
	
	private function show_dialog($row, $uid) {
		$this->load->helper('cookie');
		if (get_cookie('dialog-x-'.$uid.md5($row['id'])) == '1') {
			return;
		}
		
		set_cookie('dialog-x-'.$uid.md5($row['id']),'1',60*5);
		
		$html = '<div class="dialog" id="dialog-x"><div class="dialog_content">'.$row['message'].'</div><div class="dialog_option"><a href="#" onclick="location.href=\''.$row['link1'].'\'" class="dialog_btn">'.$row['btn1'].'</a><a href="'.$row['link2'].'" class="dialog_btn">'.$row['btn2'].'</a></div></div>';
		//if ($row['sound']) {
//			$html .= '<audio id=\'notify_audio\'><source src=\'/theme/sound/notify.ogg\' type=\'audio/ogg\'><source src=\'/theme/sound/notify.mp3\' type=\'audio/mpeg\'><source src=\'/theme/sound/notify.wav\' type=\'audio/wav\'></audio>';
			$html .= '<audio id=\'notify_audio\'><source src=\'/theme/sound/police.wav\' type=\'audio/wav\'></audio>';
			$html .= '<script>$(\'#notify_audio\')[0].play();</script>';
		//}
		
		echo $html;
	}
}
?>