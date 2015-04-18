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
		
		if ($row['email'] && $row['email'] != '') {
			require dirname ( __FILE__ ) . '/../../../core/libraries/aws/aws-autoloader.php';
			$config = array('key'=>AWS_KEY,'secret'=>AWS_SECRET,'region'=>AWS_REGION);
			$aws = Aws\Common\Aws::factory($config);
			$sns = $aws->get("Sns");
			
			$rowset = array(
				'Name'=>'R'.$role_id.'_U'.$row['username']
			);
			$re = $sns->createTopic($rowset);
			$row['arn'] = $re['TopicArn'];
			
			$rowset = array(
				'Endpoint'=>$row['email'],
				'Protocol'=>'email',
				'TopicArn'=>$row['arn']
			);
			$sns->subscribe($rowset);
		}
	    
	    if ($users->result_count() > 0) {
	        $re['result'] = false;
	    } else {
	        $users->username = $row['username'];
	        $users->password = $this->_encrypt_password($row['username'], $this->_gen_password($row['username']));
	        $users->name = $row['name'];
			$users->email = $row['email'];
			$users->arn = $row['arn'];
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
	
	/**
	 * 用户登录
	 * @param unknown $username
	 * @param unknown $password
	 * @return multitype:string
	 */
	public function login($username, $password) {
	    $users = new Users();
	    $users->where('username', $username)->get();
	    
	    if ($users->result_count() > 0) {
	        if ($this->_check_auth($username, $password, $users->all[0]->password)) {
	            $re = array('result'=>'1','msg'=>'登录成功');
	        } else {
	            $re = array('result'=>'0','msg'=>'密码不正确');
	        }
	    } else {
	        $re = array('result'=>'0','msg'=>'用户不存在');
	    }
	     
	    if ($re['result'] == '1') {
	        $uid = $users->all[0]->id;
	        $name = $users->all[0]->name;
			$re['first'] = $users->all[0]->first;
	        
	        //建立RBAC
	        $users_roles = new Users_Roles();
	        $users_roles->where('uid', $uid)->get();
	        
	        if ($users_roles->result_count() > 0) {
	            $roles = new Roles();
	            $roles->where('id', $users_roles->all[0]->rid)->get();
	            
	            if ($roles->result_count() > 0) {
	                $role_id = $roles->all[0]->id;
	                $role_name = $roles->all[0]->name;
	                
	                //写RBAC到SESSION
	                $this->load->library('session');
	                $rbac = array(
	                    SKEY_RBAC_USER=>array('id'=>$uid, 'name'=>$name),
	                    SKEY_RBAC_ROLE=>array('id'=>$role_id, 'name'=>$role_name)
	                );
	                $this->session->set_userdata($rbac);
	                
	                //默认首页
	                $re['default_url'] = $roles->all[0]->default_url;
	            } else {
	                $re = array('result'=>'0','msg'=>'读取权限失败ERR-R');
	            }
	        } else {
	            $re = array('result'=>'0','msg'=>'读取权限失败ERR-UR');
	        }
	    }
	    
	    return $re;
	}
	
	public function logout() {
	    $this->load->library('session');
	    $rbac = array(
	        SKEY_RBAC_USER=>array(),
	        SKEY_RBAC_ROLE=>array()
	    );
	    $this->session->unset_userdata($rbac);
	}
	
	public function update_username($uid, $username) {
		$users = new Users();
	    $users->where('username', $username)->get();
	     
	    if ($users->result_count() == 0) {
	    		$row['username'] = $username;
			$users->where('id', $uid)->update($row);
			
			$this->reset($uid);
			
			$re['result'] = '1';
		} else {
			$re['result'] = '0';
		}
		
		return $re;
	}
	
	public function reset($id) {
	    $this->db->trans_start();
	     
	    //创建用户
	    $users = new Users();
	    $users->where('id', $id)->get();
		
	    if ($users->result_count() > 0) {
	        $row['password'] = $this->_encrypt_password($users->all[0]->username, $this->_gen_password($users->all[0]->username));
	        $users->where('id', $id)->update($row);
	    } else {
	        $re = false;
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
	
	public function checkpassword($uid, $password) {
		$users = $this->getUserByUid($uid);
		
		$username = $users['username'];
		
		if ($this->_check_auth($username, $password, $users->password)) {
	        $re = array('result'=>'1','msg'=>'密碼正確');
		} else {
	        $re = array('result'=>'0','msg'=>'密码不正确');
	    }
		
		return $re;
	}
	
	public function setpassword($username, $password) {
		$this->db->trans_start();
	     
	    //创建用户
	    $users = new Users();
	    $users->where('username', $username)->get();
	     
	    if ($users->result_count() > 0) {
	        $row['password'] = $this->_encrypt_password($users->all[0]->username, $password);
	        $users->where('username', $username)->update($row);
	    } else {
	        $re = false;
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
	
	public function suspended($id) {
	    $this->db->trans_start();
	    
	    //创建用户
	    $users = new Users();
	    $users->where('id', $id)->get();
	    
	    if ($users->result_count() > 0) {
	        $row['status'] = '0';
	        $users->where('id', $id)->update($row);
	    } else {
	        $re = false;
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
	
	public function active($id) {
	    $this->db->trans_start();
	     
	    //创建用户
	    $users = new Users();
	    $users->where('id', $id)->get();
	     
	    if ($users->result_count() > 0) {
	        $row['status'] = '1';
	        $users->where('id', $id)->update($row);
	    } else {
	        $re = false;
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
	
	public function unlock($id) {
		 $this->db->trans_start();
	     
	    //创建用户
	    $users = new Users();
	    $users->where('id', $id)->get();
	     
	    if ($users->result_count() > 0) {
	        $row['first'] = '0';
	        $users->where('id', $id)->update($row);
	    } else {
	        $re = false;
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
	
	public function getUserByUid($uid) {
		$users = new Users();
	    $users->where('id', $uid)->get(1);
		
		return $users->all[0];
	}
	
	public function getUserByUsername($username) {
		$users = new Users();
	    $users->where('username', $username)->get(1);
		
		return $users->all[0];
	}
	
	public function getUserByKeyword($keyword) {
		$users = new Users();
		$users->like('username',$keyword)->or_like('name',$keyword)->get(1);
		
		return $users->all[0];
	}
	
	public function getUsersByName($name, $username) {
		$users = new Users();
		$users->like('name',$name)->or_like('username',$username)->get();
		
		return $users->all;
		
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
	
	private function _check_auth($username, $ipassword, $spassword) {
	    $this->load->library ( 'encrypt' );
	    
	    $password1 = $this->encrypt->decode ( $this->_encrypt_password($username, $ipassword), SECRET_KEY );
	    $password2 = $this->encrypt->decode ( $spassword, SECRET_KEY );
	    
	    return ($password1 == $password2);
	}
}
?>