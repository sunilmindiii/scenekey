<style>
div.profile_image {
    width: 250px;
    height: 250px;
	float:left;
}
div.profile_image > h2{
 	font-size:18px;
	text-transform:uppercase;
}
div.profile_image > img {
    width: 240px;
    height: 200px;
	
}
.profile_time_table {
    width: 60%;
    float: right;
	margin:10px;
	text-align:center;
}
div.vanue_profile_details{
	width:35%;
	float:left;
}
div.vanue_profile_details > ul > li{
	list-style:none;
	line-height:50px;
}
div.vanue_profile_details table tr th{
	border:1px solid #CCCCCC;
}
div.vanue_profile_details table tr td{
	border:1px solid #CCCCCC;
	
}
div.vanue_event_details{
	width:60%;
	float:right;
    margin: 0 10px;
}

div.vanue_event_details > h2.event_title {
    height: 20px;
    font-size: 18px;
    color: #FFFFFF;
    text-transform: uppercase;
    margin: 0px;
    background: #000000;
    padding: 10px;
	text-align: center;

}
div.event_images {
    float: left;
    padding: 5px;
}
div.event_images > img{
    width: 120px;
    border-right: 1px solid darkgray;
    height: 120px;
    padding-right: 15px;
}
div.event_details{
	padding: 10px;
    float: left;
}
div.event_details > ul >li{
	list-style:none;
}
div.divider{
	clear:both;
	width:99%;
	    border-top: 1px solid silver;
}
a#venue_images {
    display: table-footer-group;
    background-color: yellowgreen;
}
a#venue_images > img {
    border-radius: 30px;
	    width: 200px;
    height: 200px;
}
a#venue_images > img:hover {
    border: 1px solid silver;
}
div#selectImage {
    padding: 8px 1px;
}
div.vanue_image_div {
    width: 200px;
    height: 200px;
}
.errorimage{
	border:1px solid #FF0000;
}
.response_success,.response_error {
    position: absolute;
    margin: auto;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    background-color: #525050;
    width: 200px;
    height: 25px;
    z-index: 3169;
    padding: 1px 10px;
    color: whitesmoke;
}
.response_error{
	background-color:#FF0000;
}
select#selectCat {
    width: 100px;
}
.publish_button {
    margin: 5% 10%;
    float: right;
}
.publish_button > input[type=button] {
    background-color: orangered;
    border: none;
    border-radius: 5px;
    padding: 8px 10px;
    color: #FFFFFF;
    margin: 20px 0 0 25%;
    font-size: 20px;
    text-transform: capitalize;
}
.outer_div {
    background-color: rgba(0,0,0,0.5);
    width: 100%;
    height: 100%;
    position: fixed;
    z-index: 10087;
    top: 0;
}
.inner_div {
    position: absolute;
    margin: auto;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    width: 200px;
    height: 300px;
   background: url('../../../../images/ajax-loader-large.gif') center no-repeat;
    z-index: 999999;
    background-size: 100px;
}
select.time_select {
    width: 30%;
    display: none;
}
</style>


