<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home_old extends MY_Controller {

    public function __construct() {
        parent::__construct();
     
        $this->load->library('session');
    }

    public function index() {

          echo "welcome To scenekey";
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */