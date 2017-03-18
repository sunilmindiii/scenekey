<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Administration extends MY_Controller {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
		//$this->load->library('pagination');
		$this->load->library('ajax_pagination');
		 $admin_id=$this->session->userdata('adminName');
	    if(empty($admin_id)){
		    // redirect(base_url('index.php/administration'));
		}
		        date_default_timezone_set('America/Los_Angeles');

    }

    /* ------------- Admin Login Setion Start--------------- */
 public function index() {
	
    
    }

    /* ------------- Admin Login Setion End-------------- */
    /* ------------- Admin Logout Setion Start -------------- */

    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url('index.php/admin/'));
    }

    /* ------------- Admin Logout Setion End-------------- */
    /* ------------- Forget Password form page view start--------------- */

    public function forgetPassword() {
        $this->load->view('admin/adminUsers/forgot_password');
    }

    /* ------------- Forget Password form page view end------------- */
    /* ------------- Admin Dashboard Setion Start------------- */

    public function home() {
		$fields=array('count(*) as usercount');
		$data['user_count']=$this->common_model->get_sql_select_data('tbl_user',null,$fields);
        $this->adminCommonView('admin/index',$data);
    }

    /* -------------- Admin Dashboard Setion End--------------- */
    /* ---------------Manage/List of all Artists Setion Start --------------- */

    public function artists_list() {
		$this->data['artists'] = $this->cm->artists();
        $this->adminCommonView('admin/artists/all_artists', $this->data);
    }

    /* ---------------Manage/List of all Artists Setion End --------------- */
	
	/* --------------- Start of User's listing with their type --------------- */
	public function users($user_type) {
		$data['all_users']=$this->common_model->get_sql_select_data('tbl_user',null,null,null,'userid');
		$data['user_type'] = $user_type;
	    $this->adminCommonView('admin/users/all_users', $data);
    }
	
	public function ajax_user_list($user_type){
    	
		$like =$like2=	array();
		$where='';
		
		/*if(!empty($_POST['search_city'])){
			$like['venue_city']		=	$_POST['search_city'];
		}
		if(!empty($_POST['search_category'])){
			$like['venue_category_id']		=	$_POST['search_category'];
		}
		if($_POST['publish_category']!=''){
			$like['publish']		=	$_POST['publish_category'];
		}
		if(!empty($_POST['search_keyword'])){
			$like2['venue_name']		=	$_POST['search_keyword'];
		}*/
		
		if(!empty($user_type)){
			if($user_type == 'promoter'){
				$where['usertype'] = 'Promoter';
			} elseif($user_type == 'social'){
				$where['usertype'] = 'Social User';
			} elseif($user_type == 'performer'){
				$where['usertype'] = 'Performers';
			}
		}
		
		if($user_type == 'dummyuser'){	
			$where = array('user_id'=>0);
			$total = $this->cm->total_record('tbl_artist', 'artist_id', $where, $like);
		} else {
			$total = $this->cm->total_record('tbl_user', 'userid', $where, $like);
		}
		
		//$page=	$this->input->post('page');
		//$total = $this->cm->total_record('tbl_user', 'userid', $where, $like);
		$config['base_url'] = base_url().'index.php/admin/administration/ajax_user_list/'.$user_type;
		$config['total_rows'] = $total;
		$config['uri_segment'] = 5;
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
		
		$page	=	$this->uri->segment(5);
		
		$limit	=	$config['per_page'];
		$start	=	$page>0?$page:0;
		$this->ajax_pagination->initialize($config);
		
		
		//$this->data['users'] = $this->cm->users($limit,$start,$where,$like);
		if($user_type == 'dummyuser'){
			$where = array('user_id'=>0);
			$this->data['performer'] = $this->cm->getData('tbl_artist',$limit,$start,$where,$like);
		} else {
			$this->data['users'] = $this->cm->getData('tbl_user',$limit,$start,$where,$like);
		}
		
		$this->data['pagination'] =$this->ajax_pagination->create_links();
		$this->data['startFrom'] = $start + 1;
		//$this->load->view('admin/users/ajax_user_list', $this->data);
		if($user_type == 'dummyuser'){	
			$this->load->view('admin/users/ajax_performer_list', $this->data);
		} else {
			$this->load->view('admin/users/ajax_user_list', $this->data);
		}
    }
	
    /* --------------- End of User's listing --------------- */
	
	
	function add_user()
	{
		if(isset($_POST['submit'])){
			
			$userData[''] = $this->input->post('');
			
			$this->load->model('admin/adminuser_model');
			$this->adminuser_model->add_user($userData);
		}
		
		$this->adminCommonView('admin/users/edit_user');
	}
	
    
	/* ---------------Manage/List of all Vanues Setion Start --------------- */

    public function vanues_list() {
		//$this->data['like'] =$like;
		$this->data['vanue_category']	=	$this->cm->vanues_categories('category_id,category');
		$this->data['cities'] = $this->cm->cities('city');
		$this->adminCommonView('admin/vanues/all_vanues', $this->data);
    }
	 public function registerd_vanues() {

		$this->adminCommonView('admin/vanues/registred_vanues');
    }
    public function active_events() {

		$this->adminCommonView('admin/vanues/active_events');
    }
   public function ajax_active_events_list(){
    	
		$like = $like2 = array();
		

		if(!empty($_POST['search_keyword'])){
			$like2['event_name']		=	trim($_POST['search_keyword']);

		}
	if(!empty($_POST['type'])){
			$like2['type']		=	trim($_POST['type']);

		}
		//$page=	$this->input->post('page');
		$total				=	count($this->cm->active_events(NULL,NULL,NULL,$like2));
		$config['base_url'] = base_url().'index.php/admin/administration/ajax_active_events_list';
		$config['total_rows'] = $total;
		$config['uri_segment'] = 4;
		$config['per_page'] = 20;
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
		$order = isset($_POST['sort']) ? $this->input->post('sort') : '';
		$orderBy = isset($_POST['sortby']) ? 'venue_'.$this->input->post('sortby') : '';
		
		$limit	=	$config['per_page'];
		$start	=	$page>0?$page:0;
		$this->ajax_pagination->initialize($config);
		$this->data['page'] = $page;
		$this->data['vanues'] = $this->cm->active_events($limit,$start,null,$like2,'*',trim($orderBy.' '.$order));
		$this->data['pagination'] =$this->ajax_pagination->create_links();
		$this->load->view('admin/vanues/ajax_active_events_list', $this->data);
    }
	
	 public function ajax_registerd_vanue_list(){
    	
		$like = $like2 = array();
		
		if(!empty($_POST['search_city'])){
			$like['venue_city']		=	$_POST['search_city'];
		}//
		if(!empty($_POST['search_category'])){
			$like['venue_category_id']		=	$_POST['search_category'];
		}
		if(!empty($_POST['publish_category'])){
			$like['publish']		=	$_POST['publish_category'];
		}
		if(!empty($_POST['search_keyword'])){
			$like2['fname']		=	trim($_POST['search_keyword']);

		}
		//$page=	$this->input->post('page');
		$total				=	count($this->cm->registerd_vanues(NULL,NULL,NULL,$like2));
		$config['base_url'] = base_url().'index.php/admin/administration/ajax_registerd_vanue_list';
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
		$order = isset($_POST['sort']) ? $this->input->post('sort') : '';
		$orderBy = isset($_POST['sortby']) ? 'venue_'.$this->input->post('sortby') : '';
		
		$limit	=	$config['per_page'];
		$start	=	$page>0?$page:0;
		$this->ajax_pagination->initialize($config);
		$this->data['page'] = $page;
		$this->data['vanues'] = $this->cm->registerd_vanues($limit,$start,null,$like2,'*',trim($orderBy.' '.$order));
		$this->data['pagination'] =$this->ajax_pagination->create_links();
		$this->load->view('admin/vanues/ajax_registerd_vanue_list', $this->data);
    }
    public function ajax_vanue_list(){
    	
		$like = $like2 = array();
		
		if(!empty($_POST['search_city'])){
			$like['venue_city']		=	$_POST['search_city'];
		}//
		if(!empty($_POST['search_category'])){
			$like['venue_category_id']		=	$_POST['search_category'];
		}
		if(!empty($_POST['publish_category'])){
			$like['publish']		=	$_POST['publish_category'];
		}
		if(!empty($_POST['search_keyword'])){
			$like2['venue_name']		=	trim($_POST['search_keyword']);
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
		$order = isset($_POST['sort']) ? $this->input->post('sort') : '';
		$orderBy = isset($_POST['sortby']) ? 'venue_'.$this->input->post('sortby') : '';
		
		$limit	=	$config['per_page'];
		$start	=	$page>0?$page:0;
		$this->ajax_pagination->initialize($config);
		$this->data['page'] = $page;
		$this->data['vanues'] = $this->cm->vanues($limit,$start,$like,$like2,'*',trim($orderBy.' '.$order));
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
	
	public function active_event_details($id){
		$id	=	 $this->cm->idDecrypt($id);
		$data['event_feeds'] = $this->cm->activeeventfeeds($id);
		$data['event_detail'] = $this->cm->event_details($id);
        $data['total_event_feed'] = $this->cm->get_sql_select_data('tbl_event_feeds',array('event_id'=>$id),array('count(*) as count'));
		$data['total_event_key'] = $this->cm->get_sql_select_data('tbl_userevent',array('eventid'=>$id),array('count(*) as count'));
		$this->adminCommonView('admin/vanues/active_event_details',$data);	
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
		if(isset($_POST['submit']))
		{
			$artistId=array();
			$promoterId=array();
			
			if($_POST['artistId']){
				$artistId	=	$this->input->post('artistId');
			}
			if($_POST['newArtistId']){
				$newArtistId	=	$this->input->post('newArtistId');
				if(!empty($newArtistId)){
					foreach($newArtistId as $key => $val){
						$options = array('data' => array(
								'artist_name' => trim($val,",")                                                           
								),
							'table' => 'tbl_artist'
							);
							
						array_push($artistId,$this->common_model->customInsert($options));
					}
				}
			}
			if($_POST['promoterId']){
				$promoterId	=	$this->input->post('promoterId');
			}
			if($_POST['newPromoterId']){
				$newPromoterId	=	$this->input->post('newPromoterId');
				if(!empty($newPromoterId)){
					foreach($newPromoterId as $key => $val){
						$options = array('data' => array(
								'name' => trim($val,",")                                                           
								),
							'table' => 'tbl_responser'
							);
						array_push($promoterId, $this->common_model->customInsert($options));
					}
				}
			}
			$dates	=	$this->input->post('eventDate')." T ".$this->input->post('eventTime');
			$datetimes	=	$this->input->post('eventDate')." ".$this->input->post('eventTime');
			$eventStartTime= date("Y-m-d H:i:s",strtotime($datetimes));
			$duration	=	$this->input->post('duration');
			$eventEndTime= date("Y-m-d H:i:s",strtotime("+ ".($duration*60)." minutes",strtotime($eventStartTime)));	
			$options = array('data' => array(
					'event_name' => $this->input->post('eventName'),
					'event_start_time' => $eventStartTime,
					'event_end_time' => $eventEndTime,
					'venue_id' => $this->input->post('vanue_id'),
					//'event_pic' => $this->input->post('eventImage'),
					'event_created_by' => $this->input->post('adminId'),
					'event_create_at' => $this->currentDateTime, 
					'datetime' => $dates, 
					'event_date' => $this->input->post('eventDate'), 
					'event_time' => $this->input->post('eventTime'),
					'status' => 1,
					'event_type' => 1,
					'makescen'=>1,
					'event_interval'=>$duration,
					'category_id'=>$this->input->post('event_category_id')
				),
				'table' => 'events'
			);
			$data = $this->common_model->customInsert($options);
			if(!empty($artistId)){
				foreach($artistId as $key => $value ){
					$this->db->where(array("artist_id"=>$value));
					$this->db->update("tbl_artist", array("event_ids"=>$data));
				}
			}
			if(!empty($promoterId)){
				foreach($promoterId as $key => $value ){
					$this->db->where(array("id"=>$value));
					$this->db->update("tbl_responser", array("event_id"=>$data));
				}
			}
			redirect(base_url()."index.php/admin/administration/all_events");
		}
        $this->adminCommonView('admin/events/add_event');
    }

    /* ---------------Add new event End ---------------------------------- */
	/* ---------------Manage/List of all Events Setion Start --------------- */

    public function all_events() {
		$this->data['cities'] = $this->cm->cities('city');
		$this->data['artists'] = $this->cm->artists(100,0,'','','*');
        $this->adminCommonView('admin/events/all_events',$this->data);
    }
	public function ajax_events_list(){
		
    	 $where =$like2=	array();
		if(!empty($_POST['search_city'])){
			$where['venue_city']		=	$_POST['search_city'];
		}
		if(!empty($_POST['search_artist'])){
			$where['tbl_artist.artist_id']		=	$_POST['search_artist'];
		}
		if(!empty($_POST['search_keyword'])){
			$like2['event_name']		=	$_POST['search_keyword'];
		} 
		//$page=	$this->input->post('page');
		//$this->data['events'] = $this->cm->events();
		
		$total				=	$this->cm->events(NULL,NULL,$where,$like2,TRUE);
		
		$config['base_url'] = base_url().'index.php/admin/administration/ajax_events_list';
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
		$this->data['events'] = $this->cm->events($limit,$start,$where,$like2,FALSE);
		$this->data['pagination'] =$this->ajax_pagination->create_links();
		$this->load->view('admin/events/ajax_events_list', $this->data);
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
		
		$venueid = $this->cm->idDecrypt($this->input->post('venueid'));
		$pub = $this->input->post('status');//
		
		if($pub==1){
			$data	=	array('publish'=>0);
		}else{
			$data	=	array('publish'=>1);

			//getting venue detail
			
			$venues = $this->cm->getVenueDetail($venueid);
			
			if(!empty($venues)){
				$eventName = date('l').'@'.$venues['venueName'];
				$currentDate = date('Y-m-d');
				$default_event = $this->cm->getdefaultEvent($venueid);
                if(!$default_event){				
				$fields=array(	'event_name'=>$eventName,
								'venue_id'=>$venueid,
								'event_start_time'=>$venues['startDate'],
								'event_end_time'=>$venues['endDate'],
								'event_interval'=>$venues['timeInterval'],
								'datetime'=>$venues['datetime'],
								'event_time'=>$venues['event_time'],
								'artist_id'=>1775,
								'event_date'=>$currentDate,
								'status'=>1,
								'event_type'=>0
						);
				$this->cm->INSERTDATA('tbl_events',$fields);
				}
			}
		}
		
		$where	=	array("venue_id"=>$venueid);
		$data1 = $this->cm->update_vanues_status($where,$data);
		
		echo $data['publish'];
		exit(0);
	}
	public function update_venue_city(){
		
		$cityid = $this->input->post('cityid');
	    $venueid = $this->input->post('venue_id');

		if($cityid){
		$city=implode(',',$cityid);
		}
		$where	= array("venue_id"=>$venueid);
		$this->cm->UPDATEDATA('tbl_venue',array('venue_id'=>$venueid),array('is_home_city'=>$city));		
		//exit(0);
	}
    /*==========update venue show is home page section==================*/
public function update_venue_status_ishome(){
		
		$venueid = $this->cm->idDecrypt($this->input->post('venueid'));
		$is_home = $this->input->post('is_home');//
		
		if($is_home==1){
			$data	=	array('is_show_home'=>0);
		}else{
			$data	=	array('is_show_home'=>1);
		}
		
		$where	=	array("venue_id"=>$venueid);
		$data1 = $this->cm->update_vanues_status($where,$data);
		
		echo $data['is_show_home'];
		exit(0);
	}

    /* ---------------Manage/List of all Events Setion End --------------- */
public function update_city_status(){
		
		$cityid = $this->cm->idDecrypt($this->input->post('cityid'));
		$pub = $this->input->post('status');//
		
		if($pub==1){
			$data	=	array('is_show_home'=>0);
			echo "0";
		}else{
			$data	=	array('is_show_home'=>1);
			echo "1";

		}
		$where	=	array("id"=>$cityid);
		$data1 = $this->cm->UPDATEDATA('tbl_city',$where,$data);
		
		//echo $data['Publish on browser'];
		exit(0);
        
	}
    /*----------------update category time for vanue-------------------*/

    public function update_venue_categoryTime(){
		$data1 = $this->cm->update_vanues_category_time($_POST);
    	if($data1>0){
			$venue_id=$_POST['venue_id'];
			$status=$_POST['status'];
		    $hours=$_POST['value'];

			$venue_hours = array('1A' => '01:00:00', '2A' => '02:00:00', '3A' => '03:00:00', '4A' => '04:00:00', '5A' => '05:00:00',
            '6A' => '06:00:00', '7A' => '07:00:00', '8A' => '08:00:00', '9A' => '09:00:00', '10A' => '10:00:00',
            '11A' => '11:00:00', '12A' => '12:00:00', '1P' => '13:00:00', '2P' => '14:00:00', '3P' => '15:00:00',
            '4P' => '16:00:00', '5P' => '17:00:00', '6P' => '18:00:00', '7P' => '19:00:00', '8P' => '20:00:00',
            '9P' => '21:00:00', '10P' => '22:00:00', '11P' => '23:00:00', '12P' => '00:00:00');

			$where=array('venue_id'=>$venue_id,'event_date'=>date('Y-m-d'),'event_type'=>0);
			if($status=='start'){
			$fields=array('event_start_time'=>date('Y-m-d').' '.$venue_hours[$hours],'event_time'=>$venue_hours[$hours]);
		    }else {
			$last_char=substr($hours, -1);
            if($last_char=="A"){
			$endtime=date('Y-m-d', strtotime(' +1 day')).' '.$venue_hours[$hours];
			}else{
			$endtime=date('Y-m-d').' '.$venue_hours[$hours];	
			}			
		    $fields=array('event_end_time'=>$endtime);	
			}
			$this->cm->UPDATEDATA('tbl_events',$where,$fields);
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
	
   public function add_vanues(){
    	$this->data['cities'] = $this->cm->cities();

		$this->data['vanues_category'] = $this->cm->vanues_categories();		
		if(isset($_POST['submit'])){
			
			$h_city='';
			$venue_home_city=$this->input->post('artistId');
			if($venue_home_city){
			$h_city=implode(',',$venue_home_city);
			}
			
			$venue_data	=	$this->input->post('venue');
			$venue_address='';
			$v_address=$this->input->post('address');
			if($v_address[0]){
				$venue_address .=$v_address[0].' ';
			}
		   if($v_address[1]){
				$venue_address .=$v_address[1];
			}
			$address=$venue_address.' '.$venue_data['venue_city'].' '.$venue_data['venue_state'];
			$lat_long= explode(',',$this->cm->get_lat_long($address));
			$lat=$lat_long[0];
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
				'venue_created_by' => 3, 
				'venue_added_at' => date("Y-m-d H:i:s"),
				'status' => 1,
				'is_home_city'=>$h_city,
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
	
	
	   public function changelocation(){

		if(isset($_POST['submit'])){
			 $lati=$this->input->post('lati');
			 $longi=$this->input->post('longi');

					$this->cm->UPDATEDATA('tbl_user',array('userid'=>'153'),array('lat'=>$lati,'longi'=>$longi));
                   $this->session->set_flashdata('msg', 'Latitude & Longitude Updated');
            redirect(base_url()."index.php/admin/administration/changelocation");
        }
        $this->adminCommonView('admin/vanues/add_latlong');
    }
	
	public function getVenueNameSuggestion(){
		$vanues = $this->cm->vanues(100,0,'',array('venue_name'=>$this->input->post("like")),'venue_id,venue_name');
		$string	=	'';
		if(!empty($vanues)){
			$string	=	'<ul>';
			foreach($vanues as $value){
				$string	.=	'<li><a class="addVanueName" href="javascript:void(0);" vid="'.$value->venue_id.'">'.$value->venue_name.'</a></li>';
			}
			$string	.=	'</ul>';
		}
		
		echo $string;
		exit(0);
	}
	
	public function getCitySuggestion(){
		$artists = $this->cm->cities_ajax(100,0,'',array('city'=>$this->input->post("like")),'id,city,state');
		//$this->data['promoter'] = $this->cm->promoter();
		$string	=	'';
		if(!empty($artists)){
			$string	=	'<ul>';
			foreach($artists as $value){
				$string	.=	'<li><a class="addArtistName" href="javascript:void(0);" vid="'.$value->city.'">'.$value->city.'('.$value->state.')'.'</a></li>';
			}
			$string	.=	'</ul>';
		}
		
		echo $string;
		exit(0);
	}
	public function getArtistSuggestion(){
		$artists = $this->cm->artists(100,0,'',array('artist_name'=>$this->input->post("like")),'artist_id,artist_name');
		//$this->data['promoter'] = $this->cm->promoter();
		$string	=	'';
		if(!empty($artists)){
			$string	=	'<ul>';
			foreach($artists as $value){
				$string	.=	'<li><a class="addArtistName" href="javascript:void(0);" vid="'.$value->artist_id.'">'.$value->artist_name.'</a></li>';
			}
			$string	.=	'</ul>';
		}
		
		echo $string;
		exit(0);
	}
	public function getPromoterSuggestion(){
		$promoter = $this->cm->promoter(100,0,'',array('name'=>$this->input->post("like")),'id,name');
		$string	=	'';
		if(!empty($promoter)){
			$string	=	'<ul>';
			foreach($promoter as $value){
				$string	.=	'<li><a class="addPromoterName" href="javascript:void(0);" vid="'.$value->id.'">'.$value->name.'</a></li>';
			}
			$string	.=	'</ul>';
		}
		
		echo $string;
		exit(0);
	}
	public function getEventCategory(){
		$eventCategory = $this->cm->eventCategory(100,0,'',array('name'=>$this->input->post("like")),'id,name');
		$string	=	'';
		if(!empty($eventCategory)){
			$string	=	'<ul>';
			foreach($eventCategory as $value){
				$string	.=	'<li><a class="addCategory" href="javascript:void(0);" vid="'.$value->id.'">'.$value->name.'</a></li>';
			}
			$string	.=	'</ul>';
		}
		
		echo $string;
		exit(0);
	}
	
	function sendEmail()
	{
		
		if(isset($_POST['to'])){
			$emailIds = explode(',',$_POST['to']);
			
			//load mailchimp library with passing param in constructor
			$this->load->library('mailchimp',array('api_key'=>$this->config->item('mailchimp_api_key')));
			
			foreach($emailIds as $email){
				$result = $this->mailchimp->call('lists/subscribe', array(
							'id'                => $this->config->item('mailchimp_list_id'),
							'email'             => array('email'=>$email),
							'merge_vars'        => array('FNAME'=>'', 'LNAME'=>''),
							'double_optin'      => false,
							'update_existing'   => true,
							'replace_interests' => false,
							'send_welcome'      => false,
						));
			}
			
			$subject = $this->input->post('subject');
			$body = $this->input->post('body');
			
			$emailContent = array(
								'subject' => $subject,
								'body' => $body,
								'image' => base_url().'images/logo.png'
							);
			
			//load email library
			$this->load->library('email');
			$config = array (
					  'mailtype' => 'html',
					  'charset'  => 'utf-8',
					  'priority' => '1'
					   );
			$this->email->initialize($config);
			$this->email->from('support@scenkey.com', 'Support');
			$this->email->to($_POST['to']);
			$this->email->subject($this->input->post('subject'));
			$message = $this->load->view('admin/email/template_2',$emailContent,TRUE);
			$this->email->message($message);
			$this->email->send();
		}
		
	}
	
		public function city_details($id){
		$id	=	 $this->cm->idDecrypt($id);
		$data['city_detail'] = $this->cm->get_sql_select_data('tbl_city',array('id'=>$id));
		$this->adminCommonView('admin/location/city_full_details',$data);
	}
	public function update_city(){
		    $status=$this->input->post('status');
		    $id=$this->input->post('city_id');
			$update_data=array('is_show_home'=>$status);

		    $config =  array('upload_path'=> './images/city',
			'allowed_types' => "gif|jpg|png|jpeg");        
        	if(isset($_FILES['userImage'])){
				$this->upload->initialize($config);
		        if($this->upload->do_upload('userImage')){
					$da		=	$this->upload->data();
		            $data['message'] = "File Uploaded Successfully";
		            $data['status'] = 1;
		            $data["uploaded_file"] = $da['file_name'];
					$venue_image = $da['file_name'];
				    $update_data['cityimage']=$venue_image;
		        }
		    }
			$this->cm->UPDATEDATA('tbl_city',array('id'=>$id),$update_data);
			redirect($_SERVER['HTTP_REFERER']);
	}
}

?>