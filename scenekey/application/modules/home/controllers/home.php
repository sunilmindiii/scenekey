<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Home extends MY_Controller {
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$options = array(
            'select' => 'city',
            'table' => 'city',
			'order'=>array('city'=>"ASC"),
			'group'=>'city',
			'where'=>array('city <>'=>"",'is_show_home '=>"1")
        );
        $data['cities']  = $this->cm->customGet($options);
		
		$this->customHomeView('home',$data);
	}

}
?>