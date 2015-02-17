<?php
class Notify extends Base_Controller {

    function __construct() {
        parent::__construct();
    }
	
	public function check_dialog() {
		if ($this->logined) {
			$this->load->model('Notify_Model');
			$notify_model = new Notify_Model();
			
			if ($this->role['id'] == ROLE_ID_GUIDE) {
				$notify_model->getGuideNotifyByUid($this->user['id']);
			} elseif ($this->role['id'] == ROLE_ID_RESTAURANT) {
				$notify_model->getRestaurantNotifyById($this->user['id']);
			}
		}
	}
}
?>