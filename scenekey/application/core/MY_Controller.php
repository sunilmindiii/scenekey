<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

/* Constructor start contains globel variables */
	function __construct()
	{
		parent:: __construct();	
		
		//$this->currentDate      = date('Y-m-d');
		//$this->currentDateTime  = date('Y-m-d H:i:s');
		//$this->currentTime      = date('H:i:s');
		//$this->currentTimestamp = time();
		$this->sessData['userId'] = $this->session->userdata('userId');
		$this->sessData['userType'] = $this->session->userdata('userType');
		$this->sessData['userEmail'] = $this->session->userdata('userEmail');
		$this->sessData['adminId'] = $this->session->userdata('adminId');
		$this->cm = $this->common_model;
	/* For Location AJAX Start*/
	/* Comman Function Sewction Start */
		//$artists = $this->cm->artists();
		//$vanues = $this->cm->vanues();
		//$vanuesCategories = $this->cm->vanues_categories();
		//$cities = $this->cm->cities();
		//$events = $this->cm->events();
    
	}
/* Constructor end contains globel variables */	
/* Custome home page view start */	
	public function customHomeView($viewName,$viewData = false)
	{ 
		if(!isset($viewData['headerData']))
			$viewData['headerData'] = array(); 
		//print_r($viewData['headerData']); die;	
		
		$this->load->view('header',$viewData);
		$this->load->view('top_header',$viewData);
		$this->load->view($viewName,$viewData);
		$this->load->view('footer');
	}
/* Custome home page view end */
/* Admin comman view for all the backend pages start */	
	public function adminCommonView($viewName,$viewData = false)
	{ 
		if(!isset($viewData['headerData']))
			$viewData['headerData'] = array(); 
		//print_r($viewData['headerData']); die;	
		
		$this->load->view('admin/header',$viewData);
		$this->load->view('admin/menu-sidebar',$viewData);
		$this->load->view($viewName,$viewData);
		$this->load->view('admin/footer');
	}
/* Admin comman view for all the backend pages end */
        
}
