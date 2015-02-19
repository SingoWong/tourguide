<?php
class Contract_Restaurant_Model extends CI_Model {
    
    function __construct() {
        parent::__construct ();
    }
	
	function getCRestaurantByAgency($aid, $page=0, $size=20) {
		$uar = new Users_Agency_Restaurant();
		
		$uar->where('aid',$aid)->get_paged($page,$size);
		
		$ids = array();
        for ($i=0; $i<sizeof($uar->all); $i++) {
            $ids[] = $uar->all[$i]->rid;
        }
        if (sizeof($ids) > 0) {
            $users = new Users();
            $users->where_in('id', $ids)->get();
            
            $us = array_to_hashmap($users->all, 'id');
            
            for ($i=0; $i<sizeof($uar->all); $i++) {
                $uar->all[$i]->restaurant = $us[$uar->all[$i]->rid];
            }
        }
		
		return array('rowset'=>$uar->all,'pager'=>$uar->paged);
	}
	
	function getCAgencyByRestaurant($rid, $page=0, $size=20) {
		$uar = new Users_Agency_Restaurant();
		
		$uar->where('rid',$rid)->get_paged($page,$size);
		
		$ids = array();
        for ($i=0; $i<sizeof($uar->all); $i++) {
            $ids[] = $uar->all[$i]->aid;
        }
        if (sizeof($ids) > 0) {
            $users = new Users();
            $users->where_in('id', $ids)->get();
            
            $us = array_to_hashmap($users->all, 'id');
            
            for ($i=0; $i<sizeof($uar->all); $i++) {
                $uar->all[$i]->agency = $us[$uar->all[$i]->aid];
            }
        }
		
		return array('rowset'=>$uar->all,'pager'=>$uar->paged);
	}
	
	function createContractAR($aid, $rid) {
		$uar = new Users_Agency_Restaurant();
		
		$uar->where('aid',$aid)->where('rid',$rid)->get();
		
		$uar->aid = $aid;
		$uar->rid = $rid;
		
		if ($uar->result_count() > 0) {
			$re['result'] = '0';
			$re['msg'] = '餐廳和旅行社已建立合約';
		} elseif ($uar->save()) {
			$re['result'] = '1';
			$re['id'] = $uar->id;
		} else {
			$re['result'] = '0';
			$re['msg'] = '保存失敗，請重試';
		}
		
		return $re;
	}
	
	function removeContractAR($id) {
		$uar = new Users_Agency_Restaurant();
		
		$uar->where('id',$id)->get();
		
		return $uar->delete();
	}
}
?>