<?php
class Group_Out_Model extends CI_Model {
    
    function __construct() {
        parent::__construct ();
    }
	
	/**
     * 保存旅行团基本资料 
     * @param unknown $row
     * @return boolean
     */
    function saveGroupOut($row) {
        $group = new Group_Out();
        
        $group->where('id', $row['id'])->get();
        
        if ($group->result_count() > 0) {
        		$row['lid'] = $row['lid'];
			$row['code'] = $row['code'];
			$row['map'] = $row['map'];
			$row['contact_name'] = $row['contact_name'];
			$row['contact_tel'] = $row['contact_tel'];
            
            $re = $this->where('id', $row['id'])->update($row);
        } else {
            $group->aid = $row['aid'];
			$group->lid = $row['lid'];
            $group->code = $row['code'];
			$group->map = $row['map'];
            $group->contact_name = $row['contact_name'];
            $group->contact_tel = $row['contact_tel'];
            
            $re = $group->save();
        }
        
        if ($re) {
            $result = '1';
        } else {
            $result = '0';
        }
        
        return array('result'=>$result, 'id'=>$group->id);
    }
	
	/**
     * 获取旅行团的基本信息
     * @param unknown $gid
     * @return multitype:
     */
    function getGroupOutById($gid) {
        $group = new Group_Out();
        
        $group->where('id', $gid)->get(1);
        
        return $group->all[0];
    }
}
?>