<?php 
/*$servername = "gearly.webhost4lifemysql.com";
$username = "gearly";
$password = "gearly123";
$dbname = "scenekeydb";

 $conn = mysql_connect($servername, $username, $password);

 mysql_select_db("screenkey") ;
 
 */
 ?>
 <?php 
     $allcat = "SELECT category,category_id from tbl_venue_category";
	 $all_cat=mysql_query($allcat);

 		 while($allcate_de= mysql_fetch_array($all_cat)){
		 $category_fetch[]=array('category'=>$allcate_de['category'],'category_fetch_id'=>$allcate_de['category_id']);
					
		 }

	 $allcity = "SELECT lat,longitude from city ";
	 $all_city=mysql_query($allcity);
	$i=1; 
  while($final_city=mysql_fetch_array($all_city)){
	  
	  $city[]=array('lat'=>$final_city['lat'],'longitude'=>$final_city['longitude']);
  }

	foreach ($city as $final_city1){
		// $address=$final_city1['city'].', '.$final_city1['state'].', '.'US';
		  

		               foreach ($category_fetch as $category_fetch_val){  
                     // $address="San Jose, California, US";    						 
						 $category_fetch_name=$category_fetch_val['category'];
						 $category_fetch_id=$category_fetch_val['category_fetch_id'];
                           $latitude =$final_city1['lat'];
						   $longitude=$final_city1['longitude'];
	                         // $address=$final_city1['city'].', '.$final_city1['state'].', '.'US';
							//  $prepAddr = str_replace(' ','+',$address);
								//	$geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
								//	$output= json_decode($geocode);
									//$latitude = $output->results[0]->geometry->location->lat;
							      //   $longitude = $output->results[0]->geometry->location->lng.'<br>';
								   
							 echo $json_string = 'https://api.foursquare.com/v2/venues/search?client_id=BI5HHL4T34FRBGWI1X5LZVYFC4HHYHDXGYRY3XXOORQHBRXS&client_secret=2ZSZICRVHNBKKTVVPXCKUWCCWY01PTTPTPFRSMYF2PTPVE5J%20&v=20130815%20&ll='.$latitude.','.$longitude.'%20&query='.$category_fetch_name.'<br>';
                            
							$jsondata = file_get_contents($json_string);
							$array=json_decode($jsondata,true);
							
							 $cat_id=array();
							$i++;
								foreach ($array['response']['venues'] as $data){
								 $vanue_name=str_replace("'",'',$data['name']);
								 $lat=$data['location']['lat'];
								 $lng=$data['location']['lng'];
								 $contry=$data['location']['country'];
								 $state=$data['location']['state'];
								 
								 
								//foreach ($data['location']['formattedAddress'] as $address_fro){
							     $address= implode(',',$data['location']['formattedAddress']);
								 
								//}

									

									$sql = "INSERT INTO tbl_venue (venue_name,venue_category_id, venue_lat,venue_long,venue_state,venue_country,venue_address,status)
								   VALUES ('$vanue_name','$category_fetch_id','$lat','$lng','$state','$contry','$address','1')";

						 // mysql_query($sql);
								 


								}

					//}
		
	}
			 }
			 //fclose($file);

	 ?>
