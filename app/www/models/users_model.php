<?php
class Users_Model extends CI_Model {
	
	function __construct() {
		parent::__construct ();
	}
    
	public function create($row, $role_id) {
	    $this->db->trans_start();
	    
	    //创建用户
	    $users = new Users();
	    $users->where('username', $row['username'])->get();
	    
	    if ($users->result_count() > 0) {
	        $re['result'] = false;
	    } else {
	        $users->username = $row['username'];
	        $users->password = $this->_encrypt_password($row['username'], $this->_gen_password($row['username']));
	        $users->name = $row['name'];
	        $users->status = '1';
	        
	        $re['result'] = $users->save();
	        $re['uid'] = $users->id;
	    }
	    
	    //创建角色对照
	    if ($re['result']) {
    	    $roles = new Users_Roles();
	        $roles->rid = $role_id;
            $roles->uid = $users->id;
            $roles->save();
	    }
	    
	    if ($this->db->trans_status() === FALSE){
	        $this->db->trans_rollback();
	        $re['result'] = false;
	    } else {
	        $this->db->trans_commit();
	        $re['result'] = true;
	    }
	    
	    return $re;
	}
	
	public function stop($uid) {
	
	}
	
	public function active($uid) {
	
	}
	
	private function _gen_password($username) {
	    return strrev($username);
	}
	
	private function _encrypt_password($username, $password) {
	    $this->load->library ( 'encrypt' );
	    $this->encrypt->set_cipher ( MCRYPT_CAST_256 );
	    $secret_key = $this->encrypt->encode ( $username . $password, SECRET_KEY );
	    return $secret_key;
	}
}
?>