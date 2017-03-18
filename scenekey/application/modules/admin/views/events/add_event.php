<!-- start: Content -->
<style>
div.vanue_sugestion {
    position: absolute;
    max-height: 250px;
    border: 1px solid whitesmoke;
    width: 220px;
    border-top: 0;
	overflow:auto;
}
div.vanue_sugestion ul {
    padding: 0;
    background-color: thistle;
    margin: 0px;
}
div.vanue_sugestion ul li {
    background-color: whitesmoke;
    list-style: none;
    margin: 1px 0 0 0;
    padding: 0px;
    font-weight: 300;
}
span.tag{
    cursor: pointer;
    color: #fff;
    background: rgba(102, 129, 153, 0.63);
    padding: 5px;
    padding-right: 25px;
    margin: 4px;
}
span.tag:hover{
  opacity:0.7;
}
span.tag:after{
 position:absolute;
 content:"x";
 border:1px solid;
 padding:0 4px;
 margin:3px 0 10px 5px;
 font-size:10px;
}
</style>
<link rel="stylesheet" href="<?php echo base_url();?>css/jquery-ui.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>css/jquery.timepicker.css">
<script src="<?php echo base_url();?>js/jquery-ui.min.js"></script>
<script src="<?php echo base_url();?>js/jquery.timepicker.min.js"></script>

<div id="content" class="span10">
  <ul class="breadcrumb">
    <li> <i class="icon-home"></i> <a href="<?php echo base_url(); ?>locations/home">Home</a> <i class="icon-angle-right"></i> </li>
    <li> <i class="icon-reorder"></i> <a href="<?php echo base_url(); ?>admin/administration/all_events">All Events</a> <i class="icon-angle-right"></i> </li>
    <li> <i class="icon-edit"></i> <a href="#">Add New Event</a> </li>
  </ul>
  <div class="row-fluid sortable">
    <div class="box span12">
      <div class="box-header" data-original-title>
        <h2><i class="halflings-icon edit"></i><span class="break"></span>Add Event</h2>
        <div class="box-icon"> <a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a> <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a> <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a> </div>
      </div>
      <div class="box-content">
        <form class="form-horizontal" method="post" name="addNewEvent" parsley-validate>
          <fieldset>
		  <div class="control-group">
              <label class="control-label" for="eventVanue">Event Vanue <span class="required-field-color">*</span></label>
              <div class="controls">
                <input type="text" autocomplete="off" id="evanue" name="vanueName" label="vanue name" parsley-required="true">
              </div>
            </div>
			<div class="control-group">
              <label class="control-label" for="eventArtist">Event Artist</label>
              <div class="controls">
                <input type="text" autocomplete="off" id="artistName" name="artistName" label="artist name">
              </div>
            </div>
			<div class="control-group">
              <label class="control-label" for="eventArtist">Event Promoter</label>
              <div class="controls">
                <input type="text" autocomplete="off" id="promoterName" name="promoterName"  label="promoter name" >
              
              </div>
            </div>
			<div class="control-group">
              <label class="control-label" for="eventDate">Event Date <span class="required-field-color">*</span></label>
              <div class="controls">
                <input id="eventDate" type="text" name="eventDate" parsley-required="true" label="event date">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="eventTime">Event Time <span class="required-field-color">*</span></label>
              <div class="controls">
                <input  id="eventTime" type="text" parsley-required="true" label="event time" name="eventTime">
              </div>
            </div>
			<div class="control-group">
              <label class="control-label" for="duration">Duration <span class="required-field-color">*</span></label>
              <div class="controls">
                <input id="duration" type="text" parsley-required="true" label="event duration" name="duration">
              </div>
            </div>
			<div class="control-group">
              <label class="control-label" for="eventVanue">Event Category <span class="required-field-color">*</span></label>
              <div class="controls">
                <input type="text" autocomplete="off" id="ecategory" name="eventCategory" label="event category" parsley-required="true">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="eventName">Event Name <span class="required-field-color">*</span></label>
              <div class="controls">
                <input id="focusedInput" type="text" name="eventName" parsley-required="true" label="event name">
              </div>
            </div>
			
           <?php /* <div class="control-group">
              <label class="control-label" for="eventImage">Event Image</label>
              <div class="controls">
                <input class="input-xlarge focused" id="focusedInput" type="file" name="eventImage">
              </div>
            </div> */?>
            <div class="form-actions">
              <input type="submit" name="submit" class="btn btn-primary" value="Save"/>
              <button class="btn">Cancel</button>
            </div>
          </fieldset>
        </form>
      </div>
    </div>
	
    <!--/span--> 
    
  </div>
  <!--/row--> 
  
