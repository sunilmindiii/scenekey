<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Event extends MY_Controller {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }


    /* ------------- Add Event Setion Start--------------- */
    public function index() {
        $this->adminCommonView('event/add_event');
    }

    /* ------------- Add Event Setion End-------------- */
	 /* ------------- All Events Setion Start--------------- */
    public function events() {
        $this->adminCommonView('event/all_events');
    }

    /* ------------- All Events Setion End-------------- */

}

?>