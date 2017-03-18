<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Event_model extends MY_Model {
 
	public function __construct()
	{
		parent::__construct();
	
		$this->load->library('session');

 date_default_timezone_set('America/Los_Angeles');

	}
public function sp_eventbylocation($userid='',$lat='',$long=''){


        $pdo_object = $this->config->item('pdo');

        $query = $pdo_object->prepare('CALL SP_locationeevent(?,?,?)');
        $query->bindParam(1, $userid, PDO::PARAM_STR, '2000');
		$query->bindParam(2, $lat, PDO::PARAM_STR, '2000');
		$query->bindParam(3, $long, PDO::PARAM_STR, '2000');


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
public function sp_event($lat_array_data='',$long_array='',$date='',$start_date=''){


        $pdo_object = $this->config->item('pdo');

        $query = $pdo_object->prepare('CALL SP_events(?,?,?,?)');
        $query->bindParam(1, $lat_array_data, PDO::PARAM_STR, '2000');
		$query->bindParam(2, $long_array, PDO::PARAM_STR, '2000');
		$query->bindParam(3, $date, PDO::PARAM_STR, '2000');
		$query->bindParam(4, $start_date, PDO::PARAM_STR, '2000');

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
 
