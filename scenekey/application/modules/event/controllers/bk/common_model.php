<?php

class Common_model extends My_Model {

    function __construct() {
        parent::__construct();
		$this->load->library('upload');
    }

    /*public function userLoginCheck($uName = FALSE, $uPass = FALSE, $uType = FALSE) {
        if (!empty($uName) && !empty($uPass)) {
            $where = array('user_login_name' => $uName, 'user_password' => $uPass);
        } elseif (!empty($uType) && !empty($uName) && !empty($uPass)) {
            $where = array('user_type_id' => $uType, 'user_login_name' => $uName, 'user_password' => $uPass);
        } 
        $options = array(
            'select' => 'user_master.*, userstype.utype_name',
            'table' => 'user_master',
            'join' => array('userstype' => 'userstype.utype_id = user_master.user_type_id'),
            'where' => $where,
            'single' => TRUE
        );
        $userlogin = $this->customGet($options);

        //echo $this->db->last_query();
        //die();

        return $userlogin;
    }*/

    /* session data clear */
	
	
	public function UPDATEDATA($tablename, $where = '', $feild = '') {
		if (!empty($tablename) || !empty($feild)):
			$this->db->where($where);
			$this->db->update($tablename, $feild);
			return $this->db->affected_rows();;
		else: return "Invalid Input Provided";
			endif;
    }
	
	public function INSERTDATA($tablename, $feild = '') {
        if (!empty($tablename) || !empty($feild)):
            $this->db->set($feild);
            $insert = $this->db->insert($tablename);
            if ($insert):
                return $this->db->insert_id();

            endif;
        else: return "Invalid Input Provided";
        endif;
    }
	
	 public function DELETEDATA($tablename = '', $where = '') {
        if (!empty($tablename) || !empty($where)):
            $this->db->where($where);
            $this->db->delete($tablename);
        else: return "Invalid Input Provided";
        endif;
    }
	
	public function  eventByLocation($where,$limit='',$start='')
	{
		$this->db->select('*');
		$this->db->from("tbl_venue");
		$this->db->join("tbl_events",'tbl_events.venue_id = tbl_venue.venue_id');
		$this->db->join("tbl_artist",'tbl_events.artist_id = tbl_artist.artist_id');
		//$this->db->join("tbl_venue_category",'tbl_venue.venue_category_id = tbl_venue_category.category');
		if(!empty($where))$this->db->where($where);
		 if(!empty($limit))$this->db->limit($limit,$start); 
		 if(!empty($order_by)) $this->db->order_by($order_by);
		 $query = $this->db->get();
		 return $query->result_array();

	}
	
	public function getevents($lat,$long,$date,$start_time)
	{
		$query= "select * FROM tbl_venue JOIN tbl_events ON tbl_events.venue_id = tbl_venue.venue_id JOIN tbl_artist ON tbl_events.artist_id = tbl_artist.artist_id WHERE tbl_venue.venue_lat = '$lat' AND tbl_venue.venue_long= '$long' AND tbl_events.event_date=  '$date' AND tbl_events.event_time BETWEEN '$start_time' AND '23:59:59'";

		$query = $this->db->query($query);
		return $query->result_array();
	}

	public function getuserevent($userid,$array)
	{
		$query= "select event_id as eventid ,event_name as eventname,datetime as eventdate,event_interval as end_time from tbl_events where event_created_by='$userid' ";
		if(!empty($array)){
			$query .=" AND event_id NOT IN ($array)";
		}
		$query = $this->db->query($query);
		return $query->result_array();
	}
	
