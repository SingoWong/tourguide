<?php
class SysReport extends Base_Controller {

    function __construct() {
        parent::__construct();

        $this->check_belogin(ROLE_ID_ADMIN);
    }
    
    public function index() {
        $this->load->helper('url');
        
        redirect(url('sysreport/agency'));
    }
    
    public function agency() {
		$name = $this->input->get('name');
		$start_date = $this->input->get('start_date');
		$end_date = $this->input->get('end_date');
		
		$re = $this->_get_agency_report_data($name, $start_date, $end_date);
		
		$this->smarty->assign('start_date', $start_date);
		$this->smarty->assign('end_date', $end_date);
		$this->smarty->assign('name', $name);
		$this->smarty->assign('rowset', $re['rowset']);
		$this->smarty->assign('total', $re['total']);
        $this->smarty->display('./sysmanager/report_agency.html');
    }
    
    public function restaurant() {
		$name = $this->input->get('name');
		$start_date = $this->input->get('start_date');
		$end_date = $this->input->get('end_date');
		
		$re = $this->_get_restaurant_report_data($name, $start_date, $end_date);
		
		$this->smarty->assign('start_date', $start_date);
		$this->smarty->assign('end_date', $end_date);
		$this->smarty->assign('name', $name);
		$this->smarty->assign('rowset', $re['rowset']);
		$this->smarty->assign('total', $re['total']);
        $this->smarty->display('./sysmanager/report_restaurant.html');
    }
    
    public function hotel() {
        $name = $this->input->get('name');
		$start_date = $this->input->get('start_date');
		$end_date = $this->input->get('end_date');
		
		$re = $this->_get_hotel_report_data($name, $start_date, $end_date);
		
		$this->smarty->assign('start_date', $start_date);
		$this->smarty->assign('end_date', $end_date);
		$this->smarty->assign('name', $name);
		$this->smarty->assign('rowset', $re['rowset']);
		$this->smarty->assign('total', $re['total']);
        $this->smarty->display('./sysmanager/report_hotel.html');
    }
    
    public function guide() {
		$name = $this->input->get('name');
		$start_date = $this->input->get('start_date');
		$end_date = $this->input->get('end_date');
		
		$re = $this->_get_guide_report_data($name, $start_date, $end_date);
		
		$this->smarty->assign('start_date', $start_date);
		$this->smarty->assign('end_date', $end_date);
		$this->smarty->assign('name', $name);
		$this->smarty->assign('rowset', $re['rowset']);
		$this->smarty->assign('total', $re['total']);
        $this->smarty->display('./sysmanager/report_guide.html');
    }

	public function explore() {
		$report = $this->input->get("report");
		$name = $this->input->get("name");
		$start_date = $this->input->get("start_date");
		$end_date = $this->input->get("end_date");
		
		
		header('Content-Encoding: gb18030');
		header("Content-type:application/vnd.ms-excel;charset=gb18030");
		header("Content-Disposition:attachment;filename=report_".$report."_".$name."_(".$start_date."-".$end_date.").csv");
		
		if ($report == 'agency') {
			$re = $this->_get_agency_report_data($name, $start_date, $end_date);
		} elseif ($report == 'restaurant') {
			$re = $this->_get_restaurant_report_data($name, $start_date, $end_date);
		} elseif ($report == 'hotel') {
			$re = $this->_get_hotel_report_data($name, $start_date, $end_date);
		} elseif ($report == 'guide') {
			$re = $this->_get_guide_report_data($name, $start_date, $end_date);
		}
		
		$t = ","; //"\t"
		$n = "\n"; //\t\n";
		
		$html .= "序號".$t;
		$html .= "用餐日期".$t;
		$html .= "團號".$t;
		$html .= "導遊".$t;
		$html .= "餐別".$t;
		$html .= $n;
		for ($i=0;$i<sizeof($re['rowset']);$i++) {
			$item = $re['rowset'][$i];
			
			$html .= $item->id.$t;
			$html .= $item->date.$t;
			$html .= $item->code.$t;
			$html .= $item->guide_name.$t;
			if ($item->type == '0') {
				$html .= '機';
			} elseif ($item->type == '1') {
				$html .= '景';
			} elseif ($item->type == '2') {
				$html .= '中';
			} elseif ($item->type == '3') {
				$html .= '晚';
			} elseif ($item->type == '4') {
				$html .= '住';
			}
			$html .= $n;
		}
		$html .= $n;
		$html .= "總計 ".$re['total']->count." 筆 (".$re['total']->count."筆*5=".$re['total']->summation.")";
		$html .= $n;
		
		echo $html;
	}
	