<?php $time=array('12 AM','1 AM','2 AM','3 AM','4 AM','5 AM','6 AM','7 AM','8 AM','9 AM','10 AM','11 AM','12 PM','1 PM','2 PM','3 PM','4 PM','5 PM','6 PM','7 PM','8 PM','9 PM','10 PM','11 PM');?>
<div id="content" class="span10">

    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="<?php echo base_url(); ?>index.php/admin/administration/home">Home</a> 
            <i class="icon-angle-right"></i>
        </li>
		<li><a href="<?php echo base_url(); ?>index.php/admin/administration/vanues_list">All Venues</a><i class="icon-angle-right"></i></li>
    </ul>

    <div class="row-fluid sortable">		
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon star"></i><span class="break"></span>Venues Profile</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
				<?php  //echo "<pre>"; print_r($event_vanues); echo base_url()."</pre>"; ?>
				<div class="vanue_profile_top">
					<div class="profile_image">
						<h2><a href="javascript:void;" class="venue_name"><?php echo $event_vanues[0]->venue_name; ?></a>
							<input type="text" name="venue_name"  value="" class="venue_name_field" style="display:none;"/>
						</h2>
						<a href="javascript:void;" id="venue_images">
						<?php if($event_vanues[0]->venue_image!=''){ 
						echo '<img src="'.base_url().'images/venue/'.$event_vanues[0]->venue_image.'" />';
						 }else{
						echo '<img src="'.base_url().'adminMediaStyle/img/no-image.jpg" />';
						 }?>
						 </a>
						<div id="selectImage">
						<form id="uploadimage" action="" method="post" enctype="multipart/form-data">
						<input type="hidden" id="venueId" name="venueId" value="<?php echo $this->cm->idEncrypt($event_vanues[0]->venue_id); ?>" />
						<input type="file" name="file" id="file" />
						<input type="submit" value="Upload" class="submit" />
						
						</form>
						</div>
					</div>
					<div class="profile_time_table">
						<table class="table table-striped table-bordered bootstrap-datatable datatables">
							<thead>
								<tr>
									<th></th>
									<th>Open</th>
									<th>Close</th>
								</tr>
							</thead>   
							<tbody><input type="hidden" value="<?php echo $event_vanues[0]->category_id;?>" id="cat_id" />
							   <?php $time = array('1A','2A','3A','4A','5A','6A','7A','8A','9A','10A','11A','12A','1P','2P','3P','4P','5P','6P','7P','8P','9P','10P','11P','12P');
							 	$select_list	=	'<option value="">Set</option>';
							 	foreach($time as $k => $v){
							 		$select_list	.=	'<option value="'.$v.'">'.$v.'</option>';
							 	}
							   $week	=	array('monday'=>"Monday","tuesday"=>"Tuesday","wednesday"=>"Wednesday","thursday"=>"Thursday","friday"=>"Friday","saturday"=>"Saturday","sunday"=>"Sunday");
							   foreach($week as $k=>$v){ ?>
							   	<tr>
									<td><?php echo $v; ?><input type="button"  style="float:right" class="closed" data="<?php echo $v;?>"  value="Close"></td>
									<?php if($event_vanues[0]->$k!='Closed'){$mon	=	explode("-",$event_vanues[0]->$k);}else{$mon[0]=$mon[1]='Closed';}  ?>
									<td><a href="javascript:void(0);" class="start_time"><?php echo $mon[0]; ?></a>
										<select name='<?php echo $v; ?>' class="time_select start_select">
											<?php echo $select_list; ?>
										</select>
									</td>
							   <td><a href="javascript:void(0);" class="end_time"><?php if(isset($mon[1]) && $mon[1]){ echo @$mon[1]; } else{ echo "No closing hour" ;}?></a>
										<select name='<?php echo $v; ?>' class="time_select end_select">
											<?php echo $select_list; ?>
										</select>
									</td>
								</tr>
							<?php   } ?>
							
							</tbody>
                		</table> 
					</div>
				
				</div>
				<div class="clearfix"></div>
				<div class="vanue_profile_body">
					<div class="vanue_profile_details">
						<table cellpadding="10" cellspacing="8">
						
							<tr><th><span class="vanue_d_type">Address  </span></th>
								<td><span class="vanue_d_type_value">
									<a href="javascript:void;" class="venue_name"><?php  if($event_vanues[0]->venue_address){echo $event_vanues[0]->venue_address; }
									else{
										
										//echo $event_vanues[0]->venue_city.' '.$event_vanues[0]->venue_state;
						$lat=$event_vanues[0]->venue_lat;
						$lon=$event_vanues[0]->venue_long;
   $url  = "http://maps.googleapis.com/maps/api/geocode/json?latlng=".
            $lat.",".$lon."&sensor=false";
   $json = @file_get_contents($url);
   $data = json_decode($json);
   $status = $data->status;
   $address = $event_vanues[0]->venue_city.' '.$event_vanues[0]->venue_state;
   if($status == "OK"){
      $address = $data->results[0]->formatted_address;
    }
   echo $address;
									}?></a>
							
								<input id="autocomplete" placeholder="Enter your address" value="" class="venue_name_field" style="display:none;" onFocus="geolocate()" type="text" name="venue_address"></input>
								</span></td></tr>
							<?php if(!empty($event_vanues[0]->category)){
								$cate_name	=	$event_vanues[0]->category;
							}else{
								$cate_name	=	'none';
							} ?>
							<tr><th><span class="vanue_d_type">Category  </span></th><td><span class="vanue_d_type_value"><a href="javascript:void();" class="change_venue_cat" v_id="<?php echo $this->cm->idEncrypt($event_vanues[0]->category_id); ?>" ><?php echo $cate_name; ?></a></span>
							<select id="selectCat" name="selectCat" style="display:none;" v_id="<?php echo $this->cm->idEncrypt($event_vanues[0]->venue_id); ?>">
							<option>select</option>
							</select>
							</td></tr>
							<tr><th><span class="vanue_d_type">Profile Type  </span></th>
								<td><span class="vanue_d_type_value">
									<a href="javascript:void;" class="venue_namedd"><?php if($event_vanues[0]->status=='1') echo 'Real'; else echo 'Dummy';?></a>
							<input type="text" name="venue_address"  value="" class="venue_name_fielddd" style="display:none;"/>
									</span></td></tr>
							<tr><th><span class="vanue_d_type">Rating  </span></th><td><span class="vanue_d_type_value">
							<a href="javascript:void;" class="venue_name"><?php echo $event_vanues[0]->rating;?></a>
							
								<input placeholder="" value="" class="venue_name_field" style="display:none;" type="text" name="rating"></input>
								
							
							</span></td></tr>
							<tr><th><span class="vanue_d_type">Purchase Request  </span></th><td><span class="vanue_d_type_value">
							<a href="javascript:void;" class="venue_name"><?php if(!empty($event_vanues[0]->purchase)) echo $event_vanues[0]->purchase;else echo "...";?></a>
							
								<input placeholder="" value="" class="venue_name_field" style="display:none;" type="text" name="purchase"></input>
							
							</span></td></tr>
                       </tr>
							<tr><th><span class="vanue_d_type">Open Time  </span></th><td><span class="vanue_d_type_value">
								<select id="open-time" name="open_time">
                   				<?php 
                                 foreach($time as $time){
                                 	echo '<option value="'.$time.'">'.$time.'</option>';
                                 }
                   				?>
                   				</select>
							
							</span></td></tr>

						</table>
						<div class="clearfix"></div>
					<div class="publish_button">
					<input type="button"  class="<?php if($event_vanues[0]->publish==1) { echo "success";}?>" id="publish" pub="<?php echo $event_vanues[0]->publish; ?>" value="Map" /></div>
					</div>
		
					
					<div class="vanue_event_details">
				<div class="browser view">
				
              <label class="control-label" for="eventArtist"><b>Browser City</b></label>
              <div class="controls">

              	<input type="hidden" name="venue_id" class="venue_id" value="<?php echo $event_vanues[0]->venue_id; ?>"/>

                <input type="text" placeholder="Enter city name" autocomplete="off" id="artistName" value="" name="artistName" label="artist name">
              </div>
			  <input type="button"  class="" id="savecity"  value="Save" />
              <?php if($event_vanues[0]->is_home_city){
				  $browser_city= explode(',',$event_vanues[0]->is_home_city);
				  foreach($browser_city as $city){
					  echo '<h5>'.$city.'</h5>';
				  }
			  }?>
            </div>
						<h2 class="event_title">Events</h2>
						<?php if(!empty($event_vanues['events'])){ 
						foreach($event_vanues['events'] as $key ){ 
						?>
						<div class=""><?php 
						if($key->event_type==1){
							$types	=	"true";
							//$time=	date("h:i A",strtotime($key->event_time)); 
							$time=$key->event_time;  
							
							$event_nm=$key->event_name; 
						}else{ 
							$types	=	"Dummy"; 
							$day 	=	strtolower(date("l",strtotime($key->event_date)));
							//print_r($event_vanues);
							$time=	$event_vanues[0]->$day; 
							if($time!='Closed'){
								$mon	=	explode("-",$time);
								$timestring	=	"From ".@$mon[0]." To ".@$mon[1];
							}else{
								$mon[0]=$mon[1]='Closed';
								$timestring	=	'Closed';
							}
							$event_nm=date("l",strtotime($key->event_date))." @ ".$event_vanues[0]->venue_name;
						} 
						?>
							<div class="event_images"><img src="<?php echo base_url(); ?>adminMediaStyle/img/no-image.jpg" alt="event_image" /></div>
							<div class="event_details">
								<ul>
									<li>Event Name : <?php if($key->event_name!='') echo $event_nm; else echo "not available";?></li>
									<!--<li>Artist : <?php if($key->artist_name!='') echo $key->artist_name; else echo "not available";?></li>-->
									<!--<li>Date : <?php echo date("d-m-Y",strtotime($key->event_date));  ?></li>-->
									<li>Date : <?php echo $key->event_date;  ?></li>

									<li>Time : <?php echo $time;?></li>
									<li>Type : <?php echo $types; ?></li>
								</ul>
							</div>
							
						</div>
						<?php //if(! array_keys(end($event_vanues['events']))==array_keys($key)){ ?>
						<div class="divider"></div>
						<?php  } } else {?>
						<div>No Events</div>
						<?php }?>
					</div>
				</div>
			</div>
        </div><!--/span-->

    </div><!--/row-->

