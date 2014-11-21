<?php
class Accident_Model extends CI_Model {
    
    function __construct() {
        parent::__construct ();
    }

    /**
     * 获取所有意外通报
     * @return multitype:
     */
    function getAccident() {
        $accident = new Accident();
        
        $accident->get();
        
        return $accident->all;
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