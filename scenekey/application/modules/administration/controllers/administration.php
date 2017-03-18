<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Administration extends MY_Controller {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }


    /* ------------- Admin Login Setion Start--------------- */
    public function index() {
        $this->load->view('admin/login');
    }

    /* ------------- Admin Login Setion End-------------- */
	/* ------------- Admin Dashboard view Start--------------- */
    public function dashboard() {
         $this->adminCommonView('admin/index');
    }

    /* ------------- Admin Dashboard view End-------------- */
    /* ------------- Admin Logout Setion Start -------------- */

    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url('admin/'));
    }

    /* ------------- Admin Logout Setion End-------------- */
    /* ------------- Forget Password form page view start--------------- */

    public function forgetPassword() {
        $this->load->view('admin/adminUsers/forgot_password');
    }

    /* ------------- Forget Password form page view end------------- */

}

?>