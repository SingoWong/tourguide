<?php
class Notify_Model extends CI_Model {
    
    function __construct() {
        parent::__construct ();
    }

	function getNotifyByUid($uid) {
		$notify = new Notify();
		
        $notify->where('uid',$uid);
        $notify->get(1);
		
		return $notify->all[0];
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
				$row['message'] = '提醒您!! 您尚未訂餐，請立即訂餐!!';
				$row['btn1'] = '立即訂餐';
				$row['link1'] = 'index.php?ctr=guide&act=restaurant';
				$row['btn2'] = '稍後訂餐';
				$row['link2'] = 'javascript:$(\'#dialog-x\').hide();';
				$row['sound'] = true;
				$this->show_dialog($row);
			} elseif ($schedual->type='2' && $schedual->rstatus='1' && $time > ($schedual->time - 3600) && $time < $schedual->time) {
				$row['message'] = '提醒您!! 您的訂單尚未完成，是否考慮「重新訂餐」或「電話確認」?';
				$row['btn1'] = '重新訂餐';
				$row['link1'] = 'index.php?ctr=guide&act=restaurant';
				$row['btn2'] = '電話確認';
				$row['link2'] = 'index.php?ctr=guide&act=restaurant';
				$row['sound'] = true;
				$this->show_dialog($row);
			} elseif ($schedual->type='3' && $schedual->rstatus='0' && $time > $alert_ltime && $time < $schedual->time) {
				$row['message'] = '提醒您!! 您尚未訂餐，請立即訂餐!!';
				$row['btn1'] = '立即訂餐';
				$row['link1'] = 'index.php?ctr=guide&act=restaurant';
				$row['btn2'] = '稍後訂餐';
				$row['link2'] = 'javascript:$(\'#dialog-x\').hide();';
				$row['sound'] = true;
				$this->show_dialog($row);
			} elseif ($schedual->type='3' && $schedual->rstatus='1' && $time > ($schedual->time - 3600) && $time < $schedual->time) {
				$row['message'] = '提醒您!! 您的訂單尚未完成，是否考慮「重新訂餐」或「電話確認」?';
				$row['btn1'] = '重新訂餐';
				$row['link1'] = 'index.php?ctr=guide&act=restaurant';
				$row['btn2'] = '電話確認';
				$row['link2'] = 'index.php?ctr=guide&act=restaurant';
				$row['sound'] = true;
				$this->show_dialog($row);
			}
		}
		
		//TODO
	}

	function getRestaurantNotifyById($uid) {
		$orders = new Restaurant_Order();
		
		$orders->where('status', STATUS_RORDER_PANDING);
		$orders->where('rid', $rid);
		$orders->get();
		
		if ($orders->result_count() > 0) {
			$row['message'] = '您有新進訂單!!';
			$row['btn1'] = '立即檢視';
			$row['link1'] = 'index.php?ctr=restaurant&act=new_order';
			$row['btn2'] = '稍後檢視';
			$row['link2'] = 'javascript:$(\'#dialog-x\').hide();';
			$row['sound'] = false;
			$this->show_dialog($row);
		}
		
		//TODO
	}
	
	private function show_dialog($row) {
		$this->load->helper('cookie');
		if (get_cookie('dialog-x-flag') == '1') {
			return;
		}
		
		set_cookie('dialog-x-flag','1',60*5);
		
		$html = '<div class="dialog" id="dialog-x"><div class="dialog_content">'.$row['message'].'</div><div class="dialog_option"><a href="'.$row['link1'].'" class="dialog_btn">'.$row['btn1'].'</a><a href="'.$row['link2'].'" class="dialog_btn">'.$row['btn2'].'</a></div></div>';
		if ($row['sound']) {
			$html .= '<audio id=\'notify_audio\'><source src=\'/theme/sound/notify.ogg\' type=\'audio/ogg\'><source src=\'/theme/sound/notify.mp3\' type=\'audio/mpeg\'><source src=\'/theme/sound/notify.wav\' type=\'audio/wav\'></audio>';
			$html .= '<script>$(\'#notify_audio\').play();</script>';
		}
		
		echo $html;
	}
}
?>