	public function printer() {
		
		$report = $this->input->get("report");
		$name = $this->input->get("name");
		$start_date = $this->input->get("start_date");
		$end_date = $this->input->get("end_date");
		
	}
	
	private function _get_agency_report_data($name, $start_date, $end_date) {
		$this->load->model('Report_Model');
		
		$conditions = array();
        if ($name && $name != '') {
        		$this->load->model('Users_Model');
			$users = new Users_Model();
			$re = $users->getUsersByName($name, $name);
			
			$ids = array(0);
			foreach ($re as $r) {
				$ids[] = $r->id;
			}
			if (sizeof($ids) > 0) {
	            $conditions['aid'] = $ids;
			}
        }
		if (!$start_date || $start_date == '') {
			$start_date = date('Y-m-d', strtotime('-1 Month'));
		}
		if (!$end_date || $end_date == '') {
			$end_date = date('Y-m-d');
		}
		$conditions['date >='] = strtotime($start_date);
		$conditions['date <='] = strtotime($end_date);
		
		$report = new Report_Model();
		$re = $report->getReportAgency($conditions);
		
		return $re;
	}
	
	private function _get_restaurant_report_data($name, $start_date, $end_date) {
		$this->load->model('Report_Model');
		
		$conditions = array();
        if ($name && $name != '') {
        		$this->load->model('Users_Model');
			$users = new Users_Model();
			$re = $users->getUsersByName($name, $name);
			
			$ids = array(0);
			foreach ($re as $r) {
				$ids[] = $r->id;
			}
			if (sizeof($ids) > 0) {
	            $conditions['rid'] = $ids;
			}
        }
		if (!$start_date || $start_date == '') {
			$start_date = date('Y-m-d', strtotime('-1 Month'));
		}
		if (!$end_date || $end_date == '') {
			$end_date = date('Y-m-d');
		}
		$conditions['date >='] = strtotime($start_date);
		$conditions['date <='] = strtotime($end_date);
		
		$report = new Report_Model();
		$re = $report->getReportRestaurant($conditions);
		
		return $re;
	}
	
	private function _get_hotel_report_data($name, $start_date, $end_date) {
		$this->load->model('Report_Model');
		
		$conditions = array();
        if ($name && $name != '') {
        		$this->load->model('Users_Model');
			$users = new Users_Model();
			$re = $users->getUsersByName($name, $name);
			
			$ids = array(0);
			foreach ($re as $r) {
				$ids[] = $r->id;
			}
			if (sizeof($ids) > 0) {
	            $conditions['hid'] = $ids;
			}
        }
		if (!$start_date || $start_date == '') {
			$start_date = date('Y-m-d', strtotime('-1 Month'));
		}
		if (!$end_date || $end_date == '') {
			$end_date = date('Y-m-d');
		}
		$conditions['date >='] = strtotime($start_date);
		$conditions['date <='] = strtotime($end_date);
		
		$report = new Report_Model();
		$re = $report->getReportHotel($conditions, $page);
		
		return $re;
	}
	
	private function _get_guide_report_data($name, $start_date, $end_date) {
		$this->load->model('Report_Model');
		
		$conditions = array();
        if ($name && $name != '') {
        		$this->load->model('Users_Model');
			$users = new Users_Model();
			$re = $users->getUsersByName($name, $name);
			
			$ids = array(0);
			foreach ($re as $r) {
				$ids[] = $r->id;
			}
			if (sizeof($ids) > 0) {
	            $conditions['guide_id'] = $ids;
			}
        }
		if (!$start_date || $start_date == '') {
			$start_date = date('Y-m-d', strtotime('-1 Month'));
		}
		if (!$end_date || $end_date == '') {
			$end_date = date('Y-m-d');
		}
		$conditions['date >='] = strtotime($start_date);
		$conditions['date <='] = strtotime($end_date);
		
		$report = new Report_Model();
		$re = $report->getReportGuide($conditions, $page);
		
		return $re;
	}
}
?>