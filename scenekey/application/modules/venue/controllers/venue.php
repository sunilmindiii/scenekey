<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Venue extends MY_Controller {
	
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		$city =	$this->input->get('venue_city');
		$data['venue'] = array();
		$data['limit'] = 50;
		if(!empty($city)){
			$like['venue_city']		=	$city;
			$like['is_show_home']		=	'1';
			//$like['venue_name <>']		=	'';
			$data['venue'] = $this->cm->vanues($data['limit'],0,$like,NULL);
		}
		
		$this->customHomeView('venue_list',$data);
	}
	
	public function loadMore(){
		$city =	$this->input->post('city');
		$count = $this->input->post('count');
		$like['venue_city']	= $city;
		$limit = $this->input->post('limit');
		$start=(int)$limit*(int)$count;
		$like['is_show_home']		=	'1';
		$like['venue_name <>']		=	'';
		$venue = $this->cm->vanues($limit,$start,$like,NULL);
		
		$i=11; 
		foreach($venue as $city){
			if($i>16){$i=11;} ?>
			<div class="col-md-4 vanue_name">
				
				<div class="dslider_show" onclick="getStatus('<?php echo $city->venue_id; ?>')">
				<?php if(!empty($city->venue_image)){ ?>
					<img class="img-responsive" src="<?php echo base_url()."images/venue/".$city->venue_image; ?>" alt="<?php echo $city->venue_name;?>">
					<?php }else{ ?>
						<img class="img-responsive" src="<?php echo base_url()."images/".$i.".jpg"; ?>" alt="<?php echo $city->venue_name;?>">
					<?php } ?>
					<div class="captn">
						<h4><?php echo $city->venue_name;?></h4>
					</div>
				</div>
				
			</div>
			<?php $i++; 
		}
		exit(0);	
	}
	
	public function venueImage(){
		$id=$this->input->get('id');
		//$data['city']=$this->input->get('city');
		date_default_timezone_set('America/Los_Angeles');
		$current_time=date("Y-m-d H:i:s");
		
		$query='
		SELECT													
			feed,type,tbl_user.userImage,tbl_event_feeds.date,tbl_user.fullname,tbl_events.event_id,
			tbl_events.event_start_time,tbl_events.event_end_time,tbl_venue.venue_image,tbl_venue.venue_name
		FROM 
			tbl_events 
		JOIN
			tbl_venue ON tbl_venue.venue_id = tbl_events.venue_id
		JOIN 
			tbl_event_feeds ON tbl_event_feeds.event_id=tbl_events.event_id 
		JOIN
			tbl_user ON tbl_event_feeds.user_id = tbl_user.userid
		WHERE 
			tbl_events.venue_id='.$id.'
			AND tbl_events.event_start_time <= "'.$current_time.'"
			AND tbl_events.event_end_time >= "'.$current_time.'"
			AND tbl_event_feeds.type IN ("Picture","Comment") 	
		ORDER BY 
			tbl_event_feeds.id DESC';
		
		/*
		AND tbl_events.event_start_time <= "'.$current_time.'"
			AND tbl_events.event_end_time >= "'.$current_time.'"
		*/
		
		//echo $query;
		
		$res = $this->db->query($query);
		$images = $res->result_array();
		
		if(!empty($images)){
			$data['images']=$images;
			$data['next_event_time']='';
		}else{
		
			//$query1='SELECT event_start_time  FROM tbl_events  WHERE tbl_events.venue_id='.$id.'  AND tbl_events.event_start_time >="'.$current_time.'" AND  tbl_events.event_end_time>="'.$current_time.'" order by tbl_events.event_end_time asc limit 1';
			
			$query='SELECT 
						tbl_events.event_start_time,tbl_events.event_end_time,tbl_venue.venue_image,tbl_venue.venue_name
					FROM 
						tbl_events 
					JOIN
						tbl_venue ON tbl_venue.venue_id = tbl_events.venue_id
					WHERE 
						tbl_events.venue_id='.$id.'
					ORDER BY tbl_events.event_start_time ASC LIMIT 1';
			
			
			$res1 = $this->db->query($query);
			$images1 = $res1->result_array();
			
			if(!empty($images1)){
				//$diff = abs(strtotime($images1[0]->event_start_time) - strtotime($current_time));
				//$min=floor($diff/(60*60));
				
				$min = isset($images1[0]->event_start_time) ? date("h:i A",strtotime($images1[0]->event_start_time)) : date("h:i A");
				//$data['images'][0]['feed']='SK_BG_1.jpg';
				$data['next_event_time']="<h1 class='next_time_head'>Next event will be start at ".$min."</h1>";
				$data['images']=$images1;
				$data['eventCheck']=0;
				
			}else{
				$data['images'][0]['feed']='SK_BG_1.jpg';
				$data['next_event_time']="<h1 class='next_time_head'>No events </h1>";
			}
			
		}
		
		$data['imgCount'] = count($data['images']);
		
		$data['file'] = APPPATH."/modules/venue/newfile_$id.txt";
		$data['prevCount'] = $this->checkCount($data['file'],$data['imgCount']);
		
		//$this->load->view('venue_image_slider');
		$this->load->view('venue_image_slider_ajax',$data);
	}
	
	function checkCount($file,$imgCount)
	{
		$count = 0;
		if (file_exists($file)){
			$myfile = fopen($file, "r") or die(0);
			$count = fread($myfile,filesize($file));
			fclose($myfile);
			
			$myfile = fopen($file, "w") or die(0);
			fwrite($myfile, $imgCount);
			fclose($myfile);
		} else {
			$myfile = fopen($file, "w") or die(0);
			fwrite($myfile, $imgCount);
			fclose($myfile);
		}
		
		return $count;
		
	}
	
	function deleteFile()
	{
		if(isset($_GET['name']))
			unlink($_GET['name']);
	}
	
	
}
?>