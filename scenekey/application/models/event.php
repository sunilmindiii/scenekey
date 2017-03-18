<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Event extends MY_Model {
 
	public function __construct()
	{
		parent::__construct();
	
		$this->load->library('session');

 date_default_timezone_set('America/Los_Angeles');

	}
public function sp_eventbylocation(){


        $pdo_object = $this->config->item('pdo');

        $query = $pdo_object->prepare('CALL SP_locationeevent(?,?)');
        $query->bindParam(1, $city, PDO::PARAM_STR, '2000');
		$query->bindParam(2, $segmemt, PDO::PARAM_STR, '2000');

        $query->execute();
	

        $arr = array();
        $x = 0;
        $i = 1;
        do {
            $rowset = $query->fetchAll(PDO::FETCH_ASSOC);
             if($rowset){
		        $arr[$x] = $rowset; 
		        }
			 else{
			$arr[$x]='';	 
			 }
			
            $x++;


            $i++;
        } while ($query->nextRowset());
        return $arr;
 
}

}
 
