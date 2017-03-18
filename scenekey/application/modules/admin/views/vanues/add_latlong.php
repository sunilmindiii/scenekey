<!-- start: Content -->
 
<div id="content" class="span10">
  <ul class="breadcrumb">
    <li> <i class="icon-home"></i> <a href="<?php echo base_url(); ?>locations/home">Home</a> <i class="icon-angle-right"></i> </li>
    <li> <i class="icon-reorder"></i> <a href="<?php echo base_url(); ?>index.php/admin/administration/vanues_list">All Venues</a> <i class="icon-angle-right"></i> </li>
    <li> <i class="icon-edit"></i> <a href="#">Adding Latitude & Longitude</a> </li>
  </ul>
  <div class="row-fluid sortable">
    <div class="box span12">
<?php if ($this->session->flashdata('msg')) { ?>
        <div class="alert alert-success"> <?php echo $this->session->flashdata('msg') ?> </div>
    <?php } ?>   

	<div class="box-content">
        <form class="form-horizontal" method="post" enctype="multipart/form-data" id="vanueForm" parsley-validate>
          <fieldset>
            <div class="control-group">
              <label class="control-label" for="vanueName">Latitude<span class="required-field-color">*</span></label>
              <div class="controls">
                <input class="input-xlarge focused" id="focusedInput" type="text" name="lati" parsley-required="true" label="Latitude">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="vanueShortName">Longitude<span class="required-field-color">*</span></label>
              <div class="controls">
                <input class="input-xlarge focused" id="focusedInput" type="text" name="longi" parsley-required="true" label="Longitude">
              </div>
            </div>

			  <div class="form-actions">
              <input type="submit" name="submit" class="btn btn-primary" value="Save"/>
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
   <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places&callback=initAutocomplete"
        async defer></script>
  </body>
</html>
<script type="text/javascript">
$(document).ready(function($){


	});
	</script>
<!--/.fluid-container-->

<?php //$this->load->view('countryStateCity.php'); ?>