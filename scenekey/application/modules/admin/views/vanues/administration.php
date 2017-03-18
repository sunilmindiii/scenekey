<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Administration extends MY_Controller {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
		//$this->load->library('pagination');
		$this->load->library('ajax_pagination');
		
    }

    /* ------------- Admin Login Setion Start--------------- */
    public function index() {
        if (isset($_POST['submit'])) {
            //print_r($_POST); //die;

           /* $this->form_validation->set_rules($this->validation_rules ['AdminLogin']);
            if ($this->form_validation->run()) {*/
                $uname = $_POST['username'];
                $upass = md5($_POST['password']);

                $this->data['userDlt'] = $this->cm->userLoginCheck($uname, $upass, $utype = FALSE);

                if ($this->data['userDlt']) {
                    $this->session->set_userdata(array(
                        'adminId' => $this->data['userDlt']->user_id,
                        'adminName' => $this->data['userDlt']->user_first_name . ' ' . $this->data['userDlt']->user_last_name,
                        'userType' => $this->data['userDlt']->utype_name,
                    ));      //print_r($this->data['userDlt']); //die;
                    redirect(base_url('admin/administration/home'));
                } else {
                    echo '<script>window.alert("Details are not authenticatesd!!! Try Again")
                                window.location.href="' . base_url('admin/') . '";</script>';
                }
           /* } else {
                echo $this->validation_errors();
                redirect(base_url('admin/'));
            }*/
        }
        //echo $this->db->last_query();
        //die();

        $this->load->view('admin/login');
    }

    /* ------------- Admin Login Setion End-------------- */
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
    /* ------------- Admin Dashboard Setion Start------------- */

    public function home() {
        $this->adminCommonView('admin/index');
    }

    /* -------------- Admin Dashboard Setion End--------------- */
    /* ---------------Manage/List of all Artists Setion Start --------------- */

    public function artists_list() {
		$this->data['artists'] = $this->cm->artists();
        $this->adminCommonView('admin/artists/all_artists', $this->data);
    }

    /* ---------------Manage/List of all Artists Setion End --------------- */
    /* ---------------Manage/List of all Vanues Setion Start --------------- */

    public function vanues_list() {
		//$this->data['like'] =$like;
		$this->data['vanue_category']	=	$this->cm->vanues_categories('category_id,category');
		$this->data['cities'] = $this->cm->cities('city');
		$this->adminCommonView('admin/vanues/all_vanues', $this->data);
    }
    public function ajax_vanue_list(){
    	$like =$like2=	array();
		if(!empty($_POST['search_city'])){
			$like['venue_city']		=	$_POST['search_city'];
		}//
		if(!empty($_POST['search_category'])){
			$like['venue_category_id']		=	$_POST['search_category'];
		}
		if($_POST['publish_category']!=''){
			$like['publish']		=	$_POST['publish_category'];
		}
		if(!empty($_POST['search_keyword'])){
			$like2['venue_name']		=	$_POST['search_keyword'];
		}
		//$page=	$this->input->post('page');
		$total				=	count($this->cm->vanues(NULL,NULL,$like,NULL));
		$config['base_url'] = base_url().'index.php/admin/administration/ajax_vanue_list';
		$config['total_rows'] = $total;
		$config['uri_segment'] = 4;
		$config['per_page'] = 10;
		$config['num_links'] = 5;
		$config['first_link'] = FALSE;
		$config['last_link'] = FALSE;
		$config['full_tag_open'] = '<ul>';
		$config['full_tag_close'] = '</ul>';
		$config['next_link'] = 'Next &rarr;';
		$config['next_tag_open'] = '<li class="next page">';
		$config['next_tag_close'] = '</li>';
		$config['anchor_class'] = 'class="paginationlink" ';
		$config['prev_link'] = '&larr; Previous';
		$config['prev_tag_open'] = '<li class="prev page">';
		$config['prev_tag_close'] = '</li>';
	
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
	
		$config['num_tag_open'] = '<li class="page">';
		$config['num_tag_close'] = '</li>';
		
		
		$page	=	$this->uri->segment(4);
		
		$limit	=	$config['per_page'];
		$start	=	$page>0?$page:0;
		$this->ajax_pagination->initialize($config);
		$this->data['vanues'] = $this->cm->vanues($limit,$start,$like,$like2);
		$this->data['pagination'] =$this->ajax_pagination->create_links();
		
		$this->load->view('admin/vanues/ajax_vanues_list', $this->data);
    }
	//code by satyapal for vanues details by id----------------------------
	public function vanues_details($id){
		$id	=	 $this->cm->idDecrypt($id);
		$this->data['event_vanues'] = $this->cm->event_by_vanues($id);
		$this->adminCommonView('admin/vanues/vanues_full_details',$this->data);
	}
	public function vanues_imageUpload(){
		$venueId=	 $this->cm->idDecrypt($this->input->post("venueId"));
		$path	=	'./images/venue/';
		$data	=	$this->cm->uploadImage($_FILES,$path,$venueId);
		echo json_encode($data);
		exit(0);
	}
	//end here-------------------------------------------------------------
    /* ---------------Manage/List of all Vanues Setion End --------------- */
	/* ---------------Manage/List of all Vanues Categories Setion Start --------------- */

    public function vanues_categories_list() {
		$this->data['vanuesCategories'] = $this->cm->vanues_categories('*');
        $this->adminCommonView('admin/vanues/all_vanue_categories', $this->data);
    }

    /* ---------------Manage/List of all Vanues Categories Setion End --------------- */
	/* ---------------Manage/List of all City Setion Start --------------- */

    public function city_list() {
		$this->data['cities'] = $this->cm->cities();
        $this->adminCommonView('admin/location/all_cities', $this->data);
    }

    /* ---------------Manage/List of all City Setion End --------------- */
	/* ---------------Add new Event Start ------------------------------ */

    public function add_event() {
		$this->data['vanues'] = $this->cm->vanues();
		$this->data['artists'] = $this->cm->artists();
		
			if(isset($_POST['submit']))
			{
				$options = array('data' => array(
                        'event_name' => $this->input->post('eventName'),
                        'event_short_name' => $this->input->post('eventShortName'),
						'event_start_time' => $this->input->post('eventStartTime'),
						'event_end_time' => $this->input->post('eventEndTime'),
						'venue_id' => $this->input->post('vanueName'),
						'artist_id' => $this->input->post('artistName'),
						'event_pic' => $this->input->post('eventImage'),
                        'event_created_by' => '',
                        'event_create_at' => $this->currentDateTime, 
						'datetime' => $this->input->post('adminId'), 
						'event_date' => $this->input->post('eventDate'), 
						'event_time' => $this->input->post('eventTime'),
						'status' => $this->input->post('status'),
                        'event_type' => ''                                                                
                    ),
                    'table' => 'events'
                );
                $data = $this->common_model->customInsert($options);

			}
        $this->adminCommonView('admin/events/add_event', $this->data);
    }

    /* ---------------Add new event End ---------------------------------- */
	/* ---------------Manage/List of all Events Setion Start --------------- */

    public function all_events() {
		$this->data['events'] = $this->cm->events();
        $this->adminCommonView('admin/events/all_events', $this->data);
    }
	public function getVenueCategory(){
		$id	=	$this->cm->idDecrypt($this->input->post('cat_id'));
		$data = $this->cm->vanues_categories();
		$return='';
		foreach($data as $kdata => $vdata){
			if($id==$vdata->category_id){
				$return	.=	"<option selected='selected' value='".$this->cm->idEncrypt($vdata->category_id)."'>".$vdata->category."</option>";
			}else{
				$return	.=	"<option value='".$this->cm->idEncrypt($vdata->category_id)."'>".$vdata->category."</option>";
			}
		}
		print_r($return);
		exit(0);
	}
	public function update_venue_category(){
		$venue_id	=	$this->cm->idDecrypt($this->input->post('id'));
		$category_id	=	$this->cm->idDecrypt($this->input->post('cat_id'));
		$data = $this->cm->update_vanues_categories($venue_id,$category_id);

		$return	= '<table class="table table-striped table-bordered bootstrap-datatable datatables">
				<thead><tr><th></th><th>Open</th><th>Close</th></tr></thead><tbody>';
		$return		.='<input type="hidden" value="'.$data->category_id.'" id="cat_id" />';
	 	$week	=	array('monday'=>"Monday","tuesday"=>"Tuesday","wednesday"=>"Wednesday","thursday"=>"Thursday","friday"=>"Friday","saturday"=>"Saturday","sunday"=>"Sunday");
				   foreach($week as $k=>$v){ 
				  if($data->$k!='Closed'){$mon	=	explode("-",$data->$k);}else{$mon[0]=$mon[1]='Closed';}  
				   	//$mon		=	explode("-",$data->$k); 
				   	$return		.= '<tr><td>'.$v.'</td><td><a href="javascrip:void();" class="start_time">'.$mon[0].'</a></td>
						<td><a href="javascrip:void();" class="end_time">'.$mon[1].'</a></td></tr>';
				   } 
				
		$return		.=	'</tbody></table>'; 
		echo json_encode(array('category'=>$data->category,'category_id'=>$this->cm->idEncrypt($data->category_id),'category_time'=>$return));
		
		exit(0);
	}
	public function update_venue_status(){
		$pub 	=	$this->input->post('status');//
		$venueid 	=	$this->cm->idDecrypt($this->input->post('venueid'));
		if($pub==1){
			$data	=	array('publish'=>0);
		}else{
			$data	=	array('publish'=>1);
		}
		$where	=	array("venue_id"=>$venueid);
		$data1 = $this->cm->update_vanues_status($where,$data);
		echo $data['publish'];
		exit(0);
	}
    /* ---------------Manage/List of all Events Setion End --------------- */

    /*----------------update category time for vanue-------------------*/

    public function update_venue_categoryTime(){
		$data1 = $this->cm->update_vanues_category_time($_POST);
    	if($data1>0){
    		echo $_POST['value'];
    	}else{
    		echo 0;
    	}
    	exit(0);
    }
    public function update_venue_name(){
    	$data1 = $this->cm->update_vanues_name($_POST);
    	echo ($data1);
    	exit(0);
    }
	
	function get_lat_long($address){

    $address = str_replace(" ", "+", $address);

    $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=$region");
    $json = json_decode($json);

    $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
    $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
    return $latlong=$lat.','.$long;
}
   public function add_vanues($latlong){
    	$this->data['cities'] = $this->cm->cities();

		$this->data['vanues_category'] = $this->cm->vanues_categories();		
		if(isset($_POST['submit'])){
			$venue_data	=	$this->input->post('venue');
			$address=$venue_data['venue_city'];
			$lat_long= explode(',',$this->get_lat_long($address));
			$lat=$lat_long[0].' ';
			$long=$lat_long[1];

			$config =  array('upload_path'=> './images/venue',
			'allowed_types' => "gif|jpg|png|jpeg");        
        	//$this->load->library('upload', $config);
        	if(isset($_FILES['venue_image'])){
				$this->upload->initialize($config);
				$venue_image	=	'';
		        if($this->upload->do_upload('venue_image')){
					$da		=	$this->upload->data();
		            $data['message'] = "File Uploaded Successfully";
		            $data['status'] = 1;
		            $data["uploaded_file"] = $da['file_name'];
					$venue_image = $da['file_name'];
				
		        }
		    }
		   /* $this->db->select("*");
		    $this->db->from('tbl_city');
		    $this->db->where(array('id'=>$venue_data['venue_city']));
		    $cityq	=	$this->db->get();
		    $cityData	=	$cityq->row();*/
			$venue_address='';
			$v_address=$this->input->post('address');
			if($v_address[0]){
				$venue_address .=$v_address[0];
			}
		   if($v_address[1]){
				$venue_address .=$v_address[1];
			}
			$options = array('data' => array(
                'venue_name' => $venue_data['venue_name'],
                'venue_short_name' => $venue_data['venue_short_name'],
				'venue_image' => $venue_image,
				'venue_category_id' => $venue_data['venue_category_id'],
				'venue_lat' => $lat,
				'venue_long' => $long,
				'venue_city' => $venue_data['venue_city'],
                'venue_state' => $venue_data['venue_state'],
                'venue_country' => $venue_data['venue_country'], 
				'venue_address' => $venue_address, 
				'venue_created_by' => 0, 
				'venue_added_at' => date("Y-m-d H:i:s"),
				'status' => 1,
                'publish' => 0                                                                
            	),
            'table' => 'tbl_venue'
        	);

			//print_r($options);
           $data = $this->common_model->customInsert($options);
            redirect(base_url()."index.php/admin/administration/vanues_list");
        }
        $this->adminCommonView('admin/vanues/add_venues', $this->data);
    }
}

?>