	public function getevents_test($lat,$long,$date,$start_time,$nowtime)
	{

		//$query= "select * FROM tbl_venue JOIN tbl_events ON tbl_events.venue_id = tbl_venue.venue_id  WHERE tbl_venue.venue_lat IN ($lat) AND tbl_venue.venue_long IN ($long) AND tbl_events.event_date=  '$date' AND tbl_events.event_type='1' AND tbl_events.event_time BETWEEN '$start_time' AND '23:59:59'";
		$query= "select * FROM tbl_venue JOIN tbl_events ON tbl_events.venue_id = tbl_venue.venue_id  WHERE tbl_venue.venue_lat IN ($lat) AND tbl_venue.venue_long IN ($long) AND tbl_events.event_start_time<'$start_time' AND tbl_events.event_end_time>'$nowtime' AND tbl_events.event_type='1'";

		$query = $this->db->query($query);
		return $query->result_array();

	}
	
		
	public function getevents_tending($lat,$long,$date,$start_time,$nowtime)
	{


		//$query= "select * FROM tbl_venue JOIN tbl_events ON tbl_events.venue_id = tbl_venue.venue_id  WHERE tbl_venue.venue_lat IN ($lat) AND tbl_venue.venue_long IN ($long) AND tbl_events.event_date=  '$date' AND tbl_events.event_type='1' AND tbl_events.event_time BETWEEN '$start_time' AND '23:59:59'";
		$query= "select * FROM tbl_venue JOIN tbl_events ON tbl_events.venue_id = tbl_venue.venue_id  WHERE tbl_venue.venue_lat IN ($lat) AND tbl_venue.venue_long IN ($long) AND tbl_events.event_start_time<'$start_time' AND tbl_events.event_end_time>'$nowtime'  ORDER BY tbl_events.trending_point DESC ";

		$query = $this->db->query($query);
		return $query->result_array();

	}
	public function deleteeventdata($date){
	$query= "select event_id,event_date ,event_end_time FROM tbl_events  WHERE event_date <= now( ) - INTERVAL 2
            MONTH ORDER BY `tbl_events`.`event_date` DESC  ";

		$query = $this->db->query($query);
		return $query->result_array();	
	}
	public function getevents_new($lat,$long,$date,$start_time)
	{

		$query= "select * FROM tbl_venue_new JOIN tbl_events_new ON tbl_events_new.venue_id = tbl_venue_new.venue_id  WHERE tbl_venue_new.venue_lat IN ($lat) AND tbl_venue_new.venue_long IN ($long) AND tbl_events_new.event_date=  '$date' AND tbl_events_new.event_time BETWEEN '$start_time' AND '23:59:59'";

		$query = $this->db->query($query);
		return $query->result_array();

	}

	public function getevents_de_test($lat,$long,$date)
	{
		$query= "select * FROM tbl_venue JOIN tbl_events ON tbl_events.venue_id = tbl_venue.venue_id WHERE tbl_venue.venue_lat IN ($lat) AND tbl_venue.venue_long IN ($long) AND tbl_venue.publish ='1' AND tbl_events.event_type='0' AND tbl_events.event_date='$date' LIMIT 1000";

		$query = $this->db->query($query);
		return $query->result_array();
	}

	public function getevents_new_d($lat,$long)
	{
		$query= "select * FROM tbl_venue_new JOIN tbl_events_new ON tbl_events_new.venue_id = tbl_venue_new.venue_id WHERE tbl_venue_new.venue_lat IN ($lat) AND tbl_venue_new.venue_long IN ($long) AND tbl_venue_new.publish ='1' AND tbl_events_new.artist_id='1775' LIMIT 1000";

		$query = $this->db->query($query);
		return $query->result_array();
	}

	public function venueofevent($eventid){

		$query= "select * FROM tbl_venue JOIN tbl_events ON tbl_events.venue_id = tbl_venue.venue_id WHERE tbl_events.event_id='$eventid'";

		$query = $this->db->query($query);
		return $query->result_array();

	}
	

	public function getloc($lat,$lng)
	{
	$query="SELECT venue_lat,venue_long,( 3959 * acos( cos( radians($lat) ) * cos( radians(venue_lat) ) * cos( radians(venue_long) - radians($lng) ) + sin( radians($lat) ) * sin( radians(venue_lat ) ) ) ) AS distance FROM tbl_venue HAVING distance <40 ORDER BY distance";
	
		$query = $this->db->query($query);
			 return $query->result_array();

		
	}
	
