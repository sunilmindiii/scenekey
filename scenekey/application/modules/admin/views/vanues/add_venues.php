<!-- start: Content -->
 
<div id="content" class="span10">
  <ul class="breadcrumb">
    <li> <i class="icon-home"></i> <a href="<?php echo base_url(); ?>locations/home">Home</a> <i class="icon-angle-right"></i> </li>
    <li> <i class="icon-reorder"></i> <a href="<?php echo base_url(); ?>index.php/admin/administration/vanues_list">All Venues</a> <i class="icon-angle-right"></i> </li>
    <li> <i class="icon-edit"></i> <a href="#">Add New Venue</a> </li>
  </ul>
  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header" data-original-title>
        <h2><i class="halflings-icon edit"></i><span class="break"></span>Add Venue</h2>
        <div class="box-icon"> <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a> <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a> <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a> </div>
      </div>
      <div class="box-content">
        <form class="form-horizontal" method="post" enctype="multipart/form-data" id="vanueForm" parsley-validate>
          <fieldset>
            <div class="control-group">
              <label class="control-label" for="vanueName">Venue Name<span class="required-field-color">*</span></label>
              <div class="controls">
                <input class="input-xlarge focused" id="focusedInput" type="text" name="venue[venue_name]" parsley-required="true" label="vanue name">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="vanueShortName">Venue Short Name</label>
              <div class="controls">
                <input class="input-xlarge focused" id="focusedInput" type="text" name="venue[venue_short_name]" >
              </div>
            </div>
            <div class="control-group">
			<?php //print_r($this->data['vanues_category']); ?>
              <label class="control-label" for="vanueCategoryName">Venue Category Name<span class="required-field-color">*</span></label>
              <div class="controls">
                <select id="" name="venue[venue_category_id]" label="vanue category name" parsley-required="true">
                  <option value="">Select Category</option>
                  <?php foreach ($this->data['vanues_category'] as $row) { ?>
                  <option value="<?php echo $row->category_id; ?>"><?php echo $row->category; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="vanueImage">Venue Image</label>
              <div class="controls">
                <input class="input-xlarge focused" id="focusedInput" type="file" name="venue_image">
              </div>
            </div>
			
			
			<div class="control-group">
              <label class="control-label" for="vanueImage">Venue City</label>
              <div class="controls">
                <input type="text" placeholder="Enter city name" autocomplete="off" id="artistName" value="" name="artistName" label="artist name">
              </div>
            </div>
			
			 <div class="control-group">
              <label class="control-label" for="vanueImage">Search Address</label>
		
              <div class="controls">
	        <input id="autocomplete" placeholder="Enter your address"
             onFocus="geolocate()" type="text" name="vanue" style="width:90%;"></input>              </div>
            </div>
			 <div class="control-group">
              <label class="control-label" for="vanueImage">Event Address</label>
		
              <div class="controls">
					<table id="address">
						  <tr>
							<td class="slimField"><input class="field" id="street_number" name="address[]"
								  disabled="true"></input></td>
							<td class="wideField" colspan="2"><input class="field" id="route"
								  disabled="true" name="address[]"></input></td>
						  </tr> 
					</table>	  
			 </div>
			 </div>
			 <div class="control-group">
              <label class="control-label" for="vanueImage">City</label>
		
              <div class="controls">
			   <input class="field" id="locality" name="venue[venue_city]"
              disabled="true"></input>
	          </div>
            </div>
		    <div class="control-group">
              <label class="control-label" for="vanueImage">State</label>
		
              <div class="controls">
	        <input class="field" id="administrative_area_level_1" disabled="true" name="venue[venue_state]"></input></div>
            </div>
			<div class="control-group" style="display:none;">
              <label class="control-label" for="vanueImage">Zip code</label>
		
              <div class="controls">
	        <input class="field" id="postal_code"
              disabled="true"></input></div>
            </div>
			<div class="control-group">
              <label class="control-label" for="vanueImage">Country</label>
		
              <div class="controls">
	        <input class="field"
              id="country" disabled="true" name="venue[venue_country]"></input></div>
            </div>
			
			  <div class="form-actions">
              <input type="submit" name="submit" class="btn btn-primary" value="Save"/>
              <button class="btn">Cancel</button>
            </div>
            </div>

 


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

  for (var component in componentForm) {
    document.getElementById(component).value = '';
    document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details
  // and fill the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
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
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCKpfnLn74Hi2GBmTdmsZMJORZ5xyL1as&v=3.exp&sensor=false&libraries=places&callback=initAutocomplete"
        async defer></script>
  </body>
</html>
<script type="text/javascript">
$(document).ready(function($){

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
	 $('body').on('click','.tag',function(){
     $(this).remove(); 
  });
	});
	</script>
<!--/.fluid-container-->

<?php //$this->load->view('countryStateCity.php'); ?>