</div>
<!--/.fluid-container-->
<script type="text/javascript">
jQuery(document).ready(function($){
	$( "#eventDate" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'yy-mm-dd' 
    }); 
	 //$('#eventTime').timepicker();
	 $('#eventTime').timepicker({
		showPeriod: true,
		showLeadingZero: true
	});
	$('#evanue').on('keyup',function(event) {
		var current	=	$(this);
		if(current.val()!=""){
        $.ajax({
			url: "<?php echo base_url()."index.php/admin/administration/getVenueNameSuggestion"; ?>", 
			type: "POST",             
			data:{like:current.val()},        
			cache: false,                    
			success: function(data){
				$(".vanue_sugestion").remove();
				current.parent().append('<div class="vanue_sugestion">'+data+'</div>');
			}
		});
		}else{
			$(".vanue_sugestion").remove();
		}
    });
	$("body").on("click",".addVanueName",function(){
		var cur 	=	$(this);
		var vals =	cur.text();
		var vId 	=	cur.attr("vid");
		$('#evanue').val(vals);
		$('#evanue').after('<input type="hidden" value="'+vId+'" name="vanue_id" />');
		$(".vanue_sugestion").remove();
	});
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
				url: "<?php echo base_url()."index.php/admin/administration/getArtistSuggestion"; ?>", 
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
			$('#artistName').after('<span class="tag"><input type="hidden" value="'+vId+'" name=artistId[] />'+ vals +'</span>');
		}
		$('#artistName').val('');
		//$('#artistName').attr("vid",vId);
		$(".vanue_sugestion").remove();
	}); 
	$('#promoterName').on('keyup',function(e) {
		var code = e.which; 
		if(code==13)e.preventDefault();
		if(code==13||code==188||code==186){
			var current	=	$(this);
			if(current.val()!='') {
				$('#promoterName').after('<span class="tag"><input type="hidden" value="'+ current.val() +'" name=newPromoterId[] />'+ current.val() +'</span>');
				current.val('');
			}
			$(".vanue_sugestion").remove();
		}else{ 
			var current	=	$(this);
			if(current.val()!=""){
			$.ajax({
				url: "<?php echo base_url()."index.php/admin/administration/getPromoterSuggestion"; ?>", 
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
	$("body").on("click",".addPromoterName",function(){
		var cur 	=	$(this);
		var vals =	cur.text();
		var vId 	=	cur.attr("vid");
		if(vals) {
			$('#promoterName').after('<span class="tag"><input type="hidden" value="'+vId+'" name=promoterId[] />'+ vals +'</span>');
		}
		$('#promoterName').val('');
		//$('#artistName').attr("vid",vId);
		$(".vanue_sugestion").remove();
	}); 
	$('#ecategory').on('keyup',function(event) {
		var current	=	$(this);
		if(current.val()!=""){
        $.ajax({
			url: "<?php echo base_url()."index.php/admin/administration/getEventCategory"; ?>", 
			type: "POST",             
			data:{like:current.val()},        
			cache: false,                    
			success: function(data){
				$(".vanue_sugestion").remove();
				current.parent().append('<div class="vanue_sugestion">'+data+'</div>');
			}
		});
		}else{
			$(".vanue_sugestion").remove();
		}
    });
	$("body").on("click",".addCategory",function(){
		var cur 	=	$(this);
		var vals =	cur.text();
		var vId 	=	cur.attr("vid");
		$('#ecategory').val(vals);
		$('#ecategory').after('<input type="hidden" value="'+vId+'" name="event_category_id" />');
		$('#ecategory').attr("value",vId);
		$(".vanue_sugestion").remove();
	});
  
  $('body').on('click','.tag',function(){
     $(this).remove(); 
  });
});
</script>	
<?php //$this->load->view('countryStateCity.php'); ?>
