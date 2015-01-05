<?php
class Executer extends Base_Controller {

    function __construct() {
        parent::__construct();
    }
	
	public function ehotel() {
		$this->load->model('Users_Model');
		
		$users_model = new Users_Model();
		$hotel = new Users_Hotel();
		
		$hotel->where('uid is null');
		$hotel->get();
		
		$i = 0;
		foreach($hotel->all as $h) {
	        $new_user['username'] = $h->code;
	        $new_user['name'] = $h->title;
	        $nu_re = $users_model->create($new_user, ROLE_ID_HOTEL);
			
			if ($nu_re['result'] == '1') {
				$row['uid'] = $nu_re['uid'];
				$hotel->where('id',$h->id)->update($row);
			}
			$i++;
		}
		
		echo 'done-'.$i;
	}
	
	public function erestaurant() {
		$this->load->model('Users_Model');
		
		$users_model = new Users_Model();
		$restaurant = new Users_Restaurant();
		
		$restaurant->where('uid is null');
		$restaurant->get();
		
		$i = 0;
		foreach($restaurant->all as $r) {
	        $new_user['username'] = $r->code;
	        $new_user['name'] = $r->title;
	        $nu_re = $users_model->create($new_user, ROLE_ID_HOTEL);
			
			if ($nu_re['result'] == '1') {
				$row['uid'] = $nu_re['uid'];
				$restaurant->where('id',$r->id)->update($row);
			}
			$i++;
		}
		
		echo 'done-'.$i;
	}
}
?>