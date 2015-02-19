<?php
class Contract_Hotel_Model extends CI_Model {
    
    function __construct() {
        parent::__construct ();
    }
	
	function getCHotelByAgency($aid, $page=0, $size=20) {
		$uah = new Users_Agency_Hotel();
		
		$uah->where('aid',$aid)->get_paged($page,$size);
		
		$ids = array();
        for ($i=0; $i<sizeof($uah->all); $i++) {
            $ids[] = $uah->all[$i]->hid;
        }
        if (sizeof($ids) > 0) {
            $users = new Users();
            $users->where_in('id', $ids)->get();
            
            $us = array_to_hashmap($users->all, 'id');
            
            for ($i=0; $i<sizeof($uah->all); $i++) {
                $uah->all[$i]->hotel = $us[$uah->all[$i]->hid];
            }
        }
		
		return array('rowset'=>$uah->all,'pager'=>$uah->paged);
	}
	
	function getCAgencyByHotel($hid, $page=0, $size=20) {
		$uah = new Users_Agency_Hotel();
		
		$uah->where('hid',$hid)->get_paged($page,$size);
		
		$ids = array();
        for ($i=0; $i<sizeof($uah->all); $i++) {
            $ids[] = $uah->all[$i]->aid;
        }
        if (sizeof($ids) > 0) {
            $users = new Users();
            $users->where_in('id', $ids)->get();
            
            $us = array_to_hashmap($users->all, 'id');
            
            for ($i=0; $i<sizeof($uah->all); $i++) {
                $uah->all[$i]->agency = $us[$uah->all[$i]->aid];
            }
        }
		
		return array('rowset'=>$uah->all,'pager'=>$uah->paged);
	}
	
	function createContractAH($aid, $hid) {
		$uah = new Users_Agency_Hotel();
		
		$uah->where('aid',$aid)->where('hid',$hid)->get();
		
		$uah->aid = $aid;
		$uah->hid = $hid;
		
		if ($uah->result_count() > 0) {
			$re['result'] = '0';
			$re['msg'] = '旅行社和飯店已建立合約';
		} elseif ($uah->save()) {
			$re['result'] = '1';
			$re['id'] = $uah->id;
		} else {
			$re['result'] = '0';
			$re['msg'] = '保存失敗，請重試';
		}
		
		return $re;
	}
	
	function removeContractAH($id) {
		$uah = new Users_Agency_Hotel();
		
		$uah->where('id',$id)->get();
		
		return $uah->delete();
	}
}
?>