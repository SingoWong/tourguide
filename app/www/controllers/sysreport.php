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
        $this->load->model('Report_Model');
		
		$agency = $this->input->get('agency');
		$start_date = $this->input->get('start_date');
		$end_date = $this->input->get('end_date');
		
		$conditions = array();
        if ($agency && $agency != '') {
        		$this->load->model('Users_Model');
			$users = new Users_Model();
			$re = $users->getUsersByName($agency, $agency);
			
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
		
		$this->smarty->assign('start_date', $start_date);
		$this->smarty->assign('end_date', $end_date);
		$this->smarty->assign('rowset', $re['rowset']);
		$this->smarty->assign('total', $re['total']);
        $this->smarty->display('./sysmanager/report_agency.html');
    }
    
    public function restaurant() {
        $this->load->model('Report_Model');

		$agency = $this->input->get('agency');
		$start_date = $this->input->get('start_date');
		$end_date = $this->input->get('end_date');
		
		$conditions = array();
        if ($agency && $agency != '') {
        		$this->load->model('Users_Model');
			$users = new Users_Model();
			$re = $users->getUsersByName($agency, $agency);
			
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
		
		$this->smarty->assign('start_date', $start_date);
		$this->smarty->assign('end_date', $end_date);
		$this->smarty->assign('rowset', $re['rowset']);
		$this->smarty->assign('total', $re['total']);
        $this->smarty->display('./sysmanager/report_restaurant.html');
    }
    
    public function hotel() {
        $this->load->model('Report_Model');

		$agency = $this->input->get('agency');
		$start_date = $this->input->get('start_date');
		$end_date = $this->input->get('end_date');
		
		$conditions = array();
        if ($agency && $agency != '') {
        		$this->load->model('Users_Model');
			$users = new Users_Model();
			$re = $users->getUsersByName($agency, $agency);
			
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
		
		$this->smarty->assign('start_date', $start_date);
		$this->smarty->assign('end_date', $end_date);
		$this->smarty->assign('rowset', $re['rowset']);
		$this->smarty->assign('total', $re['total']);
        $this->smarty->display('./sysmanager/report_hotel.html');
    }
    
    public function guide() {
        $this->load->model('Report_Model');

		$agency = $this->input->get('agency');
		$start_date = $this->input->get('start_date');
		$end_date = $this->input->get('end_date');
		
		$conditions = array();
        if ($agency && $agency != '') {
        		$this->load->model('Users_Model');
			$users = new Users_Model();
			$re = $users->getUsersByName($agency, $agency);
			
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
		
		$this->smarty->assign('start_date', $start_date);
		$this->smarty->assign('end_date', $end_date);
		$this->smarty->assign('rowset', $re['rowset']);
		$this->smarty->assign('total', $re['total']);
        $this->smarty->display('./sysmanager/report_guide.html');
    }
}
?>