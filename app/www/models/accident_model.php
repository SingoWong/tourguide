<?php
class Accident_Model extends CI_Model {
    
    function __construct() {
        parent::__construct ();
    }

    /**
     * 获取所有意外通报
     * @return multitype:
     */
    function getAccident($with_relation=false, $group_aid=0) {
        $accident = new Accident();
        
        if ($group_aid == 0) {
            $accident->get();
        } else {
            $accident->where('group_aid', $group_aid)->get();
        }
        
        if ($with_relation) {
            $ids = array();
            for ($i=0; $i<sizeof($accident->all); $i++) {
                $ids[] = $accident->all[$i]->id;
            }
            
            if (sizeof($ids) > 0) {
                $accident_bus = new Accident_Bus();
                $accident_desert = new Accident_Desert();
                $accident_medicine = new Accident_Medicine();
                $accident_res = new Accident_Res();
                
                $accident_bus->where_in('aid', $ids)->get();
                $accident_desert->where_in('aid', $ids)->get();
                $accident_medicine->where_in('aid', $ids)->get();
                $accident_res->where_in('aid', $ids)->get();
                
                $bus = array_to_hashmap($accident_bus->all, 'aid');
                $desert = array_to_hashmap($accident_desert->all, 'aid');
                $medicine = array_to_hashmap($accident_medicine->all, 'aid');
                
                for ($i=0; $i<sizeof($accident->all); $i++) {
                    $accident->all[$i]->bus = $bus[$accident->all[$i]->id];
                    $accident->all[$i]->desert = $desert[$accident->all[$i]->id];
                    $accident->all[$i]->medicine = $medicine[$accident->all[$i]->id];
                }
                
                $res = array();
                for ($i=0; $i<sizeof($accident_res->all);$i++) {
                    $row['id'] = $accident_res->all[$i]->id;
                    $row['aid'] = $accident_res->all[$i]->aid;
                    $row['pic_url'] = $accident_res->all[$i]->pic_url;
                    
                    $res[] = $row;
                }
                $accident->res = $res;
            }
        }
        
        return $accident;
    }
    
    /**
     * 获取意外基本信息
     * @param unknown $aid
     * @return multitype:
     */
    function getAccidentById($aid) {
        $accident = new Accident();
        
        $accident->where('id',$aid)->get(1);
        
        return $accident->all;
    }
    
    /**
     * 获取游览车意外信息
     * @param unknown $aid
     * @return multitype:
     */
    function getAccidentBusById($aid) {
        $accident_bug = new Accident_Bus();
        
        $accident_bug->where('aid',$aid)->get(1);
        
        return $accident_bug->all;
    }
    
    /**
     * 获取团员脱团情况
     * @param unknown $aid
     * @return multitype:
     */
    function getAccidentDesertById($aid) {
        $accident_desert = new Accident_Desert();
        
        $accident_desert->where('aid',$aid)->get();
        
        return $accident_desert->all;
    }
    
    /**
     * 获取团员伤亡情况
     * @param unknown $aid
     * @return Accident_Medicine
     */
    function getAccidentMedicineById($aid) {
        $accident_medicine = new Accident_Medicine();
        
        $accident_medicine->where('aid',$aid)->get();
        
        return $accident_medicine;
    }
    
    /**
     * 获取意外的所有图片
     * @param unknown $aid
     * @return multitype:
     */
    function getAccidentResById($aid) {
        $accident_res = new Accident_Res();
        
        $accident_res->where('aid',$aid)->get();
        
        return $accident_res->all;
    }
}
?>