		public function getloc_new($lat,$lng)
	{
	$query="SELECT venue_lat,venue_long,( 3959 * acos( cos( radians($lat) ) * cos( radians(venue_lat) ) * cos( radians(venue_long) - radians($lng) ) + sin( radians($lat) ) * sin( radians(venue_lat ) ) ) ) AS distance FROM tbl_venue_new HAVING distance <20 ORDER BY distance";
	
		$query = $this->db->query($query);
			 return $query->result_array();

		
	} 
public function getVenueSearch($name,$page=''){

		$query="SELECT venue_id,venue_name,venue_city,venue_state,venue_image from tbl_venue where venue_name like '%$name%'ORDER BY venue_name ASC LIMIT ";
		
		if(!empty($page) && $page!='0'){
		
		$query .= "$page, ";
		}
               $query .= "10";
		$query = $this->db->query($query);
	 return $query->result_array();


}
public function getVenueSearch_limit($name){

		$query="SELECT count(*) as total from tbl_venue where venue_name like '%$name%'";
	
		$query = $this->db->query($query);
			 return $query->result_array();


}

public function getArtistSearch($name,$page=''){

		$query="SELECT artist_id,artist_name,artist_image from tbl_artist where artist_name like '%$name%' ORDER BY artist_name ASC LIMIT ";
		
		if(!empty($page) && $page!='0'){
		
		$query .= "$page, ";
		}
               $query .= "10";
		$query = $this->db->query($query);
	 return $query->result_array();


}
public function getArtistSearch_limit($name){

		$query="SELECT count(*) as total from tbl_artist where artist_name like '%$name%'";
	
		$query = $this->db->query($query);
			 return $query->result_array();


}
public function getResponserSearch($name,$page=''){

		$query="SELECT * from tbl_responser where name like '%$name%' ORDER BY name ASC LIMIT ";
		
		if(!empty($page) && $page!='0'){
		
		$query .= "$page, ";
		}
               $query .= "10";
		$query = $this->db->query($query);
	 return $query->result_array();


}
public function getResponserSearch_limit($name){

		$query="SELECT count(*) as total from tbl_responser where name like '%$name%'";
	
		$query = $this->db->query($query);
			 return $query->result_array();


}
public function geteventartist($id){
	
		$query = "SELECT * FROM tbl_artist WHERE event_ids='".$id."'"; 

		$query = $this->db->query($query);
			 return $query->result_array();

	
}
public function bevent(){
	
		$query = "SELECT * FROM tbl_events WHERE event_name='' "; 

		$query = $this->db->query($query);
			 return $query->result_array();

	
}
public function geteventvenue($id){
	
		$query = "SELECT * FROM tbl_venue join tbl_events on tbl_venue.venue_id=tbl_events.venue_id WHERE  tbl_events.event_id='".$id."'"; 

		$query = $this->db->query($query);
			 return $query->result_array();

	
}
public function venueAvgrating($venue_id=''){
	
		$query = "SELECT COUNT( * ) AS rating_count FROM tbl_events JOIN tbl_rating ON tbl_events.event_id = tbl_rating.event_id WHERE tbl_events.venue_id ='$venue_id'"; 

		$query = $this->db->query($query);
			 return $query->result_array();
}

/**function for weservices end here**/
	
	

    public function clearSessionData() {

        foreach ($this->session->userdata as $sess_var) {
            unset($sess_var);
        }
    }

    /* Function for user login End */
	/* Function for Fetch all Artists Records Start */
	
	public function artists($limit='',$start='',$where='',$like='',$select='*')
	{
		$this->db->select($select);
		$this->db->from("artist");
		if(!empty($where))$this->db->where($where);
		if(!empty($like))$this->db->like($like);
		if(!empty($limit))$this->db->limit($limit,$start);
		$this->db->order_by('artist_name',"ASC");
		$vanues	=	$this->db->get();
		
		return $vanues->result();
		/*echo $this->db->last_query();  die();*/
	}
	
	/* Function for Fetch all Artists Records End */
	/* Function for Fetch all Vanues Records Start */
	
