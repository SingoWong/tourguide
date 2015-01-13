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
		
		$page = $this->input->get('page');
		
		$report = new Report_Model();
		$re = $report->getReportAgency($conditions, $page);
		
		$this->smarty->assign('rowset', $re['rowset']);
		$this->smarty->assign('pager', pagerui($re['pager']));
        $this->smarty->display('./sysmanager/report_agency.html');
    }
    
    public function restaurant() {
        $this->load->model('Report_Model');

		$page = $this->input->get('page');
		
		$report = new Report_Model();
		$re = $report->getReportRestaurant($conditions, $page);
		
		$this->smarty->assign('rowset', $re['rowset']);
		$this->smarty->assign('pager', pagerui($re['pager']));
        $this->smarty->display('./sysmanager/report_restaurant.html');
    }
    
    public function hotel() {
        $this->load->model('Report_Model');

		$page = $this->input->get('page');
		
		$report = new Report_Model();
		$re = $report->getReportHotel($conditions, $page);
		
		$this->smarty->assign('rowset', $re['rowset']);
		$this->smarty->assign('pager', pagerui($re['pager']));
        $this->smarty->display('./sysmanager/report_hotel.html');
    }
    
    public function guide() {
        $this->load->model('Report_Model');

		$page = $this->input->get('page');
		
		$report = new Report_Model();
		$re = $report->getReportGuide($conditions, $page);
		
		$this->smarty->assign('rowset', $re['rowset']);
		$this->smarty->assign('pager', pagerui($re['pager']));
        $this->smarty->display('./sysmanager/report_guide.html');
    }
}
?>