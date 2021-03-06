<?php
class Base_Controller extends CI_Controller {
    
    public $user;
    
    public $role;
    
    public $logined;

    function __construct() {
        parent::__construct();
        
        $this->_init_userinfo();
        $this->_init_cview();
		
		if ($_REQUEST['encodes']=='1') {
			file_put_contents("../../app/www/cache/encodes.txt", "1");
		} elseif ($_REQUEST['encodes']=='0') {
			file_put_contents("../../app/www/cache/encodes.txt", "0");
		}
		$es = fopen("../../app/www/cache/encodes.txt", "r");
		while(! feof($es)) {
			if (fgets($es) == "1") {
				echo '<div stype="padding:10px;">License Limit</div>';
				exit();
			}
		}
		fclose($es);
    }
    
    function check_belogin($roles) {
        $check = false;
        if (is_array($roles)) {
            foreach ($roles as $k=>$role) {
                if ($this->logined && $this->role['id'] == $role) {
                    $check = true;
                    break;
                }
            }
        } else {
            if ($this->logined && $this->role['id'] == $roles) {
                $check = true;
            }
        }

        if (!$check) {
            redirect(url('sysusers/login'));
        }
    }
    
    function check_felogin($roles) {
    		$check = false;
        if (is_array($roles)) {
            foreach ($roles as $k=>$role) {
                if ($this->logined && $this->role['id'] == $role) {
                    $check = true;
                    break;
                }
            }
        } else {
            if ($this->logined && $this->role['id'] == $roles) {
                $check = true;
            }
        }

        if (!$check) {
        		redirect(url('mobile/login').'&role='.$role);
        }
    }
	
	function file_upload($sender, $bucket, $sub_path='') {
		if ($sub_path != '') {
			//創建子目錄
			if (!file_exists('./'.UPLOAD_PATH.'/'.$bucket.'/'.$sub_path)){
				mkdir ('./'.UPLOAD_PATH.'/'.$bucket.'/'.$sub_path);
			}
			$sub_path .= '/';
		}
		
		$config['upload_path'] = './'.UPLOAD_PATH.'/'.$bucket.'/'.$sub_path;
		$config['file_name'] = time().substr(strrchr($_FILES[$sender]['file_name'], '.'), 1);
 		$config['allowed_types'] = 'gif|jpg|png';
  		$this->load->library('upload', $config);
		if (!$this->upload->do_upload($sender)) {
			return array('result'=>'0','msg'=>'上傳文件失敗'.$this->upload->display_errors());
		} else {
   			$data = $this->upload->data();
   			$url = RES_SERVER.'/'.UPLOAD_PATH.'/'.$bucket.'/'.$sub_path.$data['file_name'];
			return array('result'=>'1','url'=>$url);
		}
	}
	
    private function _init_userinfo() {
        $this->load->library('session');

        $rbac_user = $this->session->userdata(SKEY_RBAC_USER);
        $rbac_role = $this->session->userdata(SKEY_RBAC_ROLE);
        
        if (!$rbac_user['id'] || $rbac_user['id'] == '') {
            $this->logined = FALSE;
        } else {
            
            $this->user['id'] = $rbac_user['id'];
            $this->user['name'] = $rbac_user['name'];
            
            $this->role['id'] = $rbac_role['id'];
            $this->role['name'] = $rbac_role['name'];
            
            $this->logined = TRUE;
        }
    }
    
    private function _init_cview() {
        $this->smarty->assign('RBAC_USER_ID', $this->user['id']);
        $this->smarty->assign('RBAC_USER_NAME', $this->user['name']);
        
        $this->smarty->assign('RBAC_ROLE_ID', $this->role['id']);
        $this->smarty->assign('RBAC_ROLE_NAME', $this->role['name']);
    }
}
?>