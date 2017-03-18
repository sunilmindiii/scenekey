<?php
class Userprofile extends CI_Model {
	
	    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
	function registration($data)
	{
		unset($data['submit']);
		echo $this->db->insert('test', $data); 
	}
	
}
?>