	public function vanues($limit='',$start='',$where='',$like='',$select='*',$order='' )
	{
		$this->db->select($select);
		$this->db->from("venue");
		if(!empty($where))$this->db->where($where);
		if(!empty($like))$this->db->like($like);
		if(!empty($limit))$this->db->limit($limit,$start);
		if(!empty($order))
			$this->db->order_by($order);
		else
			$this->db->order_by('venue_added_at desc');
		
		$vanues	=	$this->db->get(); 
		
		//echo $this->db->last_query(); 
		
		return $vanues->result();
	}
	//code by satyapal singh bist------------------------
	
	public function event_by_vanues($id){
		
		$options = array('select'=>"*",
			'where'	=>	array('venue.venue_id'=>$id),
            'table' => 'venue',
			'join'	=>	array('venue_category'=>'venue_category.category_id=venue.venue_category_id'),
			'limit'=>1
        );
		
        $event_vanues = $this->customGet($options);
		
		//get venue's time if exists
		$venue = array('select'=>"*",
			'where'	=>	array('venue_id'=>$id),
            'table' => 'tbl_venue_time'
        );
		$venueTime = $this->customGet($venue);
		
		if(count($venueTime) > 0){
			foreach($venueTime[0] as $key=>$val){
				$event_vanues[0]->$key = $val; //replacing category time with venue time for all day of the week
			}
		}
		
		$options_event = array('select'=>"*",
			'where'	=>	array('events.venue_id'=>$id),
            'table' => 'events'
        );
		
		$event_vanues['events'] = $this->customGet($options_event);
        return $event_vanues;
	}
	//end here------------------------------------------------
	/* Function for Fetch all Vanues Records End */
	/* Function for Fetch all Vanues Categories Records Start */
	
	public function vanues_categories($selects='*')
	{
		 $options = array(
            'select' => $selects,
            'table' => 'venue_category',
        );
         $vanues = $this->customGet($options);
        return $vanues;
		/*echo $this->db->last_query();  die();*/
	}
	
	/* Function for Fetch all Vanues Categories Records End */
	/* Function for Fetch all Vanues Categories Records Start */
	
	public function cities($selects='*')
	{
		 $options = array(
            'select' => $selects,
            'table' => 'city',
			'order'=>array('city'=>"ASC"),
			'group'=>'city',
			'where'=>array('city <>'=>"")
        );
         $city = $this->customGet($options);
        return $city;
		/*echo $this->db->last_query();  die();*/
	}
	
	/* Function for Fetch all Vanues Categories Records Start */
	
	public function events($limit='',$start='',$where='',$like2='',$count=FALSE)
	{
		ini_set('display_errors',1);
		$this->db->select("events.*, venue.venue_name, artist.artist_name");
		$this->db->from("events");
		$this->db->join("artist","artist.artist_id = events.artist_id");
		$this->db->join("venue","venue.venue_id = events.venue_id");
		if(!empty($where))$this->db->where($where);
		if(!empty($like2))$this->db->like($like2);
		if(!empty($limit))$this->db->limit($limit,$start);
		
		if($count){
			return $this->db->count_all_results();
		} else{
			$events	= $this->db->get();
			return $events->result();
		}
		
		
		/* $options = array(
            'select' => 'events.*, venue.venue_name, artist.artist_name',
            'table' => 'events',
			'join' => array('artist' => 'artist.artist_id = events.artist_id',
							'venue' => 'venue.venue_id = events.venue_id'),
        );
        $events = $this->customGet($options);
        return $events; */
		/*echo $this->db->last_query();  die();*/
	}
	
