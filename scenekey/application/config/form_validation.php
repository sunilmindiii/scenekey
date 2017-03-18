<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| USER AGENT TYPES
| -------------------------------------------------------------------
| This file contains four arrays of user agent data.  It is used by the
| User Agent Class to help identify browser, platform, robot, and
| mobile device data.  The array keys are used to identify the device
| and the array values are used to set the actual name of the item.
|
*/

$config = array(

				'register' => array(
                                    array(
                                            'field' => 'user_master[user_type]',
                                            'label' => 'User Type',
                                            'rules' => 'required'
                                         ),
                                   array(
                                            'field' => 'user_master[user_fullname]',
                                            'label' => 'User Name',
                                            'rules' => 'required'
                                         ),
										 
								 array(
                                            'field' => 'user_master[gender]',
                                            'label' => 'Gender',
                                            'rules' => 'required'
                                         ),
				
										 
								array(
                                            'field' => 'user_master[user_email]',
                                            'label' => 'Email',
                                            'rules' => 'required|valid_email|is_unique[user_master.user_email]'
                                         
                                          	),
											
									array(
                                            'field' => 'user_password',
                                            'label' => 'Password',
                                            'rules' => 'required'
                                          ),
									array(
                                            'field' => 'cpassword',
                                            'label' => 'Confirm Password',
                                            'rules' => 'matches[user_password]'
                                          ),
									array(
                                            'field' => 'register[contact]',
                                            'label' => 'Contact',
                                            'rules' => 'required'
                                          )
			        ),
				
				'emailId' => array(
                                    array(
                                            'field' => 'user_master[user_email]',
                                            'label' => 'Email',
                                            'rules' => 'required|valid_email|is_unique[user_master.user_email]'
                                         )
				),

				'adminDoctorRegister' => array(
                                    
                                   array(
                                            'field' => 'user_master[user_fullname]',
                                            'label' => 'User Name',
                                            'rules' => 'required'
                                         ),
				   array(
                                            'field' => 'register[gender]',
                                            'label' => 'Gender',
                                            'rules' => 'required'
                                         ),
				   array(
                                            'field' => 'register[contact]',
                                            'label' => 'Contact',
                                            'rules' => 'required'
                                         ),
				   array(
                                            'field' => 'register[address]',
                                            'label' => 'Address',
                                            'rules' => 'required'
                                         ),
				   array(
                                            'field' => 'register[country_id]',
                                            'label' => 'Country',
                                            'rules' => 'required'
                                         ),
				   array(
                                            'field' => 'register[state_id]',
                                            'label' => 'State',
                                            'rules' => 'required'
                                         ),
				   array(
                                            'field' => 'register[city_id]',
                                            'label' => 'City',
                                            'rules' => 'required'
                                         ),
				   array(
                                            'field' => 'register[specialities]',
                                            'label' => 'Specialities',
                                            'rules' => 'required'
                                         ),
				   /*array(
                                            'field' => 'register[registration_no]',
                                            'label' => 'Registration Number',
                                            'rules' => 'required'
                                         ),
				   array(
                                            'field' => 'register[year_of_registration]',
                                            'label' => 'Year Of Registration',
                                            'rules' => 'required'
                                         ),
				   array(
                                            'field' => 'degree',
                                            'label' => 'Degree',
                                            'rules' => 'required'
                                         ),*/
				   
				  array(
                                            'field' => 'register[about]',
                                            'label' => 'Description',
                                            'rules' => 'required'
                                         ),
				),

				'adminHospitalRegister' => array(
                                    
                  array(
                                            'field' => 'profile[hospital_master_name]',
                                            'label' => 'Hospital Name',
                                            'rules' => 'required'
                                         ),
				 
				   array(
                                            'field' => 'countryName',
                                            'label' => 'Country',
                                            'rules' => 'required'
                                         ),
				   array(
                                            'field' => 'stateName',
                                            'label' => 'State',
                                            'rules' => 'required'
                                         ),
				   array(
                                            'field' => 'cityName',
                                            'label' => 'City',
                                            'rules' => 'required'
                                         ),
			
				),
				
				'adminhospital_login'=>array(   
				                    array(  
                                            'field' => 'user_name',
                                            'label' => 'User Name',
                                            'rules' => 'required|is_unique[tbl_hospital_master.hospital_master_user_name]'
                                         ),				
				                    array(  
                                            'field' => 'cpassword',
                                            'label' => 'Confirm Password',
                                            'rules' => 'required|required|matches[password]'
                                         ),
							  array(  
                                            'field' => 'password',
                                            'label' => 'Password',
                                            'rules' => 'required'
                                         ),
				
				),
				
	'adminHospitaldoctor'=>array(   
				                    array(  
                                            'field' => 'doctor_list',
                                            'label' => 'Doctor',
                                            'rules' => 'required'
                                         ),				  
				
			          	),
				
			'adminhospital_seo'=>array(   
				                    array(  
                                            'field' => 'meta[hospital_master_meta_tags]',
                                            'label' => 'Meta Tags',
                                            'rules' => 'required'
                                         ),				
				                    array(  
                                            'field' => 'meta[hospital_master_meta_title]',
                                            'label' => 'Meta Title',
                                            'rules' => 'required'
                                         ),
							     array(  
                                            'field' => 'meta[hospital_master_meta_description]',
                                            'label' => 'Meta Description',
                                            'rules' => 'required'
                                         ),

				
				),
				
				
				'adminHealthRegister' => array(
                                    array(
                                            'field' => 'user_master[user_type]',
                                            'label' => 'User Type',
                                            'rules' => 'required'
                                         ),
                                   array(
                                            'field' => 'user_master[user_fullname]',
                                            'label' => 'User Name',
                                            'rules' => 'required'
                                         ),
				  array(
                                            'field' => 'user_master[gender]',
                                            'label' => 'Gender',
                                            'rules' => 'required'
                                         ),
				   array(
                                            'field' => 'register[contact]',
                                            'label' => 'Contact',
                                            'rules' => 'required'
                                         ),
				   array(
                                            'field' => 'register[address]',
                                            'label' => 'Contact',
                                            'rules' => 'required'
                                         ),
				   array(
                                            'field' => 'register[country_id]',
                                            'label' => 'Country',
                                            'rules' => 'required'
                                         ),
				   array(
                                            'field' => 'register[state_id]',
                                            'label' => 'State',
                                            'rules' => 'required'
                                         ),
				   array(
                                            'field' => 'register[city_id]',
                                            'label' => 'City',
                                            'rules' => 'required'
                                         ),
				   array(
                                            'field' => 'register[services_type]',
                                            'label' => 'Services type',
                                            'rules' => 'required'
                                         ),
				   array(
                                            'field' => 'register[services]',
                                            'label' => 'Services',
                                            'rules' => 'required'
                                         ),
				),
								
				'reviewrating' => array(
                               
                                   array(
                                            'field' => 'rating',
                                            'label' => 'Rating',
                                            'rules' => 'required'
                                         ),
										 
								 array(
                                            'field' => 'review',
                                            'label' => 'Review',
                                            'rules' => 'required'
                                         )
				
					
								),

			 
			 


			 
			   );
			
			   
