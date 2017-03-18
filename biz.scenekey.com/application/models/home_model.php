<?php
class Home_model extends CI_Model {


	function insert_venue($data) {

		$res = $this->db->select('id')->where(array('email'=>$data['email']))->get('tbl_venue_owner');
		if($res->num_rows()){
			echo "Already exists";
			return false;
		} else {
			
		
			$this->load->database();
			$this->db->insert('tbl_venue_owner',$data);
			if($this->db->insert_id()) {
				$sessionData = array(
				'id'=> $this->db->insert_id(),
				'email' => $data['email']
				);
			
			$this->session->set_userdata($sessionData);
			}
			
			return true;
		}
	}

	function view_venue_id($id)
	{
		$this->db->select('*')->from('tbl_venue')->where('venue_id',$id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;

	}

	function venuelogin($data)
	{
		$res = $this->db->select('*')->where(array('email'=>$data['email'],'password'=>$data['password']))->get('tbl_venue_owner');
		if($res->num_rows() > 0){
			$result = $res->row();

			$sessionData = array(
				'email'=> $result->email,
				'id' => $result->id
				);
			
			$this->session->set_userdata($sessionData);

			return true;
		} else{
			return FALSE;
		}
	}
	function getAllvenues($limit,$start,$city='')
		{
		/* 	$this->db->select('*');
		    $this->db->where('venue_city', $city);
			$this->db->limit($limit, $start);
        	$query = $this->db->get("tbl_venue");
        	$result= $query->result();
			return $result; */
			///
	$this->db->select('*'); // you can write other fields using comma 
    $this->db->from("tbl_venue");        
    $this->db->join("tbl_city",'tbl_venue.venue_city = tbl_city.city','left');
	$this->db->where('venue_city', $city);
    $this->db->where('tbl_venue.is_show_home','1');
	$this->db->group_by('venue_id'); 
	$this->db->limit($limit, $start);

    $query = $this->db->get();   
    return $query->result();
		}	

	function record_count($city=''){
		
		$this->db->where('venue_city', $city);
	   $this->db->where('is_show_home','1');
        $this->db->from('tbl_venue');
        return $this->db->count_all_results();
			 //return $this->db->count_all("tbl_venue")->where('venue_city',$city) ;


		}

	function customGet($limit='',$start=''){
			$this->db->select('*');
			$query = $this->db->where('is_show_home',1);
			$this->db->order_by("city", "asc");
            if($limit){
			$this->db->limit($limit,$start);
	        }
			$query = $this->db->get('tbl_city');

			$result = $query->result();
			return $result;
		}

	

	function view_venue_city($id)
	{ 
		
		$this->db->select('	tbl_venue.*,tbl_city.city');
		$this->db->from('tbl_venue');
		$this->db->join('tbl_city','tbl_venue.venue_city = tbl_city.city');
		$this->db->where('tbl_city.id',$id) ;
		$this->db->limit(5);
		$query = $this->db->get();
		$result = $query->result();
		
		return $result;
	}
}
?>
