<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct() {

    parent::__construct();
    	$this->load->model('home_model'); 
    	$this->load->helper('url') ;
		$this->load->library('pagination');
    }


	public function index()
	{
		
	/*	$bredcum['header_data'][]=array('title'=>'City','module'=>base_url());
		$this->load->view('header',$bredcum); 
		$this->load->view('home');
		$this->load->view('footer');*/
		
		$config = array();
        $config["base_url"] = base_url() . "index.php/home/venue_city";
        $config["total_rows"] = count($this->home_model->customGet());
        $config["per_page"] = 12;
        $config["uri_segment"] = 3;
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['next_link'] = 'view more';
        $this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data["cities"] = $this->home_model->customGet($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $data["sn"] = $page +1 ;
        //$bredcum['header_data'][]=array('title'=>'Venue Channel','module'=>base_url());
		$this->load->view('header'); 
		$this->load->view('all_city',$data);
		$this->load->view('footer');
	}


	// signup;
	public function venue()
	{

		$this->load->library('form_validation');
		$this->form_validation->set_rules('fname','Frist name','required');
		$this->form_validation->set_rules('lname','Last name','required');
		$this->form_validation->set_rules('business','Business name','required');
		$this->form_validation->set_rules('email','Email','required|valid_email|is_unique[tbl_venue_owner.email]');
		$this->form_validation->set_rules('password','Password','required');
		$this->form_validation->set_rules('cpassword','Password','trim|required|matches[password]');

		if($this->form_validation->run() == FALSE){
			$data['error'] = validation_errors();
		$bredcum['header_data'][]=array('title'=>'Sign Up','module'=>'');

        $this->load->view('header',$bredcum);
			$this->load->view('header'); 
		    $this->load->view('venue',$data);
		} else{
			
			$venueData = array(
				'fname' => $this->input->post('fname'),
				'lname' => $this->input->post('lname'),
				'business_name' => $this->input->post('business'),
				'email' => $this->input->post('email'),
				'password' => md5($this->input->post('password')),
				'crd' => date('Y-m-d H:i:s'),
				'upd' =>date('Y-m-d H:i:s'),
				);
			$data = $this->home_model->insert_venue($venueData);
			if ($data) {
		     $last_url=$this->session->userdata('last_url');
				if($last_url){
					redirect($last_url);

				}else{
			     redirect(base_url());
				}			}
		} 
		
		
		
	}//End funtion


	// start venueLogin 
	public function venuelogin()
	{
		if($this->session->userdata('email')){
			redirect(base_url());
		}
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email','Email','required|valid_email');
		$this->form_validation->set_rules('password','Password','required');

		if($this->form_validation->run() == FALSE){
			$data['error'] = validation_errors();
			
		} else{
			
			$userData = array(
				'email' => $this->input->post('email'),
				'password' => md5($this->input->post('password'))
				);
			$data = $this->home_model->venuelogin($userData);
			
			if($data){
				$last_url=$this->session->userdata('last_url');
				if($last_url){
					redirect($last_url);

				}else{
			     redirect(base_url());
				}
				//          redirect($_SERVER['HTTP_REFERER']);

			} else{
				$data['error'] = "Invalid email or password.";
			
			}
		}
		$bredcum['header_data'][]=array('title'=>'Login','module'=>'');

        $this->load->view('header',$bredcum);
		$this->load->view('venuelogin',$data);
		
	}//End funtion

	function logout(){

		$this->session->sess_destroy();
		redirect(base_url());
	}
	function seturl(){
	$city_name = $this->input->get('id');
	$last_url=base_url().'index.php/home/venueImage?id='.$city_name;
	//$this->session->userdata('last_url',$last_url);
	}
	function venue_view(){
		
		$city_name = str_replace('%20',' ',$this->uri->segment(3));

		$config = array();
        $config["base_url"] = base_url() . "index.php/home/venue_view/".$city_name.'/';     
		$this->session->set_userdata("last_url",$config["base_url"]);
		$config["total_rows"] = $this->home_model->record_count($city_name);
        $config["per_page"] = 10;
        $config["uri_segment"] = 4;
         //config for bootstrap pagination class integration
        $config['full_tag_open'] = '<ul class="pagination pagination-sm pull-right">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $data["records"] = $this->home_model->
            getAllvenues($config["per_page"], $page,$city_name);
        $data["links"] = $this->pagination->create_links();
        $data["sn"] = $page +1 ;
		
        $bredcum['header_data'][]=array('title'=>'Venue Channel','module'=>base_url());

        $this->load->view('header',$bredcum);
        $this->load->view("venue_view", $data);
        $this->load->view('footer');
	}

	function show_venue(){

		$id = str_replace('%20',' ',$this->uri->segment(3));
		$data['records'] = $this->home_model->view_venue_id($id);
		$this->load->view('header');
        $this->load->view('venue_profile',$data);
        $this->load->view('footer');
	}

	function venue_city(){
	
		$config = array();
        $config["base_url"] = base_url() . "index.php/home/venue_city";
        $config["total_rows"] = count($this->home_model->customGet());
        $config["per_page"] = 12;
        $config["uri_segment"] = 3;
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['next_link'] = 'view more';
        $this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data["cities"] = $this->home_model->customGet($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $data["sn"] = $page +1 ;
        //$bredcum['header_data'][]=array('title'=>'Venue Channel','module'=>base_url());
		$this->load->view('header'); 
		$this->load->view('all_city',$data);
		$this->load->view('footer');
	}


	function city_venue(){

		$id = $this->uri->segment(3);
		$data['city_id'] = $id;
		$data['records'] = $this->home_model->view_venue_city($id);
		$this->load->view('header');
		$this->load->view('city_venue',$data);
		$this->load->view('footer');

	}
		
	public function venueImage($id=''){
	
		
		$id=$this->input->get('id');
		//$data['city']=$this->input->get('city');
		date_default_timezone_set('America/Los_Angeles');
		$current_time=date("Y-m-d H:i:s");
		
		$query='
		SELECT													
			tbl_venue.venue_id as venue_id,feed,type,tbl_user.userImage,tbl_event_feeds.date,tbl_user.fullname,tbl_events.event_id,
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
						tbl_venue.venue_id as venue_id,tbl_events.event_start_time,tbl_events.event_end_time,tbl_venue.venue_image,tbl_venue.venue_name
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
				//$data['images'][0]['feed']='SK_BG_1.jpg';
				//$data['next_event_time']="<h1 class='next_time_head'>No events </h1>";
				
					$query='SELECT 
						venue_id,venue_image,venue_name
					FROM 
					
						tbl_venue
					WHERE 
					venue_id='.$id.'';
			
			
			$res1 = $this->db->query($query);
			$images1 = $res1->result_array();
			$data['images']=$images1;

			}
			
		}
		
		$data['imgCount'] = count($data['images']);
		
	    $data['file'] = APPPATH."views/count/newfile_$id.txt";
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


/* End of file home.php */
/* Location: ./application/controllers/home.php */