	/* Function for Fetch all Vanues Categories Records End */
	

   
    /* Generlise function to upload files from form End */
	/*code start by satyapal*/
	public function uploadImage($file,$path,$venueId){
		if (!file_exists($path)) {
    		mkdir($path, 0777, true);
		}
		$config =  array('upload_path'=> $path,
			'allowed_types' => "gif|jpg|png|jpeg");        
        //$this->load->library('upload', $config);
		$this->upload->initialize($config);
        if($this->upload->do_upload('file')){
			$da		=	$this->upload->data();
            $data['message'] = "File Uploaded Successfully";
            $data['status'] = 1;
            $data["uploaded_file"] = $da['file_name'];
			$data1 = array(
               'venue_image' => $da['file_name']
            );
			$this->db->where('venue_id', $venueId);
			$this->db->update('tbl_venue', $data1);
        }else{
            $data['message'] = $this->upload->display_errors();
            $data['status'] = 0;
        }		
		return $data;
	}
	public function update_vanues_categories($venue_id,$category_id){
		$data = array('venue_category_id' => $category_id);
		$this->db->where('venue_id', $venue_id);
		$this->db->update('tbl_venue', $data);
		$this->db->select("*");
		$this->db->from('venue_category');
		$this->db->where(array('tbl_venue_category.category_id'=>$category_id));
		return $this->db->get()->row();
		//$this->db->select("category,category_id");
		
	}
	public function update_vanues_status($where,$data){
		$this->db->where($where);
		$this->db->update('tbl_venue', $data);
		return $this->db->affected_rows();
	}
	public function update_vanues_category_time($data){
		$where = array('category_id'=>$data['id'],'status'=>1); 
		$catReq = $this->db->where($where)->get('tbl_venue_category');
		
		if($catReq->num_rows()){
			$catRes = $catReq->row();
			$catVenueReq = $this->db->where(array('venue_id'=>$data['venue_id']))->count_all_results('tbl_venue_time');
			
			if($catVenueReq == 0){
				$venueTimeArr['sunday'] = $catRes->sunday;
				$venueTimeArr['monday'] = $catRes->monday;
				$venueTimeArr['tuesday'] = $catRes->tuesday;
				$venueTimeArr['wednesday'] = $catRes->wednesday;
				$venueTimeArr['thursday'] = $catRes->thursday;
				$venueTimeArr['friday'] = $catRes->friday;
				$venueTimeArr['saturday'] = $catRes->saturday;
				$venueTimeArr['venue_id'] = $data['venue_id'];
				
				$this->db->insert('tbl_venue_time',$venueTimeArr);
			}
			
			$col = strtolower($data['col']);
			$time_string	=	explode("-", $catRes->$col);
			
			if($data['status']=='start'){
				$time_string[0]=$data['value'];
			}elseif($data['status']=='end'){
				$time_string[1]=$data['value'];
			}
			
			$data1 = array($col => implode('-', $time_string));
			return $this->db->update('tbl_venue_time', $data1,array('venue_id'=>$data['venue_id']));
			
		}
	}
	public function update_vanues_name($data){
		$where = array('venue_id'=>$this->cm->idDecrypt($data['id'])); 
		if($data['field']=='venue_address'){
		    $venue_address=$data['name'];
			$venue_address_array=array_reverse(explode(",",$data['name']));
			$venue_data['venue_city']=$venue_address_array[2];
			$venue_data['venue_state']=$venue_address_array[1];
			$lat_long= explode(',',$this->get_lat_long($venue_address));
			$lat=$lat_long[0];
			$long=$lat_long[1];
			$data1	=	array('venue_lat' => $lat,
				'venue_long' => $long,
				'venue_city' => $venue_data['venue_city'],
                'venue_state' => $venue_data['venue_state'],
                'venue_country' => $venue_address_array[0], 
				'venue_address' => $venue_address); 
		}else{
			$data1	=	array($data['field']=>$data['name']); 
		}
		
		
		$this->db->update('tbl_venue', $data1, $where);
		return $data['name'];
	}
	public function slug_generator(){
		$i=0;
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@%^_+";
		while($i==0){
			$event_slug = substr( str_shuffle( $chars ), 0, 20 );
			$this->db->select("event_name");
			$this->db->from("events");
			$this->db->where(array('event_slug'=>$event_slug));
			$event_query=$this->db->get();
			$event_data=	$event_query->row();
			if(empty($event_data)){
				
				$i++;
			}
		}
		return $event_slug;
	}
	function get_lat_long($address){

		$address = str_replace(" ", "+", $address);

		$json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false");
		$json = json_decode($json);

		$lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
		$long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
		return $latlong=$lat.','.$long;
	}
	function promoter($limit,$start,$where='',$like='',$select='*'){
		$this->db->select($select);
		$this->db->from("tbl_responser");
		if(!empty($where))$this->db->where($where);
		if(!empty($like))$this->db->like($like);
		if(!empty($limit))$this->db->limit($limit,$start);
		$query=$this->db->get();
		return $query->result();
	}
	function eventCategory($limit,$start,$where='',$like='',$select='*'){
		$this->db->select($select);
		$this->db->from("tbl_event_category");
		if(!empty($where))$this->db->where($where);
		if(!empty($like))$this->db->like($like);
		if(!empty($limit))$this->db->limit($limit,$start);
		$query=$this->db->get();
		return $query->result();
	}
	/*code end by satyapal*/

