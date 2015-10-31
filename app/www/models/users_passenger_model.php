<?php
class Users_Passenger_Model extends CI_Model {
    
    function __construct() {
        parent::__construct ();
    }
	
	public function save($idc, $name, $policyno) {
		$this->load->model('Users_Model');

        $this->db->trans_start();
        
        $users_model = new Users_Model();
		
        $new_user['username'] = $idc;
        $new_user['name'] = $name;
        $np_re = $users_model->create($new_user, ROLE_ID_PASSENGER);
		
		$new_user['username'] = 'H'.$idc;
        $new_user['name'] = $name;
        $nf_re = $users_model->create($new_user, ROLE_ID_FAMILY);
        
		//初始化密碼
		$users_model->setpassword($idc, $policyno);
		$users_model->setpassword('H'.$idc, 'H'.$policyno);
        
        if ($this->db->trans_status() === FALSE || !$np_re['uid']){
            $this->db->trans_rollback();
			return array('result'=>false);
        } else {
            $this->db->trans_commit();
			
			if ($row['email'] != '') {
				//TODO 更新SNS EndPoint
			}
			
			return array('result'=>true, 'uid'=>$np_re['uid']);
        }
	}
	
	public function getPassengers($ngid) {
		$ngp = new NGroup_Passenger();
		$user = new Users();
		
		$ngp->where('ngid', $ngid)->get();
		
		$ids = array(0);
		foreach ($ngp->all as $n) {
			$ids[] = $n->uid;
		}
		
		$user->where_in('id', $ids)->get();
		
		return $user->all;
	}
	
}
?>