</div><!--/.fluid-container-->
<script type="text/javascript">
jQuery(document).ready(function($){
	$(".change_venue_cat").on("click",function(){
	var current		=	$(this);

		$.ajax({
				url: "<?php echo base_url()."index.php/admin/administration/getVenueCategory"; ?>", 
				type: "POST",             
				data:{cat_id:current.attr('v_id')},        
				cache: false,                    
				success: function(data){
					if(data!=''){
						$("#selectCat").html(data);
						current.hide();
						$("#selectCat").show();
					}
				}
			});
	});
	$("#uploadimage").on('submit',function(e) {
		e.preventDefault();
		var formdata	=	 new FormData(this);
		//console.log(formdata);
		var file	=	$("#file").val();
		$("#uniform-file").removeClass("errorimage");
		if(file){	
			$.ajax({
				url: "<?php echo base_url()."index.php/admin/administration/vanues_imageUpload"; ?>", 
				type: "POST",             
				data:formdata, 
				contentType: false,       
				cache: false,             
				processData:false,    
				beforeSend: function() {
				    $("body").append("<div class='outer_div'></div><div class='inner_div'></div>");
				},      
				success: function(data){
				//alert(data);
				$(".outer_div,.inner_div").remove(); 
					var obj = jQuery.parseJSON( data );
					if(obj.status==1){
						$("a#venue_images img").prop("src","<?php echo base_url()."images/venue/"; ?>"+obj.uploaded_file);
						$("body").append("<div class='response_success'>"+obj.message+"</div>");
						setTimeout(function(){$(".response_success").remove();},1000);
					}else{
						$("body").append("<div class='response_error'>"+obj.message+"</div>");
						setTimeout(function(){$(".response_success").remove();},1000);
					} 
				}
			});
		}else{
			$("#uniform-file").addClass("errorimage");
		}	
	});//change_venue_cat
	$("body").on("change","#selectCat",function(){
		var current		=	$(this);
			$.ajax({
				url: "<?php echo base_url()."index.php/admin/administration/update_venue_category"; ?>", 
				type: "POST",             
				data:{'cat_id':current.val(),'id':current.attr('v_id')},      
				cache: false,  
				 beforeSend: function() {
				    $("body").append("<div class='outer_div'></div><div class='inner_div'></div>");
				},                   
				success: function(data){
					$(".outer_div,.inner_div").remove();
					var obj	=	$.parseJSON(data);
					$("a.change_venue_cat").text(obj.category)
					$("a.change_venue_cat").attr({'v_id':obj.category_id});
					current.hide();
					$("a.change_venue_cat").show();
					$(".profile_time_table").html(obj.category_time); 
				}
			});
	});
	$("body").on("click","#publish",function(){
		var current		=	$(this);
		var venueId		=	$("input#venueId").val();
		
			$.ajax({
				url: "<?php echo base_url()."index.php/admin/administration/update_venue_status"; ?>", 
				type: "POST",             
				data:{'venueid':venueId,'status':current.attr('pub')},      
				cache: false,        
				 beforeSend: function() {
				    $("body").append("<div class='outer_div'></div><div class='inner_div'></div>");
				},               
				success: function(data){
					$(".outer_div,.inner_div").remove();
					if(data==1){
						current.attr('pub',1);
						current.addClass('success');

					}else if(data==0){
						current.attr('pub',0);
						current.removeClass('success');
					}
				}
			});
	});//,
	$("body").on("click",".start_time, .end_time",function(){
		var current		=	$(this);
		$(".start_select, .end_select").hide();
		current.next().show();
		current.hide();
	});
	$("body").on("change",".time_select",function(){
		var current		=	$(this);
		var cat 		=	$("#cat_id").val();
		var col		=	current.attr("name");	
		var status 	=	'';
		if(current.hasClass("start_select")){
			status   	=	"start";
		}else if(current.hasClass("end_select")){
			status   	=	"end";
		}
		$.ajax({
			url: "<?php echo base_url()."index.php/admin/administration/update_venue_categoryTime"; ?>", 
			type: "POST",             
			data:{id:cat,'col':col,'status':status,value:current.val(),venue_id:'<?php echo $event_vanues[0]->venue_id; ?>'},      
			cache: false,        
			 beforeSend: function() {
			    $("body").append("<div class='outer_div'></div><div class='inner_div'></div>");
			},               
			success: function(data){
				$(".outer_div,.inner_div").remove();
				if(data!=0){
					current.prev().text(data);
				}
				//
				current.prev().show();
				current.hide();
			}
		});
	});
	
	
	$("body").on("click",".closed",function(){
		var current		=	$(this);
		var col		=	current.attr("data");	
		var status 	=	'';
		
		$.ajax({
			url: "<?php echo base_url()."index.php/admin/administration/update_venue_categoryTime"; ?>", 
			type: "POST",             
			data:{col:col,closed:'1',venue_id:'<?php echo $event_vanues[0]->venue_id; ?>'},      
			cache: false,        
			// beforeSend: function() {
			  //  $("body").append("<div class='outer_div'></div><div class='inner_div'></div>");
			//},               
			success: function(data){
				$(".outer_div,.inner_div").remove();
				if(data!=0){
					//current.prev().text(data);
				}
				//
				location.reload();
				//current.prev().show();
				//current.hide();
			}
		});
	});
	
	
	$(".venue_name").on("click",function(){
		var cur 	= $(this);
		cur.next().val(cur.text());
		cur.next().show();
		cur.next().focus();
		cur.hide();
	});
	$(".venue_name_field").on("keydown",function(e){
		var cur=	$(this);
		
		if(e.keyCode == 13){
			var venueId		=	$("input#venueId").val();
        	$.ajax({
			url: "<?php echo base_url()."index.php/admin/administration/update_venue_name"; ?>", 
			type: "POST",             
			data:{id:venueId,'name':cur.val(),"field":cur.attr("name")},      
			cache: false,        
			 beforeSend: function() {
			    $("body").append("<div class='outer_div'></div><div class='inner_div'></div>");
			},               
			success: function(data){
				$(".outer_div,.inner_div").remove();
				cur.prev().text(data);
				cur.prev().show();
				cur.hide();
			}
		});
    	}
	});
	
	///// city search
	
	$('#artistName').on('keyup',function(e) {
		var code = e.which; 
		if(code==13)e.preventDefault();
		if(code==13||code==188||code==186){
			var current	=	$(this);
			if(current.val()!='') {
				$('#artistName').after('<span class="tag"><input type="hidden" value="'+ current.val() +'" name=newArtistId[] />'+ current.val() +'</span>');
				current.val('');
			}
			$(".vanue_sugestion").remove();
		}else{ 
			var current	=	$(this);
			if(current.val()!=""){
			$.ajax({
				url: "<?php echo base_url()."index.php/admin/administration/getcitySuggestion"; ?>", 
				type: "POST",             
				data:{like:current.val(),type:''},        
				cache: false,                    
				success: function(data){
					$(".vanue_sugestion").remove();
					current.parent().append('<div class="vanue_sugestion">'+data+'</div>');
				}
			});
			}else{
				$(".vanue_sugestion").remove();
			}
		}
    });
	$("body").on("click",".addArtistName",function(){
		var cur 	=	$(this);
		var vals =	cur.text();
		var vId 	=	cur.attr("vid");
		if(vals) {
			$('#artistName').after('<span class="tag"><input type="hidden" value="'+vId+'" name=artistId[] class="cityarray"/>'+ vals +'</span>');
		}
		$('#artistName').val('');
		//$('#artistName').attr("vid",vId);
		$(".vanue_sugestion").remove();
	});
	///end
	$("body").on("click","#savecity",function(){
        var cityid ={};
		var current		=	$(this);
		//var cityid		=	$(".cityarray").val();
		 var venue_id= $(".venue_id").val();
		 var i=1;
		  $(".cityarray" ).each(function( index ) {
		   cityid[i]=	$(this).val();
		   i++;
          });
			$.ajax({
				url: "<?php echo base_url()."index.php/admin/administration/update_venue_city"; ?>", 
				type: "POST",             
				data:{'cityid':cityid,'venue_id':venue_id},      
				cache: false,        
				 beforeSend: function() {
				    $("body").append("<div class='outer_div'></div><div class='inner_div'></div>");
				},               
				success: function(data){
					$(".outer_div,.inner_div").remove();
			        alert('City for browser view updated.')
					 location.reload(); 
				}
			});
	});	
	
	 $('body').on('click','.tag',function(){
     $(this).remove(); 
  });
});
</script>
 <script>
// This example displays an address form, using the autocomplete feature
// of the Google Places API to help users fill in the information.

var placeSearch, autocomplete;
var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  postal_code: 'short_name'
};

function initAutocomplete() {
  // Create the autocomplete object, restricting the search to geographical
  // location types.
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
      {types: ['geocode']});

  // When the user selects an address from the dropdown, populate the address
  // fields in the form.
  autocomplete.addListener('place_changed', fillInAddress);
}

// [START region_fillform]
function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  //for (var component in componentForm) {
    //document.getElementById(component).value = '';
    //document.getElementById(component).disabled = false;
  //}

  // Get each component of the address from the place details
  // and fill the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
	  //console.log(val);
      document.getElementById(addressType).value = val;
    }
  }
}
// [END region_fillform]

// [START region_geolocation]
// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      var circle = new google.maps.Circle({
        center: geolocation,
        radius: position.coords.accuracy
      });
      autocomplete.setBounds(circle.getBounds());
    });
  }
}
// [END region_geolocation]

    </script>
	 <!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>-->
   <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places&callback=initAutocomplete"
        async defer></script>
  