    public function get_sql_select_data($tablename, $where = '', $feild = '', $limit = '', $order_by = '', $like = '') {
        if (!empty($feild))
            $this->db->select($feild);
        if (empty($feild))
            $this->db->select();
        if (!empty($where))
            $this->db->where($where);
        if (!empty($limit))
            $this->db->limit($limit);
        if (!empty($like))
            $this->db->like($like);
        if (!empty($order_by))
            $this->db->order_by($order_by);

        $this->db->from($tablename);
        $query = $this->db->get();

        // return $query->result();

        return $query->result_array();
    }
	
	public function getData($table,$limit='',$start='',$where='',$like='',$select='*')
	{
		$this->db->select($select);
		$this->db->from($table);
		if(!empty($where))$this->db->where($where);
		if(!empty($like))$this->db->like($like);
		if(!empty($limit))$this->db->limit($limit,$start);
		$vanues	=	$this->db->get();        
		return $vanues->result();
	}
	
	public function total_record($table, $select, $where='',$like='')
	{
		$this->db->select($select);
		$this->db->from($table);
		if(!empty($where))$this->db->where($where);
		if(!empty($like))$this->db->like($like);
		//$vanues	=	$this->db->get($table); 
		return $this->db->count_all_results();
	}

	public function artist_user(){
        $query = "SELECT event_ids as event_id,artist_id FROM tbl_artist  WHERE user_id!=0"; 
		$query = $this->db->query($query);
		return $query->result_array();

	}
	public function promoter_user(){
        $query = "SELECT event_id,id FROM tbl_responser  WHERE user_id!=''"; 
		$query = $this->db->query($query);
		return $query->result_array();

	}
	
	function getVenueDetail($venueId)
	{
		$this->db->select('tbl_venue.venue_name,tbl_venue_category.'.strtolower(date('l')));
		$this->db->from('tbl_venue');
		$this->db->join('tbl_venue_category','tbl_venue_category.category_id = tbl_venue.venue_category_id');
		$this->db->where(array('tbl_venue.venue_id'=>$venueId));
		
		$venueDetail = $this->db->get();        
		$res = $venueDetail->result();
		$return = array();
		
		if(!empty($res)){
			
			$col = strtolower(date('l'));
			$time = $res[0]->$col;
			if($time != 'Closed'){
	
				$return['venueName'] = $res[0]->venue_name;
				
				$time = explode('-',$time);
				$startDate = str_replace('P','pm',$time[0]);
				$endDate = str_replace('A','am',$time[1]);
				
				$return['startDate'] = date('Y-m-d H:00:00',strtotime($startDate)); //start date
				$return['endDate'] = date('Y-m-d H:00:00',strtotime($endDate));
			
				$newdate = strtotime ( '1 day' , strtotime ( $return['endDate'] ) ) ;
				$return['endDate'] = date ( 'Y-m-d H:00:00' , $newdate ); // end date
				
				$date1 = new DateTime($return['startDate']);
				$date2 = new DateTime($return['endDate']);
				$interval = $date1->diff($date2);
				
				$eventTime = explode(' ',$return['startDate']);
				
				$return['timeInterval'] = $interval->h;
				$return['datetime'] = str_replace(' ','T',$return['startDate']);
				$return['event_time'] = $eventTime[1];
				
			}
			
		}
		
		return $return;
	}
	
}
?>