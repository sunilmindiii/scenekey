<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Event extends MY_Controller {
 
	public function __construct()
	{
		parent::__construct();
	
		$this->load->library('session');
		$this->load->model('event_model');

 date_default_timezone_set('America/Los_Angeles');

	}

	public function index()
    { 
	$category_fetch =$this->common_model->get_sql_select_data('tbl_venue_category');
	$where=array('status'=>1);
    $city =$this->common_model->get_sql_select_data('city',$where);
   
	foreach ($city as $final_city1)
	{
           foreach ($category_fetch as $category_fetch_val)
		    {  
                    						 
						 $category_fetch_name=$category_fetch_val['category'];
						  $category_fetch_id=$category_fetch_val['category_id'];
                           $latitude =$final_city1['lat'];
						   $city =$final_city1['city'];
						   $longitude=$final_city1['longitude'];
                          $json_string = 'https://api.foursquare.com/v2/venues/search?client_id=BI5HHL4T34FRBGWI1X5LZVYFC4HHYHDXGYRY3XXOORQHBRXS&client_secret=2ZSZICRVHNBKKTVVPXCKUWCCWY01PTTPTPFRSMYF2PTPVE5J%20&v=20130815%20&ll='.$latitude.','.$longitude.'%20&query='.$category_fetch_name.'';
                            
							  $ch = curl_init();
							  curl_setopt($ch, CURLOPT_URL,$json_string);
							  curl_setopt($ch, CURLOPT_POST, TRUE);
							  curl_setopt($ch, CURLOPT_POSTFIELDS, $msg);
							  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
							  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
							  $p_result = curl_exec($ch);
							 $array = json_decode(trim($p_result), TRUE);
							 curl_close($ch);
							

						
							 $cat_id=array();
						
								foreach ($array['response']['venues'] as $data)
								 {
								 $vanue_name=str_replace("'",'',$data['name']);
								 $lat=$data['location']['lat'];
								 $lng=$data['location']['lng'];
								 $contry=$data['location']['country'];
								 $state=$data['location']['state'];
                                 $address= implode(',',$data['location']['formattedAddress']);
								 $field=array('venue_name'=>$vanue_name,
								              'venue_category_id'=>$category_fetch_id,
											  'venue_lat'=>$lat,
											  'venue_long'=>$lng,
											  'venue_state'=>$state,
											  'venue_city'=>$city,
											  'venue_country'=>$contry,
								               'venue_address'=>$address,
											   'status'=>'1'
								            );
											//print_r($field);
								   // $this->common_model->INSERTDATA('tbl_venue',$field);

								}

	        }
	}
		
	
	 
	}
	
	 public function getEvent_old()
   {

	   $count=1;
	   $fields=array('city','state');
		$where=array('status'=>1);
        $city =$this->common_model->get_sql_select_data('tbl_city',$where);
		foreach ($city as $city)
		{
              $city_name=$city['city'];
			 $city_name_en=URLencode($city_name);
			  $state_name=$city['state'];
              $json_string = 'http://api.bandsintown.com/events/search.json?location='.$city_name_en.','.$state_name.'';
             //die;
                            
					$ch1 = curl_init();
				    curl_setopt($ch1, CURLOPT_URL,$json_string);
					 curl_setopt($ch1, CURLOPT_POST, TRUE);
					curl_setopt($ch1, CURLOPT_POSTFIELDS, $msg);
					curl_setopt($ch1, CURLOPT_RETURNTRANSFER, TRUE);
					curl_setopt($ch1, CURLOPT_FOLLOWLOCATION, 1);
					 $p_result = curl_exec($ch1);
					 $array = json_decode(trim($p_result), TRUE);
					curl_close($ch1);  
					
			              //print_r($array);
					//echo $count;
					//echo '<br>';
					//$count++;
					
					
					foreach($array as $enue){
		                 $datetime=$enue['datetime'];
						 $dt=explode('T',$datetime);

					     $name=$enue['venue']['name'];
				         $lat=$enue['venue']['latitude'];
						 $long=$enue['venue']['longitude'];	
						 $city=$enue['venue']['city'];
						 $state=$enue['venue']['region'];
						 if(empty($state)){
						  $state='CA';
						 }
						 
						 $country=$enue['venue']['country'];
                              foreach($enue['artists'] as $artist){
					           $artist_name=$artist['name'];	
							}							 
						 
						if(!empty($name)){ 
						$where=array('venue_lat'=>$lat,'venue_long'=>$long);
                        $venue =$this->common_model->get_sql_select_data('tbl_venue',$where);
						
						if($venue){
							$where_event=array('venue_id'=>$venue[0]['venue_id'],'datetime'=>$datetime);
						    $event_exist =$this->common_model->get_sql_select_data('tbl_events',$where_event);

							if($event_exist){
							$where_art=array('artist_id'=>$event_exist[0]['artist_id']);	
						    $art_filed=array('artist_name'=>$artist_name);
							$artist_id =$this->common_model->UPDATEDATA('tbl_artist',$where_art,$art_filed);
							$fields=array('event_name'=>$name,'event_create_at'=>date("Y-m-d H:i:s"),'datetime'=>$datetime,'event_date'=>$dt[0],'event_time'=>$dt[1],'status'=>1);
							$venue =$this->common_model->UPDATEDATA('tbl_events',$where_event,$fields);
								
							}
							else{
					     	$art_filed=array('artist_name'=>$artist_name);
							$artist_id =$this->common_model->INSERTDATA('tbl_artist',$art_filed);
							$fields=array('event_name'=>$name,'venue_id'=>$venue[0]['venue_id'],'artist_id'=>$artist_id,'event_create_at'=>date("Y-m-d H:i:s"),'datetime'=>$datetime,'event_date'=>$dt[0],'event_time'=>$dt[1],'status'=>1);
							 $venue =$this->common_model->INSERTDATA('tbl_events',$fields);
						      }
						}
						 else
						 {
		                     $field_venue=array('venue_name'=>$name,

											  'venue_lat'=>$lat,
											  'venue_long'=>$long,
											  'venue_city'=>$city,
											  'venue_state'=>$state,
											  'venue_country'=>$country,
											  'venue_category_id'=>'1',
											   'status'=>'1'
								            );
										
								    $venue=$this->common_model->INSERTDATA('tbl_venue',$field_venue);
							$art_filed=array('artist_name'=>$artist_name);
							$artist_id =$this->common_model->INSERTDATA('tbl_artist',$art_filed);
							$fields=array('event_name'=>$name,'venue_id'=>$venue,'artist_id'=>$artist_id,'event_create_at'=>date("Y-m-d H:i:s"),'datetime'=>$datetime,'event_date'=>$dt[0],'event_time'=>$dt[1],'status'=>1);
							 $venue =$this->common_model->INSERTDATA('tbl_events',$fields);
							 
						 }
						 
						}
	                }
			
				

					
					
   }
   
   }
   public function getEvent()
   {

	   $count=1;
	   $fields=array('city','state');
		$where=array('status'=>1);
        $city =$this->common_model->get_sql_select_data('tbl_city',$where);
		foreach ($city as $city)
		{
              $city_name=$city['city'];
			 $city_name_en=URLencode($city_name);
			  $state_name=$city['state'];
             $json_string = 'http://api.bandsintown.com/events/search.json?location='.$city_name_en.','.$state_name.'';
                            
					$ch1 = curl_init();
				    curl_setopt($ch1, CURLOPT_URL,$json_string);
					 curl_setopt($ch1, CURLOPT_POST, TRUE);
					curl_setopt($ch1, CURLOPT_POSTFIELDS, $msg);
					curl_setopt($ch1, CURLOPT_RETURNTRANSFER, TRUE);
					curl_setopt($ch1, CURLOPT_FOLLOWLOCATION, 1);
					 $p_result = curl_exec($ch1);
					 $array = json_decode(trim($p_result), TRUE);
					curl_close($ch1);  
					
			              //print_r($array);
					//echo $count;
					//echo '<br>';
					//$count++;
					
					
					foreach($array as $enue){
		                 $datetime=$enue['datetime'];
						 $dt=explode('T',$datetime);

					     $name=$enue['venue']['name'];
				         $lat=$enue['venue']['latitude'];
						 $long=$enue['venue']['longitude'];	
						 $city=$enue['venue']['city'];
						 $state=$enue['venue']['region'];
						 if(!empty($state)){
						 // $state='CA';
//}
						 
						 $country=$enue['venue']['country'];
						      foreach($enue['artists'] as $artist_event){
					          $event_name=$artist_event['name'];	
							}	
                            						 
						 
						if(!empty($name)){ 
						$where=array('venue_lat'=>$lat,'venue_long'=>$long);
                        $venue =$this->common_model->get_sql_select_data('tbl_venue',$where);
						
						if($venue){
							$where_event=array('venue_id'=>$venue[0]['venue_id'],'datetime'=>$datetime);
						    $event_exist =$this->common_model->get_sql_select_data('tbl_events',$where_event);

			
							if($event_exist){
								/*
							$where_art=array('event_ids'=>$event_exist[0]['event_id']);	


							$this->common_model->DELETEDATA('tbl_artist',$where_art);
                            foreach($enue['artists'] as $artist){

						    $art_filed=array('artist_name'=>$artist['name'],'event_ids'=>$event_exist[0]['event_id']);
                            $this->common_model->INSERTDATA('tbl_artist',$art_filed);
							}

							$fields=array('event_name'=>$name,'event_create_at'=>date("Y-m-d H:i:s"),'datetime'=>$datetime,'event_date'=>$dt[0],'event_time'=>$dt[1],'status'=>1);
							$this->common_model->UPDATEDATA('tbl_events',$where_event,$fields);
							*/	
							}
							else{
					     	//$art_filed=array('artist_name'=>$artist_name);
							//$artist_id =$this->common_model->INSERTDATA('tbl_artist',$art_filed);
							$start_time=$dt[0].' '.$dt[1];
							$end_time= date('Y-m-d H:i:s', strtotime($start_time . ' +240 minute'));

							$fields=array('event_name'=>$event_name,'venue_id'=>$venue[0]['venue_id'],'event_start_time'=>$start_time,'event_end_time'=>$end_time,'event_create_at'=>date("Y-m-d H:i:s"),'datetime'=>$datetime,'event_date'=>$dt[0],'event_time'=>$dt[1],'status'=>1,'event_type'=>1,'category_id'=>3);
							 $venue_ev =$this->common_model->INSERTDATA('tbl_events',$fields);
							 
							 //	foreach($artist_name as $artist){
							 foreach($enue['artists'] as $artist){

						    $art_filed=array('artist_name'=>$artist['name'],'event_ids'=>$venue_ev);
                            $this->common_model->INSERTDATA('tbl_artist',$art_filed);
							}
						      }
						}
						 else
						 {
		                     $field_venue=array('venue_name'=>$name,

											  'venue_lat'=>$lat,
											  'venue_long'=>$long,
											  'venue_city'=>$city,
											  'venue_state'=>$state,
											  'venue_country'=>$country,
											  'venue_category_id'=>'1',
											  'venue_created_by'=>'2',
											  'venue_added_at'=>date('Y-m-d H:i:s'),
											  'status'=>'1'
								            );
										
						$venue=$this->common_model->INSERTDATA('tbl_venue',$field_venue);
							//$art_filed=array('artist_name'=>$artist_name);
							//$artist_id =$this->common_model->INSERTDATA('tbl_artist',$art_filed);
								$start_time=$dt[0].' '.$dt[1];
							$end_time= date('Y-m-d H:i:s', strtotime($start_time . ' +240 minute'));
							$fields=array('event_name'=>$event_name,'venue_id'=>$venue,'event_create_at'=>date("Y-m-d H:i:s"),'datetime'=>$datetime,'event_start_time'=>$start_time,'event_end_time'=>$end_time,'event_date'=>$dt[0],'event_time'=>$dt[1],'status'=>1,'event_type'=>1,'category_id'=>3);
							 $venue1 =$this->common_model->INSERTDATA('tbl_events',$fields);
							 
							// foreach($artist_name as $artist){
								  foreach($enue['artists'] as $artist){

						    $art_filed=array('artist_name'=>$artist['name'],'event_ids'=>$venue1);
                            $this->common_model->INSERTDATA('tbl_artist',$art_filed);
							}
							 
						 }
						 
						}
	                }
			
		}

					
					
   }
   
   }
   
   public function trending()
   {	   
   $usereventarray=array();
	   if($this->input->post('user_id')){
		   $user_id=$this->input->post('user_id');
		    $userevents =$this->common_model->get_sql_select_data('tbl_userevent',array('userid'=>$user_id),array('eventid'));
            foreach($userevents as $userevent){
				$usereventarray[]=$userevent['eventid'];
			}
	       $final['userinfo']=$this->getUserdetailByID($user_id);
        }
	   
	   $event_date=array('1A'=>'01:00:00','2A'=>'02:00:00','3A'=>'03:00:00','4A'=>'04:00:00','5A'=>'05:00:00',
	                      '6A'=>'06:00:00','7A'=>'07:00:00','8A'=>'08:00:00','9A'=>'09:00:00','10A'=>'10:00:00',
						  '11A'=>'11:00:00','12A'=>'12:00:00','1P'=>'13:00:00','2P'=>'14:00:00','3P'=>'15:00:00',
						  '4P'=>'16:00:00','5P'=>'17:00:00','6P'=>'18:00:00','7P'=>'19:00:00','8P'=>'20:00:00',
						  '9P'=>'21:00:00','10P'=>'22:00:00','11P'=>'23:00:00','12P'=>'00:00:00' );
	   
	 $lat= $this->input->post('lat');
	 $long= $this->input->post('long');
	 $where=array('lat'=>$lat,'longitude'=>$long);
	 if($lat && $long)
	 {

	 $venue_lat_long =$this->common_model->getloc($lat,$long);
	 $city =$this->common_model->get_sql_select_data('tbl_city',$where);
     $city_lat=$city[0]['city'];	 
	 foreach($venue_lat_long as $lat_long)
	{
		$lat_array[]=$lat_long['venue_lat'];
		$long_array[]=$lat_long['venue_long'];
		
	}
	 $lats=implode(',',$lat_array);
    $longs=implode(',',$long_array);

	   $date=date("Y-m-d"); 
 
       $nowtime = date("Y-m-d H:i:s");
       $start_time = date('Y-m-d H:i:s', strtotime($nowtime . ' +1080 minute'));

	  $events =$this->common_model->getevents_tending($lats,$longs,$date,$start_time,$nowtime);
	  	foreach($events as $event) {
		if(in_array($event['event_id'],$usereventarray)){
			$status="exist";
		}
		else {
		   $status="not exist";
	
		}
		$venues_true[]=$event['venue_id'];
		$where_cat=array('category_id'=>$event['venue_category_id']);
			$where_event=array('event_id'=>$event['event_id'],'type'=>'Picture');
				$order_by='id DESC';
				$userevent_img =$this->common_model->get_sql_select_data('tbl_event_feeds',$where_event,NULL,NULL,$order_by);
				if($userevent_img){
				$img=base_url().'upload/'.$userevent_img[0]['feed'];
			      }
				  else{
				$img=base_url().'upload/defaultevent.jpg';
  
				  }
		$category =$this->common_model->get_sql_select_data('tbl_venue_category',$where_cat);
		if($event['venue_address']=='' || $event['venue_address']==null){
			
			$add=$event['venue_city'].', '.$event['venue_state'].', '.$event['venue_country'];
		}
		else 
		{
			$add=$event['venue_address'];
	
		}
		if(!$event['avg_rating_venue']){
			$rating=0;
		}
		else {
		$rating=$event['avg_rating_venue'];
	
		}
		$data['venue']=array('venue_id'=>$event['venue_id'],'venue_name'=>$event['venue_name'],'category'=>$category[0]['category'],'category_id'=>$category[0]['category_id'],'address'=>$add,'city'=>$event['venue_city'],'region'=>$event['venue_state'],'country'=>$event['venue_country'],'latitude'=>$event['venue_lat'],'longitude'=>$event['venue_long'],'rating'=>$rating);
		if($event['event_type']==1 ) {
			$artists_list =$this->common_model->get_sql_select_data('tbl_artist',array('event_ids'=>$event['event_id']));
           if(!empty($artists_list)){
			$data['artists']='';
			foreach($artists_list as $artist){
			$data['artists'][]=array('artist_name'=>$artist['artist_name'],'artist_id'=>$artist['artist_id'],'rating'=>$artist['avg_rating']);
	
			}
		}
	
		}	
     else {
			$data['artists']='';
			unset($data['artists']);

	 }
		if($event['event_interval']){
				$interval=$event['event_interval']*60;
				$event_interval=$event['event_interval'];
			   $event_time = $event['datetime'].'TO'.date('H:i:s', strtotime($event['event_time'] . ' +'.$interval.' minute'));

			}
			else {
			 $event_time = $event['datetime'].'TO'.date('H:i:s', strtotime($event['event_time'] . ' +240 minute'));
			 $event_interval=4;

			}

		 // if($event['makescen']==1){
			   $event_name=$event['event_name'];
		 //  }
		 //  else if($event['event_type']==0){		   
		  // $event_name=$event['event_name'];  
		 //  }
		 //  else {
			// $event_name=$artists[0]['artist_name'];
		  // }
		    if($event['category_id']){
			   $cat_id=$event['category_id'];
			   $category_event =$this->common_model->get_sql_select_data('tbl_event_category',array('id'=>$cat_id));
                $cat_name= $category_event[0]['name'];
		   }
		   else {
			   $cat_id=3;
			   $cat_name='Nightlife';

		   }
		   
		 if($event['avg_rating']==null){
			$rating_event=0;
		}
		else {
		$rating_event=$event['avg_rating'];
	
		}
		$data['events']=array('event_id'=>$event['event_id'],'event_name'=>$event_name,'category'=>$cat_name,'category_id'=>$cat_id,'event_date'=>$event_time,'event_time'=>$event['event_time'],'rating'=>$rating_event,'image'=>$img,'interval'=>$event_interval,'status'=>$status);
	    $final['events'][]=$data;
		   		
	}
	

	  
	
	if(!empty($final )){
	echo json_encode($final );
     }
	  else {
		  $data1=array('status'=>0,'message'=>'No data were found!');
		  echo json_encode($data1);
	  }
   }

else{
	 $data1=array('status'=>0,'message'=>'Check Parameters');
		  echo json_encode($data1);
	
}
   }
	
	public function default_event(){
		$v_f=array('venue_id,venue_name');
		$where=array('publish'=>'1');
 $venues =$this->common_model->get_sql_select_data('tbl_venue',null,$v_f);
  $events =$this->common_model->get_sql_select_data('tbl_events',null,$v_f);
  foreach($events as $event){
	  $ev[]=$event['venue_id'];
  }
foreach($venues as $venue){
	
	if(!in_array($venue['venue_id'],$ev)){
		
	$fields=array('event_name'=>'scenekey pitch','venue_id'=>$venue['venue_id'],'artist_id'=>1775,'status'=>1);
	$this->common_model->INSERTDATA('tbl_events',$fields);
	}


}
	}
	public function dailyevent(){
		
	   $event_date=array('1A'=>'01:00:00','2A'=>'02:00:00','3A'=>'03:00:00','4A'=>'04:00:00','5A'=>'05:00:00',
	                      '6A'=>'06:00:00','7A'=>'07:00:00','8A'=>'08:00:00','9A'=>'09:00:00','10A'=>'10:00:00',
						  '11A'=>'11:00:00','12A'=>'12:00:00','1P'=>'13:00:00','2P'=>'14:00:00','3P'=>'15:00:00',
						  '4P'=>'16:00:00','5P'=>'17:00:00','6P'=>'18:00:00','7P'=>'19:00:00','8P'=>'20:00:00',
						  '9P'=>'21:00:00','10P'=>'22:00:00','11P'=>'23:00:00','12P'=>'00:00:00' );
		
		$v_f='venue_id,venue_name,venue_category_id';
		$where=array('publish'=>'1');
        $venues =$this->common_model->get_sql_select_data('tbl_venue',$where,$v_f);
		foreach($venues as $venue){
			
				$date_even=date('Y-m-d');
		$where_venue=array('event_type'=>1,'venue_id'=>$venue['venue_id'],'event_date'=>$date_even);
		$events =$this->common_model->get_sql_select_data('tbl_events',$where_venue);
			if(!$events) {
				$closed=1;
			/*===============start time and end time ==================*/
		$venue_time =$this->common_model->get_sql_select_data('tbl_venue_time',array('venue_id'=>$venue['venue_id']));
		echo $venue_time[0]['venue_id'];
	    $attr=strtolower(date("l"));
		if(!empty ($venue_time[0]['venue_id']) && isset($venue_time[0]['venue_id'])){
		
	    $ev_date=explode('-',$venue_time[0][$attr]);	
		}	
		else {
		$where_cat=array('category_id'=>$venue['venue_category_id']);
		$category =$this->common_model->get_sql_select_data('tbl_venue_category',$where_cat);
         if($category[0][$attr]=='Closed'){
			 $closed=0;
		 }
        else {
	      $ev_date=explode('-',$category[0][$attr]);
		}		 
			}  
		$t1=strtotime($event_date[$ev_date[0]]);
		$t2=strtotime($event_date[$ev_date[1]]);
		$start_time=date('Y-m-d').' '.$event_date[$ev_date[0]];
		$datetime=date('Y-m-d').'T'.$event_date[$ev_date[0]];
		$end_time=date('Y-m-d').' '.$event_date[$ev_date[1]];
		if($t1>t2){
		 $start_time=date('Y-m-d').' '.$event_date[$ev_date[0]];
		$end_t= date('Y-m-d', strtotime($date_even . ' +1 day'));
		 $end_time=$end_t.' '.$event_date[$ev_date[1]];
		 $date1Timestamp = strtotime($start_time);
		$date2Timestamp = strtotime($end_time);
		 
		$interval = $date2Timestamp - $date1Timestamp;
		 
		$interval=$interval/(3600);

		}
		else{
		$interval= ($t2- $t1)/3600;  

		}
			
			
           /*================end here=================================*/			
				
				
			 $ename= date("l").'@'.$venue['venue_name'];

			$fields=array('event_name'=>$ename,'venue_id'=>$venue['venue_id'],'event_start_time'=>$start_time,'event_end_time'=>$end_time,'event_interval'=>$interval,'artist_id'=>1775,'event_date'=>$date_even,'datetime'=>$datetime,'event_time'=>$event_date[$ev_date[0]],'status'=>1,'event_type'=>0);
			if($closed>0){
				$this->common_model->INSERTDATA('tbl_events',$fields);	
			}
			 }
			}


}
	
	
		public function info(){
		phpinfo();
	}
	
	
       public function venueSearch(){
       $data=array();
         $name= $this->input->post('name');
	    $page= $this->input->post('page')*10;

        $venues =$this->common_model->getVenueSearch($name,$page);     
        $data_total=$this->common_model->getVenueSearch_limit($name);
       if(count($venues)>0){
        foreach($venues as $venue){

       if($venue['venue_image']){
			
		$venue_img='http://209.208.79.95/~scenkey/screenkeys/images/venue/'.$venue['venue_image'];
		}
        else {
			$venue_img=base_url().'img/defaultvenue.png';
		}
        $data['venue'][]=array('name'=>$venue['venue_name'],'id'=>$venue['venue_id'],'venue_city'=>$venue['venue_city'],'venue_state'=>$venue['venue_state'],'image'=>$venue_img);
        }
        $data['total']=$data_total[0]['total'];
       echo json_encode($data);
       }
        else {
      $data=array('staus'=>0,'message'=>'No Data Were found');
      echo json_encode($data);
      }
        

}	


       public function artistSearch(){
       $data=array();
         $name= $this->input->post('name');
	 $page= $this->input->post('page')*10;

        $venues =$this->common_model->getArtistSearch($name,$page);     
        $data_total=$this->common_model->getArtistSearch_limit($name);
          if(count($venues)>0){
        foreach($venues as $venue){ 
		
		
       if($venue['artist_image']){
			
		$venue_img=base_url().'upload/'.$venue['artist_image'];
		}
        else {
			$venue_img=base_url().'img/defaultuser.png';
		}
        
        $data['venue'][]=array('name'=>$venue['artist_name'],'id'=>$venue['artist_id'],'image'=>$venue_img);
        }
        $data['total']=$data_total[0]['total'];
       echo json_encode($data);
        }
         else {
      $data=array('staus'=>0,'message'=>'No Data Were found');
      echo json_encode($data);
      }
        

}	

       public function responserSearch(){
       $data=array();
         $name= $this->input->post('name');
	   $page= $this->input->post('page')*10;

        $venues =$this->common_model->getResponserSearch($name,$page);     
        $data_total=$this->common_model->getResponserSearch_limit($name);
       if(count($venues)>0){
        foreach($venues as $venue){    

  if($venue['image']){
			
	     $venue_img=base_url().'upload/'.$venue['image'];
		}
        else {
			$venue_img=base_url().'img/defaultuser.png';
		}		
        $data['venue'][]=array('name'=>$venue['name'],'id'=>$venue['id'],'image'=>$venue_img);
        }
        $data['total']=$data_total[0]['total'];
       echo json_encode($data);
      }
      else {
      $data=array('staus'=>0,'message'=>'No Data Were found');
      echo json_encode($data);
      }  

}	
public function c(){
	$app='[{"id":74971,"name":"almost famous"},{"id":126065,"name":"Artist in Residence"}]';
	$att=json_decode($app,true);
	foreach($att as $att){
	echo $att['id'];	
		
	}
	
}
 public function makescen(){

      $artist_array_j= $this->input->post('artist');
	  $promoter_array_j= $this->input->post('promoter');
	  $artist_array= json_decode($artist_array_j,true);
	  $promoter_array= json_decode($promoter_array_j,true);
	 // $artist_array=array(array('id'=>74971,'name'=>'\"almost famous\"'),array('id'=>126065,'name'=>'\"Artist in Residence\"'));
	 // $promoter_array=array(array('id'=>5,'name'=>'pal'),array('id'=>15,'name'=>'anil'));

       $user_id= $this->input->post('user_id');
	   $venue= $this->input->post('venue_id');
	   $date=$this->input->post('date');
	   $time=$this->input->post('time');
	   $category=$this->input->post('category_id');
	   $event_name=$this->input->post('event_name'); 
	   $interval=$this->input->post('interval'); 
	   
	   //  $venue=11534;
	//   $date='2015-09-24';
	//  $time='20:00:00';
	//  $category=3;
	//  $event_name='testevent'; 
   //   $interval=1;
	   $datetime=$date.'T'.$time;
	    // $img= $this->input->post('image');
	 /*  $img = str_replace('data:image/jpg;base64,', '', $img);
				$img = str_replace(' ', '+', $img);
				$data = base64_decode($img);
				$file = uniqid() . '.jpg';
				$tfile = "upload/".$file;
				$success = file_put_contents($tfile, $data);
				$path = "upload/".$file ;*/
	if($event_name && $venue && $user_id && $date && $time && $interval && $category) {
		$start_time=$date.' '.$time;
		$period=$interval*60;
	    $end_time = date('Y-m-d H:i:s', strtotime($start_time . ' +'.$period.' minute'));

		$field_array=array('event_name'=>$event_name,'venue_id'=>$venue,'event_created_by'=>$user_id,'event_date'=>$date,'datetime'=>$datetime,'event_time'=>$time,'event_start_time'=>$start_time,'event_end_time'=>$end_time,'status'=>1,'event_interval'=>$interval,'makescen'=>1,'event_type'=>1,'category_id'=>$category);
	   $scenid2= $this->common_model->INSERTDATA('tbl_events',$field_array);
		if(!empty($artist_array)) 
		{
		    foreach($artist_array as $artist_arr)
			{
			     $artist_id=$artist_arr['id'];
			     $artist_name=$artist_arr['name'];	
				 if($artist_name!='') {
		       // $artist_name= preg_replace('/[^A-Za-z0-9\-]/', '', $artists);						  
				if(!$artist_id)
				{						
				  $fields=array('artist_name'=>$artist_name,'event_ids'=>$scenid2);
			     $artist_last=$this->common_model->INSERTDATA('tbl_artist',$fields);

				 $fields_userevent=array('userid'=>$artist_last,'eventid'=>$scenid2,'date'=>date("Y-m-d H:i:s"),'eventname'=>$event_name,'eventdate'=>$datetime);
                 $this->common_model->INSERTDATA('tbl_userevent',$fields_userevent);	
				 
				} 
				else
				{		
		        $fields_update=array('event_ids'=>$scenid2);
				$where=array('artist_id'=>$artist_id);
			    $this->common_model->UPDATEDATA('tbl_artist',$where,$fields_update);
                $chk_user=$this->common_model->get_sql_select_data('tbl_artist',array('artist_id'=>$artist_id),array('user_id'));
                 $chk=0;
				 if($chk_user[0]['user_id']!='' || $chk_user[0]['user_id']!=0){
				   $user_id_artist=$this->common_model->get_sql_select_data('tbl_user',array('userFacebookId'=>$chk_user[0]['user_id']),array('userid'));	
					$artist_id_add=$user_id_artist[0]['userid'];
					if($artist_id_add==$user_id){
						$chk++;
					}
				 }
				 else{
					$artist_id_add=$artist_id; 
				 }
				 if($chk<1){
				 $fields_userevent=array('userid'=>$artist_id_add,'eventid'=>$scenid2,'date'=>date("Y-m-d H:i:s"),'eventname'=>$event_name,'eventdate'=>$datetime);
                 $this->common_model->INSERTDATA('tbl_userevent',$fields_userevent);
				   }				 
	
				}
			 }				
		    }	
        }
  
  	   if(!empty($promoter_array))
		{
		   foreach($promoter_array as $promote)
		   {	
				$promoter_id=$promote['id'];
				$promoter_name=$promote['name'];
				if($promoter_name!='') {
				//$promoter_name= preg_replace('/[^A-Za-z0-9\-]/', '', $promoter_name);						  
						   if(!$promoter_id)
							{
							$field=array('name'=>$promoter_name,'event_id'=>$scenid2);
							$this->common_model->INSERTDATA('tbl_responser',$field);	
							}
							
						else
							{
							$fields_update_p=array('event_id'=>$scenid2);
							$where_p=array('id'=>$promoter_id);
						    $this->common_model->UPDATEDATA('tbl_responser',$where_p,$fields_update_p);		
							}
				}			
		   }
	    }	
	    if($scenid2)
		{
		   $data=array('status'=>1,'message'=>'Scene Created');
           echo json_encode($data);  
	    }	
        else 
		{
		   $data=array('status'=>0,'message'=>'Scene  Not Created');
           echo json_encode($data);   		 
	    }
	   				 	
	}
	else {
		   $data=array('status'=>0,'message'=>'Check parameters');
           echo json_encode($data);  
		
	}	
			
			
}




 public function makescenUpdate(){

       $artist_array_j= $this->input->post('artist');
	   $promoter_array_j= $this->input->post('promoter');
	    $artist_array= json_decode($artist_array_j,true);
	  $promoter_array= json_decode($promoter_array_j,true);
       $user_id= $this->input->post('user_id');
	   $venue= $this->input->post('venue_id');
	   $date=$this->input->post('date');
	   $time=$this->input->post('time');
	   $category=$this->input->post('category_id');
	   $event_name=$this->input->post('event_name'); 
	   $interval=$this->input->post('interval');
       $event=$this->input->post('event_id');	   

	   $datetime=$date.'T'.$time;

	if($event_name && $venue && $user_id && $date && $time && $interval && $category && $event) {
		$where_event=array('event_id'=>$event);
		$start_time=$date.' '.$time;
		$period=$interval*60;
	    $end_time = date('Y-m-d H:i:s', strtotime($start_time . ' +'.$period.' minute'));

		$field_array=array('event_name'=>$event_name,'venue_id'=>$venue,'event_created_by'=>$user_id,'event_date'=>$date,'datetime'=>$datetime,'event_time'=>$time,'event_start_time'=>$start_time,'event_end_time'=>$end_time,'status'=>1,'event_interval'=>$interval,'makescen'=>1,'event_type'=>1,'category_id'=>$category);
	   $this->common_model->UPDATEDATA('tbl_events',$where_event,$field_array);
		
		if(!empty($artist_array)) 
		{
			$field_update=array('event_ids'=>'');
			$where_artist=array('event_ids'=>$event);
		 $this->common_model->UPDATEDATA('tbl_artist',$where_artist,$field_update); 
//print_r($artist_array);
		    foreach($artist_array as $artist_arra)
			{
			//	print_r($artist_arra);
				//echo $artist_array->id;
			    $artist_id=$artist_arra['id'];
			     $artist_name=$artist_arra['name'];	
				 if($artist_name!='') {
				if(isset($artist_id))
				{						
				$fields_update=array('event_ids'=>$event);
				$where=array('artist_id'=>$artist_id);
			    $this->common_model->UPDATEDATA('tbl_artist',$where,$fields_update);
				} 
				else
				{					
			    $fields=array('artist_name'=>$artist_name,'event_ids'=>$event);
			     $this->common_model->INSERTDATA('tbl_artist',$fields);	
				}
			 }				
		    }	
        }
      else {
		  
		  $field_update=array('event_ids'=>'');
			$where_artist=array('event_ids'=>$event);
		 $this->common_model->UPDATEDATA('tbl_artist',$where_artist,$field_update); 
	  }
  	   if(!empty($promoter_array))
		{
			$fields_res=array('event_id'=>'');
		$this->common_model->UPDATEDATA('tbl_responser',$where_event,$fields_res);

		   foreach($promoter_array as $promote)
		   {	
				$promoter_id=$promote['id'];
				$promoter_name=$promote['name'];
				if($promoter_name!='') {
						   if(isset($promoter_id))
							{
									$fields_update_p=array('event_id'=>$event);
							$where_p=array('id'=>$promoter_id);
						    $this->common_model->UPDATEDATA('tbl_responser',$where_p,$fields_update_p);		
							
							}
							
						else
							{
							$field=array('name'=>$promoter_name,'event_id'=>$event);
							$this->common_model->INSERTDATA('tbl_responser',$field);
							}
				}			
		   }
	    }	
	 else {
		 
		 	$fields_res=array('event_id'=>'');
		$this->common_model->UPDATEDATA('tbl_responser',$where_event,$fields_res);
	 }
		   $data=array('status'=>1,'message'=>'Scene Updated');
           echo json_encode($data);  
	    

	   				 	
	}
	else {
		   $data=array('status'=>0,'message'=>'Check parameters');
           echo json_encode($data);  
		
	}	
			
			
}
function getUserdetailByID($uid) {
	
		$sql = "SELECT * FROM `tbl_user` WHERE `userid` = '$uid'"; 
		$sqlquery=mysql_query($sql);
		$num=mysql_num_rows($sqlquery);  
		if($num==1){
			while($row=mysql_fetch_array($sqlquery))
			{
				
				$newimage = $row['userImage'];
				$path = base_url()."upload/".$newimage;
				$type = $row['usertype'];
				if($type == 'Artist')
				{
					
					$sqlarray['userID']=$row['userid'];
					$sqlarray['email']=$row['userEmail'];
					$sqlarray['password']=$row['password'];
					$sqlarray['fullname']=$row['fullname'];
					$sqlarray['userName']=$row['userName'];
					$sqlarray['userGender']=$row['userGender']; 
					$sqlarray['userImage']=$path;
					$sqlarray['usertype']=$row['usertype']; 
					$sqlarray['artisttype']=$row['artisttype']; 
					$sqlarray['stagename']=$row['stagename']; 
					
				}	
				else if($type == 'Promoter')
				{
					
					$sqlarray['userID']=$row['userid'];
					$sqlarray['email']=$row['userEmail'];
					$sqlarray['password']=$row['password'];
					$sqlarray['fullname']=$row['fullname'];
					$sqlarray['userName']=$row['userName'];
					$sqlarray['userGender']=$row['userGender']; 
					$sqlarray['userImage']=$path;
					$sqlarray['usertype']=$row['usertype']; 
					$sqlarray['stagename']=$row['stagename']; 
					
				}
				else if($type == 'Venue')
				{
					
					$sqlarray['userID']=$row['userid'];
					$sqlarray['email']=$row['userEmail'];
					$sqlarray['password']=$row['password'];
					$sqlarray['fullname']=$row['fullname'];
					$sqlarray['userName']=$row['userName'];
					$sqlarray['userGender']=$row['userGender']; 
					$sqlarray['userImage']=$path;
					$sqlarray['usertype']=$row['usertype']; 
					$sqlarray['venuename']=$row['venuename']; 
					$sqlarray['address']=$row['address']; 
					$sqlarray['lat']=$row['lat']; 
					$sqlarray['longi']=$row['longi']; 
				}
				else
				{
					
					$sqlarray['userID']=$row['userid'];
					$sqlarray['email']=$row['userEmail'];
					$sqlarray['password']=$row['password'];
					$sqlarray['fullname']=$row['fullname'];
					$sqlarray['stagename']=$row['stagename']; 
					$sqlarray['userName']=$row['userName'];
					$sqlarray['userGender']=$row['userGender']; 
					$sqlarray['userImage']=$path;
					$sqlarray['usertype']=$row['usertype']; 
					
				}
			}
			return $sqlarray;
		}
}

   public function eventByLocation(){
          $usereventarray=array();
	   if($this->input->post('user_id')){
		   $user_id=$this->input->post('user_id');
		    $userevents =$this->common_model->get_sql_select_data('tbl_userevent',array('userid'=>$user_id),array('eventid'));
            foreach($userevents as $userevent){
				$usereventarray[]=$userevent['eventid'];
			}
	       $final['userinfo']=$this->getUserdetailByID($user_id);
        }
	   
	   $event_date=array('1A'=>'01:00:00','2A'=>'02:00:00','3A'=>'03:00:00','4A'=>'04:00:00','5A'=>'05:00:00',
	                      '6A'=>'06:00:00','7A'=>'07:00:00','8A'=>'08:00:00','9A'=>'09:00:00','10A'=>'10:00:00',
						  '11A'=>'11:00:00','12A'=>'12:00:00','1P'=>'13:00:00','2P'=>'14:00:00','3P'=>'15:00:00',
						  '4P'=>'16:00:00','5P'=>'17:00:00','6P'=>'18:00:00','7P'=>'19:00:00','8P'=>'20:00:00',
						  '9P'=>'21:00:00','10P'=>'22:00:00','11P'=>'23:00:00','12P'=>'00:00:00' );
	   
	 $lat= $this->input->post('lat');
	 $long= $this->input->post('long');
	 $where=array('lat'=>$lat,'longitude'=>$long);
	 if($lat && $long)
	 {
   // $lat='32.3666667';
   // $long='-86.3';
	 $venue_lat_long =$this->common_model->getloc($lat,$long);
	 	// print_r( $venue_lat_long);
	 //die;
	 $city =$this->common_model->get_sql_select_data('tbl_city',$where);

        $city_lat=$city[0]['city'];
	 
	 foreach($venue_lat_long as $lat_long)
	{
		$lat_array[]=$lat_long['venue_lat'];
		$long_array[]=$lat_long['venue_long'];
		
	}
	 $lats=implode(',',$lat_array);
    $longs=implode(',',$long_array);

	   $date=date("Y-m-d"); 
 
 $nowtime = date("Y-m-d H:i:s");
//echo '<br>';
  $start_time = date('Y-m-d H:i:s', strtotime($nowtime . ' +1080 minute'));

	  $events =$this->common_model->getevents_test($lats,$longs,$date,$start_time,$nowtime);
	  $event_de =$this->common_model->getevents_de_test($lats,$longs,$date);
	  	foreach($events as $event) {
		if(in_array($event['event_id'],$usereventarray)){
			$status="exist";
		}
		else {
		   $status="not exist";
	
		}
		$venues_true[]=$event['venue_id'];
		$where_cat=array('category_id'=>$event['venue_category_id']);
			$where_event=array('event_id'=>$event['event_id'],'type'=>'Picture');
				$order_by='id DESC';
				$userevent_img =$this->common_model->get_sql_select_data('tbl_event_feeds',$where_event,NULL,NULL,$order_by);
				if($userevent_img){
				$img=base_url().'upload/'.$userevent_img[0]['feed'];
			      }
				  else{
				$img=base_url().'upload/defaultevent.jpg';
  
				  }
		$category =$this->common_model->get_sql_select_data('tbl_venue_category',$where_cat);
		if($event['venue_address']=='' || $event['venue_address']==null){
			
			$add=$event['venue_city'].', '.$event['venue_state'].', '.$event['venue_country'];
		}
		else 
		{
			$add=$event['venue_address'];
	
		}
		if(!$event['avg_rating_venue']){
			$rating=0;
		}
		else {
		$rating=$event['avg_rating_venue'];
	
		}
		$data['venue']=array('venue_id'=>$event['venue_id'],'venue_name'=>$event['venue_name'],'category'=>$category[0]['category'],'category_id'=>$category[0]['category_id'],'address'=>$add,'city'=>$event['venue_city'],'region'=>$event['venue_state'],'country'=>$event['venue_country'],'latitude'=>$event['venue_lat'],'longitude'=>$event['venue_long'],'rating'=>$rating);
		
			$artists =$this->common_model->get_sql_select_data('tbl_artist',array('event_ids'=>$event['event_id']));
           if($artists){
			$data['artists']='';
			foreach($artists as $artist){
			$data['artists'][]=array('artist_name'=>$artist['artist_name'],'artist_id'=>$artist['artist_id'],'rating'=>$artist['avg_rating']);
	
				
			}
		}
			if($event['event_interval']){
				$interval=$event['event_interval']*60;
				$event_interval=$event['event_interval'];
			   $event_time = $event['datetime'].'TO'.date('H:i:s', strtotime($event['event_time'] . ' +'.$interval.' minute'));

			}
			else {
			 $event_time = $event['datetime'].'TO'.date('H:i:s', strtotime($event['event_time'] . ' +240 minute'));
			 $event_interval=4;

			}

		  if($event['makescen']==1){
			   $event_name=$event['event_name'];
		   }
		   else {
			 $event_name=$artists[0]['artist_name'];
		   }
		    if($event['category_id']){
			   $cat_id=$event['category_id'];
			   $category_event =$this->common_model->get_sql_select_data('tbl_event_category',array('id'=>$cat_id));
                $cat_name= $category_event[0]['name'];
		   }
		   else {
			   $cat_id=3;
			   $cat_name='Nightlife';

		   }
		   
		 if($event['avg_rating']==null){
			$rating_event=0;
		}
		else {
		$rating_event=$event['avg_rating'];
	
		}
		//$data['artists']=array(array('artist_name'=>$event['artist_name'],'artist_id'=>$event['artist_id'],'rating'=>5));
		$data['events']=array('event_id'=>$event['event_id'],'event_name'=>$event_name,'category'=>$cat_name,'category_id'=>$cat_id,'event_date'=>$event_time,'event_time'=>$event['event_time'],'rating'=>$rating_event,'image'=>$img,'interval'=>$event_interval,'status'=>$status);
	    $final['events'][]=$data;
		   		
	}
	
		foreach($event_de as $event_de) {
			
		if(in_array($event_de['event_id'],$usereventarray)){
			$status="exist";
		}
		else {
		   $status="not exist";
	
		}
		if(!in_array($event_de['venue_id'], $venues_true)) {
			   $where_event=array('event_id'=>$event_de['event_id'],'type'=>'Picture');
				$order_by='id DESC';
				$userevent_img =$this->common_model->get_sql_select_data('tbl_event_feeds',$where_event,NULL,NULL,$order_by);
				if($userevent_img){
				$img=base_url().'upload/'.$userevent_img[0]['feed'];
			      }
				  else{
				$img=base_url().'upload/defaultevent.jpg';
  
				  }
		$where_cat=array('category_id'=>$event_de['venue_category_id']);
		$category =$this->common_model->get_sql_select_data('tbl_venue_category',$where_cat);
		if($event_de['venue_address']=='' || $event_de['venue_address']==null){
			
			$add=$event_de['venue_city'].', '.$event_de['venue_state'].', '.$event_de['venue_country'];
		 }
		else {
					$add=$event_de['venue_address'];

		}
		$data_d['venue']=array('venue_id'=>$event_de['venue_id'],'venue_name'=>$event_de['venue_name'],'category'=>$category[0]['category'],'category_id'=>$category[0]['category_id'],'address'=>$add,'city'=>$event_de['venue_city'],'region'=>$event_de['venue_state'],'country'=>$event_de['venue_country'],'latitude'=>$event_de['venue_lat'],'longitude'=>$event_de['venue_long']);

	   $attr=strtolower(date("l"));
	   $ev_date=explode('-',$category[0][$attr]);
	   $real_time=$event_de['event_date'].'T'.$event_date[$ev_date[0]].'TO'.$event_date[$ev_date[1]];
      
//echo($event_date[$ev_date[0]] - $event_date[$ev_date[1]]);
$t1=strtotime($event_date[$ev_date[0]]);
$t2=strtotime($event_date[$ev_date[1]]);
if($t1>t2){
 $start_time=$event_de['event_date'].' '.$event_date[$ev_date[0]];
$end_t= date('Y-m-d', strtotime($event_de['event_date'] . ' +1 day'));
 $end_time=$end_t.' '.$event_date[$ev_date[1]];
 //$diff=date_diff($start_time,$end_time);
 $date1Timestamp = strtotime($start_time);
$date2Timestamp = strtotime($end_time);
 
$interval = $date2Timestamp - $date1Timestamp;
 
$interval=$interval/(3600);

}
else{
$interval= ($t2- $t1)/3600;  

}
//echo $interval.'<br>';
		$data_d['events']=array('event_id'=>$event_de['event_id'],'event_name'=>$event_de['event_name'],'interval'=>$interval,'category'=>'Nightlife','category_id'=>'3','event_date'=>$real_time,'image'=>$img,'status'=>$status);
	    $final['events'][]=$data_d;
        }
	}
	  
	
	if(!empty($final )){
	echo json_encode($final );
     }
	  else {
		  $data1=array('status'=>0,'message'=>'No data were found!');
		  echo json_encode($data1);
	  }
   }

else{
	 $data1=array('status'=>0,'message'=>'Check Parameters');
		  echo json_encode($data1);
	
}
   }
   public function allCategory(){
	   
	   $fields='category_id,category';
		$categories =$this->common_model->get_sql_select_data('tbl_venue_category',NULL,$fields);
		echo json_encode($categories);
   }
   
     public function eventCategory(){
	   
	   $fields='id,name';
		$categories =$this->common_model->get_sql_select_data('tbl_event_category',NULL,$fields);
		echo json_encode($categories);
   }
   public function getb(){
	   $fields='venue_id,venue_city,venue_state,venue_country';
	   $where=array('venue_address'=>'');
		$categories =$this->common_model->get_sql_select_data('tbl_venue',$where,$fields);   
		foreach($categories as $c){
			$where1=array('venue_id'=>$c['venue_id']);
			$add=$c['venue_city'].', '.$c['venue_state'].', '.$c['venue_country'];
			$fields1=array('venue_address'=>$add);
		$categories =$this->common_model->UPDATEDATA('tbl_venue',$where1,$fields1);   
	
		}
		//print_r($categories);
	   
   }
   
   public function t(){

  // echo $date=date('y-m-d').'<br>';
  // echo date("h:i:sa").'<br>';
  //  echo date_default_timezone_get();
  	   $fields='event_date,event_time,event_id,event_interval';

	  $categories =$this->common_model->get_sql_select_data('tbl_events',NULL,$fields);
     foreach($categories as  $even)	{ 
      $start=$even['event_date'].' '.$even['event_time'];
	  if($even['event_interval']){
		  $end=$event['event_interval']*60;
	  }
	  else{
		$end=240;  
	  }
	  $end_time = date('Y-m-d H:i:s', strtotime($start . ' +'.$end.' minute'));

		$fields1=array('event_start_time'=>$start,'event_end_time'=>$end_time);
		$categories =$this->common_model->UPDATEDATA('tbl_events',array('event_id'=>$even['event_id']),$fields1);   
   }
	
   }
   public function deleteEvent(){
	 $event_id=$this->input->post('event_id'); 
     if($event_id){
		$where=array('event_id'=>$event_id);
		$where_user_event=array('eventid'=>$event_id);
        try {
        $this->common_model->DELETEDATA('tbl_events',$where);	
		$this->common_model->DELETEDATA('tbl_event_feeds',$where);
        $this->common_model->DELETEDATA('tbl_nudges',$where);
		$this->common_model->DELETEDATA('tbl_rating',$where);
		$this->common_model->DELETEDATA('tbl_userevent',$where_user_event);	
	    $this->common_model->UPDATEDATA('tbl_responser',$where,array('event_id'=>''));
	    $this->common_model->UPDATEDATA('tbl_artist',array('event_ids'=>$event_id),array('event_ids'=>''));   
		 $data=array('status'=>1,'message'=>'Event deleted.');
		  echo json_encode($data);
		}
      catch (Exception $e) {
	       $data=array('status'=>0,'message'=>'Event not deleted.');
		    echo json_encode($data);	
		}
		
	 }
     else {
		 $data=array('status'=>0,'message'=>'Check Parameters');
		  echo json_encode($data);
      }	 
	   
   }
   public function artistup(){
	   
		  $events =$this->common_model->bevent();
		  
		  foreach($events as $event){
		 $artist =$this->common_model->get_sql_select_data('tbl_venue',array('venue_id'=>$event['venue_id']));
		 if($artist[0]['venue_name']!='') {
		// echo $artist[0]['artist_name'].'<br>';
		 $this->common_model->UPDATEDATA('tbl_events',array('event_id'=>$event['event_id']),array('event_name'=>$artist[0]['venue_name']));   
		  }

  
		  }
   
   }
   
   public function deleteeventcron(){


   	$artists =$this->common_model->artist_user();
    $responsers =$this->common_model->promoter_user();
    foreach($responsers as $responser)  {
    $responser_array[]=$responser['event_id'];
    }
    foreach($artists as $artist)  {
    $artist_array[]=$artist['event_id'];
    }

	 $date= date("Y-m-d h:i:s",strtotime("-2 month"));  
	  $event_to_delete =$this->common_model->deleteeventdata($date);

	foreach($event_to_delete as $event){
	   $event_id=$event['event_id'];
       if($event_id){
		$where=array('event_id'=>$event_id);
		$where_user_event=array('eventid'=>$event_id);
        try {
        $this->common_model->DELETEDATA('tbl_events',$where);	
	    $this->common_model->DELETEDATA('tbl_event_feeds',$where);
        $this->common_model->DELETEDATA('tbl_nudges',$where);
		$this->common_model->DELETEDATA('tbl_rating',$where);
		$this->common_model->DELETEDATA('tbl_userevent',$where_user_event);
         if(in_array($event_id,$artist_array)){
         	 $this->common_model->UPDATEDATA('tbl_artist',array('event_ids'=>$event_id),array('event_ids'=>''));   
         }
         else {
         	$this->common_model->DELETEDATA('tbl_artist',array('event_ids'=>$event_id));	
         }
         if(in_array($event_id,$responser_array)){
	        $this->common_model->UPDATEDATA('tbl_responser',$where,array('event_id'=>''));
         }
         else {
	        $this->common_model->DELETEDATA('tbl_responser',$where);
         }
		}
      catch (Exception $e) {
	       $data=array('status'=>0,'message'=>'Event not deleted.');
		    echo json_encode($data);	
		}



	  }

   }
}

   public function trending_test()
   {
     $lat= $this->input->post('lat');
	 $long= $this->input->post('long');	 
	 $date=date("Y-m-d"); 
     $start_time = date('Y-m-d H:i:s', strtotime($nowtime . ' +1080 minute'));
     $event_para=$this->event_model->sp_eventbylocation($this->input->post('user_id'),$lat,$long);
	 foreach($event_para[1] as $lat_long_data){
		$lat_array_data[]=$lat_long_data['venue_lat'];
		$long_array_data[]=$lat_long_data['venue_long']; 
	 }
	 	 $lats=implode(',',$lat_array_data);
       $longs=implode(',',$long_array_data);

	  $events =$this->common_model->getevents_tending($lats,$longs,$date,$start_time,$nowtime);
    
	
      $usereventarray=array();
	   if($this->input->post('user_id')){
               $user_id=$this->input->post('user_id');
            foreach($event_para[0] as  $userevent){
				$usereventarray[]=$userevent['eventid'];
			}
	       $final['userinfo']=$this->getUserdetailByID($user_id);
        }
	   
	   $event_date=array('1A'=>'01:00:00','2A'=>'02:00:00','3A'=>'03:00:00','4A'=>'04:00:00','5A'=>'05:00:00',
	                      '6A'=>'06:00:00','7A'=>'07:00:00','8A'=>'08:00:00','9A'=>'09:00:00','10A'=>'10:00:00',
						  '11A'=>'11:00:00','12A'=>'12:00:00','1P'=>'13:00:00','2P'=>'14:00:00','3P'=>'15:00:00',
						  '4P'=>'16:00:00','5P'=>'17:00:00','6P'=>'18:00:00','7P'=>'19:00:00','8P'=>'20:00:00',
						  '9P'=>'21:00:00','10P'=>'22:00:00','11P'=>'23:00:00','12P'=>'00:00:00' );
	   
	
	 $where=array('lat'=>$lat,'longitude'=>$long);
	 if($lat && $long)
	 {

	 $venue_lat_long =$this->common_model->getloc($lat,$long);
	 if($event_para[2]){
	 $city =$event_para[2];
     $city_lat=$city[0]['city'];
	 }	 
	 foreach($venue_lat_long as $lat_long)
	{
		$lat_array[]=$lat_long['venue_lat'];
		$long_array[]=$lat_long['venue_long'];
		
	}
	 $lats=implode(',',$lat_array);
    $longs=implode(',',$long_array);

	   $date=date("Y-m-d"); 
 
       $nowtime = date("Y-m-d H:i:s");
       $start_time = date('Y-m-d H:i:s', strtotime($nowtime . ' +1080 minute'));

	  $events =$this->common_model->getevents_tending($lats,$longs,$date,$start_time,$nowtime);
	  	foreach($events as $event) {
		if(in_array($event['event_id'],$usereventarray)){
			$status="exist";
		}
		else {
		   $status="not exist";
	
		}
		$venues_true[]=$event['venue_id'];
		$where_cat=array('category_id'=>$event['venue_category_id']);
			$where_event=array('event_id'=>$event['event_id'],'type'=>'Picture');
				$order_by='id DESC';
				$userevent_img =$this->common_model->get_sql_select_data('tbl_event_feeds',$where_event,NULL,NULL,$order_by);
				if($userevent_img){
				$img=base_url().'upload/'.$userevent_img[0]['feed'];
			      }
				  else{
				$img=base_url().'upload/defaultevent.jpg';
  
				  }
		$category =$this->common_model->get_sql_select_data('tbl_venue_category',$where_cat);
		if($event['venue_address']=='' || $event['venue_address']==null){
			
			$add=$event['venue_city'].', '.$event['venue_state'].', '.$event['venue_country'];
		}
		else 
		{
			$add=$event['venue_address'];
	
		}
		if(!$event['avg_rating_venue']){
			$rating=0;
		}
		else {
		$rating=$event['avg_rating_venue'];
	
		}
		$data['venue']=array('venue_id'=>$event['venue_id'],'venue_name'=>$event['venue_name'],'category'=>$category[0]['category'],'category_id'=>$category[0]['category_id'],'address'=>$add,'city'=>$event['venue_city'],'region'=>$event['venue_state'],'country'=>$event['venue_country'],'latitude'=>$event['venue_lat'],'longitude'=>$event['venue_long'],'rating'=>$rating);
		if($event['event_type']==1 ) {
			$artists_list =$this->common_model->get_sql_select_data('tbl_artist',array('event_ids'=>$event['event_id']));
           if(!empty($artists_list)){
			$data['artists']='';
			foreach($artists_list as $artist){
			$data['artists'][]=array('artist_name'=>$artist['artist_name'],'artist_id'=>$artist['artist_id'],'rating'=>$artist['avg_rating']);
	
			}
		}
	
		}	
     else {
			$data['artists']='';
			unset($data['artists']);

	 }
		if($event['event_interval']){
				$interval=$event['event_interval']*60;
				$event_interval=$event['event_interval'];
			   $event_time = $event['datetime'].'TO'.date('H:i:s', strtotime($event['event_time'] . ' +'.$interval.' minute'));

			}
			else {
			 $event_time = $event['datetime'].'TO'.date('H:i:s', strtotime($event['event_time'] . ' +240 minute'));
			 $event_interval=4;

			}

			   $event_name=$event['event_name'];
	
		    if($event['category_id']){
			   $cat_id=$event['category_id'];
			   $category_event =$this->common_model->get_sql_select_data('tbl_event_category',array('id'=>$cat_id));
                $cat_name= $category_event[0]['name'];
		   }
		   else {
			   $cat_id=3;
			   $cat_name='Nightlife';

		   }
		   
		 if($event['avg_rating']==null){
			$rating_event=0;
		}
		else {
		$rating_event=$event['avg_rating'];
	
		}
		$data['events']=array('event_id'=>$event['event_id'],'event_name'=>$event_name,'category'=>$cat_name,'category_id'=>$cat_id,'event_date'=>$event_time,'event_time'=>$event['event_time'],'rating'=>$rating_event,'image'=>$img,'interval'=>$event_interval,'status'=>$status);
	    $final['events'][]=$data;
		   		
	}
	

	  
	
	if(!empty($final )){
	echo json_encode($final );
     }
	  else {
		  $data1=array('status'=>0,'message'=>'No data were found!');
		  echo json_encode($data1);
	  }
   }

else{
	 $data1=array('status'=>0,'message'=>'Check Parameters');
		  echo json_encode($data1);
	
}

   }
 }
